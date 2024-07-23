<?php

namespace App\Livewire\Bidang;

use App\Models\Bidang;
use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Detail extends Component
{
    use LivewireAlert;
    public $bidangId;
    public $role;
    public array $image = [];

    public $selectedJabatan;
    public $confirmDeletion = false;

    public $name;
    public $notlpn;
    public $email;
    public $password;
    public $model_user;
    public function mount($id)
    {
        $this->bidangId = $id;
    }
    public function add($jabatan)
    {
        $this->selectedJabatan = $jabatan;
        if ($this->selectedJabatan == 'Kepala') {
            $this->role = 'subkabib';
        } elseif ($this->selectedJabatan == 'Kepala Seksi') {
            $this->role = 'kasi';
        } else {
            $this->role = 'staffBagian';
        }
        $this->dispatch('show-modal-add');
    }
    public function saves()
    {


        // Validasi input
        $this->validate([
            'name' => 'required|max:255',
            'notlpn' => 'required',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6|max:255',
        ]);

        DB::beginTransaction();
        try {
            $validatedData = [
                'name' => $this->name,
                'notlpn' => $this->notlpn,
                'email' => $this->email,
                'password' => bcrypt($this->password), // Hash password
            ];
            if ($this->image) {
                foreach ($this->image as $file) {
                    $validatedData['avatar'] = $file['name'];
                    Storage::putFileAs('public/avatars', new File($file['path']), $validatedData['avatar']);
                }
            }
            $user = User::create($validatedData);
            $user->assignRole($this->role);
            Jabatan::create(['alias' => strtoupper($this->role), 'name' => $this->selectedJabatan, 'bidang_id' => $this->bidangId, 'user_id' => $user->id]);
            DB::commit();
            // Reset properti
            $this->reset(['name', 'email', 'notlpn', 'password', 'image']);
            $this->alert('success', 'Pengguna berhasil dibuat.', [
                'position' => 'top',
                'timer' => 2000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
            $this->dispatch('hide-form');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            $this->dispatch('hide-form');
            $this->alert('success', 'Failed to save Surat Masuk.', [
                'position' => 'top',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        }
    }

    public function edit($userId)
    {
        // dd($userId);/
        $this->selectedJabatan = 'EDIT';
        $this->model_user = User::where('id',  $userId)->first();
        $this->name = $this->model_user->name;
        $this->email = $this->model_user->email;
        $this->notlpn = $this->model_user->notlpn;

        $this->dispatch('show-modal-add');
    }
    public function update()
    {
        // Validasi input
        $this->validate([
            'name' => 'required|max:255',
            'notlpn' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->model_user->id,
        ]);

        DB::beginTransaction();
        try {
            // dd($user);
            $validatedData = [
                'name' => $this->name,
                'notlpn' => $this->notlpn,
                'email' => $this->email,
            ];
            if ($this->password) {
                $validatedData['password'] = bcrypt($this->password);
            }
            if ($this->image) {
                foreach ($this->image as $file) {
                    $validatedData['avatar'] = $file['name'];
                    Storage::putFileAs('public/avatars', new File($file['path']), $validatedData['avatar']);
                }
            }
            $this->model_user->update($validatedData);
            DB::commit();
            // Reset properti
            $this->reset(['name', 'email', 'notlpn', 'password', 'image']);
            $this->alert('success', 'Pengguna berhasil dibuat.', [
                'position' => 'top',
                'timer' => 2000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
            $this->dispatch('hide-form');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            $this->dispatch('hide-form');
            $this->alert('success', 'Failed to save Surat Masuk.', [
                'position' => 'top',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        }
    }
    public function deleteBidang()
    {
        if ($this->confirmDeletion) {
            // Logika untuk menghapus bidang
            // Temukan bidang yang akan dihapus
            $bidang = Bidang::findOrFail($this->bidangId);

            // Hapus pengguna yang terkait dengan bidang tersebut
            foreach ($bidang->jabatans as $jabatan) {
                $jabatan->user()->delete();
            }

            // Hapus bidang
            $bidang->delete();
            // Reset properti
            $this->confirmDeletion = false;

            $this->alert('success', 'Delete Bidang successfully.', [
                'position' => 'top',
                'timer' => 2000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
            return redirect()->route('bidang.index');
        }
    }
    public function getDetailBidangProperty()
    {
        return Bidang::with(['kepalaBidang.user', 'kepalaSeksi.user', 'staff.user'])
            ->where('id', $this->bidangId)
            ->firstOrFail();
    }
    public function render()
    {
        return view('livewire.bidang.detail', ['bidang' => $this->detail_bidang]);
    }
}

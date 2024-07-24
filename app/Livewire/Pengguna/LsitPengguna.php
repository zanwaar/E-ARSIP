<?php

namespace App\Livewire\Pengguna;

use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class LsitPengguna extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $model_user; // Default value
    public $name;
    public $notlpn;
    public $email;
    public $password;
    public $selectedJabatan = 'ALL'; // Default value
    protected $paginationTheme = 'bootstrap';
    public $searchTerm = null;
    public array $image = [];

    protected $queryString = ['searchTerm' => ['except' => '']];
    public function filterByJabatan($jabatan)
    {
        $this->selectedJabatan = $jabatan;
        $this->resetPage(); // Reset pagination when filter changes
    }
    public function add($user)
    {
        $this->model_user = User::where('id',  $user)->first();
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
    public function getUsersProperty()
    {
        $query = User::with(['jabatans.bidang'])
            ->where('id', '<>', 1)
            ->where('id', '<>', 2)
            ->where('name', 'like', '%' . $this->searchTerm . '%');

        if ($this->selectedJabatan !== 'ALL') {
            $query->whereHas('jabatans', function ($q) {
                $q->where('alias', $this->selectedJabatan);
            });
        }

        return $query->latest()->paginate(10);
    }

    public function render()
    {

        return view('livewire.pengguna.lsit-pengguna', ['users' => $this->users]);
    }
}

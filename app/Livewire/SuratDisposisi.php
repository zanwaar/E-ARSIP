<?php

namespace App\Livewire;

use App\Livewire\Components\Sidebar;
use App\Models\Disposisi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class SuratDisposisi extends Component
{
    use LivewireAlert;
    public $idSuratMasuk;
    public $idDisposisi;
    public $user_id;
    public $user_id_bidang_id;
    public $isi;
    public function add($id)
    {
        // dd($id);
        $this->idSuratMasuk = $id['surat_masuk']['id'];
        $this->idDisposisi = $id['id'];
        $this->dispatch('show-modal-add');
    }
    public function addTask()
    {
        $this->validate([
            'idDisposisi' => 'required',
            'isi' => 'required',
        ]);
        // dd($this->user_id);
        DB::beginTransaction();
        try {
            Disposisi::where('id', $this->idDisposisi)->update([
                'is_read' => true,
            ]);
            $authUser = auth()->user();
            $authRole = $authUser->jabatans->alias ?? null;

            // Cek jabatan pengguna
            if ($authRole  == 'Kasi') {
                // Jika jabatan adalah 'Kasi', masukkan bidang_id
                Disposisi::create([
                    'surat_masuk_id' => $this->idSuratMasuk,
                    'user_id' => $this->user_id,
                    'isi_disposisi' => $this->isi,
                    'bidang_id' => $authUser->jabatans->bidang->id,
                    'is_read' => true,
                ]);
            } else {
                // Jika bukan 'Kasi', maka bidang_id null
                Disposisi::create([
                    'surat_masuk_id' => $this->idSuratMasuk,
                    'user_id' => $this->user_id,
                    'isi_disposisi' => $this->isi,
                    'bidang_id' => null,
                ]);
            }
            $this->dispatch('update-count')->to(Sidebar::class);
            $this->dispatch('hide-form');
            $this->alert('success', 'Surat Disposisi Telah Dibuat', [
                'position' => 'top',
                'timer' => 5000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
            $this->reset();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function getDisposisisProperty()
    {
        // $user = User::with('jabatans.bidang')->where('id', auth()->user()->id)->first();
        $user = Auth::user();
        // $bidang = 0;
        // dd($user->jabatans->bidang->id);



        if ($user->jabatans->alias == 'Staff') {
            $disposisi = Disposisi::with(['suratMasuk.dokuments'])
                ->where('bidang_id', $user->jabatans->bidang->id)
                ->latest()
                ->paginate(5);
        } else {
            $disposisi = Disposisi::with(['suratMasuk.dokuments'])
                ->where('user_id', $user->id)
                ->latest()
                ->paginate(5);
        }

        return $disposisi;
    }
    public function render()
    {
        return view('livewire.surat-disposisi', ['suratDisposisi' => $this->disposisis]);
    }
}

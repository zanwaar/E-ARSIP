<?php

namespace App\Livewire\Pengguna;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Profile extends Component
{
    use LivewireAlert;
    public $modelUser;
    public $name;
    public $notlpn;
    public $email;
    public array $image = [];
    public function mount()
    {
        $this->modelUser = Auth()->user();
        $this->name = $this->modelUser->name;
        $this->notlpn = $this->modelUser->notlpn;
        $this->email = $this->modelUser->email;
    }
    public function add()
    {

        $this->dispatch('show-modal-add');
    }
    public function update_profile()
    {
        DB::beginTransaction();
        try {
            if ($this->image) {
                foreach ($this->image as $file) {
                    $validatedData['avatar'] = $file['name'];
                    Storage::putFileAs('public/avatars', new File($file['path']), $validatedData['avatar']);
                }
            }
            $this->modelUser->update($validatedData);
            DB::commit();
            // Reset properti
            $this->reset(['image']);
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
    public function update()
    {
        // Validasi input
        $this->validate([
            'name' => 'required|max:255',
            'notlpn' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->modelUser->id,
        ]);

        DB::beginTransaction();
        try {
            // dd($user);
            $validatedData = [
                'name' => $this->name,
                'notlpn' => $this->notlpn,
                'email' => $this->email,
            ];
            $this->modelUser->update($validatedData);
            DB::commit();
            // Reset properti

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
    public function render()
    {
        return view('livewire.pengguna.profile');
    }
}

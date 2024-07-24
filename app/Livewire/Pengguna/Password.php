<?php

namespace App\Livewire\Pengguna;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Password extends Component
{
    use LivewireAlert;
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    protected $rules = [
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ];

    public function updatePassword()
    {
        $this->validate();

        // Check if the current password matches
        if (!Hash::check($this->current_password, Auth::user()->password)) {
            $this->addError('current_password', 'The current password is incorrect.');
            return;
        }

        // Update the password
        Auth::user()->update(['password' => Hash::make($this->new_password)]);

        $this->alert('success', 'Password successfully updated', [
            'position' => 'top',
            'timer' => 2000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }
    public function render()
    {
        return view('livewire.pengguna.password');
    }
}

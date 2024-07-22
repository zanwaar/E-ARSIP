<?php

namespace App\Livewire\Pengguna;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class LsitPengguna extends Component
{
    use WithPagination;
    use LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

    public function getUsersProperty()
    {
        return User::with(['jabatans.bidang'])
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->latest()
            ->paginate(10);
    }
    public function render()
    {
      
        return view('livewire.pengguna.lsit-pengguna', ['users' => $this->users]);
    }
}

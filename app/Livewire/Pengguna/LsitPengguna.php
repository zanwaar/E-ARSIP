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
    public $selectedJabatan = 'ALL'; // Default value
    protected $paginationTheme = 'bootstrap';
    public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];
    public function filterByJabatan($jabatan)
    {
        $this->selectedJabatan = $jabatan;
        $this->resetPage(); // Reset pagination when filter changes
    }

    public function getUsersProperty()
    {
        $query = User::with(['jabatans.bidang'])
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

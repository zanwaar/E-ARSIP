<?php

namespace App\Livewire\Jabatan;

use App\Models\Jabatan;
use App\Models\Jabatans;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ListJabatan extends Component
{
    use WithPagination;
    use LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    public $idBeingRemoved = null;
    public $mbidang = [];
    public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];
    public function getJabatanProperty()
    {
        return Jabatan::latest()
            ->where(function ($query) {
                $query->orwhere('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->paginate(10);
    }
    public function render()
    {
        return view('livewire.jabatan.list-jabatan', ['jabatans' => $this->jabatan]);
    }
}

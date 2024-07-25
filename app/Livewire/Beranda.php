<?php

namespace App\Livewire;

use App\Models\FileDokument;
use Livewire\Component;
use Livewire\WithPagination;

class Beranda extends Component
{
    use WithPagination;

    public $searchTerm = null;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['searchTerm' => ['except' => '']];

    public function getFileProperty()
    {
        return FileDokument::where('file', 'like', '%' . $this->searchTerm . '%')
            ->latest()
            ->paginate(10);
    }

    public function getTotalFilesByStatus($status)
    {
        return FileDokument::where('dokument', $status)->count();
    }

    public function render()
    {

        return view('livewire.beranda', [
            'files' => $this->file,
            'totalKeluar' => $this->getTotalFilesByStatus(FileDokument::KELUAR),
            'totalMasuk' => $this->getTotalFilesByStatus(FileDokument::MASUK),
            'totalDokument' => $this->getTotalFilesByStatus(FileDokument::DOKUMENT),
        ]);
    }
}

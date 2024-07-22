<?php

namespace App\Livewire\Dokument;

use App\Models\SuratKeluar as ModelsSuratKeluar;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class SuratKeluar extends Component
{
    use WithPagination;
    use LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

    public function getSuratKeluarProperty()
    {
        return ModelsSuratKeluar::where('nomor_surat', 'like', '%' . $this->searchTerm . '%')
            ->latest()
            ->paginate(10);
    }
    public function render()
    {
        return view('livewire.dokument.surat-keluar', ['suratKeluars' => $this->surat_keluar]);
    }
}

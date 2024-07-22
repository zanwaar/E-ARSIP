<?php

namespace App\Livewire\Dokument;

use App\Models\Disposisi as ModelsDisposisi;
use App\Models\SuratMasuk;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Disposisi extends Component
{
    use WithPagination;
    use LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];
    public $surat;
    public function mount($surat)
    {
        $this->surat = $surat;
    }
    public function getDisposisiProperty()
    {
        return SuratMasuk::with(['disposisis.user.jabatans', 'disposisis.bidang', 'dokuments'])
            ->where('id', $this->surat)
            ->firstOrFail();
    }
    // public function getDisposisiProperty()
    // {
    //     return ModelsDisposisi::with(['suratMasuk', 'user.jabatans', 'parent'])
    //         ->latest()
    //         ->paginate(10);
    // }
    public function render()
    {
        return view('livewire.dokument.disposisi', ['suratDisposisi' => $this->disposisi]);
    }
}

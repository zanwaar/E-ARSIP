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
        $authUser = auth()->user();

        $query = FileDokument::query();

        if ($authUser->jabatans?->alias) {
            if ($authUser->jabatans?->alias !== 'KADIS') {
                $query->where(function ($q) use ($authUser) {
                    // Kondisi untuk 'SURAT MASUK'
                    $q->where(function ($subQuery) use ($authUser) {
                        $subQuery->where('dokument', FileDokument::MASUK)
                            ->whereHas('disposisi', function ($subQuery) use ($authUser) {
                                if ($authUser->jabatans?->alias === 'STAFFBAGIAN') {
                                    $subQuery->where('bidang_id', $authUser->jabatans->bidang_id);
                                } else {
                                    $subQuery->where('user_id', $authUser->id);
                                }
                            });
                    });

                    // Kondisi untuk 'SURAT KELUAR' dan 'DOKUMENT'
                    $q->orWhereIn('dokument', [FileDokument::KELUAR, FileDokument::DOKUMENT]);
                });
            }
        }


        return $query->where('file', 'like', '%' . $this->searchTerm . '%')
            ->latest()
            ->paginate(10);
    }

    public function getTotalFilesByStatus($status)
    {
        $authUser = auth()->user();

        $query = FileDokument::where('dokument', $status);

        if ($authUser->jabatans?->alias) {
            if ($authUser->jabatans?->alias !== 'KADIS') {
                if ($status === FileDokument::MASUK) {
                    // Filter berdasarkan disposisi yang ditujukan kepada pengguna yang sedang login
                    $query->whereHas('disposisi', function ($subQuery) use ($authUser) {
                        // Menyesuaikan filter berdasarkan peran pengguna
                        if ($authUser->jabatans?->alias === 'STAFFBAGIAN') {
                            $subQuery->where('bidang_id', $authUser->jabatans->bidang_id);
                        } else {
                            $subQuery->where('user_id', $authUser->id);
                        }
                    });
                }
            }
        }

        return $query->count();
    }



    public function render()
    {
        // dd($this->getTotalFilesByStatus(FileDokument::MASUK));
        return view('livewire.beranda', [
            'files' => $this->file,
            'totalKeluar' => $this->getTotalFilesByStatus(FileDokument::KELUAR),
            'totalMasuk' => $this->getTotalFilesByStatus(FileDokument::MASUK),
            'totalDokument' => $this->getTotalFilesByStatus(FileDokument::DOKUMENT),
        ]);
    }
}

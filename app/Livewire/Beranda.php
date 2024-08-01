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
            $this->applyRoleBasedFilters($query, $authUser);
        }

        return $query->where('file', 'like', '%' . $this->searchTerm . '%')
            ->latest()
            ->paginate(10);
    }

    private function applyRoleBasedFilters($query, $authUser)
    {
        if ($authUser->jabatans->alias !== 'KADIS') {
            $query->where(function ($q) use ($authUser) {
                $q->where(function ($subQuery) use ($authUser) {
                    $this->applyIncomingDocumentFilters($subQuery, $authUser);
                    $this->applyOutgoingDocumentFilters($subQuery, $authUser);
                });
            });
        }
    }

    private function applyIncomingDocumentFilters($query, $authUser)
    {
        $query->where('dokument', FileDokument::MASUK)
            ->whereHas('disposisi', function ($subQuery) use ($authUser) {
                if ($authUser->jabatans->alias === 'STAFFBAGIAN') {
                    $subQuery->where('bidang_id', $authUser->jabatans->bidang_id);
                } else {
                    $subQuery->where('user_id', $authUser->id);
                }
            });
    }

    private function applyOutgoingDocumentFilters($query, $authUser)
    {
        if ($authUser->jabatans->alias !== 'STAFFBAGIAN' && $authUser->jabatans->alias !== 'KASIH') {
            $query->orWhere('dokument', FileDokument::KELUAR)
                ->whereHas('suratkeluar', function ($subQuery) use ($authUser) {
                    $subQuery->where('bidang_id', $authUser->jabatans->bidang_id);
                });
        }
    }

    public function getTotalFilesByStatus($status)
    {
        $authUser = auth()->user();
        $query = FileDokument::where('dokument', $status);

        if ($authUser->jabatans?->alias) {
            if ($authUser->jabatans->alias !== 'KADIS') {
                $query->where(function ($q) use ($authUser, $status) {
                    $q->where(function ($subQuery) use ($authUser, $status) {
                        if ($status === FileDokument::MASUK) {
                            $subQuery->whereHas('disposisi', function ($disposisiQuery) use ($authUser) {
                                if ($authUser->jabatans->alias === 'STAFFBAGIAN') {
                                    $disposisiQuery->where('bidang_id', $authUser->jabatans->bidang_id);
                                } else {
                                    $disposisiQuery->where('user_id', $authUser->id);
                                }
                            });
                        } elseif ($status === FileDokument::KELUAR) {
                            if ($authUser->jabatans->alias !== 'STAFFBAGIAN' && $authUser->jabatans->alias !== 'KASIH') {
                                $subQuery->whereHas('suratkeluar', function ($suratkeluarQuery) use ($authUser) {
                                    $suratkeluarQuery->where('bidang_id', $authUser->jabatans->bidang_id);
                                });
                            }
                        }
                    });
                });
            }
        }

        return $query->count();
    }


    public function render()
    {
        return view('livewire.beranda', [
            'files' => $this->file,
            'totalKeluar' => $this->getTotalFilesByStatus(FileDokument::KELUAR),
            'totalMasuk' => $this->getTotalFilesByStatus(FileDokument::MASUK),
        ]);
    }
}

<?php

namespace App\Livewire\Dokument;

use App\Models\FileDokument;
use App\Models\SuratKeluar as ModelsSuratKeluar;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class SuratKeluar extends Component
{
    use WithPagination;
    use LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm = null;
    public $nomorSurat;
    public $penerima;
    public $perihal;
    public $tanggal_keluar;
    public array  $files = [];
    protected $queryString = ['searchTerm' => ['except' => '']];

    public function add()
    {
        $this->generateNomorSurat();
        $this->dispatch('show-modal-add');
    }
    public function saves()
    {
        $this->validate([
            'penerima' => 'required|string|max:255',
            'tanggal_keluar' => 'required|date',
            'perihal' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $suratkeluar = ModelsSuratKeluar::create([
                'nomor_surat' => $this->nomorSurat,
                'penerima' => $this->penerima,
                'tanggal_keluar' => $this->tanggal_keluar,
                'perihal' => $this->perihal,
            ]);

            foreach ($this->files as $file) {
                // $fileName = Storage::putFile('files', new File($file['path']));
                $fileName = $this->nomorSurat . '_' . $file['name'];
                $size = floor($file['size'] / 1024);
                Storage::putFileAs('files/surat-keluar', new File($file['path']), $fileName);
                FileDokument::create([
                    'dokument_id' => $suratkeluar->id,
                    'dokument' => 'SURAT KELUAR',
                    'file' => $fileName,
                    'size' =>  $size . ' KB',
                ]);
            }

            DB::commit();
            $this->alert('success', 'Surat Keluar saved successfully.', [
                'position' => 'top',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
            $this->reset();
            $this->dispatch('hide-form');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            $this->dispatch('hide-form');
            $this->alert('success', 'Failed to save Surat Keluar.', [
                'position' => 'top',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        }
    }
    public function getSuratKeluarProperty()
    {
        return ModelsSuratKeluar::where(function ($query) {
            $query->where('nomor_surat', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('penerima', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('perihal', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('tanggal_keluar', 'like', '%' . $this->searchTerm . '%');
        })
            ->latest()
            ->paginate(10);
    }
    public function generateNomorSurat()
    {
        // Get the current year
        $currentYear = date('Y');

        // Get the latest SuratMasuk for the current year
        $latestSurat = ModelsSuratKeluar::whereYear('created_at', $currentYear)
            ->latest()
            ->first();

        // Extract the number from the latest surat nomor_surat
        if ($latestSurat) {
            $latestNumber = (int) explode('/', $latestSurat->nomor_surat)[0];
        } else {
            $latestNumber = 0;
        }

        // Increment the number
        $newNumber = str_pad($latestNumber + 1, 3, '0', STR_PAD_LEFT);

        // Generate the new nomor_surat
        $this->nomorSurat = "{$newNumber}/SK/{$currentYear}";

        return $this->nomorSurat;
    }
    public function render()
    {
        return view('livewire.dokument.surat-keluar', ['suratKeluars' => $this->surat_keluar]);
    }
}

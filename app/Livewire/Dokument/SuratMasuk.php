<?php

namespace App\Livewire\Dokument;

use App\Models\Disposisi;
use App\Models\FileDokument;
use App\Models\SuratMasuk as ModelsSuratMasuk;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class SuratMasuk extends Component
{
    use WithPagination;
    use LivewireAlert;
    // protected $paginationTheme = 'bootstrap';
    public $searchTerm = null;
    public $nomorSurat;
    public $pengirim;
    public $tanggal_masuk;
    public $perihal;

    protected $queryString = ['searchTerm' => ['except' => '']];
    public array  $files = [];
  
    public function saves()
    {
        $this->validate([
            'pengirim' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'perihal' => 'required|string',
        ]);
        // foreach ($this->files as $file) {
        //     dd($file);
        // }
        // Start database transaction
        DB::beginTransaction();

        try {
            $suratMasuk = ModelsSuratMasuk::create([
                'nomor_surat' => $this->nomorSurat,
                'pengirim' => $this->pengirim,
                'tanggal_masuk' => $this->tanggal_masuk,
                'perihal' => $this->perihal,
            ]);

            foreach ($this->files as $file) {
                // $fileName = Storage::putFile('files', new File($file['path']));
                $fileName = $this->nomorSurat . '_' . $file['name'];
                $size = floor($file['size'] / 1024);
                Storage::putFileAs('files/surat-masuk', new File($file['path']), $fileName);
                FileDokument::create([
                    'dokument_id' => $suratMasuk->id,
                    'dokument' => 'SURAT MASUK',
                    'file' => $fileName,
                    'size' =>  $size . ' KB',
                ]);
            }

            Disposisi::create(['surat_masuk_id' => $suratMasuk->id, 'user_id' => 3, 'isi_disposisi' => 'Surat Masuk']);
            DB::commit();
            session()->flash('message', 'Surat Masuk saved successfully.');
            $this->alert('success', 'Surat Masuk saved successfully.', [
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
            session()->flash('error', 'Failed to save Surat Masuk.');
            $this->dispatch('hide-form');
            $this->alert('success', 'Failed to save Surat Masuk.', [
                'position' => 'top',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        }
    }
    public function getSuratMasukProperty()
    {
        return ModelsSuratMasuk::where(function ($query) {
            $query->where('nomor_surat', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('pengirim', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('perihal', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('tanggal_masuk', 'like', '%' . $this->searchTerm . '%');
        })
            ->latest()
            ->paginate(10);
    }

    public function add()
    {
        $this->generateNomorSurat();
        $this->dispatch('show-modal-add');
    }

    public function generateNomorSurat()
    {
        // Get the current year
        $currentYear = date('Y');

        // Get the latest SuratMasuk for the current year
        $latestSurat = ModelsSuratMasuk::whereYear('created_at', $currentYear)
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
        $this->nomorSurat = "{$newNumber}/SM/{$currentYear}";

        return $this->nomorSurat;
    }
    public function render()
    {
        return view('livewire.dokument.surat-masuk', ['suratMasuks' => $this->surat_masuk]);
    }
}

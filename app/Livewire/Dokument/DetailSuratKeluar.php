<?php

namespace App\Livewire\Dokument;

use App\Models\FileDokument;
use App\Models\SuratKeluar;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class DetailSuratKeluar extends Component
{
    use LivewireAlert;
    public $idfile;
    public $surat;
    public $nomorSurat;
    public $penerima;
    public $perihal;
    public $tanggal_keluar;
    public array  $files = [];
    public function mount($surat)
    {
        $this->surat = $surat;
    }
    public function show()
    {
        $this->dispatch('show-modal-add');
    }
    public function showDelete($id)
    {
        $this->idfile = $id;
        $this->dispatch('show-modal-file');
    }
    public function deletefile()
    {
        FileDokument::find($this->idfile)->delete();
        $this->dispatch('hide-form');
        $this->alert('success', 'File Berhasil Dihapus.', [
            'position' => 'top',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
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
            SuratKeluar::where('id', $this->surat)->update([
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
                    'dokument_id' => $this->surat,
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
            // $this->reset();
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
        return SuratKeluar::with(['dokuments'])
            ->where('id', $this->surat)
            ->firstOrFail();
    }
    public function render()
    {
        $this->nomorSurat = $this->surat_keluar->nomor_surat;
        $this->penerima = $this->surat_keluar->penerima;
        $this->perihal = $this->surat_keluar->perihal;
        $this->tanggal_keluar = $this->surat_keluar->tanggal_keluar;
        return view('livewire.dokument.detail-surat-keluar', ['suratkeluar' => $this->surat_keluar]);
    }
}

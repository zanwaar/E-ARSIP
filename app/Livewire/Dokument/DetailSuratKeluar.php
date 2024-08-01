<?php

namespace App\Livewire\Dokument;

use App\Models\Bidang;
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
    public $idbidang;
    public array  $files = [];
    public function mount($surat)
    {
        $this->surat = $surat;
    }
    public $confirmDeletion = false;

    public function delete()
    {
        if ($this->confirmDeletion) {

            $suratkeluar = SuratKeluar::findOrFail($this->surat);
            $fileDokuments = $suratkeluar->dokuments;

            foreach ($fileDokuments as $fileDokument) {
                // dd($fileDokument->file);
                // Determine the file path
                $filePath = 'files/surat-keluar/' . $fileDokument->file;

                // Check if the file exists in storage and delete it
                if (Storage::disk('local')->exists($filePath)) {
                    Storage::disk('local')->delete($filePath);
                }

                // Delete the FileDokument record
                $fileDokument->delete();
            }
            // Delete the suratkeluar record
            $suratkeluar->delete();
            $this->confirmDeletion = false;

            $this->alert('success', 'Delete successfully.', [
                'position' => 'top',
                'timer' => 2000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
            return redirect()->route('dokument.surat-keluar');
        }
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

        $fileDokument = FileDokument::find($this->idfile);
        $filePath = 'files/surat-keluar/' . $fileDokument->file;

        // Check if the file exists in storage and delete it
        if (Storage::disk('local')->exists($filePath)) {
            Storage::disk('local')->delete($filePath);
        }
        $fileDokument->delete();
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
            'idbidang' => 'required',
        ]);

        DB::beginTransaction();

        try {
            SuratKeluar::where('id', $this->surat)->update([
                'nomor_surat' => $this->nomorSurat,
                'penerima' => $this->penerima,
                'tanggal_keluar' => $this->tanggal_keluar,
                'perihal' => $this->perihal,
                'bidang_id' => $this->idbidang,
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
            $this->reset(['files']);
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
        return SuratKeluar::with(['dokuments', 'bidang'])
            ->where('id', $this->surat)
            ->firstOrFail();
    }
    public function render()
    {
        $this->nomorSurat = $this->surat_keluar->nomor_surat;
        $this->penerima = $this->surat_keluar->penerima;
        $this->perihal = $this->surat_keluar->perihal;
        $this->tanggal_keluar = $this->surat_keluar->tanggal_keluar;
        $this->idbidang = $this->surat_keluar->bidang_id;
        $bidang = Bidang::where('name', '<>', 'Kepala Dinas')->get();
        return view('livewire.dokument.detail-surat-keluar', ['suratkeluar' => $this->surat_keluar, 'bidangs' => $bidang]);
    }
}

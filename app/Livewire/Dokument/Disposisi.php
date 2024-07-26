<?php

namespace App\Livewire\Dokument;

use App\Models\Disposisi as ModelsDisposisi;
use App\Models\FileDokument;
use App\Models\SuratMasuk;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Disposisi extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $surat;
    public $nomorSurat;
    public $pengirim;
    public $perihal;
    public $tanggal_masuk;
    public array  $files = [];
    public function mount($surat)
    {
        $this->surat = $surat;
    }
    public $confirmDeletion = false;
    public $idfile;

    public function showDelete($id)
    {
        $this->idfile = $id;
        $this->dispatch('show-modal-file');
    }

    public function deletefile()
    {
        $fileDokument = FileDokument::find($this->idfile);
        $filePath = 'files/surat-masuk/' . $fileDokument->file;

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
    public function delete()
    {
        if ($this->confirmDeletion) {

            $suratmasuk = SuratMasuk::findOrFail($this->surat);
            $fileDokuments = $suratmasuk->dokuments;

            foreach ($fileDokuments as $fileDokument) {
                // dd($fileDokument->file);
                // Determine the file path
                $filePath = 'files/surat-masuk/' . $fileDokument->file;

                // Check if the file exists in storage and delete it
                if (Storage::disk('local')->exists($filePath)) {
                    Storage::disk('local')->delete($filePath);
                }

                // Delete the FileDokument record
                $fileDokument->delete();
            }
            // Delete the SuratMasuk record
            $suratmasuk->delete();
            $this->confirmDeletion = false;

            $this->alert('success', 'Delete successfully.', [
                'position' => 'top',
                'timer' => 2000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
            return redirect()->route('dokument.surat-masuk');
        }
    }
    public function show()
    {
        $this->dispatch('show-modal-add');
    }
    public function saves()
    {
        $this->validate([
            'pengirim' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'perihal' => 'required|string',
        ]);
        DB::beginTransaction();

        try {
            SuratMasuk::where('id', $this->surat)->update([
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
                    'dokument_id' => $this->surat,
                    'dokument' => 'SURAT MASUK',
                    'bidang_id' => 0,
                    'file' => $fileName,
                    'size' =>  $size . ' KB',
                ]);
            }
            $this->reset(['files']);
            DB::commit();
            $this->alert('success', 'Surat Masuk saved successfully.', [
                'position' => 'top',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
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

    public function getDisposisiProperty()
    {
        return SuratMasuk::with(['disposisis.user.jabatans', 'disposisis.bidang', 'dokuments'])
            ->where('id', $this->surat)
            ->firstOrFail();
    }
    public function render()
    {
        $this->nomorSurat = $this->disposisi->nomor_surat;
        $this->pengirim = $this->disposisi->pengirim;
        $this->perihal = $this->disposisi->perihal;
        $this->tanggal_masuk = $this->disposisi->tanggal_masuk;
        return view('livewire.dokument.disposisi', ['suratDisposisi' => $this->disposisi]);
    }
}

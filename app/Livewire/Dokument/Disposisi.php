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
    public $idfile;
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
                    'file' => $fileName,
                    'size' =>  $size . ' KB',
                ]);
            }
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

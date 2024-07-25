<?php

namespace App\Livewire\Dokument;

use App\Models\FileDokument;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Lainnya extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $idfile;
    public $searchTerm = null;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['searchTerm' => ['except' => '']];
    public array  $files = [];

    public function getFileProperty()
    {
        return FileDokument::where(function ($query) {
            $query->where('file', 'like', '%' . $this->searchTerm . '%')
                ->Where('dokument', 'DOKUMENT');
        })
            ->latest()
            ->paginate(10);
    }
    public function add()
    {
        $this->dispatch('show-modal-add');
    }
    public function saves()
    {
        $this->validate([
            'files' => 'required|array|max:255',
            'files.*.name' => 'required|string|max:255', // Validate each file's name
            'files.*.size' => 'required|integer|min:1', // Validate each file's size
            'files.*.path' => 'required|string', // Ensure path is provided
        ]);
        DB::beginTransaction();
        try {
            foreach ($this->files as $file) {
                // $fileName = 'DOKUMENT_' . $file['name'];
                $fileName = $file['name'];
                $size = floor($file['size'] / 1024);
                Storage::putFileAs('files/dokument', new File($file['path']), $fileName);
                FileDokument::create([
                    'dokument' => 'DOKUMENT',
                    'file' => $fileName,
                    'size' =>  $size . ' KB',
                ]);
            }
            DB::commit();
            $this->alert('success', 'saved successfully.', [
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
            $this->alert('success', 'Failed to save.', [
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

    public function render()
    {
        return view('livewire.dokument.lainnya', [
            'dokument' => $this->file,
        ]);
    }
}

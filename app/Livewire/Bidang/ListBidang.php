<?php

namespace App\Livewire\Bidang;

use App\Models\Bidang;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ListBidang extends Component
{
    use WithPagination;
    use LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    public $idBeingRemoved = null;
    public $mbidang;
    public $name;
    public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

    public function add()
    {
        $this->dispatch('show-modal-add');
    }
    public function edit($idbidang)
    {
        $this->mbidang = Bidang::where('id',  $idbidang)->first();
        $this->name = $this->mbidang->name;
        $this->dispatch('show-modal-add');
    }
    public function resets()
    {
        $this->reset();
    }
    public function saves()
    {
        // Validasi input
        $this->validate([
            'name' => 'required|max:255',
        ]);
        DB::beginTransaction();
        try {
            if ($this->mbidang) {
                $this->mbidang->update([
                    'name' => $this->name
                ]);
            } else {

                Bidang::create([
                    'name' => $this->name
                ]);
            }

            DB::commit();
            // Reset properti
            $this->reset(['name', 'mbidang']);
            $this->alert('success', 'Bidang berhasil disimpan', [
                'position' => 'top',
                'timer' => 2000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
            $this->dispatch('hide-form');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            $this->dispatch('hide-form');
            $this->alert('success', 'Failed to save Bidang', [
                'position' => 'top',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        }
    }

    public function getBidangProperty()
    {
        return Bidang::with(['kepalaBidang.user', 'kepalaSeksi.user', 'staff'])
            ->where('name', '!=', 'Kepala Dinas')
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->latest()
            ->paginate(9);
    }
    public function render()
    {
        return view('livewire.bidang.list-bidang', ['listBidang' => $this->bidang]);
    }
}

<?php

namespace App\Livewire\Bidang;

use App\Models\Bidang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ListBidang extends Component
{
    use WithPagination;
    use LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    public $idBeingRemoved = null;
    public $mbidang = [];
    public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

    public function confirmRemoval($id)
    {
        $this->mbidang = $id;
        $this->idBeingRemoved = $id['id'];
        // dd($this->idBeingRemoved );
        $this->dispatch('show-delete-modal');
    }
    public function delete()
    {
        $bidang = Bidang::findOrFail($this->idBeingRemoved);
        $bidang->delete();
        $this->dispatch('hide-form');
        $this->alert('success', 'deleted successfully!', [
            'position' => 'top',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
        $this->reset();
    }
    public function getBidangProperty()
    {
        return Bidang::with(['kepalaBidang.user', 'kepalaSeksi.user', 'staff'])
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->latest()
            ->paginate(5);
    }
    public function render()
    {
        return view('livewire.bidang.list-bidang', ['listBidang' => $this->bidang]);
    }
}

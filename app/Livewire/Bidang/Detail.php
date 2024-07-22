<?php

namespace App\Livewire\Bidang;

use App\Models\Bidang;
use Livewire\Component;

class Detail extends Component
{
    public $id;
    public function mount($id)
    {
        $this->id = $id;
    }
    public function getDetailBidangProperty()
    {
        return Bidang::with(['kepalaBidang.user', 'kepalaSeksi.user', 'staff.user'])
            ->where('id', $this->id)
            ->firstOrFail();
    }
    public function render()
    {
        return view('livewire.bidang.detail', ['bidang' => $this->detail_bidang]);
    }
}

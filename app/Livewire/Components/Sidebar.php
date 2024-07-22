<?php

namespace App\Livewire\Components;

use App\Models\Disposisi;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;


class Sidebar extends Component
{
    public $total_count = 0;
    public $activeRoute = '';
    protected $listeners = ['update-count' => 'updateCount'];

    public function mount()
    {
        $this->updateCount();
        $this->activeRoute = \Illuminate\Support\Facades\Route::currentRouteName();
    }
    public function updateCount()
    {
        $user = Auth::user();
        if ($user->jabatans) {
            if ($user->jabatans->alias == 'Staff') {
                $disposisi = Disposisi::with(['suratMasuk.dokuments'])
                    ->where('bidang_id', $user->jabatans->bidang->id)
                    ->where('is_read', false)
                    ->count();
            } else {
                $disposisi = Disposisi::with(['suratMasuk.dokuments'])
                    ->where('user_id', $user->id)
                    ->where('is_read', false)
                    ->count();
            }
            $this->total_count = $disposisi;
        }
    }
    public function render()
    {
        return view('livewire.components.sidebar');
    }
}

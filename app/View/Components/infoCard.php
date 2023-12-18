<?php

namespace App\View\Components;

use App\Models\Pengaduan;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class infoCard extends Component
{

    public $countPengaduan;
    public $countPengaduanBerhasil;
    public $countPengaduanGagal;
    public $countPetugas;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {

        $role = ['admin', 'petugas'];
        $this->countPengaduan = in_array(Auth::user()->role, $role) ? Pengaduan::count() : Pengaduan::where('user_id', Auth::user()->id)->count();
        $this->countPengaduanBerhasil = in_array(Auth::user()->role, $role) ? Pengaduan::where('status_aduan', 'selesai')->count() : Pengaduan::where('status_aduan', 'selesai')->where('user_id', Auth::user()->id)->count();
        $this->countPengaduanGagal = in_array(Auth::user()->role, $role) ? Pengaduan::where('status_aduan', 'ditolak')->count() : Pengaduan::where('status_aduan', 'ditolak')->where('user_id', Auth::user()->id)->count();
        $this->countPetugas = User::where('role', 'petugas')->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View | Closure | string
    {
        return view('components.info-card');
    }
}

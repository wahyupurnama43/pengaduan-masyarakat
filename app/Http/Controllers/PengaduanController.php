<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PengaduanRequest;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    public function store(PengaduanRequest $pengaduanRequest)
    {
        $tujuan_aduan = $pengaduanRequest->tujuan_aduan;
        $lokasi = $pengaduanRequest->lokasi;
        $aduan = $pengaduanRequest->aduan;
        $tgl_aduan = $pengaduanRequest->tgl_aduan;
        if ($pengaduanRequest->hasfile('gambar_aduan')) {
            $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $pengaduanRequest->file('gambar_aduan')->getClientOriginalName());
            $pengaduanRequest->file('gambar_aduan')->move(public_path('images'), $filename);
        }

        $pengaduan = new Pengaduan();
        $pengaduan->user_id = Auth::id();
        $pengaduan->aduan = $aduan;
        $pengaduan->lokasi = $lokasi;
        $pengaduan->gambar_aduan = $filename;
        $pengaduan->tgl_aduan = $tgl_aduan;
        $pengaduan->intansi_tujuan = $tujuan_aduan;

        $pengaduan->save();

        return redirect()->back()->with('success', 'Berhasil Membuat Aduan');
    }
}

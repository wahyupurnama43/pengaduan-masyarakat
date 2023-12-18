<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SendEmail;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TanggapanController extends Controller
{
    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'status_tanggapan' => 'required',
            'tanggapan' => 'required',
        ]);

        $status_tanggapan = $request->status_tanggapan;
        $tanggap = $request->tanggapan;

        $pengaduan = Pengaduan::find($id);
        if ($status_tanggapan == 'terima') {
            $pengaduan->status_aduan = 'selesai';
            $pengaduan->save();
        } else {
            $pengaduan->status_aduan = 'ditolak';
            $pengaduan->save();
        }

        $tanggapan = Tanggapan::updateOrCreate([
            'user_id' => Auth::id(),
            'pengaduan_id' => $id,
        ], [
            'status_tanggapan' => $status_tanggapan,
            'tanggapan' => $tanggap,
        ]);

        Mail::to($tanggapan->pengaduan->user->email)->send(new SendEmail($tanggapan));

        return redirect()->back()->with('success', 'Berhasil Update Tanggapan');
    }
}

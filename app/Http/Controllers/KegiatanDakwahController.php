<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KegiatanDakwah;
use App\Models\User;
use App\Notifications\KegiatanDakwahScheduled;

class KegiatanDakwahController extends Controller
{
    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'catatan' => 'nullable|string',
            'tanggal' => 'required|date',
            'mesjid_id' => 'required|exists:mesjid,id',
        ]);

        $kegiatan = KegiatanDakwah::create($request->all());

        // Kirim notifikasi email ke semua user terverifikasi
        $users = User::whereNotNull('email_verified_at')->get();
        foreach ($users as $user) {
            $user->notify(new KegiatanDakwahScheduled($kegiatan));
        }

        return redirect()->back()->with('success', 'Log kegiatan dakwah berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kegiatan = KegiatanDakwah::findOrFail($id);

        return response()->json([
            'id' => $kegiatan->id,
            'judul' => $kegiatan->judul,
            'deskripsi' => $kegiatan->deskripsi,
            'catatan' => $kegiatan->catatan,
            'tanggal' => $kegiatan->tanggal->format('Y-m-d'),
            'mesjid_id' => $kegiatan->mesjid_id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'catatan' => 'nullable|string',
            'tanggal' => 'required|date',
        ]);

        $kegiatan = KegiatanDakwah::findOrFail($id);
        $kegiatan->update($request->all());

        return redirect()->back()->with('success', 'Log kegiatan dakwah berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kegiatan = KegiatanDakwah::findOrFail($id);
        $kegiatan->delete();

        return redirect()->back()->with('success', 'Log kegiatan dakwah berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResidentNote;
use Illuminate\Support\Facades\Auth;

class ResidentNoteController extends Controller
{
    public function index(Request $request)
    {
        $mesjidId = $request->query('mesjid_id');
        $kecamatanId = $request->query('kecamatan_id');

        $query = ResidentNote::query();

        if ($mesjidId) {
            $query->where('mesjid_id', $mesjidId);
        }

        if ($kecamatanId) {
            $query->where('kecamatan_id', $kecamatanId);
        }

        $notes = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.pages.resident_notes.index', compact('notes', 'mesjidId', 'kecamatanId'));
    }

    public function create(Request $request)
    {
        $mesjidId = $request->query('mesjid_id');
        $kecamatanId = $request->query('kecamatan_id');

        return view('admin.pages.resident_notes.create', compact('mesjidId', 'kecamatanId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mesjid_id' => 'nullable|exists:mesjid,id',
            'kecamatan_id' => 'nullable|exists:kecamatan,id',
            'isi_catatan' => 'required|string',
        ]);

        $note = new ResidentNote();
        $note->mesjid_id = $request->input('mesjid_id');
        $note->kecamatan_id = $request->input('kecamatan_id');
        $note->isi_catatan = $request->input('isi_catatan');
        $note->dibuat_oleh = Auth::id();
        $note->save();

        return redirect()->route('resident-notes.index')->with('success', 'Catatan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $note = ResidentNote::findOrFail($id);

        return view('admin.pages.resident_notes.edit', compact('note'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'isi_catatan' => 'required|string',
        ]);

        $note = ResidentNote::findOrFail($id);
        $note->isi_catatan = $request->input('isi_catatan');
        $note->save();

        return redirect()->route('resident-notes.index')->with('success', 'Catatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $note = ResidentNote::findOrFail($id);
        $note->delete();

        return redirect()->route('resident-notes.index')->with('success', 'Catatan berhasil dihapus.');
    }
}

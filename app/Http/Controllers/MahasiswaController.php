<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswas;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswas::orderBy('id', 'desc')->get();

        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function store(Request $request)
    {
        Mahasiswas::create($this->validateMahasiswa($request));

        return redirect()
            ->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $mahasiswa = Mahasiswas::findOrFail($id);

        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, int $id)
    {
        $mahasiswa = Mahasiswas::findOrFail($id);
        $mahasiswa->update($this->validateMahasiswa($request));

        return redirect()
            ->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        $mahasiswa = Mahasiswas::findOrFail($id);
        $mahasiswa->delete();

        return redirect()
            ->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    private function validateMahasiswa(Request $request): array
    {
        return $request->validate([
            'nama' => ['required', 'string', 'max:150'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'alamat' => ['required', 'string'],
            'no_hp' => ['required', 'string', 'max:20'],
        ], [
            'nama.required' => 'Nama mahasiswa wajib diisi.',
            'nama.string' => 'Nama mahasiswa harus berupa teks.',
            'nama.max' => 'Nama mahasiswa tidak boleh lebih dari 150 karakter.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'no_hp.required' => 'Nomor handphone wajib diisi.',
            'no_hp.string' => 'Nomor handphone harus berupa teks.',
            'no_hp.max' => 'Nomor handphone tidak boleh lebih dari 20 karakter.',
        ]);
    }
}

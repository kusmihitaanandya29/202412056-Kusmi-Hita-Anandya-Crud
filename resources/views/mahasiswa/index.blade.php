@extends('layouts.app')

@section('title', 'Data Mahasiswa | Academic Records')

@section('content')
    <header class="page-heading">
        <p class="eyebrow">ADMINISTRASI AKADEMIK <span>/</span> 01</p>
        <h1>Data Mahasiswa</h1>
        <p class="subtitle">Kelola informasi mahasiswa yang terdaftar dalam sistem akademik.</p>
    </header>

    @if (session('success'))
        <div class="alert alert-success" role="status">
            {{ session('success') }}
        </div>
    @endif

    <div class="workspace">
        <section class="panel form-panel" aria-labelledby="create-heading">
            <div class="panel-heading">
                <p class="section-label">DATA BARU</p>
                <h2 id="create-heading">Tambah Mahasiswa</h2>
                <p>Lengkapi informasi mahasiswa di bawah ini.</p>
            </div>

            <div class="panel-body">
                <form action="{{ route('mahasiswa.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input
                            id="nama"
                            type="text"
                            name="nama"
                            maxlength="150"
                            placeholder="Contoh: Andi Pratama"
                            value="{{ old('nama') }}"
                            @required(true)
                            @if ($errors->has('nama')) aria-invalid="true" aria-describedby="nama-error" @endif
                        >
                        @error('nama')
                            <p class="error" id="nama-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select
                            id="jenis_kelamin"
                            name="jenis_kelamin"
                            @required(true)
                            @if ($errors->has('jenis_kelamin')) aria-invalid="true" aria-describedby="jenis-kelamin-error" @endif
                        >
                            <option value="">Pilih jenis kelamin</option>
                            <option value="Laki-laki" @selected(old('jenis_kelamin') === 'Laki-laki')>Laki-laki</option>
                            <option value="Perempuan" @selected(old('jenis_kelamin') === 'Perempuan')>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <p class="error" id="jenis-kelamin-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea
                            id="alamat"
                            name="alamat"
                            rows="3"
                            placeholder="Masukkan alamat lengkap"
                            @required(true)
                            @if ($errors->has('alamat')) aria-invalid="true" aria-describedby="alamat-error" @endif
                        >{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <p class="error" id="alamat-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="no_hp">Nomor Handphone</label>
                        <input
                            id="no_hp"
                            type="tel"
                            name="no_hp"
                            maxlength="20"
                            placeholder="Contoh: 081234567890"
                            value="{{ old('no_hp') }}"
                            @required(true)
                            @if ($errors->has('no_hp')) aria-invalid="true" aria-describedby="no-hp-error" @endif
                        >
                        @error('no_hp')
                            <p class="error" id="no-hp-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Mahasiswa</button>
                </form>
            </div>
        </section>

        <section class="panel records-panel" aria-labelledby="records-heading">
            <div class="panel-heading">
                <p class="section-label">ARSIP MAHASISWA</p>
                <h2 id="records-heading">Daftar Mahasiswa</h2>
                <p>Informasi mahasiswa yang tersimpan di dalam sistem.</p>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">NO.</th>
                            <th scope="col">NAMA MAHASISWA</th>
                            <th scope="col">JENIS KELAMIN</th>
                            <th scope="col">ALAMAT</th>
                            <th scope="col">NO. HP</th>
                            <th scope="col">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mahasiswas as $mahasiswa)
                            <tr>
                                <td class="row-number">{{ $loop->iteration }}</td>
                                <td class="student-name">{{ $mahasiswa->nama }}</td>
                                <td><span class="gender">{{ $mahasiswa->jenis_kelamin }}</span></td>
                                <td class="address-cell">{{ $mahasiswa->alamat }}</td>
                                <td class="phone-cell">{{ $mahasiswa->no_hp }}</td>
                                <td>
                                    <div class="actions">
                                        <a
                                            href="{{ route('mahasiswa.edit', $mahasiswa->id) }}"
                                            class="btn btn-edit"
                                        >Edit</a>
                                        <form
                                            action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data mahasiswa ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty">
                                        <h3>Belum ada data mahasiswa</h3>
                                        <p>Data yang ditambahkan melalui formulir akan tampil di sini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection

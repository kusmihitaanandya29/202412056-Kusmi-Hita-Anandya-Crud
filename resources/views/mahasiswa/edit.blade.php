@extends('layouts.app')

@section('title', 'Edit Mahasiswa | Academic Records')

@section('content')
    <header class="page-heading">
        <p class="eyebrow">ADMINISTRASI AKADEMIK <span>/</span> 02</p>
        <h1>Perbarui Data</h1>
        <p class="subtitle">Pastikan informasi mahasiswa sesuai dengan data terbaru.</p>
    </header>

    <section class="panel edit-panel" aria-labelledby="edit-heading">
        <div class="panel-heading">
            <p class="section-label">PEMBARUAN DATA</p>
            <h2 id="edit-heading">Edit Informasi Mahasiswa</h2>
            <p>Perubahan akan disimpan ke dalam database akademik.</p>
        </div>

        <div class="panel-body">
            <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input
                        id="nama"
                        type="text"
                        name="nama"
                        maxlength="150"
                        value="{{ old('nama', $mahasiswa->nama) }}"
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
                        <option value="Laki-laki" @selected(old('jenis_kelamin', $mahasiswa->jenis_kelamin) === 'Laki-laki')>Laki-laki</option>
                        <option value="Perempuan" @selected(old('jenis_kelamin', $mahasiswa->jenis_kelamin) === 'Perempuan')>Perempuan</option>
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
                        rows="4"
                        @required(true)
                        @if ($errors->has('alamat')) aria-invalid="true" aria-describedby="alamat-error" @endif
                    >{{ old('alamat', $mahasiswa->alamat) }}</textarea>
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
                        value="{{ old('no_hp', $mahasiswa->no_hp) }}"
                        @required(true)
                        @if ($errors->has('no_hp')) aria-invalid="true" aria-describedby="no-hp-error" @endif
                    >
                    @error('no_hp')
                        <p class="error" id="no-hp-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
                </div>
            </form>
        </div>
    </section>
@endsection

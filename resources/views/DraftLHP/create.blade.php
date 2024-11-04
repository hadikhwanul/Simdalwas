@extends('Layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>Tambah {{ $judul }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('draft-lhp.index') }}">{{ $judul }}</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Tambah</h5>
                    <!-- Multi Columns Form -->
                    <form class="row g-3" action="{{ route('draft-lhp.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <label class="form-label">No LHP*</label>
                            <input type="text" class="form-control @error('no_lhp') is-invalid @enderror" id="inputName5"
                                name="no_lhp" value="{{ old('no_lhp') }}" required>
                            @error('no_lhp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal LHP*</label>
                            <input type="date" class="form-control @error('tanggal_lhp') is-invalid @enderror"
                                name="tanggal_lhp" value="{{ old('tanggal_lhp') }}" required>
                            @error('tanggal_lhp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Judul LHP*</label>
                            <input id="x" type="text" name="judul"
                                class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}">
                            @error('judul')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label class="form-label">Departemen</label>
                            <select class="form-select @error('departemen_id') is-invalid @enderror" name="departemen_id">
                                <option class="text-center" disabled value="" selected>Pilih Departemen</option>
                                @forelse ($departemen as $depart)
                                    <option value="{{ $depart->id }}"
                                        {{ old('departemen_id') == $depart->id ? 'selected' : '' }}>
                                        {{ $depart->departemen }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                            @error('departemen_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label class="form-label">Auditor*</label>
                            <select class="form-select @error('auditor_id') is-invalid @enderror" name="auditor_id"
                                required>
                                <option class="text-center" disabled value="" selected>Pilih Auditor</option>
                                @forelse ($auditor as $audit)
                                    <option value="{{ $audit->id }}"
                                        {{ old('auditor_id') == $audit->id ? 'selected' : '' }}>{{ $audit->auditor }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                            @error('auditor_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Bidang</label>
                            <select class="form-select @error('bidang') is-invalid @enderror" name="bidang">
                                <option class="text-center" disabled value="" selected>Pilih Bidang</option>
                                <option value="Komprehensif" {{ old('bidang') == 'Komprehensif' ? 'selected' : '' }}>
                                    Komprehensif</option>
                                <option value="Kebijakan" {{ old('bidang') == 'Kebijakan' ? 'selected' : '' }}>Kebijakan
                                </option>
                                <option value="Tupoksi" {{ old('bidang') == 'Tupoksi' ? 'selected' : '' }}>Tupoksi</option>
                                <option value="Pengelolaan Aset Daerah"
                                    {{ old('bidang') == 'Pengelolaan Aset Daerah' ? 'selected' : '' }}>Pengelolaan Aset
                                    Daerah</option>
                                <option value="Pengelolaan Keuangan"
                                    {{ old('bidang') == 'Pengelolaan Keuangan' ? 'selected' : '' }}>Pengelolaan Keuangan
                                </option>
                                <option value="Pengelolaan Pendapatan"
                                    {{ old('bidang') == 'Pengelolaan Pendapatan' ? 'selected' : '' }}>Pengelolaan
                                    Pendapatan</option>
                                <option value="Pengelolaan Kepegawaian"
                                    {{ old('bidang') == 'Pengelolaan Kepegawaian' ? 'selected' : '' }}>Pengelolaan
                                    Kepegawaian</option>
                                <option value="Pengelolaan Kekayaan"
                                    {{ old('bidang') == 'Pengelolaan Kekayaan' ? 'selected' : '' }}>Pengelolaan Kekayaan
                                </option>
                            </select>
                            @error('bidang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Induk*</label>
                            <select class="form-select @error('induk_id') is-invalid @enderror" name="induk_id" required>
                                <option class="text-center" disabled value="" selected>Pilih Induk</option>
                                @forelse ($induk as $induk)
                                    <option value="{{ $induk->id }}"
                                        {{ old('induk_id') == $induk->id ? 'selected' : '' }}>{{ $induk->induk }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                            @error('induk_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Sifat*</label>
                            <select class="form-select @error('sifat') is-invalid @enderror" name="sifat" required>
                                <option class="text-center" disabled value="" selected>Pilih Sifat</option>
                                <option value="Reguler" {{ old('sifat') == 'Reguler' ? 'selected' : '' }}>Reguler</option>
                                <option value="Khusus" {{ old('sifat') == 'Khusus' ? 'selected' : '' }}>Khusus</option>
                                <option value="Kinerja" {{ old('sifat') == 'Kinerja' ? 'selected' : '' }}>Kinerja</option>
                                <option value="Rahasia" {{ old('sifat') == 'Rahasia' ? 'selected' : '' }}>Rahasia</option>
                                <option value="Terpadu" {{ old('sifat') == 'Terpadu' ? 'selected' : '' }}>Terpadu</option>
                                <option value="Kasus" {{ old('sifat') == 'Kasus' ? 'selected' : '' }}>Kasus</option>
                            </select>
                            @error('sifat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Upload Draft LHP*</label>
                            <input class="form-control @error('laporan') is-invalid @enderror" type="file" id="formFile"
                                name="laporan" required>
                            @error('laporan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tim Pemeriksa</label>
                            <input id="y" type="hidden" name="pemeriksa"
                                class="form-control @error('pemeriksa') is-invalid @enderror"
                                value="{{ old('pemeriksa') }}">
                            <trix-editor input="y"></trix-editor>
                            @error('pemeriksa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <input type="hidden" name="user" value="{{ auth()->user()->username }}">
                        <input type="hidden" name="irban" value="{{ auth()->user()->kelompok }}">

                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-secondary">Kembali</button>&nbsp;
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form><!-- End Multi Columns Form -->
                </div>
            </div>
        </div>
    </section>
@endsection

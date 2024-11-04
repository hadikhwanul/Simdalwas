@extends('Layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>Edit {{ $judul }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('draft-lhp.index') }}">{{ $judul }}</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Edit</h5>

                    <!-- Multi Columns Form -->
                    <form class="row g-3" action="{{ route('draft-lhp.update', $draft->slug) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- No LHP -->
                        <div class="col-md-6">
                            <label for="no_lhp" class="form-label">No LHP*</label>
                            <input type="text" id="no_lhp" class="form-control @error('no_lhp') is-invalid @enderror"
                                name="no_lhp" value="{{ old('no_lhp', $draft->no_lhp) }}" required>
                            @error('no_lhp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tanggal LHP -->
                        <div class="col-md-6">
                            <label for="tanggal_lhp" class="form-label">Tanggal LHP*</label>
                            <input type="date" id="tanggal_lhp"
                                class="form-control @error('tanggal_lhp') is-invalid @enderror" name="tanggal_lhp"
                                value="{{ old('tanggal_lhp', $draft->tanggal_lhp) }}" required>
                            @error('tanggal_lhp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Judul LHP -->
                        <div class="col-md-6">
                            <label for="judul" class="form-label">Judul LHP*</label>
                            <input type="text" id="judul" name="judul"
                                class="form-control @error('judul') is-invalid @enderror"
                                value="{{ old('judul', $draft->judul) }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Departemen -->
                        <div class="col-6">
                            <label for="departemen_id" class="form-label">Departemen</label>
                            <select id="departemen_id" class="form-select @error('departemen_id') is-invalid @enderror"
                                name="departemen_id">
                                <option disabled value="" selected>Pilih Departemen</option>
                                @foreach ($departemen as $depart)
                                    <option value="{{ $depart->id }}"
                                        {{ old('departemen_id', $draft->departemen_id) == $depart->id ? 'selected' : '' }}>
                                        {{ $depart->departemen }}
                                    </option>
                                @endforeach
                            </select>
                            @error('departemen_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Auditor -->
                        <div class="col-6">
                            <label for="auditor_id" class="form-label">Auditor*</label>
                            <select id="auditor_id" class="form-select @error('auditor_id') is-invalid @enderror"
                                name="auditor_id" required>
                                <option disabled value="" selected>Pilih Auditor</option>
                                @foreach ($auditor as $audit)
                                    <option value="{{ $audit->id }}"
                                        {{ old('auditor_id', $draft->auditor_id) == $audit->id ? 'selected' : '' }}>
                                        {{ $audit->auditor }}
                                    </option>
                                @endforeach
                            </select>
                            @error('auditor_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Bidang -->
                        <div class="col-md-6">
                            <label for="bidang" class="form-label">Bidang</label>
                            <select id="bidang" class="form-select @error('bidang') is-invalid @enderror" name="bidang">
                                <option disabled value="" selected>Pilih Bidang</option>
                                <option value="Komprehensif"
                                    {{ old('bidang', $draft->bidang) == 'Komprehensif' ? 'selected' : '' }}>Komprehensif
                                </option>
                                <option value="Kebijakan"
                                    {{ old('bidang', $draft->bidang) == 'Kebijakan' ? 'selected' : '' }}>Kebijakan</option>
                                <option value="Tupoksi" {{ old('bidang', $draft->bidang) == 'Tupoksi' ? 'selected' : '' }}>
                                    Tupoksi</option>
                                <option value="Pengelolaan Aset Daerah"
                                    {{ old('bidang', $draft->bidang) == 'Pengelolaan Aset Daerah' ? 'selected' : '' }}>
                                    Pengelolaan Aset Daerah</option>
                                <option value="Pengelolaan Keuangan"
                                    {{ old('bidang', $draft->bidang) == 'Pengelolaan Keuangan' ? 'selected' : '' }}>
                                    Pengelolaan Keuangan</option>
                                <option value="Pengelolaan Pendapatan"
                                    {{ old('bidang', $draft->bidang) == 'Pengelolaan Pendapatan' ? 'selected' : '' }}>
                                    Pengelolaan Pendapatan</option>
                                <option value="Pengelolaan Kepegawaian"
                                    {{ old('bidang', $draft->bidang) == 'Pengelolaan Kepegawaian' ? 'selected' : '' }}>
                                    Pengelolaan Kepegawaian</option>
                                <option value="Pengelolaan Kekayaan"
                                    {{ old('bidang', $draft->bidang) == 'Pengelolaan Kekayaan' ? 'selected' : '' }}>
                                    Pengelolaan Kekayaan</option>
                            </select>
                            @error('bidang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Induk -->
                        <div class="col-md-6">
                            <label for="induk_id" class="form-label">Induk*</label>
                            <select id="induk_id" class="form-select @error('induk_id') is-invalid @enderror"
                                name="induk_id" required>
                                <option disabled value="" selected>Pilih Induk</option>
                                @foreach ($induk as $indukItem)
                                    <option value="{{ $indukItem->id }}"
                                        {{ old('induk_id', $draft->induk_id) == $indukItem->id ? 'selected' : '' }}>
                                        {{ $indukItem->induk }}
                                    </option>
                                @endforeach
                            </select>
                            @error('induk_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Sifat -->
                        <div class="col-md-6">
                            <label for="sifat" class="form-label">Sifat*</label>
                            <select id="sifat" class="form-select @error('sifat') is-invalid @enderror" name="sifat"
                                required>
                                <option disabled value="" selected>Pilih Sifat</option>
                                <option value="Reguler" {{ old('sifat', $draft->sifat) == 'Reguler' ? 'selected' : '' }}>
                                    Reguler</option>
                                <option value="Khusus" {{ old('sifat', $draft->sifat) == 'Khusus' ? 'selected' : '' }}>
                                    Khusus</option>
                                <option value="Kinerja" {{ old('sifat', $draft->sifat) == 'Kinerja' ? 'selected' : '' }}>
                                    Kinerja</option>
                                <option value="Rahasia" {{ old('sifat', $draft->sifat) == 'Rahasia' ? 'selected' : '' }}>
                                    Rahasia</option>
                                <option value="Terpadu" {{ old('sifat', $draft->sifat) == 'Terpadu' ? 'selected' : '' }}>
                                    Terpadu</option>
                                <option value="Kasus" {{ old('sifat', $draft->sifat) == 'Kasus' ? 'selected' : '' }}>Kasus
                                </option>
                            </select>
                            @error('sifat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- File Upload -->
                        <div class="col-md-6">
                            <label class="form-label">Upload draft LHP*</label>
                            <input class="form-control @error('laporan') is-invalid @enderror" type="file"
                                id="formFile" name="laporan">

                            @if ($draft->laporan)
                                <p class="text-muted mt-1">
                                    Current file:
                                    <a href="{{ asset($draft->laporan) }}" target="_blank"
                                        class="text-decoration-underline">
                                        {{ basename($draft->laporan) }}
                                    </a>
                                </p>

                                <iframe src="{{ asset($draft->laporan) }}" width="100%" height="500px"
                                    style="border: none;" allowfullscreen></iframe>
                            @endif

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
                                value="{{ old('pemeriksa', $draft->pemeriksa) }}">
                            <trix-editor input="y"></trix-editor>
                            @error('pemeriksa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <input type="hidden" name="user" value="{{ auth()->user()->username }}">
                        <input type="hidden" name="irban" value="{{ auth()->user()->kelompok }}">

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('draft-lhp.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form><!-- End Multi Columns Form -->
                </div>
            </div>
        </div>
    </section>
@endsection

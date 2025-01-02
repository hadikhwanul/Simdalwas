@extends('layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>{{ $judul }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">{{ $judul }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header card-title" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseOne" aria-expanded="false"
                                        aria-controls="flush-collapseOne">
                                        Filter
                                    </button>
                                </h2>
                                <!-- Filter Section -->
                                <form method="GET" action="{{ route('lhp.index') }}">
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="row">
                                            <div class="col-lg-2 mb-3">
                                                <p><strong>Bidang</strong></p>
                                                <select id="filter-bidang" name="bidang" class="form-select">
                                                    <option class="text-center" value="" selected>Pilih
                                                        Bidang</option>
                                                    <option value="Komprehensif"
                                                        {{ request('bidang') == 'Komprehensif' ? 'selected' : '' }}>
                                                        Komprehensif</option>
                                                    <option value="Kebijakan"
                                                        {{ request('bidang') == 'Kebijakan' ? 'selected' : '' }}>Kebijakan
                                                    </option>
                                                    <option value="Tupoksi"
                                                        {{ request('bidang') == 'Tupoksi' ? 'selected' : '' }}>Tupoksi
                                                    </option>
                                                    <option value="Pengelolaan Aset Daerah"
                                                        {{ request('bidang') == 'Pengelolaan Aset Daerah' ? 'selected' : '' }}>
                                                        Pengelolaan Aset Daerah</option>
                                                    <option value="Pengelolaan Keuangan"
                                                        {{ request('bidang') == 'Pengelolaan Keuangan' ? 'selected' : '' }}>
                                                        Pengelolaan Keuangan</option>
                                                    <option value="Pengelolaan Pendapatan"
                                                        {{ request('bidang') == 'Pengelolaan Pendapatan' ? 'selected' : '' }}>
                                                        Pengelolaan Pendapatan</option>
                                                    <option value="Pengelolaan Kepegawaian"
                                                        {{ request('bidang') == 'Pengelolaan Kepegawaian' ? 'selected' : '' }}>
                                                        Pengelolaan Kepegawaian</option>
                                                    <option value="Pengelolaan Kekayaan"
                                                        {{ request('bidang') == 'Pengelolaan Kekayaan' ? 'selected' : '' }}>
                                                        Pengelolaan Kekayaan</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-2 mb-3">
                                                <p><strong>Sifat</strong></p>
                                                <select id="filter-sifat" name="sifat" class="form-select">
                                                    <option class="text-center" value="" selected>Pilih Sifat
                                                    </option>
                                                    <option value="Reguler"
                                                        {{ request('sifat') == 'Reguler' ? 'selected' : '' }}>Reguler
                                                    </option>
                                                    <option value="Khusus"
                                                        {{ request('sifat') == 'Khusus' ? 'selected' : '' }}>Khusus
                                                    </option>
                                                    <option value="Kinerja"
                                                        {{ request('sifat') == 'Kinerja' ? 'selected' : '' }}>Kinerja
                                                    </option>
                                                    <option value="Rahasia"
                                                        {{ request('sifat') == 'Rahasia' ? 'selected' : '' }}>Rahasia
                                                    </option>
                                                    <option value="Terpadu"
                                                        {{ request('sifat') == 'Terpadu' ? 'selected' : '' }}>Terpadu
                                                    </option>
                                                    <option value="Kasus"
                                                        {{ request('sifat') == 'Kasus' ? 'selected' : '' }}>Kasus</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-2 mb-3">
                                                <p><strong>Induk</strong></p>
                                                <select id="filter-induk" name="induk_id"
                                                    class="form-select @error('induk_id') is-invalid @enderror">
                                                    <option class="text-center" value="" selected>Pilih Induk
                                                    </option>
                                                    @forelse ($induks as $induk)
                                                        <option value="{{ $induk->id }}"
                                                            {{ request('induk_id') == $induk->id ? 'selected' : '' }}>
                                                            {{ Str::before($induk->induk ?? '', '-') }}
                                                        </option>
                                                    @empty
                                                        <option value="" disabled>Tidak Ada Induk</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                            <div class="col-lg-2 mb-3">
                                                <p><strong>Tanggal LHP</strong></p>
                                                <input type="date" class="form-control" name="tanggal_lhp"
                                                    id="filter-tanggal_lhp" value="{{ request('tanggal_lhp') }}">
                                            </div>
                                            <div class="col-lg-12 mt-2">
                                                <button type="submit" class="btn btn-primary">Filter</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">Data LHP</h5>
                        </div>
                        @if (session()->has('success'))
                            <div class="alert border-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session()->has('error'))
                            <div class="alert border-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert border-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col" style="max-width: 5%;">No</th>
                                    <th class="text-center" scope="col" style="max-width: 30%;">Judul</th>
                                    <th class="text-center" scope="col" style="max-width: 15%;">Tanggal</th>
                                    <th class="text-center" scope="col" style="max-width: 25%;">Type</th>
                                    <th class="text-center" scope="col" style="max-width: 10%;">T</th>
                                    <th class="text-center" scope="col" style="max-width: 10%;">P</th>
                                    <th class="text-center" scope="col" style="max-width: 10%;">R</th>
                                    <th class="text-center" scope="col" style="max-width: 10%;">TL</th>
                                    <th class="text-center" scope="col" style="max-width: 20%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lhps as $lhp)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td><a href="{{ route('lhp.show', $lhp->slug) }}">{{ $lhp->judul }}</a><br><br>
                                            <span>Induk
                                                :</span>{{ Str::before($lhp->induk->induk ?? '', '-') }}
                                            <br><br>No LHP : {{ $lhp->no_lhp }} <br><br>
                                            <b>{{ $lhp->user }}</b><br>{{ $lhp->irban }}
                                        </td>
                                        <td>{{ $lhp->tanggal_lhp }}</td>
                                        <td><b>Bidang:</b> {{ $lhp->bidang }} <br><br> <b>Sifat:</b>
                                            {{ $lhp->sifat }}
                                        </td>
                                        <td>{{ $lhp->temuans->count() }}</td>
                                        <td>{{ $lhp->temuans->map(fn($temuan) => $temuan->penyebabs)->flatten()->count() }}
                                        </td>
                                        <td>{{ $lhp->temuans->map(fn($temuan) => $temuan->rekomendasis)->flatten()->count() }}
                                        </td>
                                        <td>{{ $lhp->temuans->map(fn($temuan) => $temuan->rekomendasis->map(fn($rekomendasi) => $rekomendasi->tindaks)->flatten())->flatten()->count() }}
                                        </td>

                                        <td>
                                            <div class="row text-center">
                                                <div class="demo-inline-spacing">
                                                    <a href="{{ route('lhp.temuan', $lhp->slug) }}"
                                                        class="btn btn-outline-warning" data-toggle="tooltip"
                                                        title="Daftar Temuan">
                                                        <span class="tf-icons bx bx-add-to-queue me-1"></span>
                                                    </a>
                                                    <a href="{{ route('lhp.edit', $lhp->slug) }}"
                                                        class="btn btn-outline-primary" data-toggle="tooltip"
                                                        title="Perbarui Data">
                                                        <span class="tf-icons bx bx-edit-alt me-1"></span>
                                                    </a>
                                                    <form action="{{ route('lhp.destroy', $lhp->slug) }}" method="POST"
                                                        class="d-inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-danger"
                                                            data-toggle="tooltip" title="Hapus Data"
                                                            onclick="return confirm('Yakin Ingin Menghapus Data?')">
                                                            <span class="tf-icons bx bx-trash me-1"></span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak Ada Data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@extends('layouts.main')

@section('main')
    <div class="pagetitle d-flex justify-content-between">
        <div>
            <h1>{{ $judul }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">{{ $judul }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

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
                                <form method="GET" action="{{ route('review-draft-lhp.index') }}">
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
                                                <p><strong>Status</strong></p>
                                                <select id="filter-status" name="status" class="form-select">
                                                    <option class="text-center" value="" selected>Pilih
                                                        Status</option>
                                                    <option value="Review DALNIS"
                                                        {{ request('status') == 'Review DALNIS' ? 'selected' : '' }}>Review
                                                        DALNIS</option>
                                                    <option value="Review IRBAN"
                                                        {{ request('status') == 'Review IRBAN' ? 'selected' : '' }}>Review
                                                        IRBAN</option>
                                                    <option value="Review Sekretaris"
                                                        {{ request('status') == 'Review Sekretaris' ? 'selected' : '' }}>
                                                        Review Sekretaris</option>
                                                    <option value="Review Inspektur"
                                                        {{ request('status') == 'Review Inspektur' ? 'selected' : '' }}>
                                                        Review Inspektur</option>
                                                    <option value="LHP Terbit"
                                                        {{ request('status') == 'LHP Terbit' ? 'selected' : '' }}>LHP
                                                        Terbit</option>
                                                    <option value="Revisi DALNIS"
                                                        {{ request('status') == 'Revisi DALNIS' ? 'selected' : '' }}>Revisi
                                                        DALNIS</option>
                                                    <option value="Revisi IRBAN"
                                                        {{ request('status') == 'Revisi IRBAN' ? 'selected' : '' }}>Revisi
                                                        IRBAN</option>
                                                    <option value="Revisi Sekretaris"
                                                        {{ request('status') == 'Revisi Sekretaris' ? 'selected' : '' }}>
                                                        Revisi Sekretaris</option>
                                                    <option value="Revisi Inspektur"
                                                        {{ request('status') == 'Revisi Inspektur' ? 'selected' : '' }}>
                                                        Revisi Inspektur</option>
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
                                            <div class="col-lg-12 mt-2 ">
                                                <button type="submit" class="btn btn-primary">Filter</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <h5 class="card-title">Data Review Draft LHP</h5>
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
                                    <th class="text-center" scope="col" style="max-width: 10%;">User</th>
                                    <th class="text-center" scope="col" style="max-width: 30%;">Judul</th>
                                    <th class="text-center" scope="col" style="max-width: 15%;">Tanggal</th>
                                    <th class="text-center" scope="col" style="max-width: 20%;">Type</th>
                                    <th class="text-center" scope="col" style="max-width: 10%;">Status</th>
                                    <th class="text-center" scope="col" style="max-width: 10%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($review as $review)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td><b>{{ $review->user }}</b><br>{{ $review->irban }}</td>
                                        <td><a
                                                href="{{ route('draft-lhp.show', $review->slug) }}">{{ $review->judul }}</a><br><br>
                                            <span>Induk
                                                :</span>{{ Str::before($review->induk->induk ?? '', '-') }}
                                            <br><br>No
                                            Draft LHP : {{ $review->no_lhp }}
                                        </td>
                                        <td>{{ $review->tanggal_lhp }}</td>
                                        <td><b>Bidang:</b><br> {{ $review->bidang }} <br> <b>Sifat:</b>
                                            {{ $review->sifat }}
                                        </td>
                                        <td class="text-center">
                                            <span @class([
                                                'badge',
                                                'bg-warning' => in_array($review->status, [
                                                    'Review DALNIS',
                                                    'Review IRBAN',
                                                    'Review Sekretaris',
                                                    'Review Inspektur',
                                                ]),
                                                'bg-success' => $review->status === 'LHP Terbit',
                                                'bg-danger' => in_array($review->status, [
                                                    'Revisi DALNIS',
                                                    'Revisi IRBAN',
                                                    'Revisi Sekretaris',
                                                    'Revisi Inspektur',
                                                ]),
                                                'bg-secondary' => !in_array($review->status, [
                                                    'Review DALNIS',
                                                    'Review IRBAN',
                                                    'Review Sekretaris',
                                                    'Review Inspektur',
                                                    'LHP Terbit',
                                                    'Revisi DALNIS',
                                                    'Revisi IRBAN',
                                                    'Revisi Sekretaris',
                                                    'Revisi Inspektur',
                                                ]),
                                            ])>
                                                {{ $review->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <a href="{{ route('review-draft-lhp.show', $review->slug) }}"
                                                    class="btn btn-outline-secondary" data-toggle="tooltip"
                                                    title="Review Draft LHP">
                                                    <i class="tf-icons bx bx-task"></i>
                                                </a>
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

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true
            });
        });
    </script>
@endsection

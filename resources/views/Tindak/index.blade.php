@extends('layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>Data {{ $judul }}</h1>
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
                                <h1 class="accordion-header card-title" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseOne" aria-expanded="false"
                                        aria-controls="flush-collapseOne">
                                        FIlter
                                    </button>
                                </h1>
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <!-- Default Card -->
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div>
                                                <p><Strong>Default Card</Strong></p>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div><!-- End Default Card -->
                                        <div class="col-lg-2">
                                            <div>
                                                <p><Strong>Default Card</Strong></p>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div><!-- End Default Card -->
                                        <div class="col-lg-2">
                                            <div>
                                                <p><Strong>Default Card</Strong></p>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div><!-- End Default Card -->
                                        <div class="col-lg-2">
                                            <div>
                                                <p><Strong>Default Card</Strong></p>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div><!-- End Default Card -->
                                        <div class="col-lg-2">
                                            <div>
                                                <p><Strong>Default Card</Strong></p>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div><!-- End Default Card -->
                                        <div class="col-lg-2">
                                            <div>
                                                <p><Strong>Default Card</Strong></p>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div><!-- End Default Card -->
                                        <div class="col-lg-2">
                                            <div>
                                                <p><Strong>Default Card</Strong></p>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div><!-- End Default Card -->
                                        <div class="col-lg-2">
                                            <div>
                                                <p><Strong>Default Card</Strong></p>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div><!-- End Default Card -->
                                        <div class="col-lg-2">
                                            <div>
                                                <p><Strong>Default Card</Strong></p>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div><!-- End Default Card -->
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-primary">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">Data {{ $judul }}</h5>
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
                                    <th class="text-center" scope="col" style="max-width: 15%;">LHP - Satker</th>
                                    <th class="text-center" scope="col" style="max-width: 15%;">Rekomendasi</th>
                                    <th class="text-center" scope="col" style="max-width: 15%;">Uraian <br> Tindak Lanjut
                                    </th>
                                    <th class="text-center" scope="col" style="max-width: 10%;">Status</th>
                                    <th class="text-center" scope="col" style="max-width: 10%;">Nilai Kerugian</th>
                                    <th class="text-center" scope="col" style="max-width: 10%;">Nilai Kewajiban</th>
                                    <th class="text-center" scope="col" style="max-width: 5%;">PJ</th>
                                    <th class="text-center" scope="col" style="max-width: 10%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($rekomendasi as $rkmdn)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ route('lhp.show', $rkmdn->temuan->first()->draft->slug) }}">
                                                {{ $rkmdn->temuan->first()->draft->judul }}
                                            </a>
                                        </td>
                                        <td>{!! $rkmdn->rekomendasi !!}</td>
                                        <td>{!! optional($rkmdn->tindaks)->tindak ?? '-' !!}</td>
                                        <td class="text-center">
                                            <span @class([
                                                'badge',
                                                'bg-success' => optional($rkmdn->tindaks)->status === 'TLS',
                                                'bg-warning' => optional($rkmdn->tindaks)->status === 'MDP',
                                                'bg-danger' => optional($rkmdn->tindaks)->status === 'TPTD',
                                                'bg-primary' => optional($rkmdn->tindaks)->status === 'TPB',
                                                'bg-secondary' => !in_array(optional($rkmdn->tindaks)->status, [
                                                    'MDP',
                                                    'TLS',
                                                    'TPTD',
                                                    'TPB',
                                                ]),
                                            ])>
                                                {{ optional($rkmdn->tindaks)->status ?? '-' }}
                                            </span>
                                        </td>

                                        <td>
                                            <span>Nilai: Rp.
                                            </span><br><br>
                                            <span>Tarik: Rp.
                                            </span><br><br>
                                            <span>Sisa: Rp.
                                        </td>
                                        <td><span>Nilai: Rp.
                                            </span><br><br>
                                            <span>Tarik: Rp.
                                            </span><br><br>
                                            <span>Sisa: Rp.
                                        </td>
                                        <td class="text-center">0</td>
                                        <td>
                                            <div class="row text-center">
                                                <div class="demo-inline-spacing mb-1">
                                                    @if ($rkmdn->tindaks?->first()?->tindak == null)
                                                        <a href="{{ route('tambah.tindak', $rkmdn->slug) }}"
                                                            class="btn btn-outline-warning" data-toggle="tooltip"
                                                            title="Tambah Data Tindak Lanjut">
                                                            <span class="tf-icons bx bx-add-to-queue mx-auto"></span>
                                                        </a>
                                                    @endif
                                                    <a href="" class="btn btn-outline-primary mb-1"
                                                        data-toggle="tooltip" title="Perbarui Data">
                                                        <span class="tf-icons bx bx-edit-alt mx-auto"></span>
                                                    </a>
                                                    <a href="{{ route('daftar.pj', $rkmdn->tindaks?->first()?->slug ?? 'default-slug') }}"
                                                        class="btn btn-outline-success mb-1" data-toggle="tooltip"
                                                        title="Daftar Penanggung Jawab">
                                                        <span class="tf-icons bx bx-user-plus mx-auto"></span>
                                                    </a>
                                                    <form action="" method="POST" class="d-inline mb-1">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-danger "
                                                            data-toggle="tooltip" title="Hapus Data"
                                                            onclick="return confirm('Yakin Ingin Menghapus Data?')">
                                                            <span class="tf-icons bx bx-trash mx-auto"></span>
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

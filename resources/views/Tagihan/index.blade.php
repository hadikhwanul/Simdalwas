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
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data {{ $judul }}</h5>
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
                                    <th class="text-center" style="max-width: 10%;">No</th>
                                    <th class="text-center" style="max-width: 20%;">Penanggung Jawab</th>
                                    <th class="text-center" style="max-width: 20%;">OPD-Satker & Kecamatan-Desa/kelurahan
                                    </th>
                                    <th class="text-center" style="max-width: 15%;">Kerugian</th>
                                    <th class="text-center" style="max-width: 15%;">Kewajiban</th>
                                    <th class="text-center" style="max-width: 10%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tagihan as $tagih)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $tagih->user->nama ?? '-' }}</td>
                                        <td>{{ $tagih->satker->opd ?? '-' }} - {{ $tagih->satker->sekolah ?? '-' }}
                                            <br><br>
                                            {{ $tagih->kecamatan->kecamatan ?? '-' }} -
                                            {{ $tagih->kecamatan->deskel ?? '-' }}
                                        </td>
                                        <td>
                                            <span>Nilai: Rp. {{ $tagih->total_kerugian }}
                                            </span><br><br>
                                            <span>Sisa: Rp. {{ $tagih->sisa_kerugian }}
                                            </span><br><br>
                                            <span>Tarik: Rp. {{ $tagih->bayar_kerugian }}
                                        </td>
                                        <td>
                                            <span>Nilai: Rp. {{ $tagih->total_kewajiban }}
                                            </span><br><br>
                                            <span>Sisa: Rp. {{ $tagih->sisa_kewajiban }}
                                            </span><br><br>
                                            <span>Tarik: Rp. {{ $tagih->bayar_kewajiban }}
                                        </td>
                                        <td>
                                            <div class="row text-center">
                                                <div class="demo-inline-spacing">
                                                    <a href="{{ route('daftar.valid', ['tagihan' => $tagih->slug]) }}"
                                                        class="btn btn-outline-primary" data-toggle="tooltip"
                                                        title="Validasi Pengembalian Dana">
                                                        <span class="tf-icons bx bx-task me-1"></span>
                                                    </a>
                                                    <a href="{{ route('daftar.bayar', ['tagihan' => $tagih->slug]) }}"
                                                        class="btn btn-outline-success" data-toggle="tooltip"
                                                        title="Daftar Pembayaran">
                                                        <span class="tf-icons bx bx-money-withdraw me-1"></span>
                                                    </a>


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
                        <div class="d-flex justify-content-end mt-3">
                            <span>{{ $tagihan->onEachSide(1)->links() }} </span>
                        </div>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

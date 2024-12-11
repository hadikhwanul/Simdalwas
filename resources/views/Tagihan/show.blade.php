@extends('Layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>Daftar Pembayaran</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="">{{ $judul }}</a></li>
                <li class="breadcrumb-item active">Daftar Pembayaran</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <span class="alert alert-primary  alert-dismissible fade show"><strong>Total Pengembalian
                            Dana</strong></span>
                    <div class="card-body pt-3">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-bold">Satuan Kerja</div>
                            <div class="col-lg-9 col-md-8">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-bold">Total Kerugian</div>
                            <div class="col-lg-9 col-md-8"></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-bold">Total Kewajiban</div>
                            <div class="col-lg-9 col-md-8">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="pagetitle d-flex justify-content-between">
                            <div>
                                <h5 class="card-title">Daftar Pembayaran</h5>
                            </div>
                            <div class="py-3 pe-2">
                                <a href="{{ route('form.bayar') }}">
                                    <button type="button" class="btn btn-warning rounded-pill">
                                        <strong><i class='bx bx-plus'></i> Tambah</strong>
                                    </button>
                                </a>
                            </div>
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
                                    <th class="text-center" scope="col" style="max-width: 10%;">No</th>
                                    <th class="text-center" scope="col" style="max-width: 20%;">Jumlah Pembayaran</th>
                                    <th class="text-center" scope="col" style="max-width: 20%;">Sisa Pembayaran</th>
                                    <th class="text-center" scope="col" style="max-width: 20%;">Tanggal Pembayaran</th>
                                    <th class="text-center" scope="col" style="max-width: 10%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td class="text-center"></td>
                                    <td><a href=""></a></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center">
                                        <div class="row text-center">
                                            <div class="demo-inline-spacing">
                                                <a href="" class="btn btn-outline-primary" data-toggle="tooltip"
                                                    title="Perbarui Data">
                                                    <span class="tf-icons bx bx-edit-alt me-1"></span>
                                                </a>

                                                <form action="" method="POST" class="d-inline">
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

                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>

            </div>

        </div>


    </section>
@endsection

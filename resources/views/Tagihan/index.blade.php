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
                                    <th class="text-center" style="max-width: 20%;">OPD & Satker</th>
                                    <th class="text-center" style="max-width: 20%;">Kecamatan & Desa Kelurahan</th>
                                    <th class="text-center" style="max-width: 20%;">Status</th>
                                    <th class="text-center" style="max-width: 10%;">Kerugian</th>
                                    <th class="text-center" style="max-width: 10%;">Kewajiban</th>
                                    <th class="text-center" style="max-width: 10%;">Jumlah Pembayaran</th>
                                    <th class="text-center" style="max-width: 10%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            <a href="{{ route('penanggung-jawab.show', $user->username) }}">
                                                {{ $user->nama }}
                                            </a>
                                        </td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->kelompok }}</td>
                                        <td>{{ $user->jobdesks->role }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="row text-center">
                                                <div class="demo-inline-spacing">
                                                    <a href="{{ route('penanggung-jawab.edit', $user->username) }}"
                                                        class="btn btn-outline-primary" data-toggle="tooltip"
                                                        title="Validasi Pengembalian Dana">
                                                        <span class="tf-icons bx bx-task me-1"></span>
                                                    </a>
                                                    <a href="{{ route('daftar.bayar') }}" class="btn btn-outline-success"
                                                        data-toggle="tooltip" title="Daftar Pembayaran">
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
                            <span>{{ $users->onEachSide(1)->links() }} </span>
                        </div>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

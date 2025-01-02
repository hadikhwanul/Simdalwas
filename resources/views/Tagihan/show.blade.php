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
                                {{ $tagih->satker->opd }} - {{ $tagih->satker->sekolah }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-bold">Kecamatan</div>
                            <div class="col-lg-9 col-md-8">
                                {{ $tagih->kecamatan->kecamatan }} - {{ $tagih->kecamatan->deskel }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-bold">Tenggat Pembayaran</div>
                            <div class="col-lg-9 col-md-8">
                                {{ $tagih->deadline }}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-6 row">
                                <div class="col-lg-5 col-md-4 label fw-bold">Total Kerugian</div>
                                <div class="col-lg-6 col-md-8">
                                    <span>Nilai: Rp. {{ $tagih->total_kerugian }}
                                    </span><br>
                                    <span>Sisa: Rp. {{ $tagih->sisa_kerugian }}
                                    </span><br>
                                    <span>Tarik: Rp. {{ $tagih->bayar_kerugian }}
                                </div>
                            </div>
                            <div class="col-lg-6 row">
                                <div class="col-lg-6 col-md-4 label fw-bold">Total Kewajiban</div>
                                <div class="col-lg-6 col-md-8">
                                    <span>Nilai: Rp. {{ $tagih->total_kewajiban }}
                                    </span><br>
                                    <span>Sisa: Rp. {{ $tagih->sisa_kewajiban }}
                                    </span><br>
                                    <span>Tarik: Rp. {{ $tagih->bayar_kewajiban }}
                                </div>
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
                                <a href="{{ route('form.bayar', ['tagihan' => $tagih->slug]) }}">
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
                                    <th class="text-center" scope="col" style="max-width: 20%;">Jumlah Pembayaran
                                        Kerugian</th>
                                    <th class="text-center" scope="col" style="max-width: 20%;">Jumlah Pembayaran
                                        kewajiban</th>
                                    <th class="text-center" scope="col" style="max-width: 20%;">Tanggal Pembayaran</th>
                                    <th class="text-center" scope="col" style="max-width: 20%;">Status</th>
                                    <th class="text-center" scope="col" style="max-width: 10%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pembayaran as $bayar)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                        <td>Rp. {{ $bayar->bayar_rugi }}</td>
                                        <td>RP. {{ $bayar->bayar_wajib }}</td>
                                        <td class="text-center">{{ $bayar->tanggal_bayar }}</td>
                                        <td class="text-center"><span @class([
                                            'badge',
                                            'bg-success' => $bayar->status === 'Pembayaran Sukses',
                                            'bg-warning' => $bayar->status === 'Menunggu Konfirmasi',
                                            'bg-danger' => $bayar->status === 'Pembayaran Ditolak',
                                            'bg-secondary' => !in_array($bayar->status, [
                                                'Pembayaran Sukses',
                                                'Menunggu Konfirmasi',
                                                'Pembayaran Ditolak',
                                            ]),
                                        ])>
                                                {{ $bayar->status ?? '-' }}
                                            </span></td>
                                        <td class="text-center">
                                            <div class="row text-center">
                                                <div class="demo-inline-spacing">
                                                    <a href="{{ route('edit.bayar', ['tagihan' => $tagih->slug, 'bayaranslug' => $bayar->slug]) }}"
                                                        class="btn btn-outline-primary" data-toggle="tooltip"
                                                        title="Perbarui Data">
                                                        <span class="tf-icons bx bx-edit-alt me-1"></span>
                                                    </a>

                                                    <form
                                                        action="{{ route('destroy.bayar', ['tagihan' => $tagih->slug, 'bayaranslug' => $bayar->slug]) }}"
                                                        method="POST" class="d-inline">
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
                                        <td colspan="8" class="text-center">Tidak Ada Riwayat Pembayaran</td>
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

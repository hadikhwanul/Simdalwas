@extends('layouts.main')

@section('main')
    <div class="pagetitle d-flex justify-content-between">
        <div>
            <h1>Daftar Tagihan Tindak Lanjut</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('tindak.index') }}">Tindak Lanjut</a></li>
                    <li class="breadcrumb-item active">Daftar Tagihan Tindak Lanjut</li>
                </ol>
            </nav>
        </div>
        <div class="py-3 pe-2">
            <a href="{{ route('draft-lhp.index') }}">
                <button type="button" class="btn btn-outline-info rounded-pill">
                    <strong><i class='bx bx-arrow-back'></i> Kembali</strong>
                </button>
            </a>
        </div>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <span class="alert alert-success  alert-dismissible fade show"><strong>Detail Tindak</strong></span>
                    <div class="card-body pt-3">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Tindak Lanjut</div>
                            <div class="col-lg-9 col-md-8">{!! $tindak->tindak !!}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Pokok Tindak Lanjut</div>
                            <div class="col-lg-9 col-md-8">
                                {{ $tindak->pokokTindak?->no_pokok . '. ' . $tindak->pokokTindak?->pokok_tindak ?? 'Tidak ada pokok rekomendasi' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Sub Pokok Tindak Lanjut</div>
                            <div class="col-lg-9 col-md-8">
                                {{ $tindak->pokokTindak?->no_subpokok . '. ' . $tindak->pokokTindak?->sub_pokok_tindak ?? 'Tidak ada pokok rekomendasi' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Status</div>
                            <div class="col-lg-9 col-md-8">{{ $tindak->status }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="pagetitle d-flex justify-content-between">
                            <div>
                                <h5 class="card-title">Data Tagihan dan Penanggung jawab</h5>
                            </div>
                            <div class="py-3 pe-2">
                                <a href="{{ route('tambah.pj', $tindak->slug) }}">
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
                                    <th class="text-center" style="max-width: 10%;">No</th>
                                    <th class="text-center" style="max-width: 20%;">Penanggung Jawab</th>
                                    <th class="text-center" style="max-width: 20%;">OPD & Satker</th>
                                    <th class="text-center" style="max-width: 20%;">Kecamatan & Desa Kelurahan</th>
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
                                        <td>{{ $tagih->satker->opd ?? '-' }} - {{ $tagih->satker->sekolah ?? '-' }}</td>
                                        <td>{{ $tagih->kecamatan->kecamatan ?? '-' }} -
                                            {{ $tagih->kecamatan->deskel ?? '-' }}</td>
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
                                                <div class="demo-inline-spacing mb-1">
                                                    <a href="{{ route('edit.pj', ['tindak' => $tagih->tindaks->first()?->slug ?? 'default-slug', 'tagihanSlug' => $tagih->slug]) }}"
                                                        class="btn btn-outline-primary mb-1">
                                                        <span class="tf-icons bx bx-edit-alt mx-auto"></span>
                                                    </a>

                                                    <form
                                                        action="{{ route('destroy.pj', ['tindak' => $tagih->tindaks->first()?->slug ?? 'default-slug', 'tagihanSlug' => $tagih->slug]) }}"
                                                        method="POST" class="d-inline mb-1">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-danger"
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
                                        <td colspan="7" class="text-center">Tidak Ada Data Tagihan</td>
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

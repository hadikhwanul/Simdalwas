@extends('layouts.main')

@section('main')
    <div class="pagetitle d-flex justify-content-between">
        <div>
            <h1>Review Draft LHP</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('lhp.index') }}">LHP</a></li>
                    <li class="breadcrumb-item active">Temuan {{ $judul }}</li>
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
            <div class="col-lg-6">
                <div class="card ">
                    <span class="alert alert-danger  alert-dismissible fade show"><strong>Details Draft
                            LHP</strong></span>
                    <div class="card-body pt-3 ">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Tanggal LHP</div>
                            <div class="col-lg-9 col-md-8">{{ $lhp->tanggal_lhp }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">No LHP</div>
                            <div class="col-lg-9 col-md-8">{{ $lhp->no_lhp }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Judul</div>
                            <div class="col-lg-9 col-md-8">{{ $lhp->judul }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <span class="alert alert-success  alert-dismissible fade show"><strong>Pemeriksa dan
                            Penyelenggara</strong></span>
                    <div class="card-body pt-3">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Auditor</div>
                            <div class="col-lg-9 col-md-8">{{ $lhp->auditor->auditor }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Induk</div>
                            <div class="col-lg-9 col-md-8">{{ $lhp->induk->induk }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Departemen</div>
                            <div class="col-lg-9 col-md-8">{{ $lhp->departemen->departemen }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Sifat</div>
                            <div class="col-lg-9 col-md-8">{{ $lhp->sifat }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Bidang</div>
                            <div class="col-lg-9 col-md-8">{{ $lhp->bidang }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="pagetitle d-flex justify-content-between">
                            <div>
                                <h5 class="card-title">Data Temuan LHP</h5>
                            </div>
                            <div class="py-3 pe-2">
                                <a href="{{ route('tambah.temuan', $lhp->slug) }}">
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
                                    <th class="text-center" scope="col" style="max-width: 20%;">Temuan</th>
                                    <th class="text-center" scope="col" style="max-width: 20%;">Pokok Temuan</th>
                                    <th class="text-center" scope="col" style="max-width: 20%;">Sub Temuan</th>
                                    <th class="text-center" scope="col" style="max-width: 10%;">Penyebab</th>
                                    <th class="text-center" scope="col" style="max-width: 10%;">Rekomendasi</th>
                                    <th class="text-center" scope="col" style="max-width: 10%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($temuans as $temuan)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="">{!! $temuan->temuan !!}</a>
                                        </td>
                                        <td>{{ $temuan->pokokTemuan->pokok_temuan }}
                                            <br><br><b>{{ 'Kode : 2.' . $temuan->pokokTemuan->no_pokok . '.' . $temuan->pokokTemuan->no_subpokok }}</b>
                                        </td>
                                        <td>{{ $temuan->pokokTemuan->sub_pokok_temuan }}
                                        </td>
                                        <td class="text-center"><b>{{ $temuan->penyebabs->count() }}</b></td>
                                        <td class="text-center"><b>{{ $temuan->rekomendasis->count() }}</b></td>
                                        <td class="text-center">
                                            <div class="row d-flex justify-content-center">
                                                <div class="demo-inline-spacing">
                                                    <a href="{{ route('temuan.edit', ['draft' => $lhp->slug, 'temuan' => $temuan->id]) }}"
                                                        class="btn btn-outline-primary">
                                                        <span class="tf-icons bx bx-edit-alt me-1"></span>
                                                    </a>

                                                    <form
                                                        action="{{ route('temuan.destroy', ['draft' => $lhp->slug, 'temuan' => $temuan->id]) }}"
                                                        method="POST" class="d-inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-danger"
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

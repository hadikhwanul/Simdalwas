@extends('layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>Data Tables</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data</li>
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
                                    <th class="text-center" scope="col" style="max-width: 20%;">Judul</th>
                                    <th class="text-center" scope="col" style="max-width: 15%;">Tanggal</th>
                                    <th class="text-center" scope="col" style="max-width: 15%;">No LHP</th>
                                    <th class="text-center" scope="col" style="max-width: 20%;">Type</th>
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
                                        <td><a href="{{ route('lhp.show', $lhp->slug) }}">{{ $lhp->judul }}</a>
                                        </td>
                                        <td>{{ $lhp->tanggal_lhp }}</td>
                                        <td>{{ $lhp->no_lhp }}</td>
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
                                            <div class="row d-flex justify-content-center">
                                                <div class="demo-inline-spacing">
                                                    <a href="{{ route('lhp.temuan', $lhp->slug) }}"
                                                        class="btn btn-outline-warning">
                                                        <span class="tf-icons bx bx-add-to-queue me-1"></span>
                                                    </a>
                                                    <a href="{{ route('lhp.edit', $lhp->slug) }}"
                                                        class="btn btn-outline-primary">
                                                        <span class="tf-icons bx bx-edit-alt me-1"></span>
                                                    </a>
                                                    <form action="{{ route('lhp.destroy', $lhp->slug) }}" method="POST"
                                                        class="d-inline">
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

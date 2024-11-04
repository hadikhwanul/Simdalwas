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
                            <h5 class="card-title">Datatables</h5>
                            <div class="py-3 pe-2">
                                <button type="button" class="btn btn-warning rounded-pill"><Strong><i
                                            class='bx bx-plus'></i>Tambah</Strong></button>
                            </div>
                        </div>
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
                                        <td><a href="{{ route('draft-lhp.show', $lhp->slug) }}">{{ $lhp->judul }}</a>
                                        </td>
                                        <td>{{ $lhp->tanggal_lhp }}</td>
                                        <td>{{ $lhp->no_lhp }}</td>
                                        <td><b>Bidang:</b> {{ $lhp->bidang }} <br><br> <b>Sifat:</b>
                                            {{ $lhp->sifat }}
                                        </td>
                                        <td>10</td>
                                        <td>10</td>
                                        <td>10</td>
                                        <td>10</td>
                                        <td>
                                            <div class="row d-flex justify-content-center">
                                                <div class="demo-inline-spacing">
                                                    <a href="" class="btn btn-outline-warning">
                                                        <span class="tf-icons bx bx-add-to-queue me-1"></span>
                                                    </a>
                                                    <a href="" class="btn btn-outline-primary">
                                                        <span class="tf-icons bx bx-edit-alt me-1"></span>
                                                    </a>
                                                    <form action="" method="POST" class="d-inline">
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

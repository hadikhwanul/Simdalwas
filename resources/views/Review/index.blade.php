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
                                    <th scope="col">No</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">No LHP</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Brandon Jacob</td>
                                    <td>Designer</td>
                                    <td>2016-05-25</td>
                                    <td>28</td>
                                    <td>2016-05-25</td>
                                    <td>2016-05-25</td>
                                    <td>
                                        <div class="row align-items-between">
                                            <div class="demo-inline-spacing">
                                                <a href=""
                                                    class="btn btn-outline-primary">
                                                    <span class="tf-icons bx bx-edit-alt me-1"></span>
                                                </a>
                                                <form
                                                    action=""
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
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

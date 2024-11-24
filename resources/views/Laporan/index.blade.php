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
            <div class="col-lg-6">
                <div class="card ">
                    <span class="alert alert-danger  alert-dismissible fade show"><strong>Laporan Draft
                            LHP</strong></span>
                    <div class="card-body pt-3 ">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Tanggal Draft LHP</div>
                            <div class="col-lg-9 col-md-8"></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">No Draft LHP</div>
                            <div class="col-lg-9 col-md-8"></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Judul</div>
                            <div class="col-lg-9 col-md-8"></div>
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
                            <div class="col-lg-9 col-md-8"></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Induk</div>
                            <div class="col-lg-9 col-md-8"></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Departemen</div>
                            <div class="col-lg-9 col-md-8"></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Sifat</div>
                            <div class="col-lg-9 col-md-8"></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Bidang</div>
                            <div class="col-lg-9 col-md-8"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

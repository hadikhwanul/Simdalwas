@extends('Layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>Tambah {{ $judul }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('draft-lhp.index') }}">{{ $judul }}</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Tambah</h5>
                    <!-- Multi Columns Form -->
                    <form class="row g-3">
                        <div class="col-md-6">
                            <label for="inputName5" class="form-label">No LHP*</label>
                            <input type="text" class="form-control" id="inputName5">
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword5" class="form-label">Tanggal LHP*</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail5" class="form-label">Judul LHP*</label>
                            <input id="x" type="hidden" name="content" class="form-control">
                            <trix-editor input="x"></trix-editor>
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail5" class="form-label">Tim Pemeriksa</label>
                            <input id="x" type="hidden" name="content" class="form-control">
                            <trix-editor input="x"></trix-editor>
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword5" class="form-label">Tahun*</label>
                            <input type="text" class="form-control yearpicker">
                        </div>
                        <div class="col-6">
                            <label for="inputAddress5" class="form-label">Departemen</label>
                            <select id="inputState" class="form-select">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="inputAddress2" class="form-label">Auditor*</label>
                            <select id="inputState" class="form-select">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="inputCity" class="form-label">Bidang</label>
                            <select id="inputState" class="form-select">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="inputState" class="form-label">Induk*</label>
                            <select id="inputState" class="form-select">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="inputState" class="form-label">Sifat*</label>
                            <select id="inputState" class="form-select">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword5" class="form-label">User*</label>
                            <input type="text" class="form-control" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword5" class="form-label">Slug*</label>
                            <input type="text" class="form-control" disabled>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-secondary">Kembali</button>&nbsp;
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form><!-- End Multi Columns Form -->
                </div>
            </div>
        </div>
    </section>
@endsection

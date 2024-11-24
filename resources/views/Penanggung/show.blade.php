@extends('layouts.main')

@section('main')
    <div class="pagetitle d-flex justify-content-between">
        <div>
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('account-center.index') }}">{{ $judul }}</a></li>
                    <li class="breadcrumb-item active">Detail Users</li>
                </ol>
            </nav>
        </div>
        <div class="py-3 pe-2"><a href="{{ route('account-center.index') }}">
                <button type="button" class="btn btn-outline-info rounded-pill"><Strong><i
                            class='bx bx-arrow-back'></i>Kembali</Strong></button></a>
        </div>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="{{ $user->profile ? URL::asset('storage/' . $user->profile) : URL::asset('assets/img/profile-img.jpg') }}"
                            alt="Profile" class="rounded-circle">
                        <h2>{{ $user->nama }}</h2>
                        <div class="d-flex align-items-center">
                            <h3><b>{{ $user->kelompok }}</b></h3> &nbsp
                            <h3>{{ $user->jobdesks->role }}</h3>
                        </div>

                        <div class="social-links mt-2">
                            <a href="https://wa.me/{{ $user->no_wa }}" target="_blank" class="whatsapp"><i
                                    class="bi bi-whatsapp"></i></a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Profile User</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Nama</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->nama }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Username</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->username }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">NIP</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->NIP }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Kelompok</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->kelompok }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Role</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->jobdesks->role }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">No HP</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->no_hp }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">No Wa</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->no_wa }}</div>
                                </div>

                                <div class="row">
                                    <div class="col d-flex justify-content-start">
                                        <a href="{{ route('account-center.edit', $user->username) }}"
                                            class="btn btn-outline-primary me-2">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <form action="{{ route('account-center.destroy', $user->username) }}"
                                            method="POST" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger"
                                                onclick="return confirm('Yakin Ingin Menghapus Data?')">
                                                <i class="bx bx-trash me-1"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>


                            </div>
                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

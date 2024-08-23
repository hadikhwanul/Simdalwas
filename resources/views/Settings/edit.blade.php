@extends('layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Users</li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="{{ auth()->user()->profile ? URL::asset('storage/' . auth()->user()->profile) : URL::asset('assets/img/profile-img.jpg') }}"
                            alt="Profile" class="rounded-circle">
                        <h2>{{ auth()->user()->nama }}</h2>
                        <div class="d-flex align-items-center">
                            <h3><b>{{ auth()->user()->kelompok }}</b></h3> &nbsp
                            <h3>{{ auth()->user()->jobdesks->role }}</h3>
                        </div>

                        <div class="social-links mt-2">
                            <a href="https://wa.me/{{ auth()->user()->no_wa }}" target="_blank" class="whatsapp"><i
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
                                <a class="nav-link {{ request()->routeIs('settings.index') ? 'active' : '' }}"
                                    href="{{ route('settings.index') }}">
                                    Overview
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('settings.edit') ? 'active' : '' }}"
                                    href="{{ route('settings.edit', auth()->user()->username) }}">
                                    Edit Profile
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('settings.change-password') ? 'active' : '' }}"
                                    href="{{ route('settings.change-password') }}">
                                    Change Password
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active pt-3" id="profile-edit">
                                <form method="POST" action="{{ route('settings.update', auth()->user()->username) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                            Image</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img class="mb-3" id="preview"
                                                src="{{ old('profile', auth()->user()->profile ? asset('storage/' . auth()->user()->profile) : '') }}"
                                                alt="Preview Gambar"
                                                style="max-width: 150px; margin-top: 10px; {{ old('profile') || auth()->user()->profile ? 'display: block;' : 'display: none;' }}">
                                            <input class="form-control @error('profile') is-invalid @enderror"
                                                type="file" id="formFile" accept="image/*"
                                                onchange="previewImage(event)" name="profile">
                                            @error('profile')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="nama" type="text"
                                                class="form-control @error('nama') is-invalid @enderror" id="fullName"
                                                value="{{ old('nama', auth()->user()->nama) }}">
                                            @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="username" type="text"
                                                class="form-control @error('username') is-invalid @enderror" id="username"
                                                value="{{ old('username', auth()->user()->username) }}">
                                            @error('username')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" id="email"
                                                value="{{ old('email', auth()->user()->email) }}">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="nip" class="col-md-4 col-lg-3 col-form-label">NIP</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="NIP" type="text"
                                                class="form-control @error('NIP') is-invalid @enderror" id="nip"
                                                value="{{ old('NIP', auth()->user()->NIP) }}">
                                            @error('NIP')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="phone" class="col-md-4 col-lg-3 col-form-label">Handphone</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="no_hp" type="text"
                                                class="form-control @error('no_hp') is-invalid @enderror" id="phone"
                                                value="{{ old('no_hp', auth()->user()->no_hp) }}">
                                            @error('no_hp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="whatsapp" class="col-md-4 col-lg-3 col-form-label">WhatsApp</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="no_wa" type="text"
                                                class="form-control @error('no_wa') is-invalid @enderror" id="whatsapp"
                                                value="{{ old('no_wa', auth()->user()->no_wa) }}">
                                            @error('no_wa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="group" class="col-md-4 col-lg-3 col-form-label">Kelompok</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select id="inputKelompok" class="form-select" name="kelompok" required>
                                                <option class="text-center" disabled>Pilih Kelompok</option>
                                                <option value="Admin"
                                                    {{ old('kelompok', auth()->user()->kelompok) == 'Admin' ? 'selected' : '' }}>
                                                    Admin
                                                </option>
                                                <option value="Pimpinan"
                                                    {{ old('kelompok', auth()->user()->kelompok) == 'Pimpinan' ? 'selected' : '' }}>
                                                    Pimpinan
                                                </option>
                                                <option value="Sekretaris"
                                                    {{ old('kelompok', auth()->user()->kelompok) == 'Sekretaris' ? 'selected' : '' }}>
                                                    Sekretaris
                                                </option>
                                                <option value="Sub. Perencanaan"
                                                    {{ old('kelompok', auth()->user()->kelompok) == 'Sub. Perencanaan' ? 'selected' : '' }}>
                                                    Sub. Perencanaan
                                                </option>
                                                <option value="Sub. Evaluasi & Pelaporan"
                                                    {{ old('kelompok', auth()->user()->kelompok) == 'Sub. Evaluasi & Pelaporan' ? 'selected' : '' }}>
                                                    Sub. Evaluasi & Pelaporan
                                                </option>
                                                <option value="IRBAN I"
                                                    {{ old('kelompok', auth()->user()->kelompok) == 'IRBAN I' ? 'selected' : '' }}>
                                                    IRBAN I
                                                </option>
                                                <option value="IRBAN II"
                                                    {{ old('kelompok', auth()->user()->kelompok) == 'IRBAN II' ? 'selected' : '' }}>
                                                    IRBAN II
                                                </option>
                                                <option value="IRBAN III"
                                                    {{ old('kelompok', auth()->user()->kelompok) == 'IRBAN III' ? 'selected' : '' }}>
                                                    IRBAN III
                                                </option>
                                                <option value="IRBAN IV"
                                                    {{ old('kelompok', auth()->user()->kelompok) == 'IRBAN IV' ? 'selected' : '' }}>
                                                    IRBAN IV
                                                </option>
                                                <option value="IRBAN V"
                                                    {{ old('kelompok', auth()->user()->kelompok) == 'IRBAN V' ? 'selected' : '' }}>
                                                    IRBAN V
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="jobdesk" class="col-md-4 col-lg-3 col-form-label">Role</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select id="inputRole" class="form-select" name="jobdesk_id" required>
                                                <option class="text-center" disabled selected>Pilih Role</option>
                                                @forelse ($role as $rl)
                                                    <option value="{{ $rl->id }}"
                                                        {{ old('jobdesk_id', auth()->user()->jobdesk_id) == $rl->id ? 'selected' : '' }}>
                                                        {{ $rl->role }}
                                                    </option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->
                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

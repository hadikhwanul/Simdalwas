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
                                    Ubah Password
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active pt-3">
                                <form method="POST" action="{{ route('settings.update-password') }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Password Saat
                                            Ini</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="input-group">
                                                <input name="current_password" type="password"
                                                    class="form-control @error('current_password') is-invalid @enderror"
                                                    id="currentPassword" required>
                                                <button type="button" class="btn btn-outline-secondary"
                                                    onclick="togglePassword('currentPassword', 'toggleCurrentPassword')">
                                                    <i class="bi bi-eye-slash" id="toggleCurrentPassword"></i>
                                                </button>
                                                @error('current_password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Password
                                            Baru</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="input-group">
                                                <input name="new_password" type="password"
                                                    class="form-control @error('new_password') is-invalid @enderror"
                                                    id="newPassword" required>
                                                <button type="button" class="btn btn-outline-secondary"
                                                    onclick="togglePassword('newPassword', 'toggleNewPassword')">
                                                    <i class="bi bi-eye-slash" id="toggleNewPassword"></i>
                                                </button>
                                                @error('new_password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Konfirmasi
                                            Password Baru</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="input-group">
                                                <input name="new_password_confirmation" type="password"
                                                    class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                                    id="renewPassword" required>
                                                <button type="button" class="btn btn-outline-secondary"
                                                    onclick="togglePassword('renewPassword', 'toggleRenewPassword')">
                                                    <i class="bi bi-eye-slash" id="toggleRenewPassword"></i>
                                                </button>
                                                @error('new_password_confirmation')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </div>
                                </form><!-- End Change Password Form -->
                            </div>
                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function togglePassword(fieldId, iconId) {
            const passwordField = document.getElementById(fieldId);
            const toggleIcon = document.getElementById(iconId);
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            }
        }
    </script>
@endsection

@extends('layouts.main')

@section('main')
    <div class="pagetitle d-flex justify-content-between">
        <div>
            <h1>{{ $judul }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('account-center.index') }}">{{ $judul }}</a></li>
                    <li class="breadcrumb-item active">Tambah Pengguna</li>
                </ol>
            </nav>
        </div>
        <div class="py-3 pe-2"><a href="{{ route('account-center.index') }}">
                <button type="button" class="btn btn-outline-info rounded-pill"><Strong><i
                            class='bx bx-arrow-back'></i>Kembali</Strong></button></a>
        </div>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Pengguna</h5>

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
                        <!-- General Form Elements -->
                        <form action="{{ route('penanggung-jawab.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Foto Profile -->
                            <div class="row mb-3">
                                <label for="formFile" class="col-sm-2 col-form-label">Foto Profile</label>
                                <div class="col-sm-10">
                                    <img class="mb-3" id="preview"
                                        src="{{ old('profile') ? asset('storage/' . old('profile')) : '' }}"
                                        alt="Preview Gambar"
                                        style="max-width: 150px; margin-top: 10px; {{ old('profile') ? 'display: block;' : 'display: none;' }}">
                                    <input class="form-control @error('profile') is-invalid @enderror" type="file"
                                        id="formFile" accept="image/*" onchange="previewImage(event)" name="profile">
                                    @error('profile')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nama -->
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" id="inputText"
                                        class="form-control @error('nama') is-invalid @enderror" name="nama"
                                        value="{{ old('nama') }}" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Username -->
                            <div class="row mb-3">
                                <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        id="inputUsername" name="username" value="{{ old('username') }}" required>
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" id="inputEmail"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- NIP -->
                            <div class="row mb-3">
                                <label for="inputNIP" class="col-sm-2 col-form-label">NIP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('NIP') is-invalid @enderror"
                                        id="inputNIP" name="NIP" value="{{ old('NIP') }}" required>
                                    @error('NIP')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Kelompok -->
                            <div class="row mb-3">
                                <label for="inputKelompok" class="col-sm-2 col-form-label">Kelompok</label>
                                <div class="col-sm-10">
                                    <select id="inputKelompok"
                                        class="form-select text-center @error('kelompok') is-invalid @enderror"
                                        name="kelompok">
                                        <option value="Tamu" {{ old('kelompok') == 'Tamu' ? 'selected' : '' }} selected>
                                            Tamu
                                        </option>
                                    </select>
                                    @error('kelompok')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Role -->
                            <div class="row mb-3">
                                <label for="inputRole" class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <select id="inputRole"
                                        class="form-select text-center @error('jobdesk_id') is-invalid @enderror"
                                        name="jobdesk_id">
                                        @forelse ($jobs as $job)
                                            @if ($job->role == 'Penanggung Jawab')
                                                <option value="{{ $job->id }}"
                                                    {{ old('jobdesk_id') == $job->id ? 'selected' : '' }}>
                                                    {{ $job->role }}
                                                </option>
                                            @endif
                                        @empty
                                            <option disabled>Data role tidak tersedia</option>
                                        @endforelse
                                    </select>
                                    @error('jobdesk_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- NO HP -->
                            <div class="row mb-3">
                                <label for="inputNoHP" class="col-sm-2 col-form-label">NO HP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                        id="inputNoHP" name="no_hp" value="{{ old('no_hp') }}" required>
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- NO WA -->
                            <div class="row mb-3">
                                <label for="inputNoWA" class="col-sm-2 col-form-label">NO WA</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('no_wa') is-invalid @enderror"
                                        id="inputNoWA" name="no_wa" value="{{ old('no_wa') }}" required>
                                    @error('no_wa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="row mb-3 align-items-center">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <div class="input-group d-flex align-items-center">
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            id="inputPassword" name="password" required>
                                        <span class="input-group-text" id="togglePassword" onclick="togglePassword()"
                                            style="cursor: pointer;">
                                            <i class="bi bi-eye-slash"></i>
                                        </span>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                            </div>
                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        // Function to preview image
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview');
                output.src = reader.result;
                output.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        // Function to toggle password visibility
        function togglePassword() {
            const passwordField = document.getElementById('inputPassword');
            const toggleIcon = document.getElementById('togglePassword');
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

        // Function to prevent non-numeric input in number fields
        document.querySelectorAll('.number-only').forEach(input => {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '');
            });
        });
    </script>
@endsection

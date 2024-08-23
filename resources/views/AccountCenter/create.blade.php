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
                        <!-- General Form Elements -->
                        <form action="{{ route('account-center.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <select id="inputKelompok" class="form-select" name="kelompok" required>
                                        <option class="text-center" disabled {{ old('kelompok') ? '' : 'selected' }}>
                                            Pilih Kelompok
                                        </option>
                                        <option value="Admin" {{ old('Admin') == 'Admin' ? 'selected' : '' }}>
                                        <option value="Pimpinan" {{ old('kelompok') == 'Pimpinan' ? 'selected' : '' }}>
                                            Pimpinan
                                        </option>
                                        <option value="Sekretaris" {{ old('kelompok') == 'Sekretaris' ? 'selected' : '' }}>
                                            Sekretaris
                                        </option>
                                        <option value="Sub. Perencanaan"
                                            {{ old('kelompok') == 'Sub. Perencanaan' ? 'selected' : '' }}>
                                            Sub. Perencanaan
                                        </option>
                                        <option value="Sub. Evaluasi & Pelaporan"
                                            {{ old('kelompok') == 'Sub. Evaluasi & Pelaporan' ? 'selected' : '' }}>
                                            Sub. Evaluasi & Pelaporan
                                        </option>
                                        <option value="IRBAN I" {{ old('kelompok') == 'IRBAN I' ? 'selected' : '' }}>
                                            IRBAN I
                                        </option>
                                        <option value="IRBAN II" {{ old('kelompok') == 'IRBAN II' ? 'selected' : '' }}>
                                            IRBAN II
                                        </option>
                                        <option value="IRBAN III" {{ old('kelompok') == 'IRBAN III' ? 'selected' : '' }}>
                                            IRBAN III
                                        </option>
                                        <option value="IRBAN IV" {{ old('kelompok') == 'IRBAN IV' ? 'selected' : '' }}>
                                            IRBAN IV
                                        </option>
                                        <option value="IRBAN V" {{ old('kelompok') == 'IRBAN V' ? 'selected' : '' }}>
                                            IRBAN V
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Role -->
                            <div class="row mb-3">
                                <label for="inputRole" class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <select id="inputRole" class="form-select" name="jobdesk_id" required>
                                        <option class="text-center" disabled selected>Pilih Role</option>
                                        @forelse ($role as $rl)
                                            <option value="{{ $rl->id }}"
                                                {{ old('jobdesk_id') == $rl->id ? 'selected' : '' }}>{{ $rl->role }}
                                            </option>
                                        @empty
                                        @endforelse
                                    </select>
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

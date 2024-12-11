@extends('Layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>Pembayaran</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="">{{ $judul }}</a></li>
                <li class="breadcrumb-item"><a href="">Daftar Pembayaran</a></li>
                <li class="breadcrumb-item active">Pembayaran</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <span class="alert alert-primary  alert-dismissible fade show"><strong>Total Pengembalian
                            Dana</strong></span>
                    <div class="card-body pt-3">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-bold">Satuan Kerja</div>
                            <div class="col-lg-9 col-md-8">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-bold">Sisa Kerugian</div>
                            <div class="col-lg-9 col-md-8"></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-bold">Sisa Kewajiban</div>
                            <div class="col-lg-9 col-md-8">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-bold">Tenggat Waktu</div>
                            <div class="col-lg-9 col-md-8">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Pembayaran</h5>
                        <div class="row g-3">
                            <!-- Pilihan Jenis Pembayaran -->
                            <div class="col-md-6">
                                <label class="form-label">Jenis Pembayaran</label>
                                <select class="form-control @error('jenis_pembayaran') is-invalid @enderror"
                                    name="jenis_pembayaran" required>
                                    <option value="">Pilih Jenis Pembayaran</option>
                                    <option value="kewajiban"
                                        {{ old('jenis_pembayaran') == 'kewajiban' ? 'selected' : '' }}>Kewajiban</option>
                                    <option value="kerugian" {{ old('jenis_pembayaran') == 'kerugian' ? 'selected' : '' }}>
                                        Kerugian</option>
                                </select>
                                @error('jenis_pembayaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sisa Pembayaran -->
                            <div class="col-md-6">
                                <label class="form-label">Sisa Pembayaran</label>
                                <input type="text" class="form-control @error('sisa_pembayaran') is-invalid @enderror"
                                    name="sisa_pembayaran" value="{{ old('sisa_pembayaran') }}" readonly>
                                @error('sisa_pembayaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Jumlah Pembayaran -->
                            <div class="col-md-6">
                                <label class="form-label">Jumlah Pembayaran</label>
                                <input type="number" class="form-control @error('jumlah_pembayaran') is-invalid @enderror"
                                    name="jumlah_pembayaran" value="{{ old('jumlah_pembayaran') }}" required>
                                @error('jumlah_pembayaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tanggal Pembayaran -->
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Pembayaran</label>
                                <input type="date" class="form-control @error('tanggal_pembayaran') is-invalid @enderror"
                                    name="tanggal_pembayaran" value="{{ old('tanggal_pembayaran') }}" required>
                                @error('tanggal_pembayaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Unggah Resi</label>
                                <input type="file" class="form-control @error('resi') is-invalid @enderror"
                                    name="resi" accept="image/*" onchange="previewImage(event)">
                                <div>
                                    <!-- Gambar Preview -->
                                    <img id="preview" src="#" alt="Preview Gambar"
                                        style="max-width: 200px; display: none; margin-bottom: 10px;">
                                </div>
                                @error('resi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <button type="reset" class="btn btn-secondary">Reset</button>&nbsp;
                            <button type="submit" class="btn btn-primary">Bayar</button>
                        </div>
                    </div>
                </div>
            </form>


        </div>


    </section>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result; // Setel sumber gambar
                    preview.style.display = 'block'; // Tampilkan elemen gambar
                };
                reader.readAsDataURL(file); // Baca file sebagai URL Data
            } else {
                preview.src = '#'; // Reset sumber gambar
                preview.style.display = 'none'; // Sembunyikan elemen gambar
            }
        }
    </script>
@endsection

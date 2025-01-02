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
                                {{ $tagih->satker->opd }} - {{ $tagih->satker->sekolah }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-bold">Kecamatan</div>
                            <div class="col-lg-9 col-md-8">
                                {{ $tagih->kecamatan->kecamatan }} - {{ $tagih->kecamatan->deskel }}
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-lg-6 row">
                                <div class="col-lg-5 col-md-4 label fw-bold">Total Kerugian</div>
                                <div class="col-lg-6 col-md-8">
                                    <span>Nilai: Rp. {{ $tagih->total_kerugian }}
                                    </span><br>
                                    <span>Sisa: Rp. {{ $tagih->sisa_kerugian }}
                                    </span><br>
                                    <span>Tarik: Rp. {{ $tagih->bayar_kerugian }}
                                </div>
                            </div>
                            <div class="col-lg-6 row">
                                <div class="col-lg-6 col-md-4 label fw-bold">Total Kewajiban</div>
                                <div class="col-lg-6 col-md-8">
                                    <span>Nilai: Rp. {{ $tagih->total_kewajiban }}
                                    </span><br>
                                    <span>Sisa: Rp. {{ $tagih->sisa_kewajiban }}
                                    </span><br>
                                    <span>Tarik: Rp. {{ $tagih->bayar_kewajiban }}
                                </div>
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
                            <!-- Sisa Pembayaran -->
                            <div class="col-md-6">
                                <label class="form-label">Sisa Pembayaran Kerugian</label>
                                <input type="text" class="form-control @error('sisa_rugi') is-invalid @enderror"
                                    name="sisa_rugi" id="sisa_rugi" value="{{ $tagih->sisa_kerugian }}" readonly>
                                @error('sisa_rugi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Sisa Pembayaran kewajiban</label>
                                <input type="text" class="form-control @error('sisa_wajib') is-invalid @enderror"
                                    name="sisa_wajib" id="sisa_wajib" value="{{ $tagih->sisa_kewajiban }}" readonly>
                                @error('sisa_wajib')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Jumlah Pembayaran -->
                            <div class="col-md-6">
                                <label class="form-label">Jumlah Pembayaran Kerugian</label>
                                <input type="number" id="bayar_rugi"
                                    class="form-control @error('bayar_rugi') is-invalid @enderror" name="bayar_rugi"
                                    value="{{ old('bayar_rugi') }}" required>
                                @error('bayar_rugi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Jumlah Pembayaran -->
                            <div class="col-md-6">
                                <label class="form-label">Jumlah Pembayaran Kewajiban</label>
                                <input type="number" class="form-control @error('bayar_wajib') is-invalid @enderror"
                                    name="bayar_wajib" id="bayar_wajib" value="{{ old('bayar_wajib') }}" required>
                                @error('bayar_wajib')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tanggal Pembayaran -->
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Pembayaran</label>
                                <input type="date" class="form-control @error('tanggal_bayar') is-invalid @enderror"
                                    name="tanggal_bayar" value="{{ old('tanggal_bayar') }}" required>
                                @error('tanggal_bayar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
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
        document.addEventListener('DOMContentLoaded', function() {
            // Get references to input fields
            const sisaRugiInput = document.getElementById('sisa_rugi');
            const jumlahRugiInput = document.getElementById('bayar_rugi');
            const sisaWajibInput = document.getElementById('sisa_wajib');
            const jumlahWajibInput = document.getElementById('bayar_wajib');

            // Store original values for reset functionality
            const originalSisaRugi = parseFloat(sisaRugiInput.value) || 0;
            const originalSisaWajib = parseFloat(sisaWajibInput.value) || 0;

            // Add event listeners to update remaining values dynamically
            jumlahRugiInput.addEventListener('input', function() {
                const jumlahRugi = parseFloat(jumlahRugiInput.value) || 0;

                // Calculate remaining value and ensure it doesn't go below 0
                let newSisaRugi = originalSisaRugi - jumlahRugi;
                newSisaRugi = newSisaRugi < 0 ? 0 : newSisaRugi;

                // Update sisa_rugi field
                sisaRugiInput.value = newSisaRugi.toFixed(2);
            });

            jumlahWajibInput.addEventListener('input', function() {
                const jumlahWajib = parseFloat(jumlahWajibInput.value) || 0;

                // Calculate remaining value and ensure it doesn't go below 0
                let newSisaWajib = originalSisaWajib - jumlahWajib;
                newSisaWajib = newSisaWajib < 0 ? 0 : newSisaWajib;

                // Update sisa_wajib field
                sisaWajibInput.value = newSisaWajib.toFixed(2);
            });

            // Reset sisa values if inputs are cleared
            jumlahRugiInput.addEventListener('blur', function() {
                if (!jumlahRugiInput.value) {
                    sisaRugiInput.value = originalSisaRugi.toFixed(2);
                }
            });

            jumlahWajibInput.addEventListener('blur', function() {
                if (!jumlahWajibInput.value) {
                    sisaWajibInput.value = originalSisaWajib.toFixed(2);
                }
            });
        });

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

@extends('Layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>Edit Pembayaran</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="">{{ $judul }}</a></li>
                <li class="breadcrumb-item"><a href="">Daftar Pembayaran</a></li>
                <li class="breadcrumb-item active">Edit Pembayaran</li>
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
            <form action="{{ route('update.bayar', ['tagihan' => $tagihan->slug, 'bayaranslug' => $pembayaran->slug]) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Use PUT for updating existing records -->

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Edit Pembayaran</h5>
                        <div class="row g-3">
                            <!-- Sisa Pembayaran Kerugian -->
                            <div class="col-md-6">
                                <label class="form-label">Sisa Pembayaran Kerugian</label>
                                <input type="text" class="form-control @error('sisa_rugi') is-invalid @enderror"
                                    name="sisa_rugi" id="sisa_rugi" value="{{ old('sisa_rugi', $tagihan->sisa_kerugian) }}"
                                    readonly>
                                @error('sisa_rugi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sisa Pembayaran Kewajiban -->
                            <div class="col-md-6">
                                <label class="form-label">Sisa Pembayaran Kewajiban</label>
                                <input type="text" class="form-control @error('sisa_wajib') is-invalid @enderror"
                                    name="sisa_wajib" id="sisa_wajib"
                                    value="{{ old('sisa_wajib', $tagihan->sisa_kewajiban) }}" readonly>
                                @error('sisa_wajib')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Jumlah Pembayaran Kerugian -->
                            <div class="col-md-6">
                                <label class="form-label">Jumlah Pembayaran Kerugian</label>
                                <input type="number" id="bayar_rugi"
                                    class="form-control @error('bayar_rugi') is-invalid @enderror" name="bayar_rugi"
                                    value="{{ old('bayar_rugi', $pembayaran->bayar_rugi) }}" required>
                                @error('bayar_rugi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Jumlah Pembayaran Kewajiban -->
                            <div class="col-md-6">
                                <label class="form-label">Jumlah Pembayaran Kewajiban</label>
                                <input type="number" class="form-control @error('bayar_wajib') is-invalid @enderror"
                                    name="bayar_wajib" id="bayar_wajib"
                                    value="{{ old('bayar_wajib', $pembayaran->bayar_wajib) }}" required>
                                @error('bayar_wajib')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tanggal Pembayaran -->
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Pembayaran</label>
                                <input type="date" class="form-control @error('tanggal_bayar') is-invalid @enderror"
                                    name="tanggal_bayar" value="{{ old('tanggal_bayar', $pembayaran->tanggal_bayar) }}"
                                    required>
                                @error('tanggal_bayar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Unggah Resi -->
                            <div class="col-md-6">
                                <label class="form-label">Unggah Resi</label>
                                <input type="file" class="form-control @error('resi') is-invalid @enderror"
                                    name="resi" accept="image/*" onchange="previewImage(event)">
                                <div>
                                    <!-- Gambar Preview -->
                                    <img id="preview"
                                        src="{{ old('resi', $pembayaran->resi ? asset('storage/' . $pembayaran->resi) : '#') }}"
                                        alt="Preview Gambar" style="max-width: 200px; display: block; margin-bottom: 10px;">
                                </div>
                                @error('resi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <button type="reset" class="btn btn-secondary">Reset</button>&nbsp;
                            <button type="submit" class="btn btn-primary">Update Pembayaran</button>
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

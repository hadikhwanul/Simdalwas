@extends('Layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>Validasi Pembayaran</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="">{{ $judul }}</a></li>
                <li class="breadcrumb-item"><a href="">Daftar Pembayaran</a></li>
                <li class="breadcrumb-item active">Validasi Pembayaran</li>
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
        <div class="col-lg-12">
            <div class="card">
                <span class="alert alert-primary  alert-dismissible fade show"><strong>Total Pengembalian
                        Dana</strong></span>
                <div class="card-body pt-3">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label fw-bold">Satuan Kerja</div>
                        <div class="col-lg-9 col-md-8">
                            {{ $tagihan->satker->opd }} - {{ $tagihan->satker->sekolah }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label fw-bold">Kecamatan</div>
                        <div class="col-lg-9 col-md-8">
                            {{ $tagihan->kecamatan->kecamatan }} - {{ $tagihan->kecamatan->deskel }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label fw-bold">Tenggat Pembayaran</div>
                        <div class="col-lg-9 col-md-8">
                            {{ $tagihan->deadline }}
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-6 row">
                            <div class="col-lg-5 col-md-4 label fw-bold">Total Kerugian</div>
                            <div class="col-lg-6 col-md-8">
                                <span>Nilai: Rp. {{ $tagihan->total_kerugian }}
                                </span><br>
                                <span>Sisa: Rp. {{ $tagihan->sisa_kerugian }}
                                </span><br>
                                <span>Tarik: Rp. {{ $tagihan->bayar_kerugian }}
                            </div>
                        </div>
                        <div class="col-lg-6 row">
                            <div class="col-lg-6 col-md-4 label fw-bold">Total Kewajiban</div>
                            <div class="col-lg-6 col-md-8">
                                <span>Nilai: Rp. {{ $tagihan->total_kewajiban }}
                                </span><br>
                                <span>Sisa: Rp. {{ $tagihan->sisa_kewajiban }}
                                </span><br>
                                <span>Tarik: Rp. {{ $tagihan->bayar_kewajiban }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <form
                action="{{ route('update.validasi', ['tagihan' => $tagihan->slug, 'bayaranslug' => $pembayaran->slug]) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Use PUT for updating existing records -->

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Validasi Pembayaran</h5>
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
                                    value="{{ old('bayar_rugi', $pembayaran->bayar_rugi) }}" required readonly>
                                @error('bayar_rugi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Jumlah Pembayaran Kewajiban -->
                            <div class="col-md-6">
                                <label class="form-label">Jumlah Pembayaran Kewajiban</label>
                                <input type="number" class="form-control @error('bayar_wajib') is-invalid @enderror"
                                    name="bayar_wajib" id="bayar_wajib"
                                    value="{{ old('bayar_wajib', $pembayaran->bayar_wajib) }}" required readonly>
                                @error('bayar_wajib')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tanggal Pembayaran -->
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Pembayaran</label>
                                <input type="date" class="form-control @error('tanggal_bayar') is-invalid @enderror"
                                    name="tanggal_bayar" value="{{ old('tanggal_bayar', $pembayaran->tanggal_bayar) }}"
                                    required readonly>
                                @error('tanggal_bayar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" name="status">
                                    <option class="text-center" disabled value="">Pilih status</option>
                                    <option value="Menunggu Konfirmasi"
                                        {{ old('status', $pembayaran->status) == 'Menunggu Konfirmasi' ? 'selected' : '' }}>
                                        Menunggu Konfirmasi
                                    </option>
                                    <option value="Pembayaran Ditolak"
                                        {{ old('status', $pembayaran->status) == 'Pembayaran Ditolak' ? 'selected' : '' }}>
                                        Pembayaran Ditolak
                                    </option>
                                    <option value="Pembayaran Sukses"
                                        {{ old('status', $pembayaran->status) == 'Pembayaran Sukses' ? 'selected' : '' }}>
                                        Pembayaran Berhasil
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Unggah Resi -->
                            <div class="col-md-12 text-center">
                                <label class="form-label">Resi Pembayaran</label>
                                <div>
                                    <!-- Gambar Tersimpan -->
                                    <img id="preview"
                                        src="{{ $pembayaran->resi ? asset('storage/' . $pembayaran->resi) : 'https://via.placeholder.com/200x200?text=Resi+Belum+Tersedia' }}"
                                        alt="Gambar Resi" style="max-width: 50%; height: auto; margin-bottom: 10px;">
                                </div>
                            </div>

                        </div>
                        <div class="d-flex justify-content-end mt-4">
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

@extends('Layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>Tambah Temuan {{ $judul }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="">{{ $judul }}</a></li>
                <li class="breadcrumb-item active">Tambah {{ $judul }}</li>
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
            <div class="col-lg-6">
                <div class="card ">
                    <span class="alert alert-danger  alert-dismissible fade show"><strong>Temuan</strong></span>
                    <div class="card-body pt-3 ">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-bold">Temuan</div>
                            <div class="col-lg-9 col-md-8">{!! $rekomendasi->temuan->temuan !!}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-bold">Ket Temuan</div>
                            <div class="col-lg-9 col-md-8">{!! $rekomendasi->temuan->keterangan !!}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-bold">Pokok Temuan</div>
                            <div class="col-lg-9 col-md-8">
                                {{ $rekomendasi->temuan->pokokTemuan->no_pokok . '. ' . $rekomendasi->temuan->pokokTemuan->pokok_temuan }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-bold">Sub Pokok Temuan</div>
                            <div class="col-lg-9 col-md-8">
                                {{ $rekomendasi->temuan->pokokTemuan->no_subpokok . '. ' . $rekomendasi->temuan->pokokTemuan->sub_pokok_temuan }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <span class="alert alert-success  alert-dismissible fade show"><strong>Penyebab</strong></span>
                    <div class="card-body pt-3">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-bold">Penyebab</div>
                            <div class="col-lg-9 col-md-8">
                                {!! $rekomendasi->temuan->first()?->penyebabs->first()?->penyebab ?? 'Data not available' !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-bold">Pokok Penyebab</div>
                            <div class="col-lg-9 col-md-8">
                                {{ $rekomendasi->temuan->first()?->penyebabs->first()?->pokokPenyebab?->no_pokok .
                                    '. ' .
                                    $rekomendasi->temuan->first()?->penyebabs->first()?->pokokPenyebab?->pokok_penyebab ??
                                    'Data not available' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-bold">Sub Pokok Penyebab</div>
                            <div class="col-lg-9 col-md-8">
                                {{ $rekomendasi->temuan->first()?->penyebabs->first()?->pokokPenyebab?->no_subpokok .
                                    '. ' .
                                    $rekomendasi->temuan->first()?->penyebabs->first()?->pokokPenyebab?->sub_pokok_penyebab ??
                                    'Data not available' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <span class="alert alert-primary  alert-dismissible fade show"><strong>Rekomendasi</strong></span>
                    <div class="card-body pt-3">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-bold">Rekomendasi</div>
                            <div class="col-lg-9 col-md-8">{!! $rekomendasi->rekomendasi !!}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-bold">Pokok Rekomendasi</div>
                            <div class="col-lg-9 col-md-8">
                                {{ $rekomendasi->pokokRekomendasi->no_pokok . '. ' . $rekomendasi->pokokRekomendasi->pokok_rekomendasi }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-bold">Sub Pokok Rekomendasi</div>
                            <div class="col-lg-9 col-md-8">
                                {{ $rekomendasi->pokokRekomendasi->no_subpokok . '. ' . $rekomendasi->pokokRekomendasi->sub_pokok_rekomendasi }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <h5 class="card-title">Form Tambah {{ $judul }}</h5>
                            <!-- Temuan Field -->
                            <!-- Keterangan Temuan Field -->
                            <div class="col-md-6">
                                <label class="form-label">Keterangan Tindak</label>
                                <input id="keterangan" type="hidden" name="keterangan"
                                    class="form-control @error('keterangan') is-invalid @enderror"
                                    value="{{ old('keterangan', '') }}">
                                <trix-editor input="keterangan"></trix-editor>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Pokok Temuan Field -->
                            <div class="col-md-6">
                                <label class="form-label">Pokok Tindak Lanjut</label>
                                <select id="pokok_temuan" class="form-select" name="pokok_temuan" required>
                                    <option disabled selected>Pilih Pokok Temuan</option>

                                </select>
                            </div>

                            <!-- Sub Pokok Temuan Field -->
                            <div class="col-md-6">
                                <label class="form-label">Sub Pokok Tindak Lanjut</label>
                                <select id="sub_pokok_temuan" class="form-select" name="pokok_temuan_id" required>
                                    <option disabled selected>Pilih Sub Pokok Temuan</option>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="col-md-12">
                    <button class="btn btn-primary mt-3" type="submit">Simpan Tindak Lanjut</button>
                </div>
            </form>

        </div>


    </section>
    <script>
        // Format input sebagai Rupiah
        function formatRupiah(input) {
            let value = input.value.replace(/[^\d]/g, ''); // Hapus semua karakter selain angka
            let formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Tambahkan titik setiap 3 digit

            input.value = formattedValue; // Set nilai yang diformat
        }
    </script>
    <script>
        // Helper function to toggle Sub Select options based on parent select
        function toggleSubOptions(parentSelect, subSelect, dataAttribute) {
            // Get selected value from parent select
            const selectedValue = parentSelect.value;

            // Reset sub-select options
            subSelect.value = '';
            Array.from(subSelect.options).forEach(option => {
                option.hidden = true; // Hide all options
                // Show only options matching the selected parent value
                if (option.dataset[dataAttribute] === selectedValue) {
                    option.hidden = false;
                }
            });

            // Enable sub-select if there are valid options
            subSelect.disabled = !Array.from(subSelect.options).some(option => !option.hidden);
        }

        // Event Listeners for cascading dropdowns
        document.addEventListener('DOMContentLoaded', function() {
            // Pokok Temuan & Sub Pokok Temuan
            const pokokTemuanSelect = document.getElementById('pokok_temuan');
            const subPokokTemuanSelect = document.getElementById('sub_pokok_temuan');
            subPokokTemuanSelect.disabled = true; // Disable initially
            pokokTemuanSelect.addEventListener('change', function() {
                toggleSubOptions(pokokTemuanSelect, subPokokTemuanSelect, 'noPokok');
            });

            // Pokok Penyebab & Sub Pokok Penyebab
            const pokokPenyebabSelect = document.getElementById('pokok_penyebab');
            const subPokokPenyebabSelect = document.getElementById('sub_pokok_penyebab');
            subPokokPenyebabSelect.disabled = true; // Disable initially
            pokokPenyebabSelect.addEventListener('change', function() {
                toggleSubOptions(pokokPenyebabSelect, subPokokPenyebabSelect, 'noPokok');
            });

            // Pokok Rekomendasi & Sub Pokok Rekomendasi
            const pokokRekomendasiSelect = document.getElementById('pokok_rekomendasi');
            const subPokokRekomendasiSelect = document.getElementById('sub_pokok_rekomendasi');
            subPokokRekomendasiSelect.disabled = true; // Disable initially
            pokokRekomendasiSelect.addEventListener('change', function() {
                toggleSubOptions(pokokRekomendasiSelect, subPokokRekomendasiSelect, 'noPokok');
            });
        });
    </script>
@endsection

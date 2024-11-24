@extends('Layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>Tambah Temuan {{ $judul }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('lhp.index') }}">{{ $judul }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('lhp.temuan', $lhp->slug) }}">Temuan {{ $judul }}</a>
                </li>
                <li class="breadcrumb-item active">Tambah Temuan {{ $judul }}</li>
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
                    <span class="alert alert-danger  alert-dismissible fade show"><strong>Details Draft
                            LHP</strong></span>
                    <div class="card-body pt-3 ">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Tanggal LHP</div>
                            <div class="col-lg-9 col-md-8">{{ $lhp->tanggal_lhp }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">No LHP</div>
                            <div class="col-lg-9 col-md-8">{{ $lhp->no_lhp }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Judul</div>
                            <div class="col-lg-9 col-md-8">{{ $lhp->judul }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <span class="alert alert-success  alert-dismissible fade show"><strong>Pemeriksa dan
                            Penyelenggara</strong></span>
                    <div class="card-body pt-3">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Auditor</div>
                            <div class="col-lg-9 col-md-8">{{ $lhp->auditor->auditor }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Induk</div>
                            <div class="col-lg-9 col-md-8">{{ $lhp->induk->induk }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Departemen</div>
                            <div class="col-lg-9 col-md-8">{{ $lhp->departemen->departemen }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Sifat</div>
                            <div class="col-lg-9 col-md-8">{{ $lhp->sifat }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Bidang</div>
                            <div class="col-lg-9 col-md-8">{{ $lhp->bidang }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('temuan.store', $lhp->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <h5 class="card-title">Form Tambah Temuan</h5>
                            <!-- Temuan Field -->
                            <div class="col-md-6">
                                <label class="form-label">Temuan</label>
                                <input id="temuan" type="hidden" name="temuan"
                                    class="form-control @error('temuan') is-invalid @enderror"
                                    value="{{ old('temuan', '') }}">
                                <trix-editor input="temuan"></trix-editor>
                                @error('temuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Keterangan Temuan Field -->
                            <div class="col-md-6">
                                <label class="form-label">Keterangan Temuan</label>
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
                                <label class="form-label">Pokok Temuan</label>
                                <select id="pokok_temuan" class="form-select" name="pokok_temuan" required>
                                    <option disabled selected>Pilih Pokok Temuan</option>
                                    @foreach ($pokok_temuan as $temuan)
                                        <option value="{{ $temuan->no_pokok }}"
                                            {{ old('pokok_temuan') == $temuan->no_pokok ? 'selected' : '' }}>
                                            {{ $temuan->no_pokok }}. {{ $temuan->pokok_temuan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Jumlah Penyebab Field -->
                            <div class="col-md-6">
                                <label class="form-label">Jumlah Penyebab</label>
                                <!-- Hidden User Input -->
                                <input type="text" class="form-control" name="user"
                                    value="{{ auth()->user()->username }}" disabled>
                            </div>

                            <!-- Sub Pokok Temuan Field -->
                            <div class="col-md-6">
                                <label class="form-label">Sub Pokok Temuan</label>
                                <select id="sub_pokok_temuan" class="form-select" name="pokok_temuan_id" required>
                                    <option disabled selected>Pilih Sub Pokok Temuan</option>
                                    @foreach ($sub_pokok_temuan as $sub)
                                        <option value="{{ $sub->id }}" data-no-pokok="{{ $sub->no_pokok }}">
                                            {{ $sub->no_subpokok }}. {{ $sub->sub_pokok_temuan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row g-3">
                            <h5 class="card-title">Penyebab</h5>

                            <div class="col-md-6">
                                <label class="form-label">Pokok Penyebab</label>
                                <select id="pokok_penyebab" class="form-select" name="pokok_penyebab" required>
                                    <option disabled selected>Pilih Pokok Penyebab</option>
                                    @foreach ($pokok_penyebab as $penyebab)
                                        <option value="{{ $penyebab->no_pokok }}"
                                            {{ old('pokok_temuan') == $penyebab->no_pokok ? 'selected' : '' }}>
                                            {{ $penyebab->no_pokok }}. {{ $penyebab->pokok_penyebab }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Keterangan Penyebab Field -->
                            <div class="col-md-6">
                                <label for="penyebab_keterangan" class="form-label">Keterangan Penyebab</label>
                                <input id="penyebab" type="hidden" name="penyebab"
                                    class="form-control @error('penyebab') is-invalid @enderror"
                                    value="{{ old('penyebab', '') }}">
                                <trix-editor input="penyebab"></trix-editor>
                                @error('penyebab')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sub Pokok Penyebab Field -->
                            <div class="col-md-6" style="margin-top:-5%">
                                <label for="sub_pokok_penyebab" class="form-label">Sub Pokok Penyebab</label>
                                <select id="sub_pokok_penyebab" class="form-select" name="id_pokok_penyebab" required>
                                    <option disabled selected>Pilih Sub Pokok Penyebab</option>
                                    @foreach ($sub_pokok_penyebab as $sub)
                                        <option value="{{ $sub->id }}" data-no-pokok="{{ $sub->no_pokok }}">
                                            {{ $sub->no_subpokok }}. {{ $sub->sub_pokok_penyebab }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <h5 class="card-title">Rekomendasi</span></h5>

                            <!-- Pokok Rekomendasi Field -->
                            <div class="col-md-6">
                                <label class="form-label">Pokok Rekomendasi</label>
                                <select id="pokok_rekomendasi" class="form-select" name="pokok_rekomendasi" required>
                                    <option disabled selected>Pilih Pokok Rekomendasi</option>
                                    @foreach ($pokok_rekomendasi as $rekomendasi)
                                        <option value="{{ $rekomendasi->no_pokok }}"
                                            {{ old('pokok_rekomendasi') == $rekomendasi->no_pokok ? 'selected' : '' }}>
                                            {{ $rekomendasi->no_pokok }}. {{ $rekomendasi->pokok_rekomendasi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Keterangan Rekomendasi Field -->
                            <div class="col-md-6">
                                <label class="form-label">Keterangan Rekomendasi</label>
                                <input id="rekomendasi" type="hidden" name="rekomendasi"
                                    class="form-control @error('rekomendasi') is-invalid @enderror"
                                    value="{{ old('rekomendasi', '') }}">
                                <trix-editor input="rekomendasi"></trix-editor>
                                @error('rekomendasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sub Pokok Rekomendasi Field -->
                            <div class="col-md-6" style="margin-top: -6%">
                                <label class="form-label">Sub Pokok Rekomendasi</label>
                                <select id="sub_pokok_rekomendasi" class="form-select" name="pokok_rekomendasi_id"
                                    required>
                                    <option disabled selected>Pilih Sub Pokok Rekomendasi</option>
                                    @foreach ($sub_pokok_rekomendasi as $sub)
                                        <option value="{{ $sub->id }}" data-no-pokok="{{ $sub->no_pokok }}">
                                            {{ $sub->no_subpokok }}. {{ $sub->sub_pokok_rekomendasi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Nilai Kerugian Field -->
                            <div class="col-md-6" style="margin-top: 3%">
                                <label class="form-label">Nilai Kerugian (Rp)</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="text" class="form-control @error('kerugian') is-invalid @enderror"
                                        name="kerugian" value="{{ old('kerugian') }}" id="kerugian"
                                        onkeyup="formatRupiah(this)">
                                    @error('kerugian')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nilai Kewajiban Field -->
                            <div class="col-md-6" style="margin-top: -7.5%">
                                <label class="form-label">Nilai Kewajiban (Rp)</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="text" class="form-control @error('kewajiban') is-invalid @enderror"
                                        name="kewajiban" value="{{ old('kewajiban') }}" id="kewajiban"
                                        onkeyup="formatRupiah(this)">
                                    @error('kewajiban')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="col-md-12">
                    <button class="btn btn-primary mt-3" type="submit">Simpan Temuan</button>
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

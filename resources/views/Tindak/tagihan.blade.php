@extends('Layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>Tambah Tagihan dan Penanggung Jawab</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="">{{ $judul }}</a></li>
                <li class="breadcrumb-item active">Tambah Tagihan dan Penanggung Jawab</li>
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
            <form action="{{ route('store.pj', $tindak->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <h5 class="card-title">Form Tambah Tagihan dan Penanggung Jawab</h5>

                            <div class="col-md-6">
                                <label class="form-label">Penanggung Jawab</label>
                                <select class="form-select @error('user_id') is-invalid @enderror" name="user_id">
                                    <option class="text-center" value="" selected>Pilih penanggung</option>
                                    @forelse ($penanggung as $pj)
                                        <option value="{{ $pj->id }}"
                                            {{ old('user_id') == $pj->id ? 'selected' : '' }}>
                                            {{ $pj->nama }}
                                        </option>
                                    @empty
                                        <option disabled>Tidak ada penanggung jawaban</option>
                                    @endforelse
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="col-md-6">
                                <label class="form-label">Tenggat Tagihan</label>
                                <input type="date" class="form-control @error('deadline') is-invalid @enderror"
                                    name="deadline" value="{{ old('deadline') }}" required>
                                @error('deadline')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Kecamatan</label>
                                <select id="kecamatan" class="form-select @error('no_camat') is-invalid @enderror"
                                    name="no_camat" required>
                                    <option class="text-center" selected>Pilih Kecamatan</option>
                                    @foreach ($kecamatan as $camat)
                                        <option value="{{ $camat->no_camat }}" data-no-pokok="{{ $camat->no_camat }}"
                                            {{ old('no_camat') == $camat->no_camat ? 'selected' : '' }}>
                                            {{ $camat->no_camat }}. {{ $camat->kecamatan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('no_camat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Desa/Kelurahan</label>
                                <select id="deskel" class="form-select @error('kecamatan_id') is-invalid @enderror"
                                    name="kecamatan_id" disabled required>
                                    <option class="text-center" disabled value="" selected>Pilih Desa/Kelurahan
                                    </option>
                                    @foreach ($deskel as $item)
                                        <option value="{{ $item->id }}" data-no-pokok="{{ $item->no_camat }}"
                                            {{ old('kecamatan_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->no_deskel }}. {{ $item->deskel }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kecamatan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Obrik</label>
                                <select id="opd" class="form-select @error('opd') is-invalid @enderror" name="opd"
                                    required>
                                    <option class="text-center" disabled selected>Pilih Pokok Penyebab</option>
                                    @foreach ($opd as $item)
                                        <option value="{{ $item->no_opd }}" data-no-pokok="{{ $item->no_opd }}"
                                            {{ old('opd') == $item->no_opd ? 'selected' : '' }}>
                                            {{ $item->no_opd }}. {{ $item->opd }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('opd')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sekolah Field -->
                            <div class="col-md-6">
                                <label for="sekolah" class="form-label">Sekolah</label>
                                <select id="sekolah" class="form-select @error('satker_id') is-invalid @enderror"
                                    name="satker_id" disabled required>
                                    <option class="text-center" disabled value="" selected>Pilih Sekolah</option>
                                    @foreach ($sekolah as $sklh)
                                        <option value="{{ $sklh->id }}" data-no-pokok="{{ $sklh->no_opd }}"
                                            {{ old('satker_id') == $sklh->id ? 'selected' : '' }}>
                                            {{ $sklh->no_sekolah }}. {{ $sklh->sekolah }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('satker_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <input hidden class="form-control @error('user') is-invalid @enderror" id="user_tindak"
                                name="user" value="{{ auth()->user()->username }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body row">
                                <h5 class="card-title" style="margin-bottom: -5%">Kerugian
                                    <hr>
                                </h5>
                                <div class="col-md-12">
                                    <label class="form-label">Total Kerugian</label>
                                    <input type="number" class="form-control @error('total_kerugian') is-invalid @enderror"
                                        id="total_kerugian" name="total_kerugian" value="" readonly>
                                    @error('total_kerugian')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Negara</label>
                                    <input type="number" class="form-control @error('negara') is-invalid @enderror"
                                        id="negara" name="negara" value="">
                                    @error('negara')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Daerah</label>
                                    <input type="number" class="form-control @error('daerah') is-invalid @enderror"
                                        id="daerah" name="daerah" value="">
                                    @error('daerah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Obrik</label>
                                    <input type="number" class="form-control @error('obrik') is-invalid @enderror"
                                        id="obrik" name="obrik" value="">
                                    @error('obrik')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Peran Pelaku</label>
                                    <input id="peran_rugi" type="hidden" name="peran_rugi"
                                        class="form-control @error('peran_rugi') is-invalid @enderror"
                                        value="{{ old('peran_rugi', '') }}">
                                    <trix-editor input="peran_rugi"></trix-editor>
                                    @error('peran_rugi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12" style="margin-bottom: 23.5%">
                                    <label class="form-label">Keterangan</label>
                                    <input id="ket_rugi" type="hidden" name="ket_rugi"
                                        class="form-control @error('ket_rugi') is-invalid @enderror"
                                        value="{{ old('ket_rugi', '') }}">
                                    <trix-editor input="ket_rugi"></trix-editor>
                                    @error('ket_rugi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body row">
                                <h5 class="card-title" style="margin-bottom: -5%">Kewajiban
                                    <hr>
                                </h5>
                                <div class="col-md-12">
                                    <label class="form-label">Total Kewajiban</label>
                                    <input type="number"
                                        class="form-control @error('total_kewajiban') is-invalid @enderror"
                                        id="total_kewajiban" name="total_kewajiban" value="" readonly>
                                    @error('total_kewajiban')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">PPH 21</label>
                                    <input type="number" class="form-control @error('pph_21') is-invalid @enderror"
                                        id="pph_21" name="pph_21" value="">
                                    @error('pph_21')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">PPH 22</label>
                                    <input type="number" class="form-control @error('pph_22') is-invalid @enderror"
                                        id="pph_22" name="pph_22" value="">
                                    @error('pph_22')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">PPH 23</label>
                                    <input type="number" class="form-control @error('pph_23') is-invalid @enderror"
                                        id="pph_23" name="pph_23" value="">
                                    @error('pph_23')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">PPN</label>
                                    <input type="number" class="form-control @error('ppn') is-invalid @enderror"
                                        id="ppn" name="ppn" value="">
                                    @error('ppn')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">MBLB</label>
                                    <input type="number" class="form-control @error('mblb') is-invalid @enderror"
                                        id="mblb" name="mblb" value="">
                                    @error('mblb')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Pajak Restoran</label>
                                    <input type="number" class="form-control @error('pajak') is-invalid @enderror"
                                        id="pajak" name="pajak" value="">
                                    @error('pajak')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Peran Pelaku</label>
                                    <input id="peran_wajib" type="hidden" name="peran_wajib"
                                        class="form-control @error('pelaku') is-invalid @enderror"
                                        value="{{ old('peran_wajib', '') }}">
                                    <trix-editor input="peran_wajib"></trix-editor>
                                    @error('peran_wajib')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Keterangan</label>
                                    <input id="ket_wajib" type="hidden" name="ket_wajib"
                                        class="form-control @error('ket_wajib') is-invalid @enderror"
                                        value="{{ old('ket_wajib', '') }}">
                                    <trix-editor input="ket_wajib"></trix-editor>
                                    @error('ket_wajib')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-end mt-4">
                                    <button type="reset" class="btn btn-secondary">Kembali</button>&nbsp;
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>

        </div>


    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const negaraInput = document.getElementById('negara');
            const daerahInput = document.getElementById('daerah');
            const obrikInput = document.getElementById('obrik');
            const totalKerugianInput = document.getElementById('total_kerugian');

            // Function to calculate total kerugian
            function calculateTotal() {
                const negara = parseFloat(negaraInput.value) || 0; // Default to 0 if the value is empty
                const daerah = parseFloat(daerahInput.value) || 0;
                const obrik = parseFloat(obrikInput.value) || 0;

                // Update the total_kerugian field with the sum
                totalKerugianInput.value = negara + daerah + obrik;
            }

            // Event listeners for changes in the input fields
            negaraInput.addEventListener('input', calculateTotal);
            daerahInput.addEventListener('input', calculateTotal);
            obrikInput.addEventListener('input', calculateTotal);
        });
        document.addEventListener('DOMContentLoaded', function() {
            const totalKewajibanInput = document.getElementById('total_kewajiban');
            const inputs = [
                document.getElementById('pph_21'),
                document.getElementById('pph_22'),
                document.getElementById('pph_23'),
                document.getElementById('ppn'),
                document.getElementById('mblb'),
                document.getElementById('pajak')
            ];

            // Function to calculate the total kewajiban
            function calculateTotalKewajiban() {
                let total = 0;

                inputs.forEach(input => {
                    const value = parseFloat(input.value) || 0; // Default to 0 if value is empty
                    total += value;
                });

                totalKewajibanInput.value = total; // Update the total_kewajiban field
            }

            // Add event listeners to all inputs
            inputs.forEach(input => {
                input.addEventListener('input', calculateTotalKewajiban);
            });
        });
    </script>
    <script>
        // Helper function to toggle Sub Select options based on parent select
        function toggleSubOptions(parentSelect, subSelect, dataAttribute) {
            const selectedValue = parentSelect.value; // Get selected value from parent select
            subSelect.value = ''; // Reset sub-select value

            // Reset and filter options based on selected value
            Array.from(subSelect.options).forEach(option => {
                option.hidden = option.dataset[dataAttribute] !== selectedValue;
            });

            // Enable sub-select if there are valid options
            subSelect.disabled = !Array.from(subSelect.options).some(option => !option.hidden);
        }

        // Event Listeners for cascading dropdowns
        document.addEventListener('DOMContentLoaded', function() {
            const kecamatanSelect = document.getElementById('kecamatan');
            const deskelSelect = document.getElementById('deskel');
            deskelSelect.disabled = true; // Initially disable

            const opdSelect = document.getElementById('opd');
            const sekolahSelect = document.getElementById('sekolah');
            sekolahSelect.disabled = true; // Initially disable

            // Event listener for Kecamatan -> Desa/Kelurahan
            kecamatanSelect.addEventListener('change', function() {
                toggleSubOptions(kecamatanSelect, deskelSelect, 'noPokok');
            });

            // Event listener for Obrik -> Sekolah
            opdSelect.addEventListener('change', function() {
                toggleSubOptions(opdSelect, sekolahSelect, 'noPokok');
            });
        });
    </script>
@endsection

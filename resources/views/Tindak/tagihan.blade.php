@extends('Layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>Tambah Temuan {{ $judul }}</h1>
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
                                    <option class="text-center" disabled value="" selected>Pilih penanggung</option>
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
                                <label class="form-label">User</label>
                                <input type="text" class="form-control @error('user') is-invalid @enderror"
                                    id="inputName5" name="user" value="{{ auth()->user()->username }}" required readonly>
                                @error('user')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Kecamatan</label>
                                <select class="form-select @error('no_camat') is-invalid @enderror" name="no_camat">
                                    <option class="text-center" disabled value="" selected>Pilih Kecamatan </option>
                                    @forelse ($kecamatan as $camat)
                                        <option value="{{ $camat->id }}"
                                            {{ old('no_camat') == $camat->id ? 'selected' : '' }}>
                                            {{ $camat->kecamatan }}
                                        </option>
                                    @empty
                                        <option disabled>Tidak ada kecamatan</option>
                                    @endforelse
                                </select>
                                @error('no_camat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Desa/Kelurahan</label>
                                <select class="form-select @error('no_deskel') is-invalid @enderror" name="no_deskel">
                                    <option class="text-center" disabled value="" selected>Pilih Desa/Kelurahan
                                    </option>
                                    @forelse ($deskel as $deskel)
                                        <option value="{{ $deskel->id }}"
                                            {{ old('no_deskel') == $deskel->id ? 'selected' : '' }}>
                                            {{ $deskel->deskel }}
                                        </option>
                                    @empty
                                        <option disabled>Tidak ada Desa/Kelurahan</option>
                                    @endforelse
                                </select>
                                @error('no_deskel')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Obrik</label>
                                <select id="opd" class="form-select" name="opd" required>
                                    <option disabled selected>Pilih Pokok Penyebab</option>
                                    @foreach ($opd as $opd)
                                        <option value="{{ $opd->no_opd }}"
                                            {{ old('pokok_temuan') == $opd->no_opd ? 'selected' : '' }}>
                                            {{ $opd->no_opd }}. {{ $opd->opd }}
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
                                <select id="sekolah" class="form-select" name="id_satker" required>
                                    <option disabled selected>Pilih Sekolah</option>
                                    @foreach ($sekolah as $sklh)
                                        <option value="{{ $sklh->id }}" data-no-pokok="{{ $sklh->no_opd }}">
                                            {{ $sklh->no_sekolah }}. {{ $sklh->sekolah }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_satker')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body row">
                                <h5 class="card-title" style="margin-bottom: -5%"><strong>Kerugian
                                        <hr>
                                    </strong>
                                </h5>
                                <div class="col-md-12">
                                    <label class="form-label">Total Kerugian</label>
                                    <input type="text" class="form-control @error('kerugian') is-invalid @enderror"
                                        id="inputName5" name="kerugian" value="" required>
                                    @error('kerugian')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Negara</label>
                                    <input type="text" class="form-control @error('negara') is-invalid @enderror"
                                        id="inputName5" name="negara" value="" required>
                                    @error('negara')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Daerah</label>
                                    <input type="text" class="form-control @error('daerah') is-invalid @enderror"
                                        id="inputName5" name="daerah" value="" required>
                                    @error('daerah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Obrik</label>
                                    <input type="text" class="form-control @error('obrik') is-invalid @enderror"
                                        id="inputName5" name="obrik" value="" required>
                                    @error('obrik')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Peran Pelaku</label>
                                    <input id="pelaku" type="hidden" name="pelaku"
                                        class="form-control @error('pelaku') is-invalid @enderror"
                                        value="{{ old('pelaku', '') }}">
                                    <trix-editor input="pelaku"></trix-editor>
                                    @error('pelaku')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Keterangan</label>
                                    <input id="keterangan" type="hidden" name="keterangan"
                                        class="form-control @error('keterangan') is-invalid @enderror"
                                        value="{{ old('keterangan', '') }}">
                                    <trix-editor input="keterangan"></trix-editor>
                                    @error('keterangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-start" style="margin-top: 23%">
                                    <button type="reset" class="btn btn-secondary">Kembali</button>&nbsp;
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-lg-12 row g-3">
                                        <h5 class="card-title" style="margin-bottom: -5%"><strong>Kewajiban
                                                <hr>
                                            </strong>
                                        </h5>
                                        <div class="col-md-12">
                                            <label class="form-label">Total Kewajiban</label>
                                            <input type="text"
                                                class="form-control @error('kewajiban') is-invalid @enderror"
                                                id="inputName5" name="kewajiban" value="" required>
                                            @error('kewajiban')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">PPN</label>
                                            <input type="text" class="form-control @error('ppn') is-invalid @enderror"
                                                id="inputName5" name="ppn" value="" required>
                                            @error('ppn')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">PPH 21</label>
                                            <input type="text"
                                                class="form-control @error('pph_21') is-invalid @enderror"
                                                id="inputName5" name="pph_21" value="" required>
                                            @error('pph_21')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">PPH 22</label>
                                            <input type="text"
                                                class="form-control @error('pph_21') is-invalid @enderror"
                                                id="inputName5" name="pph_21" value="" required>
                                            @error('pph_21')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">PPH 23</label>
                                            <input type="text"
                                                class="form-control @error('pph_21') is-invalid @enderror"
                                                id="inputName5" name="pph_21" value="" required>
                                            @error('pph_21')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">MBLB</label>
                                            <input type="text"
                                                class="form-control @error('pph_21') is-invalid @enderror"
                                                id="inputName5" name="pph_21" value="" required>
                                            @error('pph_21')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Pajak Restoran</label>
                                            <input type="text"
                                                class="form-control @error('pph_21') is-invalid @enderror"
                                                id="inputName5" name="pph_21" value="" required>
                                            @error('pph_21')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Peran Pelaku</label>
                                            <input id="pelaku" type="hidden" name="pelaku"
                                                class="form-control @error('pelaku') is-invalid @enderror"
                                                value="{{ old('pelaku', '') }}">
                                            <trix-editor input="pelaku"></trix-editor>
                                            @error('pelaku')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Keterangan</label>
                                            <input id="keterangan" type="hidden" name="keterangan"
                                                class="form-control @error('keterangan') is-invalid @enderror"
                                                value="{{ old('keterangan', '') }}">
                                            <trix-editor input="keterangan"></trix-editor>
                                            @error('keterangan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>


    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pokokTindakSelect = document.getElementById('pokok_tindak');
            const subPokokTindakSelect = document.getElementById('sub_pokok_tindak');

            // Disable sub pokok tindak initially
            subPokokTindakSelect.disabled = true;

            // Event listener for cascading behavior
            pokokTindakSelect.addEventListener('change', function() {
                const selectedNoPokok = this.value;

                // Enable sub pokok tindak and filter options
                subPokokTindakSelect.disabled = false;
                Array.from(subPokokTindakSelect.options).forEach(option => {
                    if (option.getAttribute('data-no-pokok') === selectedNoPokok) {
                        option.style.display = '';
                    } else {
                        option.style.display = 'none';
                    }
                });

                // Reset sub pokok selection
                subPokokTindakSelect.value = '';
            });
        });
    </script>
@endsection

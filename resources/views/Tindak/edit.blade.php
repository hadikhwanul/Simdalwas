@extends('Layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>Edit Temuan {{ $judul }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="">{{ $judul }}</a></li>
                <li class="breadcrumb-item active">Edit {{ $judul }}</li>
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
            <!-- Details Section -->
            <div class="col-lg-6">
                <div class="card">
                    <span class="alert alert-danger alert-dismissible fade show"><strong>Temuan</strong></span>
                    <div class="card-body pt-3">
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
                                {{ $rekomendasi->temuan->pokokTemuan->no_pokok ?? '-' }}.
                                {{ $rekomendasi->temuan->pokokTemuan->pokok_temuan ?? '-' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-bold">Sub Pokok Temuan</div>
                            <div class="col-lg-9 col-md-8">
                                {{ $rekomendasi->temuan->pokokTemuan->no_subpokok ?? '-' }}.
                                {{ $rekomendasi->temuan->pokokTemuan->sub_pokok_temuan ?? '-' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Form Edit -->
            <form action="{{ route('update.tindak', $tindak->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- For PUT method -->
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <h5 class="card-title">Form Edit {{ $judul }}</h5>
                            <div class="col-md-12">
                                <label class="form-label">Keterangan {{ $judul }}</label>
                                <input id="tindak" type="hidden" name="tindak"
                                    class="form-control @error('tindak') is-invalid @enderror"
                                    value="{{ old('tindak', $tindak->tindak) }}">
                                <trix-editor input="tindak"></trix-editor>
                                @error('tindak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Pokok Tindak Lanjut</label>
                                <select id="pokok_tindak" class="form-select" name="pokok_tindak" required>
                                    <option disabled>Pilih Pokok Tindak Lanjut</option>
                                    @forelse ($PokokTindak as $pokok)
                                        <option value="{{ $pokok->no_pokok }}"
                                            {{ old('pokok_tindak', $tindak->pokok_tindak) == $pokok->no_pokok ? 'selected' : '' }}>
                                            {{ $pokok->no_pokok }}. {{ $pokok->pokok_tindak }}
                                        </option>
                                    @empty
                                        <option disabled>Tidak Ada Pokok Tindak Lanjut</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Sub Pokok Tindak Lanjut</label>
                                <select id="sub_pokok_tindak" class="form-select" name="pokok_temuan_id" required>
                                    <option disabled>Pilih Sub Pokok Tindak Lanjut</option>
                                    @forelse ($SubPokokTindak as $sub)
                                        <option value="{{ $sub->id }}"
                                            {{ old('pokok_temuan_id', $tindak->pokok_temuan_id) == $sub->id ? 'selected' : '' }}
                                            data-no-pokok="{{ $sub->no_pokok }}">
                                            {{ $sub->no_subpokok }}. {{ $sub->sub_pokok_tindak }}
                                        </option>
                                    @empty
                                        <option disabled>Tidak Ada Sub Pokok Tindak Lanjut</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" name="status">
                                    <option class="text-center" disabled>Pilih status</option>
                                    <option value="TPB" {{ old('status', $tindak->status) == 'TPB' ? 'selected' : '' }}>
                                        TPB - Temuan Pemeriksaan Belum Ada Tindak Lanjut
                                    </option>
                                    <option value="MDP" {{ old('status', $tindak->status) == 'MDP' ? 'selected' : '' }}>
                                        MDP - Masih Dalam Proses
                                    </option>
                                    <option value="TLS" {{ old('status', $tindak->status) == 'TLS' ? 'selected' : '' }}>
                                        TLS - Tindak Lanjut Selesai
                                    </option>
                                    <option value="TPTD"
                                        {{ old('status', $tindak->status) == 'TPTD' ? 'selected' : '' }}>
                                        TPTD - Temuan Pemeriksaan Tidak Dapat Dilanjuti
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Tindak Lanjut</label>
                                <input type="date" class="form-control @error('tanggal_tl') is-invalid @enderror"
                                    name="tanggal_tl" value="{{ old('tanggal_tl', $tindak->tanggal_tl) }}" required>
                                @error('tanggal_tl')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-success mt-3" type="submit">Update Tindak Lanjut</button>
                </div>
            </form>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pokokTindakSelect = document.getElementById('pokok_tindak');
            const subPokokTindakSelect = document.getElementById('sub_pokok_tindak');

            subPokokTindakSelect.disabled = true;

            pokokTindakSelect.addEventListener('change', function() {
                const selectedNoPokok = this.value;

                subPokokTindakSelect.disabled = false;
                Array.from(subPokokTindakSelect.options).forEach(option => {
                    if (option.getAttribute('data-no-pokok') === selectedNoPokok) {
                        option.style.display = '';
                    } else {
                        option.style.display = 'none';
                    }
                });

                subPokokTindakSelect.value = '';
            });

            // Pre-select sub pokok if available
            const selectedNoPokok = pokokTindakSelect.value;
            if (selectedNoPokok) {
                Array.from(subPokokTindakSelect.options).forEach(option => {
                    if (option.getAttribute('data-no-pokok') === selectedNoPokok) {
                        option.style.display = '';
                    } else {
                        option.style.display = 'none';
                    }
                });
                subPokokTindakSelect.disabled = false;
            }
        });
    </script>
@endsection

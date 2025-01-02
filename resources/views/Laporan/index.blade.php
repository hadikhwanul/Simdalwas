@extends('layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>Pencarian Laporan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Laporan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card ">
                    <span class="alert alert-danger  alert-dismissible fade show"><strong>Laporan Draft
                            LHP</strong></span>
                    <div class="card-body">
                        <div class="col-md-12">
                            <label class="form-label">Judul Draft LHP</label>
                            <select class="form-select @error('draft') is-invalid @enderror" name="draft">
                                <option class="text-center" disabled value="" selected>Pilih Draft LHP</option>
                                @forelse ($drafts as $draft)
                                    <option value="{{ $draft->id }}"
                                        {{ old('draft') == $draft->slug ? 'selected' : '' }}>{{ $draft->judul }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                        </div><br>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"><i class='bx bx-printer'> </i> Print </button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <span class="alert alert-success  alert-dismissible fade show"><strong>Laporan LHP</strong></span>
                    <div class="card-body">
                        <div class="col-md-12">
                            <label class="form-label">Judul LHP</label>
                            <select class="form-select @error('draft') is-invalid @enderror" name="lhp">
                                <option class="text-center" disabled value="" selected>Pilih LHP</option>
                                @forelse ($lhps as $lhp)
                                    <option value="{{ $lhp->id }}" {{ old('lhp') == $lhp->slug ? 'selected' : '' }}>
                                        {{ $lhp->judul }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                        </div><br>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"><i class='bx bx-printer'> </i> Print </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <span class="alert alert-primary  alert-dismissible fade show"><strong>Laporan Temuan
                            LHP</strong></span>
                    <div class="card-body">
                        <div class="col-md-12">
                            <label class="form-label">Judul LHP</label>
                            <select class="form-select @error('draft') is-invalid @enderror" name="lhp">
                                <option class="text-center" disabled value="" selected>Pilih LHP</option>
                                @forelse ($lhps as $lhp)
                                    <option value="{{ $lhp->id }}" {{ old('lhp') == $lhp->slug ? 'selected' : '' }}>
                                        {{ $lhp->judul }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                        </div><br>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"><i class='bx bx-printer'> </i> Print </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <span class="alert alert-warning  alert-dismissible fade show"><strong>Laporan Tindak
                            Lanjut</strong></span>
                    <div class="card-body row">
                        <div class="col-md-6">
                            <label class="form-label">Judul LHP</label>
                            <select class="form-select @error('draft') is-invalid @enderror" name="lhp">
                                <option class="text-center" disabled value="" selected>Pilih LHP</option>
                                @forelse ($lhps as $lhp)
                                    <option value="{{ $lhp->id }}" {{ old('lhp') == $lhp->slug ? 'selected' : '' }}>
                                        {{ $lhp->judul }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                        </div><br>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" name="status">
                                <option class="text-center" disabled value="" selected>Pilih status</option>
                                <option value="Semua" {{ old('status') == 'Semua' ? 'selected' : '' }}>
                                    Semua</option>
                                <option value="TPB" {{ old('status') == 'TPB' ? 'selected' : '' }}>
                                    TPB - Temuan Pemeriksaan Belum Ada Tindak Lanjut </option>
                                <option value="MDP" {{ old('status') == 'MDP' ? 'selected' : '' }}>
                                    MDP - Masih Dalam Proses
                                </option>
                                <option value="TLS" {{ old('status') == 'TLS' ? 'selected' : '' }}>
                                    TLS - Tindak Lanjut Selesai
                                </option>
                                <option value="TPTD" {{ old('status') == 'TPTD' ? 'selected' : '' }}>
                                    TPTD - Temuan Pemeriksaan Tidak Dapat Dilanjuti</option>
                            </select>
                        </div><br>
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary"><i class='bx bx-printer'> </i> Print </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

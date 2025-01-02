@extends('layouts.main')

@section('main')
    @php
        $userRole = auth()->user()->jobdesks->role;
    @endphp
    <div class="pagetitle d-flex justify-content-between">
        <div>
            <h1>Review Draft LHP</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('review-draft-lhp.index') }}">Review Draft LHP</a></li>
                    <li class="breadcrumb-item active">{{ $judul }}</li>
                </ol>
            </nav>
        </div>
        <div class="py-3 pe-2">
            <a href="{{ route('draft-lhp.index') }}">
                <button type="button" class="btn btn-outline-info rounded-pill">
                    <strong><i class='bx bx-arrow-back'></i> Kembali</strong>
                </button>
            </a>
        </div>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-lg-6">
                <div class="card ">
                    <span class="alert alert-danger  alert-dismissible fade show"><strong>Details Draft LHP</strong></span>
                    <div class="card-body pt-3 ">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Tanggal Draft LHP</div>
                            <div class="col-lg-9 col-md-8">{{ $review->tanggal_lhp }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">No Draft LHP</div>
                            <div class="col-lg-9 col-md-8">{{ $review->no_lhp }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Judul</div>
                            <div class="col-lg-9 col-md-8">{{ $review->judul }}</div>
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
                            <div class="col-lg-9 col-md-8">{{ $review->auditor->auditor }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Induk</div>
                            <div class="col-lg-9 col-md-8">{{ $review->induk->induk }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Departemen</div>
                            <div class="col-lg-9 col-md-8">{{ $review->departemen->departemen }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Sifat</div>
                            <div class="col-lg-9 col-md-8">{{ $review->sifat }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Bidang</div>
                            <div class="col-lg-9 col-md-8">{{ $review->bidang }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Review Draft LHP</h5>
                                <div class="row">
                                    <div class="col-lg-12 col-md-8">
                                        @if ($review->laporan)
                                            <p class="text-muted mt-1">
                                                Current file:
                                                <a href="{{ asset('storage/laporan_files/' . basename($review->laporan)) }}"
                                                    target="_blank" class="text-decoration-underline">
                                                    {{ basename($review->laporan) }}
                                                </a>
                                            </p>
                                            <!-- Pratinjau PDF -->
                                            <iframe
                                                src="{{ asset('storage/laporan_files/' . basename($review->laporan)) }}"
                                                width="100%" height="700px" style="border: none;"
                                                allowfullscreen></iframe>
                                        @else
                                            <p class="text-danger">Laporan tidak tersedia.</p>
                                        @endif
                                    </div>
                                </div>
                            </div><!-- End Overview -->
                            @if (str_contains('DALNIS|Admin|SuperAdmin', $userRole))
                                {{-- review dalnis --}}
                                <div class="col-lg-12 mt-3">
                                    <form action="{{ route('review.dalnis', $review->slug) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <!-- Alert Section -->
                                        <div class="alert alert-primary alert-dismissible fade show">
                                            <strong>Review DALNIS</strong>
                                        </div>

                                        <!-- Input for DALNIS Revision -->
                                        <input id="dalnis" type="hidden" name="revisi_dalnis"
                                            class="form-control @error('revisi_dalnis') is-invalid @enderror"
                                            value="{{ old('revisi_dalnis', $review->revisi_dalnis ?? '') }}">
                                        <trix-editor input="dalnis"></trix-editor>
                                        <p>*Jika Ada Revisi Wajib diisi</p>
                                        @error('revisi_dalnis')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <!-- Hidden Input for User -->
                                        <input type="hidden" name="user" value="{{ auth()->user()->username }}">

                                        <!-- Action Buttons -->
                                        <div class="d-flex justify-content-end mt-3">
                                            <button type="submit" name="action" value="revisi"
                                                class="btn btn-secondary">Revisi</button>&nbsp;
                                            <button type="submit" name="action" value="lanjutkan"
                                                class="btn btn-primary">Lanjutkan Ke IRBAN</button>
                                        </div>
                                    </form>
                                </div>
                                {{-- !review dalnis --}}
                            @endif
                            @if (str_contains('IRBAN|Admin|SuperAdmin', $userRole))
                                {{-- review irban --}}
                                <div class="col-lg-12 mt-3">
                                    <form action="{{ route('review.irban', $review->slug) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <!-- Alert Section -->
                                        <div class="alert alert-primary alert-dismissible fade show">
                                            <strong>Review IRBAN</strong>
                                        </div>

                                        <!-- Input for DALNIS Revision -->
                                        <input id="irban" type="hidden" name="revisi_irban"
                                            class="form-control @error('revisi_irban') is-invalid @enderror"
                                            value="{{ old('revisi_irban', $review->revisi_dalnis ?? '') }}">
                                        <trix-editor input="irban"></trix-editor>
                                        <p>*Jika Ada Revisi Wajib diisi</p>
                                        @error('revisi_irban')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <!-- Hidden Input for User -->
                                        <input type="hidden" name="user" value="{{ auth()->user()->username }}">

                                        <!-- Action Buttons -->
                                        <div class="d-flex justify-content-end mt-3">
                                            <button type="submit" name="action" value="revisi"
                                                class="btn btn-secondary">Revisi</button>&nbsp;
                                            <button type="submit" name="action" value="lanjutkan"
                                                class="btn btn-primary">Lanjutkan Ke Sekretaris</button>
                                        </div>
                                    </form>
                                </div>
                                {{-- !review irban --}}
                            @endif
                            @if (str_contains('SEKRETARIS|Admin|SuperAdmin', $userRole))
                                {{-- review sekretaris --}}
                                <div class="col-lg-12 mt-3">
                                    <form action="{{ route('review.sekretaris', $review->slug) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <!-- Alert Section -->
                                        <div class="alert alert-primary alert-dismissible fade show">
                                            <strong>Review Sekretaris</strong>
                                        </div>

                                        <!-- Input for Sekretaris Revision -->
                                        <input id="sekretaris" type="hidden" name="revisi_sekretaris"
                                            class="form-control @error('revisi_sekretaris') is-invalid @enderror"
                                            value="{{ old('revisi_sekretaris', $review->revisi_sekretaris ?? '') }}">
                                        <trix-editor input="sekretaris"></trix-editor>
                                        <p>*Jika Ada Revisi Wajib diisi</p>
                                        @error('revisi_sekretaris')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <!-- Hidden Input for User -->
                                        <input type="hidden" name="user" value="{{ auth()->user()->username }}">

                                        <!-- Action Buttons -->
                                        <div class="d-flex justify-content-end mt-3">
                                            <button type="submit" name="action" value="revisi"
                                                class="btn btn-secondary">Revisi</button>&nbsp;
                                            <button type="submit" name="action" value="lanjutkan"
                                                class="btn btn-primary">Lanjutkan Ke Inspektur</button>
                                        </div>
                                    </form>
                                </div>
                                {{-- !review sekretaris --}}
                            @endif
                            @if (str_contains('INSPEKTUR|Admin|SuperAdmin', $userRole))
                                {{-- review inspektur --}}
                                <div class="col-lg-12 mt-3">
                                    <form action="{{ route('review.inspektur', $review->slug) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <!-- Alert Section -->
                                        <div class="alert alert-primary alert-dismissible fade show">
                                            <strong>Review Inspektur</strong>
                                        </div>

                                        <!-- Input for inspektur Revision -->
                                        <input id="inspektur" type="hidden" name="revisi_inspektur"
                                            class="form-control @error('revisi_inspektur') is-invalid @enderror"
                                            value="{{ old('revisi_inspektur', $review->revisi_inspektur ?? '') }}">
                                        <trix-editor input="inspektur"></trix-editor>
                                        <p>*Jika Ada Revisi Wajib diisi</p>
                                        @error('revisi_inspektur')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <!-- Hidden Input for User -->
                                        <input type="hidden" name="user" value="{{ auth()->user()->username }}">

                                        <!-- Action Buttons -->
                                        <div class="d-flex justify-content-end mt-3">
                                            <button type="submit" name="action" value="revisi"
                                                class="btn btn-secondary">Revisi</button>&nbsp;
                                            <button type="submit" name="action" value="lanjutkan"
                                                class="btn btn-primary">Terbitkan LHP</button>
                                        </div>
                                    </form>
                                </div>
                                {{-- !review dalnis --}}
                            @endif
                        </div>
                    </div><!-- End Bordered Tabs -->
                </div>
            </div>
        </div>
    </section>
@endsection

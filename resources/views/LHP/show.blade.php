@extends('layouts.main')

@section('main')
    <div class="pagetitle d-flex justify-content-between">
        <div>
            <h1>{{ $judul }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('lhp.index') }}">LHP</a></li>
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
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body pt-3">
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Details LHP</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">No LHP</div>
                                    <div class="col-lg-9 col-md-8">{{ $lhp->no_lhp }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Judul</div>
                                    <div class="col-lg-9 col-md-8">{{ $lhp->judul }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Tanggal</div>
                                    <div class="col-lg-9 col-md-8">{{ $lhp->tanggal_lhp }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Auditor</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $lhp->auditor ? $lhp->auditor->auditor : '-' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Induk</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $lhp->induk ? $lhp->induk->induk : '-' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Departemen</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $lhp->departemen ? $lhp->departemen->departemen : '-' }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Sifat</div>
                                    <div class="col-lg-9 col-md-8">{{ $lhp->sifat }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Bidang</div>
                                    <div class="col-lg-9 col-md-8">{{ $lhp->bidang ? $lhp->bidang : '-' }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Pemeriksa</div>
                                    <div class="col-lg-9 col-md-8">{!! $lhp->pemeriksa !!}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Status</div>
                                    <div class="col-lg-9 col-md-8">{{ $lhp->status }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Upload</div>
                                    <div class="col-lg-9 col-md-8">{{ $lhp->user }} - {{ $lhp->irban }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Laporan</div>
                                    <div class="col-lg-9 col-md-8">
                                        @if ($lhp->laporan)
                                            <p class="text-muted mt-1">
                                                Current file:
                                                <a href="{{ asset('storage/laporan_files/' . basename($lhp->laporan)) }}"
                                                    target="_blank" class="text-decoration-underline" download>
                                                    {{ basename($lhp->laporan) }}
                                                </a>
                                            </p>

                                            <!-- Pratinjau PDF -->
                                            <iframe src="{{ asset('storage/laporan_files/' . basename($lhp->laporan)) }}"
                                                width="100%" height="500px" style="border: none;"
                                                allowfullscreen></iframe>
                                        @else
                                            <p class="text-danger">Laporan tidak tersedia.</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col d-flex justify-content-end">
                                        <a href="{{ route('lhp.edit', $lhp->slug) }}" class="btn btn-outline-primary me-2">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <form action="{{ route('lhp.destroy', $lhp->slug) }}" method="POST"
                                            class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger"
                                                onclick="return confirm('Yakin ingin menghapus data?')">
                                                <i class="bx bx-trash me-1"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div><!-- End Overview -->
                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>

            <!-- Right side columns -->
            <div class="col-lg-4 section dashboard">

                <!-- Recent Activity -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">History <span>| Draft LHP</span></h5>

                        <div class="activity">
                            @forelse ($lhp->histories as $history)
                                <div class="activity-item d-flex">
                                    <div class="activite-label">{{ $history->created_at->diffForHumans() }}</div>
                                    <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                                    <div class="activity-content">
                                        {{ $history->history }}
                                    </div>
                                </div><!-- End activity item-->
                            @empty
                                <div class="activity-item d-flex">
                                    <div class="activite-label">No history found.</div>
                                </div><!-- End activity item-->
                            @endforelse
                        </div>
                    </div>
                </div><!-- End Recent Activity -->

            </div><!-- End Right side columns -->
        </div>
    </section>
@endsection

@extends('layouts.main')

@section('main')
    <div class="pagetitle d-flex justify-content-between">
        <div>
            <h1>{{ $judul }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">{{ $judul }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header card-title" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseOne" aria-expanded="false"
                                        aria-controls="flush-collapseOne">
                                        Filter
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="row">
                                        @foreach (range(1, 8) as $i)
                                            <div class="col-lg-2 mb-3">
                                                <div>
                                                    <p><strong>Default Card {{ $i }}</strong></p>
                                                    <select id="inputState" class="form-select select2">
                                                        <option value="">Select an option</option>
                                                        <option value="1">Option 1</option>
                                                        <option value="2">Option 2</option>
                                                        <option value="3">Option 3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-lg-12 mt-2">
                                            <button class="btn btn-primary">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="card-title">Data Review Draft LHP</h5>
                        @if (session()->has('success'))
                            <div class="alert border-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session()->has('error'))
                            <div class="alert border-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert border-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col" style="width: 5%;">No</th>
                                    <th class="text-center" scope="col" style="width: 15%;">User</th>
                                    <th class="text-center" scope="col" style="max-width: 20%;">Judul</th>
                                    <th class="text-center" scope="col" style="width: 20%;">Tanggal</th>
                                    <th class="text-center" scope="col" style="width: 10%;">No LHP</th>
                                    <th class="text-center" scope="col" style="width: 20%;">Type</th>
                                    <th class="text-center" scope="col" style="width: 10%;">Status</th>
                                    <th class="text-center" scope="col" style="max-width: 10%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($review as $review)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td><b>{{ $review->user }}</b><br>{{ $review->irban }}</td>
                                        <td><a href="{{ route('draft-lhp.show', $review->slug) }}">{{ $review->judul }}</a>
                                        </td>
                                        <td>{{ $review->tanggal_lhp }}</td>
                                        <td>{{ $review->no_lhp }}</td>
                                        <td><b>Bidang:</b><br> {{ $review->bidang }} <br> <b>Sifat:</b>
                                            {{ $review->sifat }}
                                        </td>
                                        <td class="text-center">
                                            <span @class([
                                                'badge',
                                                'bg-warning' => in_array($review->status, [
                                                    'Review DALNIS',
                                                    'Review IRBAN',
                                                    'Review Sekretaris',
                                                    'Review Inspektur',
                                                ]),
                                                'bg-success' => $review->status === 'LHP Terbit',
                                                'bg-danger' => in_array($review->status, [
                                                    'Revisi DALNIS',
                                                    'Revisi IRBAN',
                                                    'Revisi Sekretaris',
                                                    'Revisi Inspektur',
                                                ]),
                                                'bg-secondary' => !in_array($review->status, [
                                                    'Review DALNIS',
                                                    'Review IRBAN',
                                                    'Review Sekretaris',
                                                    'Review Inspektur',
                                                    'LHP Terbit',
                                                    'Revisi DALNIS',
                                                    'Revisi IRBAN',
                                                    'Revisi Sekretaris',
                                                    'Revisi Inspektur',
                                                ]),
                                            ])>
                                                {{ $review->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <a href="{{ route('review-draft-lhp.show', $review->slug) }}"
                                                    class="btn btn-outline-secondary" data-toggle="tooltip"
                                                    title="Review Draft LHP">
                                                    <i class="tf-icons bx bx-task"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak Ada Data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true
            });
        });
    </script>
@endsection

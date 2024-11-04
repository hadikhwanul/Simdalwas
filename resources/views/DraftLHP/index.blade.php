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
        <div class="py-3 pe-2">
            <a href="{{ route('draft-lhp.create') }}">
                <button type="button" class="btn btn-warning rounded-pill">
                    <strong><i class='bx bx-plus'></i> Tambah</strong>
                </button>
            </a>
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
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-lg-2 mb-3">
                                            <div>
                                                <p><strong>Searchable Select</strong></p>
                                                <select id="inputState" class="form-select select2">
                                                    <option value="">Select an option</option>
                                                    <option value="1">Option 1</option>
                                                    <option value="2">Option 2</option>
                                                    <option value="3">Option 3</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mt-2">
                                            <button class="btn btn-primary">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="card-title">Data Draft LHP</h5>
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
                                    <th class="text-center" scope="col" style="width: 15%;">Judul</th>
                                    <th class="text-center" scope="col" style="width: 20%;">Tanggal</th>
                                    <th class="text-center" scope="col" style="width: 10%;">No LHP</th>
                                    <th class="text-center" scope="col" style="width: 20%;">Type</th>
                                    <th class="text-center" scope="col" style="width: 10%;">Status</th>
                                    <th class="text-center" scope="col" style="width: 5%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($drafts as $draft)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td><b>{{ $draft->user }}</b><br>{{ $draft->irban }}</td>
                                        <td><a href="{{ route('draft-lhp.show', $draft->slug) }}">{{ $draft->judul }}</a>
                                        </td>
                                        <td>{{ $draft->tanggal_lhp }}</td>
                                        <td>{{ $draft->no_lhp }}</td>
                                        <td><b>Bidang:</b> {{ $draft->bidang }} <br><br> <b>Sifat:</b> {{ $draft->sifat }}
                                        </td>
                                        <td class="text-center"><span class="badge bg-warning">{{ $draft->status }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <a href="{{ route('draft-lhp.edit', $draft->slug) }}"
                                                    class="btn btn-outline-primary">
                                                    <i class="tf-icons bx bx-edit-alt"></i>
                                                </a>
                                                <form action="{{ route('draft-lhp.destroy', $draft->slug) }}"
                                                    method="POST" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger"
                                                        onclick="return confirm('Yakin Ingin Menghapus Data?')">
                                                        <i class="tf-icons bx bx-trash"></i>
                                                    </button>
                                                </form>
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

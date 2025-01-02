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
                                <!-- Filter Section -->
                                <form method="GET" action="{{ route('draft-lhp.index') }}">
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="row">
                                            <div class="col-lg-2 mb-3">
                                                <p><strong>Bidang</strong></p>
                                                <select id="filter-bidang" name="bidang" class="form-select">
                                                    <option class="text-center" value="" selected>Pilih
                                                        Bidang</option>
                                                    <option value="Komprehensif"
                                                        {{ request('bidang') == 'Komprehensif' ? 'selected' : '' }}>
                                                        Komprehensif</option>
                                                    <option value="Kebijakan"
                                                        {{ request('bidang') == 'Kebijakan' ? 'selected' : '' }}>Kebijakan
                                                    </option>
                                                    <option value="Tupoksi"
                                                        {{ request('bidang') == 'Tupoksi' ? 'selected' : '' }}>Tupoksi
                                                    </option>
                                                    <option value="Pengelolaan Aset Daerah"
                                                        {{ request('bidang') == 'Pengelolaan Aset Daerah' ? 'selected' : '' }}>
                                                        Pengelolaan Aset Daerah</option>
                                                    <option value="Pengelolaan Keuangan"
                                                        {{ request('bidang') == 'Pengelolaan Keuangan' ? 'selected' : '' }}>
                                                        Pengelolaan Keuangan</option>
                                                    <option value="Pengelolaan Pendapatan"
                                                        {{ request('bidang') == 'Pengelolaan Pendapatan' ? 'selected' : '' }}>
                                                        Pengelolaan Pendapatan</option>
                                                    <option value="Pengelolaan Kepegawaian"
                                                        {{ request('bidang') == 'Pengelolaan Kepegawaian' ? 'selected' : '' }}>
                                                        Pengelolaan Kepegawaian</option>
                                                    <option value="Pengelolaan Kekayaan"
                                                        {{ request('bidang') == 'Pengelolaan Kekayaan' ? 'selected' : '' }}>
                                                        Pengelolaan Kekayaan</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-2 mb-3">
                                                <p><strong>Sifat</strong></p>
                                                <select id="filter-sifat" name="sifat" class="form-select">
                                                    <option class="text-center" value="" selected>Pilih Sifat
                                                    </option>
                                                    <option value="Reguler"
                                                        {{ request('sifat') == 'Reguler' ? 'selected' : '' }}>Reguler
                                                    </option>
                                                    <option value="Khusus"
                                                        {{ request('sifat') == 'Khusus' ? 'selected' : '' }}>Khusus
                                                    </option>
                                                    <option value="Kinerja"
                                                        {{ request('sifat') == 'Kinerja' ? 'selected' : '' }}>Kinerja
                                                    </option>
                                                    <option value="Rahasia"
                                                        {{ request('sifat') == 'Rahasia' ? 'selected' : '' }}>Rahasia
                                                    </option>
                                                    <option value="Terpadu"
                                                        {{ request('sifat') == 'Terpadu' ? 'selected' : '' }}>Terpadu
                                                    </option>
                                                    <option value="Kasus"
                                                        {{ request('sifat') == 'Kasus' ? 'selected' : '' }}>Kasus</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-2 mb-3">
                                                <p><strong>Status</strong></p>
                                                <select id="filter-status" name="status" class="form-select">
                                                    <option class="text-center" value="" selected>Pilih
                                                        Status</option>
                                                    <option value="Review DALNIS"
                                                        {{ request('status') == 'Review DALNIS' ? 'selected' : '' }}>Review
                                                        DALNIS</option>
                                                    <option value="Review IRBAN"
                                                        {{ request('status') == 'Review IRBAN' ? 'selected' : '' }}>Review
                                                        IRBAN</option>
                                                    <option value="Review Sekretaris"
                                                        {{ request('status') == 'Review Sekretaris' ? 'selected' : '' }}>
                                                        Review Sekretaris</option>
                                                    <option value="Review Inspektur"
                                                        {{ request('status') == 'Review Inspektur' ? 'selected' : '' }}>
                                                        Review Inspektur</option>
                                                    <option value="LHP Terbit"
                                                        {{ request('status') == 'LHP Terbit' ? 'selected' : '' }}>LHP
                                                        Terbit</option>
                                                    <option value="Revisi DALNIS"
                                                        {{ request('status') == 'Revisi DALNIS' ? 'selected' : '' }}>Revisi
                                                        DALNIS</option>
                                                    <option value="Revisi IRBAN"
                                                        {{ request('status') == 'Revisi IRBAN' ? 'selected' : '' }}>Revisi
                                                        IRBAN</option>
                                                    <option value="Revisi Sekretaris"
                                                        {{ request('status') == 'Revisi Sekretaris' ? 'selected' : '' }}>
                                                        Revisi Sekretaris</option>
                                                    <option value="Revisi Inspektur"
                                                        {{ request('status') == 'Revisi Inspektur' ? 'selected' : '' }}>
                                                        Revisi Inspektur</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-2 mb-3">
                                                <p><strong>Induk</strong></p>
                                                <select id="filter-induk" name="induk_id"
                                                    class="form-select @error('induk_id') is-invalid @enderror">
                                                    <option class="text-center" value="" selected>Pilih Induk
                                                    </option>
                                                    @forelse ($induks as $induk)
                                                        <option value="{{ $induk->id }}"
                                                            {{ request('induk_id') == $induk->id ? 'selected' : '' }}>
                                                            {{ Str::before($induk->induk ?? '', '-') }}
                                                        </option>
                                                    @empty
                                                        <option value="" disabled>Tidak Ada Induk</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                            <div class="col-lg-2 mb-3">
                                                <p><strong>Tanggal LHP</strong></p>
                                                <input type="date" class="form-control" name="tanggal_lhp"
                                                    id="filter-tanggal_lhp" value="{{ request('tanggal_lhp') }}">
                                            </div>
                                            <div class="col-lg-12 mt-2">
                                                <button type="submit" class="btn btn-primary">Filter</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <h5 class="card-title">Data Draft LHP</h5>
                        <!-- Display success/error messages here -->

                        <!-- Table with stripped rows -->
                        <!-- Data Table -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col" style="max-width: 5%;">No</th>
                                    <th class="text-center" scope="col" style="max-width: 10%;">User</th>
                                    <th class="text-center" scope="col" style="max-width: 25%;">Judul</th>
                                    <th class="text-center" scope="col" style="max-width: 15%;">Tanggal</th>
                                    <th class="text-center" scope="col" style="max-width: 15%;">Type</th>
                                    <th class="text-center" scope="col" style="max-width: 10%;">Status</th>
                                    <th class="text-center" scope="col" style="max-width: 15%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="data-body">
                                @forelse ($drafts as $draft)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td><b>{{ $draft->user }}</b><br>{{ $draft->irban }}</td>
                                        <td><a
                                                href="{{ route('draft-lhp.show', $draft->slug) }}">{{ $draft->judul }}</a><br><br>
                                            <span>Induk
                                                :</span>{{ Str::before($draft->induk->induk ?? '', '-') }}
                                            <br><br>No
                                            Draft LHP : {{ $draft->no_lhp }}
                                        </td>
                                        <td>{{ $draft->tanggal_lhp }}</td>
                                        <td><b>Bidang:</b> {{ $draft->bidang }} <br><br> <b>Sifat:</b> {{ $draft->sifat }}
                                        </td>
                                        <td class="text-center">
                                            <span @class([
                                                'badge',
                                                'bg-warning' => in_array($draft->status, [
                                                    'Review DALNIS',
                                                    'Review IRBAN',
                                                    'Review Sekretaris',
                                                    'Review Inspektur',
                                                ]),
                                                'bg-success' => $draft->status === 'LHP Terbit',
                                                'bg-danger' => in_array($draft->status, [
                                                    'Revisi DALNIS',
                                                    'Revisi IRBAN',
                                                    'Revisi Sekretaris',
                                                    'Revisi Inspektur',
                                                ]),
                                                'bg-secondary' => !in_array($draft->status, [
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
                                                {{ $draft->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="gap-2 text-center">
                                                <a href="{{ route('draft-lhp.edit', $draft->slug) }}"
                                                    class="btn btn-outline-primary" title="Perbarui Data">
                                                    <i class="tf-icons bx bx-edit-alt"></i>
                                                </a>
                                                <form action="{{ route('draft-lhp.destroy', $draft->slug) }}"
                                                    method="POST" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger"
                                                        title="Hapus Data"
                                                        onclick="return confirm('Yakin Ingin Menghapus Data?')">
                                                        <i class="tf-icons bx bx-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak Ada Data</td>
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

    <!-- JS: AJAX -->
    <script>
        $(document).ready(function() {
            $('#filter-btn').click(function() {
                // Gather filter data
                var bidang = $('#filter-bidang').val();
                var sifat = $('#filter-sifat').val();
                var status = $('#filter-status').val();
                var tanggal_lhp = $('#filter-tanggal_lhp').val();

                // Send AJAX request
                $.ajax({
                    url: "{{ route('draft-lhp.index') }}", // The route to filter drafts
                    type: "GET",
                    data: {
                        bidang: bidang,
                        sifat: sifat,
                        status: status,
                        tanggal_lhp: tanggal_lhp
                    },
                    success: function(response) {
                        // Replace the table body with the filtered results
                        $('tbody').html(response.table_data);
                        // Update the pagination links
                        $('.pagination').html(response.pagination);
                    }
                });
            });
        });
    </script>
@endsection

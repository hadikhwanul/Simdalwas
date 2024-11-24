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
                                <select id="jumlah_penyebab" class="form-select" name="jumlah_penyebab" required>
                                    <option value="" disabled {{ old('jumlah_penyebab') ? '' : 'selected' }}>Pilih
                                        jumlah penyebab</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}"
                                            {{ old('jumlah_penyebab', 1) == $i ? 'selected' : '' }}>{{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Sub Pokok Temuan Field -->
                            <div class="col-md-6">
                                <label class="form-label">Sub Pokok Temuan</label>
                                <select id="sub_pokok_temuan" class="form-select" name="pokok_temuan_id" required>
                                    <option disabled selected>Pilih Sub Pokok Temuan</option>
                                    @foreach ($sub_pokok_temuan as $sub)
                                        <option value="{{ $sub->id }}" data-no-pokok="{{ $sub->no_pokok }}">
                                            {{ $sub->no_subpokok }}. {{ $sub->pokok_temuan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Jumlah Rekomendasi Field -->
                            <div class="col-md-6">
                                <label class="form-label">Jumlah Rekomendasi</label>
                                <select id="jumlah_rekomendasi" class="form-select" name="jumlah_rekomendasi" required>
                                    <option value="" disabled {{ old('jumlah_rekomendasi') ? '' : 'selected' }}>Pilih
                                        jumlah rekomendasi</option>
                                    @for ($j = 1; $j <= 10; $j++)
                                        <option value="{{ $j }}"
                                            {{ old('jumlah_rekomendasi', 1) == $j ? 'selected' : '' }}>{{ $j }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Hidden User Input -->
                            <input type="text" class="form-control" name="user"
                                value="{{ auth()->user()->username }}" hidden disabled>
                        </div>
                    </div>
                </div>

                <!-- Penyebab Fields -->
                <div id="penyebab-container"></div>

                <!-- Rekomendasi Fields -->
                <div id="rekomendasi-container"></div>

                <!-- Templates for Dynamic Fields -->
                <template id="penyebab-template">
                    <div class="card mt-3 penyebab-item">
                        <div class="card-body">
                            <div class="row g-3">
                                <h5 class="card-title">Penyebab <span class="penyebab-index"></span></h5>

                                <!-- Pokok Penyebab Field -->
                                <div class="col-md-6">
                                    <label class="form-label">Pokok Penyebab</label>
                                    <select id="pokok_penyebab" class="form-select" name="pokok_penyebab" required>
                                        <option disabled selected>Pilih Pokok Penyebab</option>
                                        @foreach ($pokok_penyebab as $penyebab)
                                            <option value="{{ $penyebab->id }}"
                                                {{ old('penyebab.' . $loop->index) == $penyebab->no_pokok ? 'selected' : '' }}>
                                                {{ $penyebab->no_pokok }}. {{ $penyebab->pokok_penyebab }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Keterangan Penyebab Field -->
                                <div class="col-md-6">
                                    <label class="form-label">Keterangan Penyebab</label>
                                    <input id="penyebab" type="hidden" name="penyebab[]" class="form-control"
                                        value="{{ old('penyebab.0') }}">
                                    <trix-editor input="penyebab"></trix-editor>
                                    @error('penyebab.0')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Sub Pokok Penyebab Field -->
                                <div class="col-md-6" style="margin-top: -7%">
                                    <label class="form-label">Sub Pokok Penyebab</label>
                                    <select id="sub_pokok_penyebab" class="form-select" name="pokok_penyebab_id[]"
                                        required>
                                        <option disabled selected>Pilih Sub Pokok Penyebab</option>
                                        @foreach ($sub_pokok_penyebab as $sub)
                                            <option value="{{ $sub->id }}" data-no-pokok="{{ $sub->no_pokok }}">
                                                {{ $sub->no_subpokok }}. {{ $sub->pokok_penyebab }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
                <template id="rekomendasi-template">
                    <div class="card rekomendasi-item">
                        <div class="card-body">
                            <div class="row g-3">
                                <h5 class="card-title">Rekomendasi <span class="rekomendasi-index"></span></h5>

                                <!-- Pokok Rekomendasi Field -->
                                <div class="col-md-6">
                                    <label class="form-label">Pokok Rekomendasi</label>
                                    <select class="form-select pokok_rekomendasi" name="pokok_rekomendasi">
                                        <option disabled selected>Pilih Pokok Rekomendasi</option>
                                        @foreach ($pokok_rekomendasi as $rekomendasi)
                                            <option value="{{ $rekomendasi->id }}">
                                                {{ $rekomendasi->no_pokok }}. {{ $rekomendasi->pokok_rekomendasi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Keterangan Rekomendasi Field -->
                                <div class="col-md-6">
                                    <label class="form-label">Keterangan Rekomendasi</label>
                                    <input id="rekomendasi" type="hidden" name="rekomendasi[]"
                                        class="form-control @error('rekomendasi.*') is-invalid @enderror">
                                    <trix-editor input="rekomendasi"></trix-editor>
                                    @error('rekomendasi.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Sub Pokok Rekomendasi Field -->
                                <div class="col-md-6" style="margin-top: -7%">
                                    <label class="form-label">Sub Pokok Rekomendasi</label>
                                    <select id="sub_pokok_rekomendasi" class="form-select" name="pokok_rekomendasi_id[]"
                                        required>
                                        <option disabled selected>Pilih Sub Pokok Rekomendasi</option>
                                        @foreach ($sub_pokok_rekomendasi as $sub)
                                            <option value="{{ $sub->id }}" data-no-pokok="{{ $sub->no_pokok }}">
                                                {{ $sub->no_subpokok }}. {{ $sub->pokok_rekomendasi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Nilai Kerugian Field -->
                                <div class="col-md-6">
                                    <label class="form-label">Nilai Kerugian</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rp.</span>
                                        <input type="number"
                                            class="form-control @error('kerugian.*') is-invalid @enderror"
                                            name="kerugian[]" value="{{ old('kerugian.0') }}" required>
                                        @error('kerugian.*')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Nilai Kewajiban Field -->
                                <div class="col-md-6" style="margin-top: -7.5%">
                                    <label class="form-label">Nilai Kewajiban</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rp.</span>
                                        <input type="number"
                                            class="form-control @error('kewajiban.*') is-invalid @enderror"
                                            name="kewajiban[]" value="{{ old('kewajiban.0') }}" required>
                                        @error('kewajiban.*')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                </template>
                <!-- Submit Button -->
                <div class="col-md-12">
                    <button class="btn btn-primary mt-3" type="submit">Simpan Temuan</button>
                </div>
            </form>

        </div>


    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elements for 'penyebab' and 'rekomendasi'
            const jumlahPenyebab = document.getElementById('jumlah_penyebab');
            const penyebabContainer = document.getElementById('penyebab-container');
            const penyebabTemplate = document.getElementById('penyebab-template').content;

            const jumlahRekomendasi = document.getElementById('jumlah_rekomendasi');
            const rekomendasiContainer = document.getElementById('rekomendasi-container');
            const rekomendasiTemplate = document.getElementById('rekomendasi-template').content;

            // Elements for 'kerugian' and 'kewajiban' inputs
            const kerugianInput = document.getElementById('kerugian');
            const kewajibanInput = document.getElementById('kewajiban');

            // Function to generate fields based on the selected number (penyebab/rekomendasi)
            function generateFields(container, template, jumlah, indexClass) {
                container.innerHTML = ''; // Reset container
                for (let i = 1; i <= jumlah; i++) {
                    const clone = template.cloneNode(true);
                    clone.querySelector(indexClass).textContent = i; // Update index
                    container.appendChild(clone); // Add to container
                }
            }

            // Event listeners for 'jumlah_penyebab' and 'jumlah_rekomendasi' fields
            jumlahPenyebab.addEventListener('change', function() {
                const jumlah = parseInt(this.value, 10);
                generateFields(penyebabContainer, penyebabTemplate, jumlah,
                    '.penyebab-index'); // Generate 'penyebab'
            });

            jumlahRekomendasi.addEventListener('change', function() {
                const jumlah = parseInt(this.value, 10);
                generateFields(rekomendasiContainer, rekomendasiTemplate, jumlah,
                    '.rekomendasi-index'); // Generate 'rekomendasi'
            });

            // Initialize form with default values (1 'penyebab' and 1 'rekomendasi')
            generateFields(penyebabContainer, penyebabTemplate, 1, '.penyebab-index');
            generateFields(rekomendasiContainer, rekomendasiTemplate, 1, '.rekomendasi-index');

            // Apply currency formatting to 'kerugian' and 'kewajiban' fields
            function formatCurrency(input) {
                input.addEventListener('input', function() {
                    let value = input.value.replace(/\D/g, ''); // Remove non-numeric characters
                    if (value.length > 0) {
                        value = 'Rp. ' + value.replace(/(\d)(?=(\d{3})+(?!\d))/g,
                            '$1,'); // Format with commas
                    }
                    input.value = value;
                });
            }

            if (kerugianInput) formatCurrency(kerugianInput);
            if (kewajibanInput) formatCurrency(kewajibanInput);





            // !Pokok Rekomendasi & Sub Pokok Temuan
            const pokokSelect = document.getElementById('pokok_temuan');
            const subPokokSelect = document.getElementById('sub_pokok_temuan');

            // Ensure Sub Pokok Temuan is disabled on initial page load
            subPokokSelect.disabled = true;

            pokokSelect.addEventListener('change', function() {
                const selectedNoPokok = this.value;

                // Hide all options in Sub Pokok Temuan initially
                Array.from(subPokokSelect.options).forEach(option => {
                    option.hidden = true; // Hide options
                });

                // Enable or disable Sub Pokok Temuan based on Pokok Temuan selection
                if (selectedNoPokok) {
                    subPokokSelect.disabled = false; // Enable Sub Pokok Temuan
                } else {
                    subPokokSelect.disabled = true; // Disable Sub Pokok Temuan if no Pokok is selected
                }

                // Show options that match the selected Pokok Temuan
                Array.from(subPokokSelect.options).forEach(option => {
                    if (option.dataset.noPokok === selectedNoPokok) {
                        option.hidden = false; // Show matched options
                    }
                });

                // Reset Sub Pokok Temuan selection
                subPokokSelect.value = '';
            });
        });
    </script>
@endsection

@php
    public function storetemuan(Request $request, $slug)
    {
        // Find the LHP model using the slug
        $lhp = Draft::where('slug', $slug)->first();

        if (!$lhp) {
            return redirect()->back()->with('error', 'LHP not found.');
        }

        // Validation rules for the incoming data
        try {
            $validated = $request->validate([
                'temuan' => 'required|string',
                'keterangan' => 'required|string',
                'pokok_temuan_id' => 'required|exists:pokok_temuan,id', // Ensure the pokok_temuan exists
                'jumlah_penyebab' => 'required|integer|min:1|max:10',
                'jumlah_rekomendasi' => 'required|integer|min:1|max:10',

                // Penyebab Validation
                'penyebab' => 'required|array|size:' . $request->jumlah_penyebab,
                'penyebab.*' => 'required|exists:penyebabs,id', // Check if penyebab ID exists
                'pokok_penyebab_id' => 'required|array|size:' . $request->jumlah_penyebab,
                'pokok_penyebab_id.*' => 'required|exists:penyebabs,id', // Check if pokok_penyebab_id exists

                // Rekomendasi Validation
                'rekomendasi' => 'required|array|size:' . $request->jumlah_rekomendasi,
                'rekomendasi.*' => 'required|exists:rekomendasis,id', // Check if rekomendasi ID exists
                'pokok_rekomendasi_id' => 'required|array|size:' . $request->jumlah_rekomendasi,
                'pokok_rekomendasi_id.*' => 'required|exists:rekomendasis,id', // Check if pokok_rekomendasi_id exists

                // Optional Fields
                'kerugian' => 'nullable|array|size:' . $request->jumlah_rekomendasi,
                'kerugian.*' => 'numeric|min:0',
                'kewajiban' => 'nullable|array|size:' . $request->jumlah_rekomendasi,
                'kewajiban.*' => 'numeric|min:0',
            ]);


        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log the validation errors for debugging purposes
            \Log::error('Validation errors:', $e->errors());

            // Redirect back with the validation errors
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        // Store Temuan
        $temuan = new Temuan();
        $temuan->temuan = $request->temuan;
        $temuan->keterangan = $request->keterangan;
        $temuan->pokok_temuan_id = $request->pokok_temuan_id;
        $temuan->user = $request->user;
        $temuan->lhp_id = $lhp->id; // Associate with the LHP
        $temuan->save();

        // Store Penyebab
        foreach ($request->penyebab as $index => $penyebab) {
            $temuan->penyebabs()->create([
                'penyebab' => $penyebab,
                'pokok_penyebab_id' => $request->pokok_penyebab_id[$index],
            ]);
        }

        // Store Rekomendasi
        foreach ($request->rekomendasi as $index => $rekomendasi) {
            $temuan->rekomendasis()->create([
                'rekomendasi' => $rekomendasi,
                'pokok_rekomendasi_id' => $request->pokok_rekomendasi_id[$index],
                'kerugian' => $request->kerugian[$index] ?? 0,
                'kewajiban' => $request->kewajiban[$index] ?? 0,
            ]);
        }

        // Redirect back with a success message
        return redirect()->route('temuan.index', $lhp->slug)->with('success', 'Temuan successfully saved!');
    }
@endphp
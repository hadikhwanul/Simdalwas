<!DOCTYPE html>
<html>

<head>
    <title>Export Laporan Temuan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center mb-4">
            <table class="text-center">
                <tr class="text-center">
                    <td width="150" rowspan="2">
                        <img src="{{ URL::asset('assets/img/favicon.png') }}" width="90" height="120"
                            alt="Logo" />
                    </td>
                    <td>
                        <p style="font-family: Arial; color: black; margin: 0;">PEMERINTAH KABUPATEN LOMBOK TIMUR</p>
                        <h2 style="font-family: Arial; color: blue; margin: 0;">INSPEKTORAT DAERAH</h2>
                        <p style="font-family: Arial; color: black; font-size: 12px; margin: 0;">
                            Jalan Prof. Moh Yamin, SH, Selong | Fax: (0376) 2923429 | Tlp: (0370) 2921235 - 2523255
                        </p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="d-flex justify-content-center mb-4">
            <h4>FORMULIR TEMUAN LHP "{{ $lhp->judul }}"</h4>
            <h5>INSPEKTORAT DAERAH KABUPATEN LOMBOK TIMUR</h5>
        </div>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Temuan</th>
                    <th class="text-center">Pokok Temuan</th>
                    <th class="text-center">Sub Pokok Temuan</th>
                    <th class="text-center">Penyebab</th>
                    <th class="text-center">Pokok Penyebab</th>
                    <th class="text-center">Sub Pokok Penyebab</th>
                    <th class="text-center">Rekomendasi</th>
                    <th class="text-center">Pokok Rekomendasi</th>
                    <th class="text-center">Sub Pokok Rekomendasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($temuans as $temuan)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{!! $temuan->temuan ?? '-' !!}</td>
                        <td>
                            {{ $temuan->pokokTemuan->pokok_temuan ?? '-' }}<br>
                            <b>Kode:
                                1.{{ $temuan->pokokTemuan->no_pokok ?? '-' }}.{{ $temuan->pokokTemuan->no_subpokok ?? '-' }}</b>
                        </td>
                        <td>{{ $temuan->pokokTemuan->sub_pokok_temuan ?? '-' }}</td>
                        <td>{!! $temuan->penyebabs->penyebab ?? '-' !!}</td>
                        <td>
                            {{ $temuan->penyebabs->pokokPenyebab->pokok_penyebab ?? '-' }}<br>
                            <b>Kode:
                                2.{{ $temuan->penyebabs->pokokPenyebab->no_pokok ?? '-' }}.{{ $temuan->penyebabs->pokokPenyebab->no_subpokok ?? '-' }}</b>
                        </td>
                        <td>{{ $temuan->penyebabs->pokokPenyebab->sub_pokok_penyebab ?? '-' }}</td>
                        <td>
                            {!! $temuan->rekomendasis->rekomendasi ?? '-' !!}<br>
                            Kerugian: {{ $temuan->rekomendasis->kerugian ?? '-' }}<br>
                            Kewajiban: {{ $temuan->rekomendasis->kewajiban ?? '-' }}
                        </td>
                        <td>
                            {{ $temuan->rekomendasis->pokokRekomendasi->pokok_rekomendasi ?? '-' }}<br>
                            <b>Kode:
                                3.{{ $temuan->rekomendasis->pokokRekomendasi->no_pokok ?? '-' }}.{{ $temuan->rekomendasis->pokokRekomendasi->no_subpokok ?? '-' }}</b>
                        </td>
                        <td>{{ $temuan->rekomendasis->pokokRekomendasi->sub_pokok_rekomendasi ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">Tidak Ada Data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>

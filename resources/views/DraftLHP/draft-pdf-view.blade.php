<!-- resources/views/draft-pdf-view.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Draft LHP Report</title>
    <style>
        /* Custom styles for PDF */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
        }

        .details {
            margin-bottom: 20px;
        }

        .details div {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <h1>Draft LHP Report</h1>

    <div class="details">
        <div><strong>No LHP:</strong> {{ $draft->no_lhp }}</div>
        <div><strong>Judul:</strong> {{ $draft->judul }}</div>
        <div><strong>Tanggal:</strong> {{ $draft->tanggal_lhp }}</div>
        <div><strong>Auditor:</strong> {{ $draft->auditor->auditor }}</div>
        <div><strong>Induk:</strong> {{ $draft->induk->induk }}</div>
        <div><strong>Departemen:</strong> {{ $draft->departemen->departemen }}</div>
        <div><strong>Status:</strong> {{ $draft->status }}</div>
    </div>

    @if ($draft->laporan)
        <div>
            <strong>Laporan:</strong>
            <a href="{{ asset('storage/laporan_files/' . basename($draft->laporan)) }}" target="_blank">
                {{ basename($draft->laporan) }}
            </a>
        </div>
    @else
        <p>Laporan tidak tersedia.</p>
    @endif
</body>

</html>

<?php

namespace App\Http\Controllers;

use App\Models\Draft;
use App\Models\Induk;
use App\Models\Temuan;
use App\Models\Tindak;
use App\Models\Tagihan;
use App\Models\Penyebab;
use App\Models\Pembayaran;
use App\Models\Rekomendasi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Chart Draft LHP
        $lhpData = Draft::selectRaw('YEAR(tanggal_lhp) as year, COUNT(*) as count')
            ->where('status', '!=', 'LHP Terbit') // Exclude "LHP Terbit" status
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        // Prepare the data for the chart
        $years_line = $lhpData->pluck('year');
        $counts_line = $lhpData->pluck('count');

        // Pie Chart Status LHP
        $statusCounts = Draft::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        // Prepare data for the Pie Chart (names and counts)
        $chartData = [];
        foreach ($statusCounts as $statusCount) {
            $chartData[] = [
                'name' => $statusCount->status,
                'value' => $statusCount->count,
            ];
        }

        // Bar Chart LHP
        $lhpData = Draft::selectRaw('induk_id, COUNT(*) as count')
            ->where('status', 'LHP Terbit')
            ->groupBy('induk_id')
            ->get();

        // Get the names of induks
        $indukNames = Induk::whereIn('id', $lhpData->pluck('induk_id'))->get()->pluck('induk', 'id')
            ->mapWithKeys(function ($name, $id) {
                // Limit the name to before the hyphen
                return [$id => Str::before($name, '-')];
            });

        // Prepare data for the bar chart
        $labels_bar = [];
        $counts_bar = [];

        foreach ($lhpData as $data) {
            $labels_bar[] = $indukNames[$data->induk_id] ?? 'Unknown';  // Get the induk name by id
            $counts_bar[] = $data->count;
        }

        // Tindak Chart
        // Get the count of Tindak Lanjut per year
        $tindakData = Tindak::selectRaw('YEAR(tanggal_tl) as year, COUNT(*) as count')
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        // Prepare the data for the line chart
        $years_tindak = $tindakData->pluck('year');  // Extract years for Tindak
        $counts_tindak = $tindakData->pluck('count'); // Extract counts for Tindak

        //radial data Tindak Lanjut
        // Fetch the data for the radial bar chart
        $tindakData = Tindak::select('status', DB::raw('count(*) as total'))
            ->whereIn('status', ['MDP', 'TLS', 'TPTD', 'TPB']) // Filter by specific statuses
            ->groupBy('status')
            ->get();


        // Pass data to the view
        return view('Dashboard.index', [
            "judul" => "Dashboard",
            "draft" => Draft::where('status', '!=', 'LHP Terbit')->count(),
            "lhp" => Draft::where('status', '=', 'LHP Terbit')->count(),
            "temuan" => Temuan::count(),
            "penyebab" => Penyebab::count(),
            "rekomendasi" => Rekomendasi::count(),
            "tindak" => Tindak::count(),
            "tagihan" => Tagihan::count(),
            "pembayaran" => Pembayaran::count(),
            "years" => $years_line,  // Pass the years data to the view
            "counts" => $counts_line, // Pass the counts data to the view
            "chartData" => $chartData,
            'indukCounts' => $counts_bar,
            'indukLabels' => $labels_bar,
            'years_tindak' => $years_tindak,
            'counts_tindak' => $counts_tindak,
            'tindakLabels' => $tindakData->pluck('status'),  // Extract labels (statuses)
            'tindakCounts' => $tindakData->pluck('total'),  // Extract values (totals)
            'tindakTotal' => $tindakData->sum('total'),     // Calculate the total for all statuses  // Pass tindak chart data

        ]);
    }


}
@extends('layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Draft LHP Card -->
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Draft LHP</h5>
                        <div class="d-flex align-items-center">
                            <div
                                class="card-icon rounded-circle d-flex align-items-center justify-content-center btn btn-outline-primary">
                                <i class="bx bx-folder"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $draft }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Draft LHP Card -->

            <!-- LHP Card -->
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">LHP</h5>
                        <div class="d-flex align-items-center">
                            <div
                                class="card-icon rounded-circle d-flex align-items-center justify-content-center btn btn-outline-success">
                                <i class="bi bi-menu-button-wide"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $lhp }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End LHP Card -->

            <!-- Example: Tindak Lanjut -->
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card ">
                    <div class="card-body">
                        <h5 class="card-title">Tindak Lanjut</h5>
                        <div class="d-flex align-items-center">
                            <div
                                class="card-icon rounded-circle d-flex align-items-center justify-content-center btn btn-outline-danger">
                                <i class="bi bi-layout-text-window-reverse"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $tindak }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Example -->

            <!-- Additional Cards -->
            <!-- Duplicate and adjust title, icons, and data as needed -->
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card ">
                    <div class="card-body">
                        <h5 class="card-title">Tagihan</h5>
                        <div class="d-flex align-items-center">
                            <div
                                class="card-icon rounded-circle d-flex align-items-center justify-content-center btn btn-outline-warning">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $tagihan }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-xl-12">

                <div class="card info-card ">

                    <div class="card-body">
                        <h5 class="card-title">Temuan</h5>

                        <div class="d-flex align-items-center">
                            <div
                                class="card-icon rounded-circle d-flex align-items-center justify-content-center btn btn-outline-secondary">
                                <i class="bx bx-archive-in"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $temuan }}</h6>
                            </div>
                        </div>

                    </div>
                </div>

            </div><!-- End Customers Card -->
            <div class="col-xxl-3 col-xl-12">

                <div class="card info-card ">

                    <div class="card-body">
                        <h5 class="card-title">Penyebab</h5>

                        <div class="d-flex align-items-center">
                            <div
                                class="card-icon rounded-circle d-flex align-items-center justify-content-center btn btn-outline-dark">
                                <i class="bx bx-folder-plus"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $penyebab }}</h6>
                            </div>
                        </div>

                    </div>
                </div>

            </div><!-- End Customers Card -->
            <div class="col-xxl-3 col-xl-12">

                <div class="card info-card ">

                    <div class="card-body">
                        <h5 class="card-title">Rekomendasi</h5>

                        <div class="d-flex align-items-center">
                            <div
                                class="card-icon rounded-circle d-flex align-items-center justify-content-center btn btn-outline-warning">
                                <i class="bx bx-folder-minus"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $rekomendasi }}</h6>
                            </div>
                        </div>

                    </div>
                </div>

            </div><!-- End Customers Card -->
            <div class="col-xxl-3 col-xl-12">

                <div class="card info-card ">

                    <div class="card-body">
                        <h5 class="card-title">Pengembalian Dana</h5>

                        <div class="d-flex align-items-center">
                            <div
                                class="card-icon rounded-circle d-flex align-items-center justify-content-center btn btn-outline-success">
                                <i class="bx bx-money-withdraw"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $pembayaran }}</h6>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div><!-- End Customers Card -->
        <div class="row">
            <!-- Reports Section -->
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Draft LHP </h5>
                        <!-- Line Chart -->
                        <div id="reportsChart"></div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#reportsChart"), {
                                    series: [{
                                        name: 'LHP Count',
                                        data: @json($counts), // Pass the counts array to the chart
                                    }],
                                    chart: {
                                        height: 470,
                                        type: 'line',
                                        toolbar: {
                                            show: false
                                        },
                                    },
                                    markers: {
                                        size: 4
                                    },
                                    colors: ['#4154f1'],
                                    fill: {
                                        type: "gradient",
                                        gradient: {
                                            shadeIntensity: 1,
                                            opacityFrom: 0.3,
                                            opacityTo: 0.4,
                                            stops: [0, 90, 100]
                                        }
                                    },
                                    dataLabels: {
                                        enabled: false
                                    },
                                    stroke: {
                                        curve: 'smooth',
                                        width: 2
                                    },
                                    xaxis: {
                                        categories: @json($years), // Pass the years array to the chart
                                    },
                                    tooltip: {
                                        x: {
                                            format: 'yyyy'
                                        },
                                    }
                                }).render();
                            });
                        </script>
                        <!-- End Line Chart -->
                    </div>
                </div>
            </div>
            <!-- End Reports Section -->

            <!-- Website Traffic Section -->
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body pb-0">
                        <h5 class="card-title">Status Draft LHP</h5>
                        <!-- Pie Chart -->
                        <div id="trafficChart" style="min-height: 500px;" class="echart"></div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const chartData = @json($chartData); // Pass the PHP data to JavaScript

                                // Prepare the Pie Chart data
                                const pieData = chartData.map(item => ({
                                    value: item.value,
                                    name: item.name,
                                }));

                                // Initialize the chart with the data
                                echarts.init(document.querySelector("#trafficChart")).setOption({
                                    tooltip: {
                                        trigger: 'item'
                                    },
                                    legend: {
                                        top: '5%',
                                        left: 'center'
                                    },
                                    series: [{
                                        name: 'Draft LHP Status',
                                        type: 'pie',
                                        radius: ['40%', '70%'],
                                        avoidLabelOverlap: false,
                                        label: {
                                            show: false,
                                            position: 'center'
                                        },
                                        emphasis: {
                                            label: {
                                                show: true,
                                                fontSize: '18',
                                                fontWeight: 'bold'
                                            }
                                        },
                                        labelLine: {
                                            show: false
                                        },
                                        data: pieData
                                    }]
                                });
                            });
                        </script>
                        <!-- End Pie Chart -->
                    </div>
                </div>
            </div>
            <!-- End Website Traffic Section -->
        </div>

        <div class="row">
            <!-- Bar Chart Section -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah LHP Per Induk</h5>
                        <!-- Bar Chart -->
                        <canvas id="barChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new Chart(document.querySelector('#barChart'), {
                                    type: 'bar',
                                    data: {
                                        labels: @json($indukLabels), // Use induk names as labels
                                        datasets: [{
                                            label: 'LHP Terbit Status by Induk',
                                            data: @json($indukCounts), // Use counts from the controller
                                            backgroundColor: [
                                                'rgba(255, 99, 132, 0.2)',
                                                'rgba(255, 159, 64, 0.2)',
                                                'rgba(255, 205, 86, 0.2)',
                                                'rgba(75, 192, 192, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(153, 102, 255, 0.2)',
                                                'rgba(201, 203, 207, 0.2)'
                                            ],
                                            borderColor: [
                                                'rgb(255, 99, 132)',
                                                'rgb(255, 159, 64)',
                                                'rgb(255, 205, 86)',
                                                'rgb(75, 192, 192)',
                                                'rgb(54, 162, 235)',
                                                'rgb(153, 102, 255)',
                                                'rgb(201, 203, 207)'
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            legend: {
                                                display: true,
                                                position: 'top'
                                            },
                                            tooltip: {
                                                enabled: true
                                            }
                                        },
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                            });
                        </script>
                        <!-- End Bar Chart -->
                    </div>
                </div>
            </div>

            <!-- Pie Chart Section -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pie Chart</h5>
                        <!-- Pie Chart -->
                        <canvas id="pieChart" style="min-height: 350px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new Chart(document.querySelector('#pieChart'), {
                                    type: 'pie',
                                    data: {
                                        labels: ['Temuan', 'Penybab', 'Rekomendasi', 'Tindak Lanjut'],
                                        datasets: [{
                                            label: 'Distribution',
                                            data: [{{ $temuan }}, {{ $penyebab }}, {{ $rekomendasi }},
                                                {{ $tindak }}
                                            ],
                                            backgroundColor: [
                                                'rgb(255, 99, 132)',
                                                'rgb(54, 162, 235)',
                                                'rgb(255, 205, 86)',
                                                'rgb(75, 192, 192)'
                                            ],
                                            hoverOffset: 4
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            legend: {
                                                display: true,
                                                position: 'top'
                                            },
                                            tooltip: {
                                                enabled: true
                                            }
                                        }
                                    }
                                });
                            });
                        </script>
                        <!-- End Pie Chart -->
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Tindak Lanjut</h5>

                        <!-- Line Chart -->
                        <canvas id="lineChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new Chart(document.querySelector('#lineChart'), {
                                    type: 'line',
                                    data: {
                                        labels: @json($years_tindak), // Use the years data passed from the controller
                                        datasets: [{
                                            label: 'Jumlah Tindak Lanjut per Tahun',
                                            data: @json($counts_tindak), // Use the counts data passed from the controller
                                            fill: false,
                                            borderColor: 'rgb(75, 192, 192)', // Line color
                                            tension: 0.1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                            });
                        </script>
                        <!-- End Line CHart -->

                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Radial Bar Chart</h5>

                        <!-- Radial Bar Chart -->
                        <div id="radialBarChart"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#radialBarChart"), {
                                    series: @json($tindakCounts), // Use the counts for the series
                                    chart: {
                                        height: 350,
                                        type: 'radialBar',
                                        toolbar: {
                                            show: true
                                        }
                                    },
                                    plotOptions: {
                                        radialBar: {
                                            dataLabels: {
                                                name: {
                                                    fontSize: '22px',
                                                },
                                                value: {
                                                    fontSize: '16px',
                                                },
                                                total: {
                                                    show: true,
                                                    label: 'Total',
                                                    formatter: function(w) {
                                                        // Return the overall total from backend
                                                        return @json($tindakTotal);
                                                    }
                                                }
                                            }
                                        }
                                    },
                                    labels: @json($tindakLabels), // Use the labels for the chart
                                }).render();
                            });
                        </script>

                        <!-- End Radial Bar Chart -->

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

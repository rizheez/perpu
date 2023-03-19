@extends('layouts.master')
@section('title', 'DASHBOARD')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title text-uppercase">Dashboard</h4>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-primary card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="bi bi-journal-text"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Buku</p>
                                            <h4 class="card-title">{{ $totalBuku }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-info card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="bi bi-bookmark-check-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Kategori</p>
                                            <h4 class="card-title">{{ $kategori }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-danger card-round">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="bi bi-people-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Anggota</p>
                                            <h4 class="card-title">{{ $anggota }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-secondary card-round">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="bi bi-clipboard2-data-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Total Buku Dipinjam</p>
                                            <h4 class="card-title">{{ $peminjaman }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    {{-- <h4 class="page-title">Data Statistik</h4> --}}
                    <div class="row">
                        <div class="col-md-8 ">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title"><i class="bi bi-bar-chart-line-fill"></i>
                                        Grafik Peminjaman Perbulan</div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="barChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-secondary">
                                    <div class="card-title text-white text-uppercase"><i class="bi bi-pie-chart-fill"></i>
                                        TOP 5
                                        Buku DiPinjam</div>
                                </div>
                                <div class="card-body bg-secondary">
                                    <div class="chart-container">
                                        <canvas id="pieChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('script')
    {{-- <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.1/chart.min.js"></script>

    <script>
        let pieChart = document.getElementById('pieChart').getContext('2d')
        const topBooks = {!! json_encode($top_books) !!};
        let myPieChart = new Chart(pieChart, {
            type: 'pie',
            data: {
                labels: topBooks.map(book => book.judul),
                datasets: [{
                    label: '# of Borrowings',
                    data: topBooks.map(book => book.count),
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(153, 102, 255)',

                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            color: 'white'
                        }
                    }
                }
            }

        })
    </script>
    <script>
        let barChart = document.getElementById('barChart').getContext('2d')

        let myBarChart = new Chart(barChart, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Total Buku Di Pinjam',
                    data: {!! json_encode($data) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 155, 0.2)',
                        'rgba(241, 13, 107, 0.2)',
                        'rgba(101, 103, 57, 0.2)',
                        'rgba(221, 103, 207, 0.2)',
                        'rgba(101, 203, 107, 0.2)',
                        'rgba(101, 103, 67, 0.2)',
                        'rgba(201, 103, 107, 0.2)',
                    ],
                    borderColor: [
                        'rgb(255, 159, 64)',
                        'rgb(255, 99, 132)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 155)',
                        'rgb(241, 13, 107)',
                        'rgb(101, 103, 57)',
                        'rgb(221, 103, 207)',
                        'rgb(101, 203, 107)',
                        'rgb(101, 103, 67)',
                        'rgb(201, 103, 107)',
                    ],
                    borderWidth: 1
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            precision: 0
                        }
                    },
                }
            }
        });

        // const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        // const data = {
        //     labels: labels,
        //     datasets: [{
        //         label: 'Number of Borrowed Books',
        //         data: {!! json_encode($data) !!},
        //         backgroundColor: 'rgba(54, 162, 235, 0.2)',
        //         borderColor: 'rgb(54, 162, 235)',
        //         borderWidth: 1
        //     }]
        // };

        // const config = {
        //     type: 'bar',
        //     data: data,
        //     options: {
        //         responsive: true,
        //         maintainAspectRatio: false,
        //         scales: {
        //             y: {
        //                 beginAtZero: true
        //             }
        //         }
        //     }
        // };

        // var myChart = new Chart(
        //     document.getElementById('myChart'),
        //     config
        // );
    </script>
@endpush

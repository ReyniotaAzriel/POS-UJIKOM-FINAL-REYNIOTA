@extends('layouts.pemilik')

@section('content')
    <div class="container mt-5">
        <h2>Dashboard</h2>

        <div class="row">
            <div class="col-md-6">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h4>Total Pemasukan</h4>
                        <h2>Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h4>Total Pengeluaran</h4>
                        <h2>Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mt-4">Grafik Pemasukan dan Pengeluaran</h3>
        <canvas id="chartLaporan"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('chartLaporan').getContext('2d');
        var chartLaporan = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($penjualanPerBulan->pluck('bulan')),
                datasets: [{
                        label: 'Pemasukan',
                        data: @json($penjualanPerBulan->pluck('total')),
                        borderColor: 'green',
                        fill: false
                    },
                    {
                        label: 'Pengeluaran',
                        data: @json($pembelianPerBulan->pluck('total')),
                        borderColor: 'red',
                        fill: false
                    }
                ]
            }
        });
    </script>
@endsection

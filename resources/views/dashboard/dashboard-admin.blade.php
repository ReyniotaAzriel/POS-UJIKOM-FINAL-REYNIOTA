@extends('layouts.admin')

@section('content')
    <h1>Admin Dashboard</h1>
    <p>Selamat datang, {{ Auth::user()->name }}! Anda login sebagai <strong>Admin</strong>.</p>
<div class="container">
    <h2>Dashboard Admin</h2>

    <div class="card">
        <div class="card-header">
            <h5>Grafik Penjualan</h5>
        </div>
        <div class="card-body">
            <canvas id="penjualanChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        var ctx = document.getElementById('penjualanChart').getContext('2d');
        var penjualanChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [
                    {
                        label: 'Jumlah Transaksi',
                        borderColor: 'blue',
                        backgroundColor: 'rgba(0, 0, 255, 0.1)',
                        data: []
                    },
                    {
                        label: 'Total Pendapatan',
                        borderColor: 'green',
                        backgroundColor: 'rgba(0, 255, 0, 0.1)',
                        data: []
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: { title: { display: true, text: 'Tanggal' } },
                    y: { title: { display: true, text: 'Jumlah' }, beginAtZero: true }
                }
            }
        }
        );

        function updateChart() {
            $.ajax({
                url: "/admin/penjualan/chart",
                type: "GET",
                success: function (data) {
                    if (data.message) {
                        console.log(data.message); // Debug jika data kosong
                        return;
                    }

                    var labels = [];
                    var jumlahTransaksi = [];
                    var totalPendapatan = [];

                    data.forEach(item => {
                        labels.push(item.tanggal);
                        jumlahTransaksi.push(item.jumlah_transaksi);
                        totalPendapatan.push(item.total_pendapatan);
                    });

                    penjualanChart.data.labels = labels;
                    penjualanChart.data.datasets[0].data = jumlahTransaksi;
                    penjualanChart.data.datasets[1].data = totalPendapatan;
                    penjualanChart.update();
                },
                error: function(xhr) {
                    console.error("Gagal mengambil data:", xhr.responseText);
                }
            });
        }

        updateChart();
        setInterval(updateChart, 5000); // Update setiap 5 detik
    });
</script>

@endsection

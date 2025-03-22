@extends('layouts.admin')

@section('content')
<h1>Admin Dashboard</h1>
<p>Selamat datang, {{ Auth::user()->name }}! Anda login sebagai <strong>Admin</strong>.</p>

<div class="container mt-4">
    <h2 class="mb-4">📊 Dashboard Admin</h2>

    

    <!-- Grafik Penjualan -->
    <div class="card shadow-lg mt-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">📈 Grafik Penjualan (30 Hari Terakhir)</h5>
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
        // Ambil Data Statistik
        $.ajax({
            url: "/admin/dashboard/stats",
            type: "GET",
            success: function (data) {
                $("#totalBarang").text(data.total_barang);
                $("#totalTransaksi").text(data.total_transaksi);
                $("#totalPemasok").text(data.total_pemasok);
                $("#totalUser").text(data.total_user);
            },
            error: function (xhr) {
                console.error("Gagal mengambil data statistik:", xhr.responseText);
            }
        });

        var ctx = document.getElementById('penjualanChart').getContext('2d');

        var gradientBlue = ctx.createLinearGradient(0, 0, 0, 400);
        gradientBlue.addColorStop(0, 'rgba(0, 123, 255, 0.4)');
        gradientBlue.addColorStop(1, 'rgba(0, 123, 255, 0.1)');

        var gradientGreen = ctx.createLinearGradient(0, 0, 0, 400);
        gradientGreen.addColorStop(0, 'rgba(40, 167, 69, 0.4)');
        gradientGreen.addColorStop(1, 'rgba(40, 167, 69, 0.1)');

        var penjualanChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [
                    {
                        label: '📅 Jumlah Transaksi',
                        borderColor: '#007bff',
                        backgroundColor: gradientBlue,
                        borderWidth: 3,
                        pointRadius: 5,
                        pointHoverRadius: 8,
                        pointBackgroundColor: '#007bff',
                        pointBorderColor: '#fff',
                        tension: 0.4,
                        data: [],
                        yAxisID: 'y_transaksi'
                    },
                    {
                        label: '💰 Total Pendapatan',
                        borderColor: '#28a745',
                        backgroundColor: gradientGreen,
                        borderWidth: 3,
                        pointRadius: 5,
                        pointHoverRadius: 8,
                        pointBackgroundColor: '#28a745',
                        pointBorderColor: '#fff',
                        tension: 0.4,
                        data: [],
                        yAxisID: 'y_pendapatan'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        title: { display: true, text: '📆 Tanggal', color: '#555', font: { size: 14 } },
                        grid: { display: false }
                    },
                    y_transaksi: {
                        title: { display: true, text: '🛒 Jumlah Transaksi', color: '#007bff', font: { size: 14 } },
                        beginAtZero: true,
                        position: 'left',
                        ticks: { stepSize: 1 }
                    },
                    y_pendapatan: {
                        title: { display: true, text: '💵 Total Pendapatan', color: '#28a745', font: { size: 14 } },
                        beginAtZero: true,
                        position: 'right'
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            font: { size: 14, weight: 'bold' },
                            color: '#333'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0,0,0,0.8)',
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 13 },
                        padding: 10,
                        cornerRadius: 6
                    }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeInOutQuart'
                }
            }
        });

        // Ambil data penjualan
        $.ajax({
            url: "/admin/penjualan/chart",
            type: "GET",
            success: function (data) {
                var labels = [];
                var jumlahTransaksi = [];
                var totalPendapatan = [];

                data.forEach(item => {
                    labels.push(item.tanggal);
                    jumlahTransaksi.push(item.jumlah_transaksi || 0);
                    totalPendapatan.push(item.total_pendapatan || 0);
                });

                penjualanChart.data.labels = labels;
                penjualanChart.data.datasets[0].data = jumlahTransaksi;
                penjualanChart.data.datasets[1].data = totalPendapatan;
                penjualanChart.update();
            },
            error: function (xhr) {
                console.error("Gagal mengambil data:", xhr.responseText);
            }
        });
    });
</script>

@endsection

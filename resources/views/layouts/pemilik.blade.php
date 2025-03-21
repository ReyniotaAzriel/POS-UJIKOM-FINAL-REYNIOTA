<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - POS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        /* Sidebar Styling */
        #sidebar {
            height: 100vh;
            position: fixed;
            width: 250px;
            background: #ffffff;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        #sidebar .nav-link {
            color: #333;
            font-weight: 500;
            padding: 12px 15px;
            transition: 0.3s;
        }

        #sidebar .nav-link:hover {
            background: #007bff;
            color: #ffffff;
            border-radius: 5px;
        }

        /* Navbar Styling */
        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .logout-btn {
            border-radius: 20px;
            padding: 8px 15px;
            font-weight: 600;
        }

        /* Content Section */
        main {
            margin-left: 250px;
            padding: 20px;
        }

        @media (max-width: 768px) {
            #sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            main {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3 fixed-top">
        <a class="navbar-brand fw-bold" href="#">POS Laravel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </nav>


    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="position-sticky py-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pemilik.dashboard') }}">
                                <i class="fas fa-box me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('laporan.barang') }}">
                                <i class="fas fa-box me-2"></i> Laporan Barang
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('laporan.kategori') }}">
                                <i class="fas fa-box me-2"></i> Laporan Kategori
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('laporan.pemasok') }}">
                                <i class="fas fa-box me-2"></i> Laporan Pemasok
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('laporan.pelanggan') }}">
                                <i class="fas fa-box me-2"></i> Laporan Pelanggan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('laporan.penjualan') }}">
                                <i class="fas fa-box me-2"></i> Laporan Penjualan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('laporan.pembelian') }}">
                                <i class="fas fa-box me-2"></i> Laporan Pembelian
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Konten Utama -->
            <main class="col-md-9 ms-sm-auto col-lg-10 p-5">
                @yield('content')
            </main>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

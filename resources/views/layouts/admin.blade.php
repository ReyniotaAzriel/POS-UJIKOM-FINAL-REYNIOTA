<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Prime Market</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>

    <style>
        /* Styling Sidebar */
        #sidebar {
            height: 100vh;
            background: #343a40;
            color: white;
            padding-top: 20px;
        }

        #sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease-in-out;
            padding: 10px 15px;
        }

        #sidebar .nav-link:hover {
            background: #495057;
            color: white;
            border-radius: 5px;
        }

        #sidebar .nav-link.active {
            background: #007bff;
            color: white;
            border-radius: 5px;
        }

        #sidebar i {
            margin-right: 10px;
        }

        /* Styling Navbar */
        .navbar {
            background: #007bff;
        }

        .navbar-brand {
            font-weight: bold;
        }

        /* Styling Main Content */
        .content {
            background: #f8f9fa;
            min-height: 100vh;
            padding: 20px;
            border-radius: 10px;
        }

        .logout-btn {
            transition: all 0.3s ease-in-out;
        }

        .logout-btn:hover {
            background: #dc3545 !important;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Prime Market</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-light logout-btn">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('dashboard') }}">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('kategori.index') }}">
                                <i class="fas fa-layer-group"></i> Kategori
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('barang.index') }}">
                                <i class="fas fa-box-open"></i> Barang
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pemasok.index') }}">
                                <i class="fas fa-truck"></i> Pemasok
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pembelian.index') }}">
                                <i class="fas fa-shopping-cart"></i> Pembelian
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pelanggan.index') }}">
                                <i class="fas fa-users"></i> Pelanggan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pengajuan.index') }}">
                                <i class="fas fa-file-alt"></i> Pengajuan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('daftar-pengajuan.index') }}">
                                <i class="fas fa-clipboard-list"></i> Daftar Pengajuan
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Konten Utama -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <div class="content shadow">
                    @yield('content')
                </div>
            </main>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

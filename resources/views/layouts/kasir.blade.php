<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime Market</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
        }

        /* Sidebar Styling */
        #sidebar {
            height: 100vh;
            position: fixed;
            width: 250px;
            background: #343a40;
            color: white;
            transition: all 0.3s ease-in-out;
        }

        #sidebar .nav-link {
            color: white;
            font-size: 16px;
            padding: 15px 20px;
            transition: 0.3s;
        }

        #sidebar .nav-link:hover {
            background: #007bff;
            color: white;
            border-radius: 5px;
        }

        #sidebar .nav-link.active {
            background: #007bff;
            font-weight: bold;
        }

        /* Navbar Styling */
        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background: #007bff !important;
        }

        .navbar-brand {
            font-weight: bold;
            letter-spacing: 1px;
        }

        .logout-btn {
            border-radius: 20px;
            padding: 8px 15px;
            font-weight: 600;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background: #dc3545;
        }

        /* Content Section */
        main {
            margin-left: 250px;
            padding: 30px;
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

        /* Animasi Hover */
        .nav-link i {
            margin-right: 10px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark px-3">
        <a class="navbar-brand" href="#">Prime Market</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-light logout-btn">
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
                            <a class="nav-link active" href="{{ route('penjualan.index') }}">
                                <i class="fas fa-shopping-cart"></i> Penjualan
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </nav>

            <!-- Konten Utama -->
            <main class="col-md-9 ms-sm-auto col-lg-10">
                @yield('content')
            </main>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

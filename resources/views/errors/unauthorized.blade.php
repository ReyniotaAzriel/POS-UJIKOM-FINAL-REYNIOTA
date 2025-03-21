<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Unauthorized</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="text-center">
        <h1 class="text-6xl font-bold text-red-500">403</h1>
        <h2 class="text-2xl font-semibold text-gray-800 mt-2">Akses Ditolak</h2>
        <p class="text-gray-600 mt-2">Anda tidak memiliki izin untuk mengakses halaman ini.</p>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="mt-4 inline-block px-6 py-3 text-white bg-blue-500 rounded-lg hover:bg-blue-600">Tekan ini untuk
                kembali</button>
        </form>
    </div>
</body>

</html>

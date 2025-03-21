<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengajuan</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Data Pengajuan Barang</h2>
    <table>
        <thead>
            <tr>
                <th>Pelanggan</th>
                <th>Nama Barang</th>
                <th>Tanggal Pengajuan</th>
                <th>Qty</th>
                <th>Terpenuhi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengajuan as $p)
                <tr>
                    <td>{{ $p->pelanggan->nama }}</td>
                    <td>{{ $p->barang ? $p->barang->nama_barang : $p->nama_barang }}</td>
                    <td>{{ $p->tanggal_pengajuan }}</td>
                    <td>{{ $p->qty }}</td>
                    <td>{{ $p->terpenuhi ? 'Ya' : 'Tidak' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

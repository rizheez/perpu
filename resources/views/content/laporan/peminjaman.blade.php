<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .th {
            font-size: 15px;
        }

        .td {
            font-size: 12px;
        }

        /* @media print {
            @page {
                size: A4 landscape;
                margin: 0;
            }

            body {
                margin: 1.6cm;
            }
        }

        table {
            margin: 0 auto;
            padding: 20px;
            width: 100%;
            max-width: 600px;
        } */
    </style>
</head>

<body>

    <div class="text-center">
        <h1 class="mb-4">Laporan Peminjaman dan Pengembalian Buku</h1>
        <h3>Bulan {{ Illuminate\Support\Carbon::createFromFormat('m', $bulan)->isoFormat('MMMM') }} Tahun
            {{ Illuminate\Support\Carbon::createFromFormat('Y', $tahun)->isoFormat('Y') }}</h3>
    </div>
    <table class="table table-bordered table-striped mt-4">
        <thead class="bg-success text-white">
            <tr>
                <th scope="col">
                    No.</th>
                <th scope="col">Nama Peminjam</th>
                <th scope="col">Judul Buku</th>
                <th scope="col">Tanggal Pinjam</th>
                <th scope="col">Tanggal Kembali</th>
                <th scope="col">Denda</th>
                <th scope="col">Petugas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $key => $p)
                <tr>
                    <td scope="row">{{ $key + 1 }}</td>
                    <td scope="row">{{ $p->anggota->nama }}</td>
                    <td scope="row">{{ $p->buku->judul }}</td>
                    <td scope="row">
                        {{ Illuminate\Support\Carbon::createFromFormat('Y-m-d', $p->tanggal_peminjaman)->isoFormat('D MMMM Y') }}
                    </td>
                    <td scope="row">
                        {{ Illuminate\Support\Carbon::createFromFormat('Y-m-d', $p->tanggal_pengembalian)->isoFormat('D MMMM Y') }}
                    </td>
                    <td scope="row">Rp.{{ $p->denda }}</td>
                    <td scope="row">{{ $p->petugas->nama }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

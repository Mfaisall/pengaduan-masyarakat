<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Data Pengaduan</title>
</head>
<body>

    <table>
        <tr>
            <th>N0</th>
            <th>Nik</th>
            <th>Nama</th>
            <th>No Telp</th>
            <th>Pengaduan</th>
            <th>Gambar</th>
        </tr>
        @php
         $no = 1; 
        @endphp
        @foreach($data as $item)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $item['nik'] }}</td>
            <td>{{ $item['nama_lengkap'] }}</td>
            <td>{{ $item['no_telp'] }}</td>
            <td>{{ \Carbon\Carbon::parse($item['created_at'])->format('j F, Y') }}</td></td>
            <td>{{ $item['pengaduan'] }}</td>
            <td><img src="assets/image/{{ $item['foto'] }}" width="80"</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
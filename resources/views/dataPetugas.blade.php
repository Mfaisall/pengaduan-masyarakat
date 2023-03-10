<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>
    <h1 style="text-align: center;">Laporan Keluhan</h1>

    <div class="buttons" style="text-align: center">
        <a class="button button1" href="/logout">Logout</a>||
        <a class="button button2" href="/">Home</a>
        <p style="color: black">{{ Auth::User()->nama_lengkap }}</p>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session('logSucces'))
        <script>
            swal({
                title: "",
                text: "Berhasil Login!",
                icon: "success",
            });
        </script>
    @endif
    @if (session('responsesSucces'))
        <script>
            swal({
                title: "",
                text: "Berhasil Login!",
                icon: "success",
            });
        </script>
    @endif
    @if (session('SuccesDel'))
        <script>
            swal({
                title: "",
                text: "Berhasil Menghapus Data!",
                icon: "success",
            });
        </script>
    @endif
    @if (session('cari'))
        <script>
            swal({
                title: "",
                text: "Berhasil mencari data!",
                icon: "success",
            });
        </script>
    @endif

    <div style="display: flex; justify-content: flex-end; align-items:center; position:relative; top:50px;">
        {{-- menggunakan merhod get karna route untuk masuke ke halam data ini menggunakan ::get --}}
        <form action="" method="GET">
            @csrf
            <input type="search" name="search" placeholder="cari Berdasarkan Nama ....">
            <button type="submit" class="btn-login">Cari</button>
        </form>
    </div>

    {{-- refresh balik data karna nanti pas di klik refresh untuk bersihin riwayat pencarian sevelumnya dan balikian lagi ke 
        halaman dashboard lagi --}}
    <a href="{{ route('data.Petugas') }}"
        style="margin-left: 10px margin-top:-2px; position: relative; top:33px; text-decoration:none">Refresh</a>

    <br></br>
    <br></br>

    <table class="table1">
        <tr>
            <th>No</th>
            <th>Nik</th>
            <th>Nama</th>
            <th>Nomor Telepon</th>
            <th>Pengaduan</th>
            <th>Gambar</th>
            <th>Status Respon</th>
            <th>Pesan Respon</th>
            <th>Action</th>
        </tr>

        @php
            $no = 1;
        @endphp

        @foreach ($data as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->nik }}</td>
                <td>{{ $item->nama_lengkap }}</td>
                <td>{{ $item->no_telp }}</td>
                <td class="card-text">{{ $item->pengaduan }}</td>
                <td> <img src="{{ asset('assets/image/' . $item->foto) }}" width="80"</td>
                <td>
                    {{-- cek apakah data report ini sudah memiliki relasi dengan data dari with('respon') --}}
                    @if ($item->respon)
                        {{-- kalau ada hasil relasinya tampilkan bagian status  --}}
                        {{ $item->respon['status'] }}
                    @else
                        {{-- kalau gaada tampilakn tanda ini  --}}
                        -
                    @endif
                </td>
                <td>
                    {{-- cek apakah data report ini sudah memiliki relasi dengan data dari with('respon') --}}
                    @if ($item->respon)
                        {{-- kalau ada hasil relasinya tampilkan bagian status  --}}
                        {{ $item->respon['pesan'] }}
                    @else
                        {{-- kalau gaada tampilakn tanda ini  --}}
                        -
                    @endif
                </td>
                <td style="display: flex; justify-content:center;">
                    {{-- kirim data id dari foreach report ke path dinamis punya nya route respons.edit --}}
                    <a href="{{ route('respon.edit', $item->id) }}" class="back-btn">Send Respon</a>
                </td>
            </tr>
        @endforeach
    </table>
</body>

</html>

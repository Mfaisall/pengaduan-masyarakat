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
        <a class="button button2" href="{{ route('index') }}">Home</a>
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
    <a href="{{ route('dashboard.admin') }}"
        style="margin-left: 10px margin-top:-2px; position: relative; top:33px; text-decoration:none">Refresh</a>
    <a href="{{ route('export.all') }}" style="text-decoration:none; position:relative; top:33px; left:20px;">Export to PDF</a>
    <a href="{{ route('export.excel') }}" style="text-decoration: none; position:relative; top:33px; left:30px;" >Export to
        Excel</a>

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
                @php
                    // substr_replace : mengubah karakter string
                    // punya 3 argumen arfumen ke -1 data yang mau dimasukan ke string
                    // argumen ke-2 mulai dari index mana ubahnya
                    // argumen ke-3 sampai index mana diubahnya
                    
                    $telp = substr_replace($item->no_telp, '62', 0, 1);
                @endphp
              
                {{-- yang ditampilkan tag a dengan $telp (data no_telp yang udah diubah jadi 628) --}}
                {{-- %20 fungsinya untuk mengasih space atau spasi  --}}
                  @php
                  if ($item->respon) {
                      $pesanWA = 'Hallo' . $item->nama . '!Pengaduan Anda di' . $item->respon['status'] . '.Berikut Pesan Untuk Anda: ' . $item->respon['pesan'];
                    # code...
                  }
                  else {
                    # code...
                    $pesanWA ='Belum Ada Data Respon!';
                  }
                @endphp
                <td><a href="https:wa.me/{{ $telp }}?text={{ $pesanWA }}"
                        target="_blank">{{ $telp }}</a> </td>
                <td class="card-text">{{ $item->pengaduan }}</td>
                {{-- menampilkan gambar full layar di tab baru  --}}
                <td> <a href="../assets/image/{{ $item->foto }}" target="_blank"><img
                            src="{{ asset('assets/image/' . $item->foto) }}" width="80"></a></td>
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
                <td class="lain">
                    <form action="{{ route('delete', $item->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit">DELETE</button>
                    </form>
                    <br>
                    <form action="{{ route('export-pdf.storeDetail', $item->id) }}" method="get">
                        <button type="submit">Print</button>
                    </form>
                    {{-- <a href="{{ route('export.pdf', $item->id) }}" methode="get" style="text-decoration: none">Export to PDF</a>    --}}
                </td>
            </tr>
        @endforeach
    </table>
</body>

</html>

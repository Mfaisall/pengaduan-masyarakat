<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>
    <h1 style="text-align: center;">Laporan Keluhan</h1>

    <div class="buttons" style="text-align: center">
        <a class="button button1" href="/logout">Logout</a>
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
			<th>Action</th>
		</tr>

        @php
        $no=1;   
        @endphp

        @foreach($data as $item)

		<tr>
			<td>{{ $no++ }}</td>
			<td>{{ $item->nik }}</td>
			<td>{{ $item->nama_lengkap }}</td>
			<td>{{ $item->no_telp }}</td>
			<td class="card-text">{{ $item->pengaduan }}</td>
			<td> <img src="{{ asset('assets/image/' . $item->foto) }}" width="80"</td>
			<td>
                <form action="{{ route('delete', $item->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit">DELETE</button>
                </form>
            </td>
		</tr>
		@endforeach
	</table>	
</body>

</html>
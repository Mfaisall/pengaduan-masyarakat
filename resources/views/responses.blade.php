<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href={{ asset('assets/css/style.css') }}>
</head>

<body>
    <form action="{{ route('respon.update', $pengaduanId) }}" method="POST"
        style="width: 500px; margin:5px auto; display:block;">
        @csrf
        @method('PATCH')
        <div class="input-card">
            <label for="status">Status :</label>
            <select name="status" id="status">
         @if ($pengaduan)
                    <option value="ditolak" {{ $pengaduan['status'] == 'ditolak' ? 'selected' : '' }}>ditolak</option>
                    <option value="proses" {{ $pengaduan['status'] == 'proses' ? 'selected' : '' }}>proses</option>
                    <option value="diterima"{{ $pengaduan['status'] == 'diterima' ? 'selected' : '' }}>diterima</option>
        @else
                <option selected hidden disabled>Pilih Status</option>
                <option value="ditolak">ditolak</option>
                <option value="proses">proses</option>
                <option value="diterima">diterima</option>
            </select>
        @endif
        </div>
        <div class="input-card">
            <label for="pesan">Pesan :</label>
            <textarea name="pesan" id="pesan" rows="3">{{ $pengaduan ? $pengaduan['pesan'] : '' }}</textarea>
        </div>
        <button type="submit" class="buttonkirim">kirim Responses</button>
    </form>
</body>

</html>

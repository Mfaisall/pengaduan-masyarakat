<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>

</head>

<body>


    @if ($errors->any())
        {{-- <div class="alert alert-danger"> --}}
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
    @endif


    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session('succesAdd'))
        <script>
            swal({
                title: "",
                text: "Berhasil Menambah Data!",
                icon: "success",
            });
        </script>
    @endif
    @if (session('succeslog'))
    <script>
        swal({
            title: "",
            text: "Berhasil Logout!",
            icon: "success",
        });
    </script>
@endif



    <section class="baris">
        <a href="/login" class="button1">Administrator</a>
        <div class="kolom kolom1">
            <ol>
                <h2>Pengaduan Masyarakat</h2>
                <li>lorem ipsum, ur dolor sit amet consectet adispisicing elti</li>
                <li>lorem ipsum, ur dolor sit amet consectet adispisicing elti</li>
                <li>lorem ipsum, ur dolor sit amet consectet adispisicing elti</li>
                <li>Lorem ipsum dolor sit amet</li>
            </ol>
        </div>
        <div class="kolom kolom2"><img src="assets/image/foto.png"></div>
    </section>

    <section class="flex-containere">
        <div class="items">Jumlah Kecamatan <br> 15</div>
        <div class="items">Jumlah Desa <br> 42</div>
        <div class="items">Jumlah Penduduk <br> 12.000</div>
        <div class="items">Data per Tahun <br> 2023</div>
    </section>

    <section class="form-container">
        <div class="card form-card">
            <form action="/tambah-data" method="POST" enctype="multipart/form-data">
                @csrf
                <h2 style="text-align: center;">Buat Pengaduan</h2>
                <div class="input-card">
                    <label>Nik :</label>
                    <input type="text" class="form-control" name="nik" id="nik" placeholder="NIK">
                </div>
                <div class="input-card">
                    <label>Nama Lengkap :</label>
                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap"
                        placeholder="Nama Lengkap">
                </div>
                <div class="input-card">
                    <label>Nomor Telepon :</label>
                    <input type="numeric" class="form-control" name="no_telp" id="no_telp" placeholder="No Tlp"
                        autocomplete="off">
                </div>
                <div class="input-card">
                    <label>Pengaduan :</label>
                    <textarea rows="10" class="form-control" name="pengaduan" id="pengaduan" placeholder="Pengaduan"></textarea>
                </div>
                <div class="input-card">
                    <label>Upload Gambar Terkait :</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                </div>
                <button>Kirim</button>
            </form>
        </div>

        <h3 style="text-align:center;">Laporan Pengaduan</h3>


        @foreach($datas as $items)

        <div class="card laporan-card">
            <div class="article">
                <p>{{ now()}} | {{ $items->nama_lengkap }}</p>
                <div class="content">
                    <div class="text">
                        {{ $items->pengaduan }}
                    </div>
                    <div>
                        <img src="{{ asset('assets/image/'. $items->foto) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach

    <br></br>

    <footer class="footerr">
        Copyright & Copy; Faisal 2023
    </footer>
</body>

</html>

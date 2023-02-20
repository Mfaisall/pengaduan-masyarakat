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

    {{-- untuk menapilkan error validasi  --}}


    {{-- @if (Session::get('gagal'))
        <div style="width: 100%; background: green; padding: 10px;">
            {{ Session::get('gagal') }}
        </div>
    @endif --}}

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
    @if (session('berhasil'))
        <script>
            swal({
                title: "",
                text: "Berhasil Logout!",
                icon: "success",
            });
        </script>
    @endif
    @if (session('gagal'))
    <script>
        swal({
            title: "",
            text: "Silahkan Login Terlebih Dahulu!",
            icon: "error",
        });
    </script>
@endif

<header>
    @if(Auth::check())
    <a href="{{ route('dashboard') }}"  class="button1">Lihat Data</a>
    @else
    <a href="{{ route('login') }}" class="button1">Administrator</a>
    @endif


</header>



    <section class="baris">
        {{-- <a href="/login" class="button1">Administrator</a> --}}
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

                @if ($errors->any())
                    <ul style="width: 100%; background:red; padding:10px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
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


        @foreach ($datas as $items)
            <div class="card laporan-card">
                <div class="article">
                    <p>{{ \Carbon\Carbon::parse($items->created_at)->format('j F, Y') }}| {{ $items->nama_lengkap }}</p>
                    <div class="content">
                        <div class="text">
                            {{ $items->pengaduan }}
                        </div>
                        <div>
                            <img src="{{ asset('assets/image/' . $items->foto) }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div style="display: flex; justify-content: flex-end; margin-top: 75vh; posisition:relative;">
            {!! $datas->links() !!}
        </div>

    </section>




    <br></br>

    <footer class="footerr">
        Copyright & Copy; Faisal 2023
    </footer>
</body>

</html>

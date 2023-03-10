<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use PDF;

use App\Exports\PengaduansExport;
use Excel;
use App\Models\Respon;


class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //untuk menampilkan halam landingpage
        // orderBy untuk urutkan data 
        //pigination utnuk menmpilakn kolom yang bisa di next
        $datas = Pengaduan::orderBy('created_at', 'DESC')->simplePaginate(2);
        return view('landingPage', compact('datas'));
    }

    public function login(){
        //untuk menampilkan halam login
        return view('login');
    }

    // request $request ditambhakan karena pada halam data ada fitur search nya dan mengabil teks yang di input search 
    public function dashboardAdmin(Request $request){
        // ambil data yang diinput ke input name nya search
        $search = $request->search;
        //where akan mencari data berdasarkan colum nama 
        // data yang diambil meruapakan data yang 'LIKE' (terdapat) teks yang dimasukin ke input search 
        // contoh L ngisi input search dengan 'fem'
        // nyari ke db yang coloum nama nya ada isi fem nya
        $data = Pengaduan::with('respon')->where('nama_lengkap', 'Like', '%' . $search . '%')->orderBy('created_at', 'DESC')->get();
          // untuk mengurutkan data yang terbaru itu menggunakan orderby 
        // compact untuk mengkirim data ke file blade
        //untuk menampilkan halam dahboard admin
        return view('dashboardAdmin', compact('data'))->with('cari', "berhasil mencari data");
    }

    public function dataPetugas(Request $request){
      // with :: ambil relasi (nama fungsi hasOne/hasMany/belongTo di Modelnya), diambil data dari relasi itu 
      $search = $request->search;
      $data = Pengaduan::with('respon')->where('nama_lengkap', 'Like', '%' . $search . '%')->orderBy('created_at', 'DESC')->get();
      return view('dataPetugas', compact('data'))->with('cari', "berhasil mencari data");
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //request untuk mengabil data dari inputan 
    public function store(Request $request)
    {
        // untuk validate data agar data yang di isi tisak asal-asalan
        $request->validate([
            'nik' => 'required',
            'nama_lengkap' => 'required',
            'no_telp' => 'required',
            'pengaduan' => 'required',
            'foto' => 'required|image|mimes:jpeg,jpg,png,svg',
        ]);

        // upload gambar ke public
        //ambil file yang siupload di input yang name nya foto
        $image = $request->file('foto');
        // ubah nama file jadi random.extensi
        $imgName = rand() . '.' . $image->extension(); // 
        // panggil folder tempat simpen gambarnya 
        $path = public_path('assets/image/');
        // pindahin gambar yang di upload dan udah di rename ke folder tadi 
        $image->move($path, $imgName);

        // dd($request->all());
        Pengaduan::create([
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'no_telp' => $request->no_telp,
            'pengaduan' => $request->pengaduan,
            'foto' => $imgName,
        ]);

        return redirect('')->with('succesAdd', "Berhasil Menambah Data Pengaduan Baru!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function auth(Pengaduan $pengaduan ,Request $request)
    {
        $request->validate([
            'email' => 'required|email|:dns',
            'password' => 'required|min:4',
          ]);
    
          // dd($request->all());
        // ambil input bagian email dan password 
          $user = $request->only('email', 'password');
          // simpandata tersebut ke fitur auth sebagai indentitas
          if (Auth::attempt($user)){
            //nesting id id bersarang if dalam if 
            //kalau data login uda masuk ke fitur auth di cek lagi pake if else 
            // kalau data auth tersebut role nya admin maka masuk ke route data 
            //kalau data auth role nya petugas maka masuk ke route data.petugas
            if (Auth::user()->role == 'admin'){
              return redirect()->route('dashboard.admin')->with('logSucces', "Berhasil Login Ke Halaman!");
            }elseif(Auth::user()->role == 'petugas'){
              return redirect()->route('data.Petugas')->with('LOGBerhasil', 'Berhasil Login Ke Halaman!');
            }
          }else{
            return redirect()->back()->with('errors', "Gagal Login!");
          }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        // $image::find($request->id);
        // hapus data foto dari folder public : path nama foto nya 
        //nama foto yang diambil dari $data yang diatas terus mengambil dari colum fot
        // cari data yang dimaksud 
        $data= Pengaduan::where('id', $id)->firstOrFail();
         // untuk memfilter data mana yang akan di ambil untuk di delete
      
         //untuk mengahups data image nya 
        unlink('assets/image/'. $data->foto);

        //untuk menghapus semua dari database nya 
        $data->delete();
          // untuk mengarahkan ke mana route setelah delete
          Respon::where('pengaduan_id', $id)->delete();
        return redirect()->back()->with('SuccesDel', "Berhasil Menghapus Data ");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {
        //
    }

    public function logout(){
        Auth::logout();
        return redirect('/login')->with('berhasil', "Berhasil Logout");
    }


    public function createPDF($id) { 
      // ambil data yg akan ditampilkan pada pdf, bisa juga dengan where atau eloquent lainnya dan jangan gunakan pagination
      // untuk memfilter data data mana yang akan di ambil untuk di print 
      $data = Pengaduan::with('respon')->where('id', $id)->get()->toArray(); 
      // kirim data yg diambil kepada view yg akan ditampilkan, kirim dengan inisial 
      view()->share('inisial',$data); 
      // panggil view blade yg akan dicetak pdf serta data yg akan digunakan
      $pdf = PDF::loadView('print', compact('data'))->setPaper('a4', 'landscape'); 
      // download PDF file dengan nama tertentu
         return $pdf->download('pdf_print_id.pdf'); 
}

public function printAll(){
  $data = Pengaduan::with('respon')->get()->toArray(); 
  // kirim data yg diambil kepada view yg akan ditampilkan, kirim dengan inisial 
  view()->share('inisial',$data); 
  // panggil view blade yg akan dicetak pdf serta data yg akan digunakan
  $pdf = PDF::loadView('print', compact('data'))->setPaper('a4', 'landscape'); 
  // download PDF file dengan nama tertentu
     return $pdf->download('pdf_print_all.pdf'); 
}

public function exportExcel()
{ 
$file_name = 'data_keseluruhan_pengaduan.xlsx'; 
return Excel::download(new PengaduansExport, $file_name); 
}




      
    
   
}

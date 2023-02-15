<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $datas = Pengaduan::all();
        return view('landingPage', compact('datas'));
    }

    public function login(){
        //untuk menampilkan halam login
        return view('login');
    }

    public function dashboardAdmin(){
        $data = Pengaduan::all();
        // compact untuk mengkirim data ke file blade
        //untuk menampilkan halam dahboard admin
        return view('dashboardAdmin', compact('data'));
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
        $imgName = rand() . '.' . $image->extension();
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

        return redirect('')->with('succesAdd', "Berhasil Menambah Data");
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
    
        //   dd($request->all());
        // ambil input bagian email dan password 
          $user = $request->only('email', 'password');
          // simpandata tersebut ke fitur auth sebagai indentitas
          if (Auth::attempt($user)){
            return redirect()->route('dashboard')->with('logSucces', "Berhasil Login!");
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
    public function delete(Pengaduan $pengaduan, $id)
    {
        // untuk memfilter data mana yang akan di ambil untuk di delete
        Pengaduan::where('id', $id)->delete();
        // untuk mengarahkan ke mana route setelah delete
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
        return redirect('/')->with('succeslog', "Berhasil Logout");
    }
    
   
}

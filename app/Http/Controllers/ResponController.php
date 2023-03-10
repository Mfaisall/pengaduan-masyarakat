<?php

namespace App\Http\Controllers;

use App\Models\Respon;
use Illuminate\Database\Console\Migrations\StatusCommand;
use Illuminate\Http\Request;

class ResponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Respon  $respon
     * @return \Illuminate\Http\Response
     */
    public function show(Respon $respon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Respon  $respon
     * @return \Illuminate\Http\Response
     */
    public function edit($pengaduan_id)
    {
        // ambil data response yang bakal dimunculin data yang di ambil data response yang report_id nya sama kaya $pengaduan_id dari path dinamis {pengaduan_id}
        //kalau ada datanya dia,il sati / first()
        // kenapa ga pake firstorFail() karena nanti bakal munculin not found view, kalau pake first() view nya ttp bakal ditampilin 
        $pengaduan = Respon::where('pengaduan_id', $pengaduan_id)->first();
        // karena mau kirim data {pengaduan_id} buat di route updatenya jadi biar bisa dipake di blade kita simpen data path dinamis $pengaduan_id nya ke variabel baru yang bakal di compact dan dipanggil diblade nya 
        $pengaduanId = $pengaduan_id;
        return view('responses', compact('pengaduan', 'pengaduanId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Respon  $respon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pengaduan_id)
    {
        $request->validate([
            'status' => 'required',
            'pesan' => 'required',
        ]);

        // updateOrCreate() fungsinya untuk melakukan update data kalo emang di db responya udaada data yang punya pengaduan_id sama dengan $pengaduan_id dari path dinamis, kalau gada data itu maka di create 
        // array pertama acuan cari datanya 
        // array ke dua data yang dikirm 
        // kenapa ppake updateOrCreate karena response ini kn kalo tandanya gada mau ditambahin tapi kalao ada mau diupdate juga 
        Respon::updateOrCreate(
            [
                'pengaduan_id' => $pengaduan_id,
            ],
            [
                'status' => $request->status,
                'pesan' => $request->pesan,
            ]
            );

            // setelah berhasail arahken ke route yang name nya data.petugas dengan pesan alert 
            return redirect()->route('data.Petugas')->with('responsesSucces', 'Berhasil Mengubah Respon');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Respon  $respon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $report_id)
    {
        
    }
}

<?php

namespace App\Exports;

use App\Models\Pengaduan;
// untuk mengabombildata dari database
use Maatwebsite\Excel\Concerns\FromCollection;
// menfatur nama nama colum header di excelnya
use Maatwebsite\Excel\Concerns\WithHeadings;
// mengatur data yang dimunculkan tiap colum di excelnya
use Maatwebsite\Excel\Concerns\WithMapping;


class PengaduansExport implements FromCollection, WithHeadings, WithMapping 
{
    /**
    * @return \Illuminate\Support\Collection
    */

    // Mengabil data dari database diambil dari FromConllection
    public function collection()
    {
        // didalam sini boleh menyertakan perintah element lain seperti where all dll
        return Pengaduan::with('respon')->orderBy('created_at', 'DESC')->get();
    }


    //untuk mengatur nama nam colum headers di excel : diambil adri withHeadings
    public function headings(): array
    {
        return[
            'ID',
            'NIK Pelapor',
            'Nama Pelapor',
            'No Telp Pelapor',
            'Tanggal Pelapor',
            'Pengaduan Pelapor',
            'Status Respon',
            'Pesan Respon',
        ];
    }

    //mengatur data yang ditampilkan per colum di excel nya 
    // fungsinys seperti foreach $item merupakanbagian aspada foreach
    public function map($item): array
    {
        return[
            $item->id,
            $item->nik,
            $item->nama_lengkap,
            $item->no_telp,
            \Carbon\Carbon::parse($item->created_at)->format('j F, Y'),
            $item->pengaduan,
            $item->respon ?  $item->respon['status'] : '-',
            $item->respon ? $item->respon['pesan'] : '-',
        ];
    }
}


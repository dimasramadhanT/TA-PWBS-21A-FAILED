<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mmahasiswa extends Model
{
    //use HasFactory;

    //buat data dari "tb_buku"
    function getData()
    {
        //tampilkan data dari "tb_mahasiswa"
        $query = DB::table('tb_buku')
               ->select("id AS id_buku","buku AS nama_buku","namapemijam AS nama_pemijam","namapenerbit AS nama_penerbit",
               "thpenerbit AS tahun_penerbit")
               ->orderBY("id")
               ->get();


            //mengirim hasil variabel "query" ke controller "mahasiswa"
               return $query;}
}

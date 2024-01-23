<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mmahasiswa extends Model
{
    // use HasFactory;

    //buat fungsi untuk ambil data "tb_admin"
    function getData()
    {
        //tampilkan data dari "tb_admin"
        $query = DB::table('tb_admin')
                ->select("ID AS id_mahasiswa","NPM AS npm_mahasiswa","NAMA AS nama_mahasiswa","TELEPON AS telpon_mahasiswa",
                "JURUSAN AS jurusan_mahasiswa")
                ->orderBy("ID")
                ->get();
        //mengirim hasil variabel "query" ke controller "mahasiswa"
        return $query;
    }

    //buat fungsi pencarian data
    function searchData($keyword)
    {
        //tampilkan data dari "tb_mahasiswa"
        $query = DB::table('tb_mahasiswa')
                ->select("ID AS id_mahasiswa","NPM AS npm_mahasiswa","NAMA AS nama_mahasiswa","TELEPON AS telpon_mahasiswa",
                "JURUSAN AS jurusan_mahasiswa")
                ->where("NPM","$keyword")
                // ->orWhere("nama","LIKE","%$keyword%")
                // ->orWhereRaw("REPLACE(nama,' ','') LIKE REPLACE('%$keyword%',' ','')")
                ->orWhere(DB::raw("REPLACE(NAMA,' ','')"),"LIKE",DB::raw("REPLACE('%$keyword%',' ','')"))
                ->orWhere("TELEPON","$keyword")
                ->orWhere("JURUSAN","LIKE","%$keyword%")
                ->orderBy("ID")
                ->get();
        //mengirim hasil variabel "query" ke controller "mahasiswa"
        return $query;
    }

    //buat fungsi detail data
    function detailData($id)
    {
        //tampilkan data dari "tb_mahasiswa"
        $query = DB::table('tb_mahasiswa')
                ->select("ID AS id_mahasiswa","NPM AS npm_mahasiswa","NAMA AS nama_mahasiswa","TELEPON AS telpon_mahasiswa",
                "JURUSAN AS jurusan_mahasiswa")
                // ->where(DB::raw("TO_BASE64(npm)"),"$id")
                ->where(DB::raw("TO_BASE64(MD5(NPM))"),"$id")

                ->get();
        //mengirim hasil variabel "query" ke controller "mahasiswa"
        return $query;
    }

   //buat fungsi untuk hapus data
   function deleteData($id)
   {
    DB::table("tb_mahasiswa")
    ->where(DB::raw("TO_BASE64(MD5(NPM))"), "$id")
    ->delete();
   }
   //buat fungsi simpan data
   function saveData($buku,$detail_peminjaman,$failed_jobs,$kategori,$migrations,$model_has_permissions,
   $model_has_roles,$paswword_reset,$peminjaman,$penerbit,$permissons,$rak,$role_has_permissions,
   $roles,$user)
   {
    //ambil data
    //"npm" = nama field
    //"$npm" = nama Parameter
    $result = [
        "buku" => $req->buku,
        "detail_peminjaman" => $req->detail_peminjaman,
        "failed_jobs" => $req->failed_jobs,
        "kategori" => $req->kategori,
        "migrations" => $req->migrations,
        "model_has_permissions" => $req->model_has_permissions,
        "model_has_roles" => $req->model_has_roles,
        "paswword_reset" => $req->paswword_resets,
        "peminjaman" => $req->peminjaman,
        "penerbit" => $req->penerbit,
        "permissons" => $req->permissions,
        "rak" => $req->rak,
        "role_has_permissions" => $req->role_has_permissions,
        "roles" => $req->roles,
        "user" => $req->user
        
    ];
    //perintah simpan data
    DB::table("tb_mahasiswa")
    ->insert($result);
   }

   function checkUpdateData($npm,$id)
   {
    //tampilkan data dari "tb_mahasiswa"
    $query = DB::table('tb_mahasiswa')
    ->select("ID AS id_mahasiswa","NPM AS npm_mahasiswa","NAMA AS nama_mahasiswa","TELEPON AS telpon_mahasiswa",
    "JURUSAN AS jurusan_mahasiswa")
    // ->where(DB::raw("TO_BASE64(npm)"),"$id")
    ->where(DB::raw("TO_BASE64(MD5(NPM))"),"!=","$id")
    ->where("NPM","$npm")
    ->get();
//mengirim hasil variabel "query" ke controller "mahasiswa"
return $query;
   }
   // fungsi untuk update data
   function updateData($npm, $nama,$jurusan,$telpon,$id)
   {
    //ambil data
    //"npm" = nama field
    //"$npm" = nama Parameter
    $result = [
        "buku" => $req->buku,
            "detail_peminjaman" => $req->detail_peminjaman,
            "failed_jobs" => $req->failed_jobs,
            "kategori" => $req->kategori,
            "migrations" => $req->migrations,
            "model_has_permissions" => $req->model_has_permissions,
            "model_has_roles" => $req->model_has_roles,
            "paswword_reset" => $req->paswword_resets,
            "peminjaman" => $req->peminjaman,
            "penerbit" => $req->penerbit,
            "permissons" => $req->permissions,
            "rak" => $req->rak,
            "role_has_permissions" => $req->role_has_permissions,
            "roles" => $req->roles,
            "user" => $req->user
    ];
    //perintah untuk update
    DB::table("tb_mahasiswa")
    ->where(DB::raw("TO_BASE64(MD5(NPM))"), "$id")
    ->update($result);
   }
}

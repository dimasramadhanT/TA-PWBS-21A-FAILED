<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mmahasiswa;
use Illuminate\Support\Facedes\Mail;


class Mahasiswa extends Controller
{
    //buat variabel
    protected $model;

    //buat fungsi global
    function __construct()
    {
        //inisialisasi variabel "model" dari model "Mmahasiswa"
        $this->model = new Mmahasiswa();
    }

    function getController()
    {
        //isi nilai dari variabel "result" dari fungsi "getData" dari model "Mmahasiswa"
        $result = $this->model->getData();

        //Kembalikan nilai variabel "result" ke dalam object "mahasiswa"
        return response(["mahasiswa"=> $result], http_response_code());
    }

    //Digunakan Untuk pencarian data
    function searchController($keyword)
    {
         //isi nilai dari variabel "result" dari fungsi "searchData" dari model "Mmahasiswa" sesuai dengan isi parameter
         $result = $this->model->searchData($keyword);

         //Kembalikan nilai variabel "result" ke dalam object "mahasiswa"
        return response(["mahasiswa"=> $result], http_response_code());
    }

    //buat fungsi detail data
    function detailController($id)
    {
                 //isi nilai dari variabel "result" dari fungsi "detailData" dari model "Mmahasiswa" sesuai dengan isi parameter "id"
                 $result = $this->model->detailData($id);

                 //Kembalikan nilai variabel "result" ke dalam object "mahasiswa"
                return response(["mahasiswa"=> $result], http_response_code());
        
    }

     //buat fungsi untuk menghapus data
     function deleteController($id)
     {
         //cek npm tersedia atau tidak 
         //jika data tersedia
        if(count($this->model->detailData($id))==1)
         {
            //lakukan penghapusan data(panggil fungsi "deleteData" dari Mmahasiswa)
            $this->model->deleteData($id);
            //buat status dan pesan
            $status = 1;
            $message = "Data Berhasil Dihapus";         }
         //jika data tidak tersedia
         else
         {
            $status = 0;
            $message = "Data Gagal Dihapus ! (NPM Tidak Ditemukan)";
         }

         //Kembalikan Nilai variabel "result" ke dalam object "Mahasiswa"
         return response(["status" => $status,"message"=>$message],http_response_code());
     }
     //buat fungsi untuk simpan data
     function saveController(Request $req)
     {
        //ambil data input
        //"npm" = variabel array yang menampung nilai dari $req
        //"$req->npm" = variabel yang dikirim dari front end
        $data = [
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
            
            // "id" => base64_encode(md5($req->npm))
        ];

        $id = base64_encode(md5($req->npm));

        //lakukan pengecekan apakah data "npm" yang diisi sudah pernah tersimpan/belum di database
       
        //jika data tersedia
        if(count($this->model->detailData($id))==1)
        {
            $status = 0;
            $message = "Data Gagal Disimpan ! ( NPM Sudah Ada !! )";
        }
        // jika data tidak tersedia
        else
        {
            //lakukan penyimpanan data
            //lakukan penginputan data(panggil fungsi "saveData" dari Mmahasiswa)
            $this->model->saveData($data["buku"],$data["detail_peminjaman"],$data["failed_jobs"],
            $data["kategori"],$data["migrations"],$data["model_has_permissions"],$data["model_has_roles"],
            $data["paswword_reset"], $data["peminjaman"], $data["penerbit"], $data["permissons"],
            $data["rak"],$data["role_has_permissions"],$data["roles"],$data["user"]);
            //buat status dan pesan
            $status = 1;
            $message = "Data berhasil di simpan !";
        }
        //Kembalikan Nilai variabel "result" ke dalam object "Mahasiswa"
        return response(["status" => $status,"message"=>$message],http_response_code());
     }

     //buat fungsi untuk ubah data
     function updateController(Request $req,$id)
     {
        //ambil data input
        $data = [
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
    
        //lakukan pengecekan apakah data "npm" yang diisi sudah pernah tersimpan/belum di database
       
        //jika data tidak tersedia
        if(count($this->model->checkUpdateData($data["NPM"],$id))==0)
        {
            //Lakukan perubahan data
            //panggil model checkupdatedata dari model "Mmahasiswa"
            $this->model->updateData($data["NPM"],$data["NAMA"],$data["JURUSAN"],$data["TELEPON"], $id);

            $status = 1;
            $message = "Data Berhasil DiUpdate!";
        }
        //jika data  tersedia
        else
        {
            $status = 0;
            $message = "Data Gagal DiUpdate !";
        }
       
        //Kembalikan Nilai variabel "result" ke dalam object "Mahasiswa"
       return response(["status" => $status,"message"=>$message],http_response_code());
     }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\buku;
use Illuminate\Support\Facedes\Mail;


class Mahasiswa extends Controller
{
    //buat variabel
    protected $model;

    //buat fungsi global
    function __construct()
    {
        //inisialisasi variabel "model" dari model "Mmahasiswa"
        $this->model = new buku();
    }

    function getController()
    {
        //isi nilai dari variabel "result" dari fungsi "getData" dari model "Mmahasiswa"
        $result = $this->model->getData();

        //Kembalikan nilai variabel "result" ke dalam object "mahasiswa"
        return response(["buku" => $result], http_response_code());
    }
}
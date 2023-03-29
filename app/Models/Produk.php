<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Produk extends Model
{
    // use HasFactory;

    protected $table = "produk";

    protected $fillable = [
        "kode_produk",
        "nama_produk",
        "merek",
        "id_toko",
    ];

    public static function getProdukBasedOnId($id){
        $sql = "SELECT *
                FROM produk WHERE id_toko = ?";
        $produk = DB::select($sql, [$id]);

        return $produk;
    }

    public static function getProdukDetail(){
         // query kode perusahaan
         $sql = "SELECT a.*,b.nama_toko
         FROM produk a
         JOIN toko b
         ON (a.id_toko=b.id_toko)";
         $produk = DB::select($sql);

         return $produk;

        
    }
}

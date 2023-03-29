<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;


class Toko extends Model
{
    use HasFactory;

    protected $table = 'toko';
    protected $fillable = ['kode_toko','nama_toko','alamat'];

    // query nilai max dari kode perusahaan untuk generate otomatis kode perusahaan
    public static function getKodeToko()
    {
        // query kode perusahaan
        $sql = "SELECT IFNULL(MAX(kode_toko), 'PR-000') as kode_toko 
                FROM toko";
        $kodetoko = DB::select($sql);

        // cacah hasilnya
        foreach ($kodetoko as $kdtk) {
            $kd = $kdtk->kode_toko;
        }
        // Mengambil substring tiga digit akhir dari string PR-000
        $noawal = substr($kd,-3);
        $noakhir = $noawal+1; //menambahkan 1, hasilnya adalah integer cth 1
        $noakhir = 'PR-'.str_pad($noakhir,3,"0",STR_PAD_LEFT); //menyambung dengan string PR-001
        return $noakhir;

    }
}

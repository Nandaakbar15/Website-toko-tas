<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Pelanggan extends Model
{
    // use HasFactory;

    protected $table = "pelanggan";

    protected $fillable = [
        "nama_pelanggan",
        "alamat_pelanggam",
        "kode_pelanggan",
    ];

    public static function getPelangganBasedOnId($id_pelanggan){
        $sql = "SELECT * FROM pelanggan WHERE id = ?";
        $pelanggan = DB::select($sql, [$id_pelanggan]);

        return $pelanggan;
    }

    public static function getPelangganDetail(){
        $sql = "SELECT * FROM pelanggan";
        $pelanggan = DB::select($sql);

        return $pelanggan;
    }
}

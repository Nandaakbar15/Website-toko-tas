<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Akses extends Model
{
    // use HasFactory;
    public static function getGrupUser($id)
    {
        $sql = "SELECT kelompok FROM users_kelompok WHERE id_user = ?";
        $kelompok = DB::select($sql, [$id]);
        return $kelompok;
    }
}

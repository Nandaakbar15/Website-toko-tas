<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Gambar_produk extends Model
{
    use HasFactory;

    // use HasFactory;
    protected $table = "gambar_produk";

    // untuk melist kolom yang dapat dimasukkan
    protected $fillable = [
        'nama_gambar',
        'gambar',
        'tgl_rilis',
        'klasifikasi_gambar',
    ];

    // untuk mendapatkan list dokumen dengan list jenis dokumen dan hobi
    public static function getAllGambarLists()
    {
        //$sql = "SELECT a.id,a.nama_dokumen,a.gambar_dokumen,a.tgl_rilis,a.klasifikasi_dokumen,b.list_dokumen, c.list_hobi FROM contohform a left outer join (SELECT id_dokumen, GROUP_CONCAT(nama_dokumen) as list_dokumen FROM contohform_jenis_dokumen GROUP BY id_dokumen) b on (a.id=b.id_dokumen) left outer join (SELECT id_dokumen, GROUP_CONCAT(hobi) as list_hobi from contohform_hobi GROUP BY id_dokumen) c on (a.id=c.id_dokumen) GROUP BY a.id,a.nama_dokumen,a.gambar_dokumen,a.tgl_rilis,a.klasifikasi_dokumen,b.list_dokumen, c.list_hobi";
        $sql = "SELECT a.id,a.nama_gambar,a.gambar,a.tgl_rilis,a.klasifikasi_gambar,ifnull(b.list_gambar,'-') as list_gambar, ifnull(c.list_tipe,'-') as list_tipe FROM gambar_produk a left outer join (SELECT id_gambar, GROUP_CONCAT(nama_gambar ORDER BY nama_gambar ASC) as list_gambar FROM jenis_gambar GROUP BY id_gambar) b on (a.id=b.id_gambar) left outer join (SELECT id_gambar, GROUP_CONCAT(tipe ORDER BY tipe ASC) as list_tipe from tipe_tas GROUP BY id_gambar) c on (a.id=c.id_gambar) GROUP BY a.id,a.nama_gambar,a.gambar,a.tgl_rilis,a.klasifikasi_gambar,b.list_gambar, c.list_tipe";
        // diganti ke view view_dokumen 
        // $sql = "SELECT * FROM view_dokumen";
        $c = DB::select($sql);

        return $c;
    }

    // untuk mendapatkan data list dokumen sesuai id dokumen
    public static function getAllGambarListsByIdGambar($id)
    {
        $sql = "SELECT a.id,a.nama_gambar,a.gambar,a.tgl_rilis,a.klasifikasi_gambar,ifnull(b.list_gambar,'-') as list_gambar, ifnull(c.list_tipe,'-') as list_tipe FROM gambar_produk a left outer join (SELECT id_gambar, GROUP_CONCAT(nama_gambar) as list_gambar FROM jenis_gambar GROUP BY id_gambar) b on (a.id=b.id_gambar) left outer join (SELECT id_gambar, GROUP_CONCAT(tipe) as list_tipe from tipe_tas GROUP BY id_gambar) c on (a.id=c.id_gambar) GROUP BY a.id,a.nama_gambar,a.gambar,a.tgl_rilis,a.klasifikasi_gambar,b.list_gambar, c.list_tipe HAVING a.id=?";
        // diganti ke view view_dokumen 
        // $sql = "SELECT * FROM view_dokumen";
        $c = DB::select($sql,[$id]);

        return $c;
    }
    // hapus tabel turunan dari contohform
    public static function delTipeJenisGambar($id){
         // hapus contohform_hobi
         $sql = "DELETE FROM tipe_tas WHERE id_gambar = ?";
         $nrd = DB::delete($sql,[$id]);
 
         // hapus contohform_hobi
         $sql = "DELETE FROM jenis_gambar WHERE id_gambar = ?";
         $nrd = DB::delete($sql,[$id]);
    }

    // memasukkan ke tabel contohform_jenis_dokumen (tabel anak dari contoh form)
    public static function inputJenisGambar($id_gambar, $nama_gambar){
        $sql = "insert into jenis_gambar(id_gambar, nama_gambar) values (?, ?)";
        $nrd = DB::insert($sql,[$id_gambar, $nama_gambar]);
    }

    // memasukkan ke tabel contohform_jenis_dokumen (tabel anak dari contoh form)
    public static function inputTipe($id_gambar, $tipe){
        $sql = "insert into tipe_tas(id_gambar, tipe) values (?, ?)";
        $nrd = DB::insert($sql,[$id_gambar, $tipe]);
    }

    // dapatkan id dokumen terakhir
    public static function getLastId(){
        $sql = "SELECT max(id) as mak_id
                FROM gambar_produk";
        $c = DB::select($sql);

        return $c;
    }
    
}

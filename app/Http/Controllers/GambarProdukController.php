<?php

namespace App\Http\Controllers;

use App\Models\Gambar_produk;
use App\Models\Produk; //load model dari kelas model Produk
use App\Models\Toko; //load model dari kelas model toko
use App\Http\Requests\StoreGambar_produkRequest;
use App\Http\Requests\UpdateGambar_produkRequest;

use Illuminate\Support\Facades\Storage; //tambahan 
use Illuminate\Support\Facades\File; //untuk hapus file

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GambarProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // mengambil data coa dan perusahaan dari database
    	$c = Gambar_produk::getAllGambarLists();

        return view('gambarproduk/view',
            [
                'gambar_produk' => $c
            ]
        );
    }

    public function fetchgambar()
    {
        $c = Gambar_produk::getAllGambarLists();
        return response()->json([
            'gambar_produk'=>$c,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGambar_produkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGambar_produkRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validator = Validator::make(
            $request->all(),
            [
                'nama_gambar' => 'required|min:3',
                'tgl_rilis' => 'required',
                'klasifikasi_gambar' => 'required',
                'gambar' => 'file|image|mimes:jpeg,png,jpg|max:2048'
            ]
        );
        
        if($validator->fails()){
            // gagal
            return response()->json(
                [
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]
            );
        }else{
            // berhasil

            // cek apakah tipenya input atau update
            // input => tipeproses isinya adalah tambah
            // update => tipeproses isinya adalah ubah
            
            if($request->input('tipeproses')=='tambah'){

                $file = $request->file('gambar_produk');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $tujuan_upload = 'gambar';
		        $file->move($tujuan_upload,$fileName);

                $empData = ['nama_gambar' => $request->input('nama_gambar'), 'gambar' => $fileName, 'tgl_rilis' => $request->input('tgl_rilis'), 'klasifikasi_gambar' => $request->input('klasifikasi_gambar')];
		        Gambar_produk::create($empData);

                // pemrosesan jenis dokumen
                $jd = $request->input('jenis_gambar');
                // dapatkan id terakhir setelah diinputkan
                $l = Gambar_produk::getLastId();
                $idmaks = $l[0]->mak_id; //dapatkan id terakhir dan simpan ke idmaks
                
                // masukkan setiap data jenis dokumen dari select2
                foreach ($jd as $value) {
                    // masukkan ke db
                    Gambar_produk::inputJenisGambar($idmaks, $value);
                }

                // proses checkbox
                $traveling = $request->input('traveling');
                if(isset($traveling)){
                    // masukkan ke db
                    Gambar_produk::inputTipe($idmaks, $traveling);
                }
                $olahraga = $request->input('olahraga');
                if(isset($olahraga)){
                    // masukkan ke db
                    Gambar_produk::inputTipe($idmaks, $olahraga);
                }
                $naikgunung = $request->input('naikgunung');
                if(isset($naikgunung)){
                    // masukkan ke db
                    Gambar_produk::inputTipe($idmaks, $naikgunung);
                }
                
                return response()->json(
                    [
                        'status' => 200,
                        'message' => 'Sukses Input Data',
                    ]
                );
            }else{
                // update ke db
                // cek dulu jika ada file yg diupload lagi maka prosedur input image dilakukan lagi
                if($request->hasFile('gambar_produk')){ 
                    // jalankan prosedur upload ke server
                    $file = $request->file('gambar_produk');
                    $fileName = time() . '.' . $file->getClientOriginalExtension();
                    $tujuan_upload = 'gambar';
                    $file->move($tujuan_upload,$fileName);

                    // update ke db
                    $c = Gambar_produk::find($request->input('idgambarprodukhidden'));
                
                    // proses update dari inputan form data
                    $c->nama_gambar = $request->input('nama_gambar');
                    $c->gambar = $fileName;
                    $c->tgl_rilis = $request->input('tgl_rilis');
                    $c->klasifikasi_gambar = $request->input('klasifikasi_gambar');
                    $c->update(); //proses update ke db

                }else{
                    // kalau tidak maka nilainya tidak perlu di update
                    // update ke db
                    // dapatkan record yang mau diupdate berdasarkan idnya
                    $c = Gambar_produk::find($request->input('idgambarprodukhidden'));
                
                    // proses update dari inputan form data
                    $c->nama_gambar = $request->input('nama_gambar');
                    $c->gambar = $request->input('gambarlama');
                    $c->tgl_rilis = $request->input('tgl_rilis');
                    $c->klasifikasi_gambar = $request->input('klasifikasi_gambar');
                    $c->update(); //proses update ke db
                }

                // hapus dulu baru masukin lagi
                Gambar_produk::delTipeJenisGambar($request->input('idgambarprodukhidden'));

                // masukin lagi jenis dokumen
                $jd = $request->input('jenis_gambar');
                foreach ($jd as $value) {
                    // masukkan ke db
                    Gambar_produk::inputJenisGambar($request->input('idgambarprodukhidden'), $value);
                }

                // proses checkbox hobi
                $traveling = $request->input('traveling');
                if(isset($traveling)){
                    // masukkan ke db
                    Gambar_produk::inputTipe($request->input('idgambarprodukidden'), $traveling);
                }
                $olahraga = $request->input('olahraga');
                if(isset($olahraga)){
                    // masukkan ke db
                    Gambar_produk::inputTipe($request->input('idgambarprodukhidden'), $olahraga);
                }
                $naikgunung = $request->input('naikgunung');
                if(isset($tidur)){
                    // masukkan ke db
                    Gambar_produk::inputTipe($request->input('idgambarprodukhidden'), $tidur);
                }

                return response()->json(
                    [
                        'status' => 200,
                        'message' => 'update data',
                    ]
                );
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gambar_produk  $gambar_produk
     * @return \Illuminate\Http\Response
     */
    public function show(Gambar_produk $gambar_produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gambar_produk  $gambar_produk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         // $c = Contohform::find($id);
         $c = Gambar_produk::getAllGambarListsByIdGambar($id);
         if($c)
         {
             return response()->json([
                 'status'=>200,
                 'c'=> $c,
             ]);
         }
         else
         {
             return response()->json([
                 'status'=>404,
                 'message'=>'Tidak ada data ditemukan.'
             ]);
         }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGambar_produkRequest  $request
     * @param  \App\Models\Gambar_produk  $gambar_produk
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        //hapus dari database
        $c = Gambar_produk::findOrFail($id);

        // hapus file
        $pathfile = public_path('gambar/' .$c->gambar);
        File::delete($pathfile);
        // hapus record di database
        $c->delete();

        // hapus anaknya
        Gambar_produk::delTipeJenisGambar($id);

        return view('gambarproduk/view',
            [
                'gambar_produk' => $c,
                'status_hapus' => 'Sukses Hapus '
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gambar_produk  $gambar_produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gambar_produk $gambar_produk)
    {
        //
    }
}

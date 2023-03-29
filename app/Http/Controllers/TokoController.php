<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Http\Requests\StoreTokoRequest;
use App\Http\Requests\UpdateTokoRequest;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //query data
         $toko = Toko::all();
         return view('toko/view',
                     [
                         'toko' => $toko
                     ]
                   );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('toko/create',
        [
            'kode_toko' => Toko::getKodeToko()
        ]
      );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTokoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTokoRequest $request)
    {
        $validated = $request->validate([
            'nama_toko' => 'required|unique:toko|max:255',
            'alamat' => 'required',
        ]);

        Toko::create($request->all());
        
        return redirect()->route('toko')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function show(Toko $toko)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $toko = Toko::whereId($id)->first();
   
         return view('toko/update', [
                 'toko' => $toko
         ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTokoRequest  $request
     * @param  \App\Models\Toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTokoRequest $request, Toko $toko)
    {
        $id = $request->input('id'); //dapatkan id dari hidden form

        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'nama_toko' => 'required|unique:perusahaan|max:255',
            'alamat' => 'required',
        ]);

        // update ke db
        Toko::whereId($id)->update($validated);
        return redirect()->route('perusahaan')->with('success','Data Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $toko = Toko::findOrFail($id);
        $toko->delete();
        return redirect()->route('toko')->with('success','Data Berhasil di Hapus');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Grafik;
use Illuminate\Http\Request;

class GrafikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grafik  $grafik
     * @return \Illuminate\Http\Response
     */
    public function show(Grafik $grafik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grafik  $grafik
     * @return \Illuminate\Http\Response
     */
    public function edit(Grafik $grafik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grafik  $grafik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grafik $grafik)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grafik  $grafik
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grafik $grafik)
    {
        //
    }

     // view bulan berjalan
     public function viewPenjualanBlnBerjalan(){
        $grafik = Grafik::viewBulanBerjalan();
        return view('grafik/bulanberjalan',
                        [
                            'grafik' => $grafik
                        ]
                    );
    }

    // view status penjualan
    public function viewStatusPenjualan(){
        $grafik = Grafik::viewStatusPenjualan();
        return view('grafik/statuspenjualan',
                        [
                            'grafik' => $grafik
                        ]
                    );
    }

    // view jml barang terjual
    public function viewJmlBarangTerjual(){
        $grafik = Grafik::viewJmlBarangTerjual();
        return view('grafik/jmlbarangterjual',
                        [
                            'grafik' => $grafik
                        ]
                    );
    }
}

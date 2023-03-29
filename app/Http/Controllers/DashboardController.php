<?php

namespace App\Http\Controllers;

use App\Models\Grafik;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // // view bulan berjalan
    // public function viewPenjualanBlnBerjalan(){
    //     $grafik = Grafik::viewBulanBerjalan();
    //     return view('dashboardbootstrap',
    //                     [
    //                         'grafik' => $grafik
    //                     ]
    //                 );
    // }

    // // view status penjualan
    // public function viewStatusPenjualan(){
    //     $grafik = Grafik::viewStatusPenjualan();
    //     return view('dashboardbootstrap',
    //                     [
    //                         'grafik' => $grafik
    //                     ]
    //                 );
    // }

    // view jml barang terjual
    public function viewJmlBarangTerjual(){
        $grafik = Grafik::viewJmlBarangTerjual();
        $grafik2 = Grafik::viewbulanberjalan();
        $grafik3 = Grafik::viewstatuspenjualan();
        return view('dashboardbootstrap',
                        [
                            'grafik' => $grafik,
                            'grafik2' => $grafik2,
                            'grafik3' => $grafik3
                        ]
                    );
    }
}

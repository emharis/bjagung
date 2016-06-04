<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class JualController extends Controller {

    public function index() {
        // $data = \DB::table('VIEW_PEMBELIAN')->orderBy('tgl','desc')->get();

        return view('penjualan.jual.index', [
            // 'data' => $data
        ]);
    }

    //Penjualan/POS
    public function pos(){
        //buat tanggal dalam format indonesia
        $day = date('N');
        $hari = "";
        if($day == 1){
            $hari = "Senin";
        }else if($day == 2){
            $hari = "Selasa";
        }else if($day == 3){
            $hari = "Rabu";
        }else if($day == 4){
            $hari = "Kamis";
        }else if($day == 5){
            $hari = "Jumat";
        }else if($day == 6){
            $hari = "Sabtu";
        }else if($day == 7){
            $hari = "Minggu";
        }
        $tgl_indo = $hari . ", ". date('d-m-Y');

        return view('penjualan.jual.pos',[
                'tgl_indo' => $tgl_indo
            ]);
    }

    //get data barang JSON
    public function getBarang(Request $request){
        $barangs = \DB::table('VIEW_STOK_BARANG')->select('id as data','nama_full as value','kode','satuan as sat','harga_jual_current')
            ->where('nama_full','like','%'.$request->get('nama').'%')
            //dan select data yang stok > 0 dan telah di set harga jual
            ->where('stok','>',0)
            ->where('harga_jual_current','>',0)
            ->get();
        // $barangs['nama'] = $request->input('nama');
        $data_barang = ['query'=>'Unit','suggestions' => $barangs];
        echo json_encode($data_barang);
    }


    //get data barang by kode return JSON
    public function getBarangByKode(Request $request){
         $barangs = \DB::table('VIEW_STOK_BARANG')->select('id as data','nama_full as nama','kode as value','satuan as sat','harga_jual_current')
            ->where('kode','like','%'.$request->get('nama').'%')
            ->where('stok','>',0)
            ->where('harga_jual_current','>',0)
            ->get();
        // $barangs['nama'] = $request->input('nama');
        $data_barang = ['query'=>'Unit','suggestions' => $barangs];

        echo json_encode($data_barang);
    }

    public function getSalesman(Request $request){
        $salesman = \DB::table('sales')
            ->select('id as data',\DB::raw('concat(kode, " - ", nama) as value'))
            ->where('nama','like','%'.$request->get('nama').'%')
            ->orWhere('kode','like','%'.$request->get('nama').'%')
            ->get();
        $data_salesman = ['query'=>'Unit','suggestions' => $salesman];

        echo json_encode($data_salesman);
    }

    public function getCustomer(Request $request){
        $customer = \DB::table('customer')
                    ->select('id as data','nama as value')
                    ->where('nama','like','%'.$request->get('nama').'%')
                    ->get();
        $data_customer = ['query'=>'Unit','suggestions' => $customer];

        return json_encode($data_customer);
    }

//==================================================================================
//END OF CODE JualController.php
}

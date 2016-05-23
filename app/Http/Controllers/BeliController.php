<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BeliController extends Controller {

    public function index() {
        $data = \DB::table('beli')->orderBy('tgl','desc')->get();

        return view('pembelian.beli.index', [
            'data' => $data
        ]);
    }

    public function add(){
    	$suppliers = \DB::table('supplier')->get();
        return view('pembelian.beli.add',[
        		'suppliers' => $suppliers
        	]);
    }

    public function getBarang(Request $request){
        $barangs = \DB::table('VIEW_STOK_BARANG')->select('id as data','nama_full as value','kode','satuan as sat')
            ->where('nama_full','like','%'.$request->get('nama').'%')
            ->get();
        // $barangs['nama'] = $request->input('nama');
        $data_barang = ['query'=>'Unit','suggestions' => $barangs];
        echo json_encode($data_barang);
    }

    public function getBarangByKode(Request $request){
         $barangs = \DB::table('VIEW_STOK_BARANG')->select('id as data','nama_full as nama','kode as value','satuan as sat')
            ->where('kode','like','%'.$request->get('nama').'%')
            ->get();
        // $barangs['nama'] = $request->input('nama');
        $data_barang = ['query'=>'Unit','suggestions' => $barangs];
        echo json_encode($data_barang);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class StokController extends Controller {

    public function index() {

        $barang = \DB::table('VIEW_BARANG')->orderBy('created_at', 'desc')->get();

        return view('setbar.stok.index', [
            'data' => $barang
        ]);
    }
    
    public function setStok($id){
        $barang = \DB::table('VIEW_BARANG')->find($id);
        $satuan_jual = \DB::table('VIEW_SATUAN_JUAL_BARANG')->where('id',$id)->get();
        $stok = \DB::table('stok')->whereBarangId($id)->where('current_stok','>',0)->get();
        
        return view('setbar.stok.setstok', [
            'data' => $barang,
            'satuan_jual' => $satuan_jual,
            'stok' => $stok,
        ]);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BarangController extends Controller {

    public function index() {
        $data = \DB::table('barang')
                ->orderBy('created_at', 'desc')
                ->get();

        $kategori = \DB::table('kategori')
                ->orderBy('created_at', 'desc')
                ->get();
        $slc_kategori = [];
        foreach ($kategori as $dt) {
            $slc_kategori[$dt->id] = $dt->nama;
        }

        $satuan = \DB::table('satuan')
                ->orderBy('created_at', 'desc')
                ->get();
        $slc_satuan_beli = [];
        foreach ($satuan as $dt) {
            $slc_satuan_beli[$dt->id] = $dt->nama;
        }

        return view('master.barang.index', [
            'data' => $data,
            'slc_kategori' => $slc_kategori,
            'slc_satuan_beli' => $slc_satuan_beli,
            'satuan' => $satuan,
        ]);
    }

    //insert new data barang
    public function insert(Request $request) {
        $id = \DB::table('barang')->insertGetId([
            'nama' => $request->input('nama')
        ]);

        if (!$request->ajax()) {
            return redirect('master/barang');
        } else {
            return json_encode(\DB::table('barang')->find($id));
        }
    }

    //get data barang
    public function getBarang($id) {
        $data = \DB::table('barang')->find($id);

        return json_encode($data);
    }

    //update data barang
    public function updateBarang(Request $request) {
        \DB::table('barang')
                ->whereId($request->input('id'))
                ->update([
                    'nama' => $request->input('nama')
        ]);

        if (!$request->ajax()) {
            return redirect('master/barang');
        } else {
            return json_encode(\DB::table('barang')->find($request->input('id')));
        }
    }

    //delete barang
    public function deleteBarang($id, Request $request) {
        \DB::table('barang')->delete($id);

        if (!$request->ajax()) {
            return redirect('master/barang');
        }
    }

}

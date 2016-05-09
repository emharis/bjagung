<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BarangController extends Controller {

    public function index() {
        $data = \DB::table('VIEW_BARANG')
                ->orderBy('kategori', 'asc')
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

        \DB::transaction(function()use($request) {
            //insert data barang
            $id = \DB::table('barang')->insertGetId([
                'nama' => $request->input('nama'),
                'kategori_id' => $request->input('kategori'),
                'satuan_beli_id' => $request->input('satuan_beli'),
            ]);

            //insert satuan jual
            if (count($request->input('satuan_jual'))) {
                foreach ($request->input('satuan_jual') as $dt) {
                    \DB::table('satuan_jual_barang')->insert([
                        'barang_id' => $id,
                        'satuan_id' => $dt,
                        'konversi' => $request->input('konversi_satuan_' . $dt),
                    ]);
                }
            }

            if ($request->ajax()) {
                echo json_encode(\DB::table('VIEW_BARANG')->find($id));
            }
        });

        if (!$request->ajax()) {
            return redirect('master/barang');
        }
//        else {
//            return json_encode(\DB::table('barang')->find($id));
//        }
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

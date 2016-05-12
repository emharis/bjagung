<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BarangController extends Controller {

    public function index() {
//        $data = \DB::table('VIEW_BARANG')
//                ->orderBy('kategori', 'asc')
//                ->orderBy('created_at', 'desc')
//                ->get();
        
        $data = \DB::select('select * from VIEW_BARANG order by kategori,created_at desc');

        $kategori = \DB::table('kategori')
                ->orderBy('created_at', 'desc')
                ->get();


        return view('master.barang.index', [
            'data' => $data,
            'kategori' => $kategori,
        ]);
    }

    //insert new data barang
    public function insert(Request $request) {

        $id = \DB::table('barang')->insertGetId([
            'nama' => $request->input('nama'),
            'kode' => $request->input('kode'),
            'kategori_id' => $request->input('kategori'),
            'rol' => $request->input('rol'),
        ]);

        if (!$request->ajax()) {
            return redirect('master/barang');
        } else {
            return json_encode(\DB::table('VIEW_BARANG')->find($id));
        }
    }

    //get data barang
    public function getBarang($id) {
        $data = \DB::table('barang')->find($id);

        return json_encode($data);
    }

    public function getSatuanBarang($id) {
        return json_encode($satuan = \DB::table('VIEW_SATUAN_JUAL_BARANG')->where('id', $id)->get());
    }

    //update data barang
    public function updateBarang(Request $request) {
        //update data barang
        \DB::table('barang')
                ->whereId($request->input('id'))
                ->update([
                    'nama' => $request->input('nama'),
                    'kode' => $request->input('kode'),
                    'kategori_id' => $request->input('kategori'),
                    'rol' => $request->input('rol'),
        ]);

        if (!$request->ajax()) {
            return redirect('master/barang');
        } else {
            return json_encode(\DB::table('VIEW_BARANG')->find($request->input('id')));
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

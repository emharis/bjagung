<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class KategoriController extends Controller {

    public function index() {
        $data = \DB::table('kategori')
                ->orderBy('created_at', 'desc')
                ->join('satuan', 'kategori.satuan_id', '=', 'satuan.id')
                ->select('kategori.*', 'satuan.nama as satuan')
                ->get();
        $satuan = \DB::table('satuan')->get();

        return view('master.kategori.index', [
            'data' => $data,
            'satuan' => $satuan,
        ]);
    }

    //insert new data kategori
    public function insert(Request $request) {
        $id = \DB::table('kategori')->insertGetId([
            'nama' => $request->input('nama'),
            'satuan_id' => $request->input('satuan'),
        ]);

        if (!$request->ajax()) {
            return redirect('master/kategori');
        } else {
            $data = \DB::table('kategori')
                    ->where('kategori.id', $id)
                    ->join('satuan', 'satuan.id', '=', 'kategori.satuan_id')
                    ->select('kategori.*', 'satuan.nama as satuan')
                    ->first();
            return json_encode($data);
        }
    }

    //get data kategori
    public function getKategori($id) {
        $data = \DB::table('kategori')
                ->where('kategori.id', $id)
                ->join('satuan', 'satuan.id', '=', 'kategori.satuan_id')
                ->select('kategori.*', 'satuan.nama as satuan')
                ->first();

        return json_encode($data);
    }

    //update data kategori
    public function updateKategori(Request $request) {
        \DB::table('kategori')
                ->whereId($request->input('id'))
                ->update([
                    'nama' => $request->input('nama'),
                    'satuan_id' => $request->input('satuan'),
        ]);

        if (!$request->ajax()) {
            return redirect('master/kategori');
        } else {
            $data = \DB::table('kategori')
                    ->where('kategori.id', $request->input('id'))
                    ->join('satuan', 'satuan.id', '=', 'kategori.satuan_id')
                    ->select('kategori.*', 'satuan.nama as satuan')
                    ->first();
            return json_encode($data);
        }
    }

    //delete kategori
    public function deleteKategori($id, Request $request) {
        \DB::table('kategori')->delete($id);

        if (!$request->ajax()) {
            return redirect('master/kategori');
        }
    }

}

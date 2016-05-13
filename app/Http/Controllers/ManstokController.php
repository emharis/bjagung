<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ManstokController extends Controller {

    public function index() {

        $barang = \DB::table('VIEW_BARANG')->orderBy('created_at', 'desc')->get();

        return view('setbar.manstok.index', [
            'data' => $barang
        ]);
    }

    public function setStok($id) {
        $barang = \DB::table('VIEW_BARANG')->find($id);

        $manual_stok = \DB::table('stok')
                ->whereTipe('M')
                ->where('barang_id', $id)
                ->orderBy('created_at', 'desc')
                ->get();

        return view('setbar.manstok.setstok', [
            'data' => $barang,
            'manual_stok' => $manual_stok,
        ]);
    }

    public function insert(Request $request) {
        \DB::transaction(function()use($request) {
            //Insert ke tabel stok

            $harga = str_replace(',', '', $request->input('harga'));
            $harga = str_replace('.', '', $harga);

            $id = \DB::table('stok')->insertGetId([
                'barang_id' => $request->input('barang_id'),
                'stok_awal' => $request->input('jumlah'),
                'current_stok' => $request->input('jumlah'),
                'tipe' => 'M',
                'harga' => $harga,
                'tgl' => date('Y-m-d', strtotime($request->input('tanggal')))
            ]);

            //insert ke stok_moving
            \DB::table('stok_moving')->insert([
                'stok_id' => $id,
                'jumlah' => $request->input('jumlah'),
                'tipe' => 'I',
            ]);

            if ($request->ajax()) {

                $data = \DB::table('VIEW_STOK')
                        ->find($id);
                echo json_encode($data);
            }
        });

        if (!$request->ajax()) {
            return redirect('setbar/manstok/set-stok/' . $request->input('barang_id'));
        }
    }

    public function delete($id) {
        $barangid = \DB::table('stok')->find($id)->barang_id;
        \DB::table('stok')->delete($id);
        return redirect('setbar/manstok/set-stok/' . $barangid);
    }

//END OF CLASS
}

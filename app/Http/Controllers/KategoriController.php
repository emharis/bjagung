<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class KategoriController extends Controller {


    // fungsi tampilkan halaman kategori
    public function index() {
        $data = \DB::table('VIEW_KATEGORI')
                ->orderBy('created_at', 'desc')
                ->get();
        $satuan = \DB::table('satuan')->get();

        return view('inventory.kategori.kategori', [
            'data' => $data,
            'satuan' => $satuan,
        ]);
    }

    // Fungsi add kategori/ tampilkan form add
    public function add(){
        $satuan = \DB::table('satuan')->get();

        return view('inventory.kategori.addkategori',[
                'satuan' => $satuan,
            ]);
    }

    // Fungsi insert data ke database
    public function insert(Request $req){
        \DB::table('kategori')
            ->insert([
                    'nama'=>$req->nama,
                    'satuan_id'=>$req->satuan,
                    'user_id' => \Auth::user()->id
                ]);

            return redirect('inventory/kategori');
    }

    // Fungsi Edit/ Tampilkan Form Edit
    public function edit($id){
        $data = \DB::table('VIEW_KATEGORI')->find($id);
        $satuan = \DB::table('satuan')->get();

        return view('inventory.kategori.editkategori',[
                'data' => $data,
                'satuan' => $satuan,
            ]);
    }

    // Simpan perubahan data ke database
    public function update(Request $req){
        \DB::table('kategori')
            ->where('id',$req->id)
            ->update([
                    'nama' => $req->nama,
                    'satuan_id' => $req->satuan
                ]);

        return redirect('inventory/kategori');
    }

    // Delete kategori dari dattabase
    public function delete(Request $req){
        \DB::table('kategori')
            ->delete($req->id);

        return redirect('inventory/kategori');
    }

    // //insert new data kategori
    // public function insert(Request $request) {
    //     $id = \DB::table('kategori')->insertGetId([
    //         'nama' => $request->input('nama'),
    //         'satuan_id' => $request->input('satuan'),
    //     ]);

    //     if (!$request->ajax()) {
    //         return redirect('master/kategori');
    //     } else {
    //         $data = \DB::table('kategori')
    //                 ->where('kategori.id', $id)
    //                 ->join('satuan', 'satuan.id', '=', 'kategori.satuan_id')
    //                 ->select('kategori.*', 'satuan.nama as satuan')
    //                 ->first();
    //         return json_encode($data);
    //     }
    // }

    // //get data kategori
    // public function getKategori($id) {
    //     $data = \DB::table('kategori')
    //             ->where('kategori.id', $id)
    //             ->join('satuan', 'satuan.id', '=', 'kategori.satuan_id')
    //             ->select('kategori.*', 'satuan.nama as satuan')
    //             ->first();

    //     return json_encode($data);
    // }

    // //update data kategori
    // public function updateKategori(Request $request) {
    //     \DB::table('kategori')
    //             ->whereId($request->input('id'))
    //             ->update([
    //                 'nama' => $request->input('nama'),
    //                 'satuan_id' => $request->input('satuan'),
    //     ]);

    //     if (!$request->ajax()) {
    //         return redirect('master/kategori');
    //     } else {
    //         $data = \DB::table('kategori')
    //                 ->where('kategori.id', $request->input('id'))
    //                 ->join('satuan', 'satuan.id', '=', 'kategori.satuan_id')
    //                 ->select('kategori.*', 'satuan.nama as satuan')
    //                 ->first();
    //         return json_encode($data);
    //     }
    // }

    // //delete kategori
    // public function deleteKategori($id, Request $request) {
    //     \DB::table('kategori')->delete($id);

    //     if (!$request->ajax()) {
    //         return redirect('master/kategori');
    //     }
    // }

}

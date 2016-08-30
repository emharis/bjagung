<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SatuanController extends Controller {


    // fungsi tampilkan halaman satuan
    public function index() {
        $data = \DB::table('VIEW_SATUAN')
                ->orderBy('created_at', 'desc')
                ->get();

        return view('inventory.satuan.satuan', [
            'data' => $data,
        ]);
    }

    // Fungsi add satuan/ tampilkan form add
    public function add(){
        return view('inventory.satuan.addsatuan');
    }

    // Fungsi insert data ke database
    public function insert(Request $req){
        \DB::table('satuan')
            ->insert([
                    'nama'=>$req->nama,
                    'user_id' => \Auth::user()->id
                ]);

        return redirect('inventory/satuan');
    }

    // Fungsi Edit/ Tampilkan Form Edit
    public function edit($id){
        $data = \DB::table('VIEW_SATUAN')->find($id);

        return view('inventory.satuan.editsatuan',[
                'data' => $data,
            ]);
    }

    // Simpan perubahan data ke database
    public function update(Request $req){
        \DB::table('satuan')
            ->where('id',$req->id)
            ->update([
                    'nama' => $req->nama
                ]);

        return redirect('inventory/satuan');
    }

    // Delete satuan dari dattabase
    public function delete(Request $req){
        \DB::table('satuan')
            ->delete($req->id);

        return redirect('inventory/satuan');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class InvbarangController extends Controller {

    // fungsi index pertama kali view dijalankan
    public function index() {
        $data = \DB::table('VIEW_BARANG')
                ->orderBy('kategori', 'asc')
                ->orderBy('created_at', 'desc')
                ->get();

        $kategori = \DB::table('kategori')
                ->orderBy('created_at', 'desc')
                ->get();


        return view('inventory.barang.barang', [
            'data' => $data,
            'kategori' => $kategori,
        ]);
    }

    public function add(){
        $kategori = \DB::table('VIEW_KATEGORI')->get();
        // $satuan = \DB::table()

        return view('inventory.barang.addbarang',[
                'kategori' => $kategori
            ]);
    }

    public function insert(Request $req){
        $hasError = false;

        return \DB::transaction(function()use($req,$hasError){
            // insert data baru ke database
            \DB::table('barang')->insert([
                'kode' => $req->kode,
                'nama' => $req->nama,
                'kategori_id' => $req->kategori,
                'rol' => $req->rol,
                'berat' => $req->berat,
            ]);

            return redirect('inventory/barang');
        });
        
    }

    public function edit($id){
        $kategori = \DB::table('kategori')->get();
        $barang = \DB::table('VIEW_BARANG')->find($id);

        return view('inventory.barang.editbarang',[
                'barang' => $barang,
                'kategori' => $kategori
            ]);
    }

    // fungsi cek kode barang
    function cekKode($kode){
        return  \DB::table('barang')->where('kode',$kode)->count();

    }

    // fungsi create kategori barang baru
    function createKategori(Request $req){
        $newid = \DB::table('kategori')->insertGetId([
                'nama' => $req->nama,
                'satuan' => $req->satuan
            ]);

        return json_encode(\DB::table('kategori')->find($newid));
    }

    // fungsi hapus data barang dari database
    function delete(Request $req){
        return \DB::transaction(function()use($req){
            \DB::table('barang')->delete($req->barang_id);

            return redirect('inventory/barang');
        });
    }

}

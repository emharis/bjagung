<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SupplierController extends Controller {


    // fungsi tampilkan halaman supplier
    public function index() {
        $data = \DB::table('VIEW_SUPPLIER')
                ->orderBy('created_at', 'desc')
                ->get();

        return view('purchase.supplier.supplier', [
            'data' => $data,
        ]);
    }

    // Fungsi add supplier/ tampilkan form add
    public function add(){
        return view('purchase.supplier.addsupplier');
    }

    // Fungsi insert data ke database
    public function insert(Request $req){
        \DB::table('supplier')
            ->insert([
                    'nama'=>$req->nama,
                    'nama_kontak'=>$req->nama_kontak,
                    'telp'=>$req->telp,
                    'telp_2'=>$req->telp2,
                    'alamat'=>$req->alamat,
                    'jatuh_tempo'=>$req->tempo,
                    'note'=>$req->note,
                    'user_id' => \Auth::user()->id
                ]);

        return redirect('purchase/supplier');
    }

    // Fungsi Edit/ Tampilkan Form Edit
    public function edit($id){
        $data = \DB::table('VIEW_SUPPLIER')->find($id);

        return view('purchase.supplier.editsupplier',[
                'data' => $data,
            ]);
    }

    // Simpan perubahan data ke database
    public function update(Request $req){
        \DB::table('supplier')
            ->where('id',$req->id)
            ->update([
                    'nama'=>$req->nama,
                    'nama_kontak'=>$req->nama_kontak,
                    'telp'=>$req->telp,
                    'telp_2'=>$req->telp2,
                    'alamat'=>$req->alamat,
                    'jatuh_tempo'=>$req->tempo,
                    'note'=>$req->note,
                ]);

        return redirect('purchase/supplier');
    }

    // Delete supplier dari dattabase
    public function delete(Request $req){
        \DB::table('supplier')
            ->delete($req->id);

        return redirect('purchase/supplier');
    }

}

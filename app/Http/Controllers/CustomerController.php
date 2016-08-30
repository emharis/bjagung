<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CustomerController extends Controller {


    // fungsi tampilkan halaman customer
    public function index() {
        $data = \DB::table('VIEW_CUSTOMER')
                ->orderBy('created_at', 'desc')
                ->get();

        return view('sales.customer.customer', [
            'data' => $data,
        ]);
    }

    // Fungsi add customer/ tampilkan form add
    public function add(){
        return view('sales.customer.addcustomer');
    }

    // Fungsi insert data ke database
    public function insert(Request $req){
        \DB::table('customer')
            ->insert([
                    'nama'=>$req->nama,
                    'nama_kontak'=>$req->nama_kontak,
                    'telp'=>$req->telp,
                    'telp_2'=>$req->telp2,
                    'alamat'=>$req->alamat,
                    'note'=>$req->note,
                    'user_id' => \Auth::user()->id
                ]);

        return redirect('sales/customer');
    }

    // Fungsi Edit/ Tampilkan Form Edit
    public function edit($id){
        $data = \DB::table('VIEW_CUSTOMER')->find($id);

        return view('sales.customer.editcustomer',[
                'data' => $data,
            ]);
    }

    // Simpan perubahan data ke database
    public function update(Request $req){
        \DB::table('customer')
            ->where('id',$req->id)
            ->update([
                    'nama'=>$req->nama,
                    'nama_kontak'=>$req->nama_kontak,
                    'telp'=>$req->telp,
                    'telp_2'=>$req->telp2,
                    'alamat'=>$req->alamat,
                    'note'=>$req->note,
                ]);

        return redirect('sales/customer');
    }

    // Delete customer dari dattabase
    public function delete(Request $req){
        \DB::table('customer')
            ->delete($req->id);

        return redirect('sales/customer');
    }

}

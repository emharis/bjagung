<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SalesmanController extends Controller {


    // fungsi tampilkan halaman salesman
    public function index() {
        $data = \DB::table('VIEW_SALESMAN')
                ->orderBy('created_at', 'desc')
                ->get();

        return view('sales.salesman.salesman', [
            'data' => $data,
        ]);
    }

    // Fungsi add salesman/ tampilkan form add
    public function add(){
        return view('sales.salesman.addsalesman');
    }

    // Fungsi insert data ke database
    public function insert(Request $req){
        \DB::table('salesman')
            ->insert([
                    'nama'=>$req->nama,
                    'kode'=>$req->kode,
                    'user_id' => \Auth::user()->id
                ]);

        return redirect('sales/salesman');
    }

    // Fungsi Edit/ Tampilkan Form Edit
    public function edit($id){
        $data = \DB::table('VIEW_SALESMAN')->find($id);

        return view('sales.salesman.editsalesman',[
                'data' => $data,
            ]);
    }

    // Simpan perubahan data ke database
    public function update(Request $req){
        \DB::table('salesman')
            ->where('id',$req->id)
            ->update([
                    'nama' => $req->nama,
                    'kode' => $req->kode
                ]);

        return redirect('sales/salesman');
    }

    // Delete salesman dari dattabase
    public function delete(Request $req){
        \DB::table('salesman')
            ->delete($req->id);

        return redirect('sales/salesman');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SupplierController extends Controller {
    
    public function index() {
        $data = \DB::table('supplier')->orderBy('created_at','desc')->get();

        return view('master.supplier.index', [
            'data' => $data
        ]);
    }

    //insert new data supplier
    public function insert(Request $request) {
        $id = \DB::table('supplier')->insertGetId([
            'nama' => $request->input('nama'),
            'nama_kontak' => $request->input('nama_kontak'),
            'telp' => $request->input('telp'),
            'telp_2' => $request->input('telp_2'),
            'alamat' => $request->input('alamat'),
            'jatuh_tempo' => $request->input('jatuh_tempo'),
            'rek' => $request->input('rek'),
        ]);

        if (!$request->ajax()) {
            return redirect('master/supplier');
        }else{
            return json_encode(\DB::table('supplier')->find($id));
        }
    }

    //get data supplier
    public function getSupplier($id) {
        $data = \DB::table('supplier')->find($id);

        return json_encode($data);
    }

    //update data supplier
    public function updateSupplier(Request $request) {
        \DB::table('supplier')
                ->whereId($request->input('id'))
                ->update([
                    'nama' => $request->input('nama'),
                    'nama_kontak' => $request->input('nama_kontak'),
                    'telp' => $request->input('telp'),
                    'telp_2' => $request->input('telp_2'),
                    'alamat' => $request->input('alamat'),
                    'jatuh_tempo' => $request->input('jatuh_tempo'),
                    'rek' => $request->input('rek'),
        ]);

        if (!$request->ajax()) {
            return redirect('master/supplier');
        }else{
            return json_encode(\DB::table('supplier')->find($request->input('id')));
        }
    }

    //delete supplier
    public function deleteSupplier($id, Request $request) {
        \DB::table('supplier')->delete($id);

        if (!$request->ajax()) {
            return redirect('master/supplier');
        }
    }

}

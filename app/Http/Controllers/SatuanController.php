<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SatuanController extends Controller {

    public function index() {
        $data = \DB::table('VIEW_SATUAN')->orderBy('created_at','desc')->get();

        return view('master.satuan.index', [
            'data' => $data
        ]);
    }

    //insert new data satuan
    public function insert(Request $request) {
        $id = \DB::table('satuan')->insertGetId([
            'nama' => $request->input('nama')
        ]);

        if (!$request->ajax()) {
            return redirect('master/satuan');
        } else {
            return json_encode(\DB::table('satuan')->find($id));
        }
    }

    //get data satuan
    public function getSatuan($id) {
        $data = \DB::table('satuan')->find($id);

        return json_encode($data);
    }

    //update data satuan
    public function updateSatuan(Request $request) {
        \DB::table('satuan')
                ->whereId($request->input('id'))
                ->update([
                    'nama' => $request->input('nama')
        ]);

        if (!$request->ajax()) {
            return redirect('master/satuan');
        } else {
            return json_encode(\DB::table('satuan')->find($request->input('id')));
        }
    }

    //delete satuan
    public function deleteSatuan($id, Request $request) {
        \DB::table('satuan')->delete($id);

        if (!$request->ajax()) {
            return redirect('master/satuan');
        }
    }

}

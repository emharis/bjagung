<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SatuanController extends Controller
{
	public function index(){
		$data = \DB::table('satuan')->get();

		return view('master.satuan.index',[
				'data' => $data
			]);
	}

	//insert new data satuan
	public function insert(Request $request){
		\DB::table('satuan')->insert([
				'nama' => $request->input('nama')
			]);

		if (!$request->ajax()) {
            return redirect('master/satuan');
        }
	}
	
	//get data satuan
	public function getSatuan($id){
		$data = \DB::table('satuan')->find($id);
		
		return json_encode($data);
	}
	
	//update data satuan
	public function updateSatuan(Request $request){
		\DB::table('satuan')
			->whereId($request->input('id'))
			->update([
				'nama' => $request->input('nama')
			]);
			
		if (!$request->ajax()) {
            return redirect('master/satuan');
        }
	}
	
	//delete satuan
	public function deleteSatuan($id,Request $request){
		\DB::table('satuan')->delete($id);
		
		if (!$request->ajax()) {
            return redirect('master/satuan');
        }
	}
	
}

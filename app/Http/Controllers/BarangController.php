<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BarangController extends Controller
{
	public function index(){
		$data = \DB::table('barang')->get();

		return view('master.barang.index',[
				'data' => $data
			]);
	}

	//insert new data barang
	public function insert(Request $request){
		\DB::table('barang')->insert([
				'nama' => $request->input('nama')
			]);

		if (!$request->ajax()) {
            return redirect('master/barang');
        }
	}
	
	//get data barang
	public function getBarang($id){
		$data = \DB::table('barang')->find($id);
		
		return json_encode($data);
	}
	
	//update data barang
	public function updateBarang(Request $request){
		\DB::table('barang')
			->whereId($request->input('id'))
			->update([
				'nama' => $request->input('nama')
			]);
			
		if (!$request->ajax()) {
            return redirect('master/barang');
        }
	}
	
	//delete barang
	public function deleteBarang($id,Request $request){
		\DB::table('barang')->delete($id);
		
		if (!$request->ajax()) {
            return redirect('master/barang');
        }
	}
	
}

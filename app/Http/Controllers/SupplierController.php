<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
	public function index(){
		$data = \DB::table('supplier')->get();

		return view('master.supplier.index',[
				'data' => $data
			]);
	}

	//insert new data supplier
	public function insert(Request $request){
		\DB::table('supplier')->insert([
				'nama' => $request->input('nama'),
				'nama_kontak' => $request->input('nama_kontak'),
				'telp' => $request->input('telp'),
				'telp_2' => $request->input('telp_2'),
				'alamat' => $request->input('alamat'),
			]);

		if (!$request->ajax()) {
            return redirect('master/supplier');
        }
	}
	
	//get data supplier
	public function getSupplier($id){
		$data = \DB::table('supplier')->find($id);
		
		return json_encode($data);
	}
	
	//update data supplier
	public function updateSupplier(Request $request){
		\DB::table('supplier')
			->whereId($request->input('id'))
			->update([
				'nama' => $request->input('nama'),
				'nama_kontak' => $request->input('nama_kontak'),
				'telp' => $request->input('telp'),
				'telp_2' => $request->input('telp_2'),
				'alamat' => $request->input('alamat'),
			]);
			
		if (!$request->ajax()) {
            return redirect('master/supplier');
        }
	}
	
	//delete supplier
	public function deleteSupplier($id,Request $request){
		\DB::table('supplier')->delete($id);
		
		if (!$request->ajax()) {
            return redirect('master/supplier');
        }
	}
	
}

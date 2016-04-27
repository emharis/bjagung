<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SalesController extends Controller
{
	public function index(){
		$data = \DB::table('sales')->get();

		return view('master.sales.index',[
				'data' => $data
			]);
	}

	//insert new data sales
	public function insert(Request $request){
		\DB::table('sales')->insert([
				'nama' => $request->input('nama'),
				'telp' => $request->input('telp'),
				'telp_2' => $request->input('telp_2'),
				'alamat' => $request->input('alamat'),
			]);

		if (!$request->ajax()) {
            return redirect('master/sales');
        }
	}
	
	//get data sales
	public function getSales($id){
		$data = \DB::table('sales')->find($id);
		
		return json_encode($data);
	}
	
	//update data sales
	public function updateSales(Request $request){
		\DB::table('sales')
			->whereId($request->input('id'))
			->update([
				'nama' => $request->input('nama'),
				'telp' => $request->input('telp'),
				'telp_2' => $request->input('telp_2'),
				'alamat' => $request->input('alamat'),
			]);
			
		if (!$request->ajax()) {
            return redirect('master/sales');
        }
	}
	
	//delete sales
	public function deleteSales($id,Request $request){
		\DB::table('sales')->delete($id);
		
		if (!$request->ajax()) {
            return redirect('master/sales');
        }
	}
	
}

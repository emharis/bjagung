<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
	public function index(){
		$data = \DB::table('kategori')->get();

		return view('master.kategori.index',[
				'data' => $data
			]);
	}

	//insert new data kategori
	public function insert(Request $request){
		\DB::table('kategori')->insert([
				'nama' => $request->input('nama')
			]);

		if (!$request->ajax()) {
            return redirect('master/kategori');
        }
	}
	
	//get data kategori
	public function getKategori($id){
		$data = \DB::table('kategori')->find($id);
		
		return json_encode($data);
	}
	
	//update data kategori
	public function updateKategori(Request $request){
		\DB::table('kategori')
			->whereId($request->input('id'))
			->update([
				'nama' => $request->input('nama')
			]);
			
		if (!$request->ajax()) {
            return redirect('master/kategori');
        }
	}
	
	//delete kategori
	public function deleteKategori($id,Request $request){
		\DB::table('kategori')->delete($id);
		
		if (!$request->ajax()) {
            return redirect('master/kategori');
        }
	}
	
}

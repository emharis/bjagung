<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ManstokController extends Controller {

    public function index() {

        $barang = \DB::table('VIEW_STOK_BARANG')->orderBy('created_at', 'desc')->get();

        return view('setbar.manstok.index', [
            'data' => $barang
        ]);
    }

    public function setStok($id) {
        $barang = \DB::table('VIEW_STOK_BARANG')->find($id);

        $manual_stok = \DB::table('stok')
                ->whereTipe('M')
                ->where('barang_id', $id)
                ->orderBy('tgl', 'desc')
                ->get();

        return view('setbar.manstok.setstok', [
            'data' => $barang,
            'manual_stok' => $manual_stok,
        ]);
    }

    public function insert(Request $request) {
        \DB::transaction(function()use($request) {
            //Insert ke tabel stok

            $harga = str_replace(',', '', $request->input('harga'));
            $harga = str_replace('.', '', $harga);

            $id = \DB::table('stok')->insertGetId([
                'barang_id' => $request->input('barang_id'),
                'stok_awal' => $request->input('jumlah'),
                'current_stok' => $request->input('jumlah'),
                'tipe' => 'M',
                'harga' => $harga,
                'tgl' => date('Y-m-d', strtotime($request->input('tanggal')))
            ]);

            //insert ke stok_moving
            \DB::table('stok_moving')->insert([
                'stok_id' => $id,
                'jumlah' => $request->input('jumlah'),
                'tipe' => 'I',
            ]);

            if ($request->ajax()) {

                $data = \DB::table('VIEW_STOK')
                        ->find($id);
                echo json_encode($data);
            }
        });

        if (!$request->ajax()) {
            return redirect('setbar/manstok/set-stok/' . $request->input('barang_id'));
        }
    }

    public function delete($id) {
        $barangid = \DB::table('stok')->find($id)->barang_id;
        \DB::table('stok')->delete($id);
        return redirect('setbar/manstok/set-stok/' . $barangid);
    }
    
    //=========================================================================================
    //
    //
    //PENGATURAN HARGA BARANG    
    public function setHarga($id,Request $request){
        $barang = \DB::table('VIEW_STOK_BARANG')->find($id);
        
        $current_harga = \DB::table('harga_jual')->where('barang_id',$id)->orderBy('created_at','desc')->first();
        
        $harga_beli_terbaru = \DB::table('stok')->where('barang_id',$id)->orderBy('created_at','desc')->first();
        
        //menghitung HPP
        ////get hpp table
        $hpp_tab = \DB::select('select sum(stok_awal) as stok_awal,sum(total_harga) as total_harga,sum(total_harga)/sum(stok_awal) as hpp, 
                ceil(sum(total_harga)/sum(stok_awal)) as hpp_fix_up
                from VIEW_STOK
                where current_stok > 0
                and barang_id = ' . $id);
                
        $history_harga = \DB::table('harga_jual')
                            ->where('barang_id',$id)
                            ->orderBy('created_at','desc')
                            ->get();
        
        return view('setbar.manstok.setharga', [
            'data' => $barang,
            'current_harga' => $current_harga,
            'harga_beli_terbaru' => $harga_beli_terbaru,
            'hpp_tab' => $hpp_tab,
            'history_harga' => $history_harga,
        ]);
    }
    
    public function updateHarga(Request $request){
        
        \DB::transaction(function()use($request){
            //input harga barang ke table harga jual barang
            //normalisasi harga
            $harga_jual = str_replace(',', '', $request->input('harga_jual'));
            $harga_jual = str_replace('.', '', $harga_jual);
            
            $harga_beli = str_replace(',', '', $request->input('harga_beli'));
            $harga_beli = str_replace('.', '', $harga_beli);
            
            
            $hpp = str_replace(',', '', $request->input('hpp'));
            $hpp = str_replace('.', '', $hpp);
            
            //input kan harga barang terbaru
            $id  = \DB::table('harga_jual')->insertGetId([
                'barang_id' => $request->input('id'),
                'harga_jual' => $harga_jual,
                'harga_beli' => $harga_beli,
                'hpp' => $hpp,
            ]);
            
            // //update harga barang terbaru ke table barang
            // \DB::table('barang')->where('id',$request->input('id'))->update([
            //     'harga_jual_current' => $harga_jual
            // ]);
            
        });
        
        return redirect('setbar/manstok/set-harga/'.$request->input('id'));
        
    }
    
    public function deleteHarga($id,Request $request){
        $data_harga = \DB::table('harga_jual')->find($id);
        \DB::table('harga_jual')->delete($id);
        return redirect('setbar/manstok/set-harga/'.$data_harga->barang_id);
    }

//END OF CLASS
}

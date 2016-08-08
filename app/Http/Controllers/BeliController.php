<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BeliController extends Controller {

    public function index() {
        $data = \DB::table('VIEW_PEMBELIAN')->orderBy('tgl','desc')->get();

        return view('pembelian.beli.index', [
            'data' => $data
        ]);
    }

    //tampilkan halaman tambah barang
    public function add(){
    	$suppliers = \DB::table('supplier')->get();
        return view('pembelian.beli.add',[
        		'suppliers' => $suppliers
        	]);
    }

    public function getBarang(Request $request){
        // $barangs = \DB::table('VIEW_STOK_BARANG')->select('id as data','nama_full as value','kode','satuan as sat')
        //     ->where('nama_full','like','%'.$request->get('nama').'%')
        //     ->get();

        $barangs = \DB::select('select id as data,concat(kode," ", nama_full) as value,id,nama_full as nama, kode,satuan as sat
            from VIEW_STOK_BARANG 
            where stok > 0 
            and harga_jual_current > 0
            and (nama_full like "%'.$request->get('nama').'%"
            or kode like "%'.$request->get('nama').'%")');

        // $barangs['nama'] = $request->input('nama');
        $data_barang = ['query'=>'Unit','suggestions' => $barangs];
        echo json_encode($data_barang);
    }

    public function getBarangByKode(Request $request){
         $barangs = \DB::table('VIEW_STOK_BARANG')->select('id as data','nama_full as nama','kode as value','satuan as sat')
            ->where('kode','like','%'.$request->get('nama').'%')
            ->get();
        // $barangs['nama'] = $request->input('nama');
        $data_barang = ['query'=>'Unit','suggestions' => $barangs];
        echo json_encode($data_barang);
    }

    public function insert(Request $request){

        $grandTotal = 0;

        \DB::transaction(function()use($request,$grandTotal){
            //insert ke master pembelian
            $tgl = $request->input('tanggal');
            $arr_tgl = explode('-',$tgl);
            $_tgl = new \DateTime();
            $_tgl->setDate($arr_tgl[2],$arr_tgl[1],$arr_tgl[0]);

            $status = $request->input('tipe') == 'T' ? 'Y' : 'N';

            //insert into table beli
            $id = \DB::table('beli')->insertGetId([
                    'no_inv' => $request->input('no_inv'),
                    'tgl' => $_tgl,
                    'supplier_id' => $request->input('supplier'),
                    'tipe' => $request->input('tipe'),
                    'status' => $status,
                    'disc' => $request->input('disc'),
                ]);
            //insert detil barang
            $barang = json_decode($request->input('barang'));
            $total = 0;
            foreach($barang->barang as $dt){
                //input ke table beli_barang
                \DB::table('beli_barang')->insert([
                        'beli_id' => $id,
                        'barang_id' => $dt->id,
                        'qty' => $dt->qty,
                        'harga' => $dt->harga,
                        'total' => $dt->qty * $dt->harga
                    ]);
                $total += $dt->qty * $dt->harga;

                //inputkan ke tabel stok
                $stokid = \DB::table('stok')->insertGetId([
                        'tgl' => $_tgl,
                        'barang_id' =>$dt->id,
                        'stok_awal' =>$dt->qty,
                        'current_stok' =>$dt->qty,
                        'tipe' =>'B',
                        'harga' =>$dt->harga,
                        'beli_id' =>$id,
                    ]);

                //input ke stok_moving
                \DB::table('stok_moving')->insert([
                        'stok_id' => $stokid,
                        'jumlah' => $dt->qty,
                        'tipe' => 'I',
                    ]);

                //hitung grand total
                $grandTotal = $total - $request->input('disc');
                //update table beli
            
                \DB::table('beli')->whereId($id)->update([
                        'total' => $total,
                        'grand_total' => $grandTotal,
                    ]);

                //jika poembayaran adalah kredit/tempo maka masukkan ke table hutang
                if($request->input('tipe') == 'K'){
                    $hutang_id = \DB::table('hutang')->insertGetId([
                            'beli_id' => $id,
                            'supplier_id' => $request->input('supplier'),
                            'grand_total' => $grandTotal,
                            'sisa_bayar' => $grandTotal,
                        ]);
                }
            }
           

        //end of insert transaction    
        });

        if (!$request->ajax()) {
            return redirect('pembelian/beli');
        } else {
            // return json_encode(\DB::table('customer')->find($id));
        }

    //==================================================================    
    //END OF INSERT METHOD
    }

    public function show($id,Request $request){
        $master_beli = \DB::table('VIEW_PEMBELIAN')->find($id);
        $barang = \DB::table('VIEW_BELI_BARANG')->where('beli_id',$id)->get();

        $data_arr = '{"master":"","barang":[]}';
        $data = json_decode($data_arr);
        $data->master = $master_beli;
        $data->barang = $barang;

        echo json_encode($data);
    }
    
    //edit data pembelian
    public function edit($id, Request $request){
        $beli = \DB::table('VIEW_PEMBELIAN')->find($id);
        $beli_barang = \DB::table('VIEW_BELI_BARANG')->where('beli_id',$id)->get();
        $suppliers = \DB::table('supplier')->get();

        $beli_barang_json = \DB::table('beli_barang')->select('barang_id as id','qty','harga')->where('beli_id',$id)->get();
        $data_arr = '{"barang":[]}';
        $data_json = json_decode($data_arr);
        $data_json->barang = $beli_barang_json;

        return view('pembelian.beli.edit',[
                'beli' => $beli, 
                'beli_barang' => $beli_barang,
                'suppliers' => $suppliers,
                'data_barang_json' => json_encode($data_json)
            ]);
    }

    //simpan edit
    public function update(Request $request){
        \DB::transaction(function()use($request){
            //insert ke master pembelian
            $tgl = $request->input('tanggal');
            $arr_tgl = explode('-',$tgl);
            $_tgl = new \DateTime();
            $_tgl->setDate($arr_tgl[2],$arr_tgl[1],$arr_tgl[0]);
            $barang = json_decode($request->input('barang'))->barang;
            $beli_id = $request->id_pembelian;

            // $status = $request->input('tipe') == 'T' ? 'Y' : 'N';

            //hapus data lama
            ////hapus data hutang
            \DB::table('hutang')->where('beli_id',$beli_id)->delete();
            ////hapus stok & stok_moving
            \DB::table('stok')->where('beli_id',$beli_id)->delete();
            ////hapus beli barang
            \DB::table('beli_barang')->where('beli_id',$beli_id)->delete();


            //insert data terbaru
            // $barang = json_decode($request->input('barang'));
            $total = 0;
            foreach($barang as $dt){
                //input ke table beli_barang
                \DB::table('beli_barang')->insert([
                        'beli_id' => $beli_id,
                        'barang_id' => $dt->id,
                        'qty' => $dt->qty,
                        'harga' => $dt->harga,
                        'total' => $dt->qty * $dt->harga
                    ]);
                $total += $dt->qty * $dt->harga;

                //inputkan ke tabel stok
                $stokid = \DB::table('stok')->insertGetId([
                        'tgl' => $_tgl,
                        'barang_id' =>$dt->id,
                        'stok_awal' =>$dt->qty,
                        'current_stok' =>$dt->qty,
                        'tipe' =>'B',
                        'harga' =>$dt->harga,
                        'beli_id' =>$beli_id,
                    ]);

                //input ke stok_moving
                \DB::table('stok_moving')->insert([
                        'stok_id' => $stokid,
                        'jumlah' => $dt->qty,
                        'tipe' => 'I',
                    ]);

                //hitung grand total
                $grandTotal = $total - $request->input('disc');

                //update table beli            
                \DB::table('beli')->whereId($beli_id)->update([
                        'total' => $total,
                        'disc' => $request->input('disc'),
                        'grand_total' => $grandTotal,
                    ]);

                //jika poembayaran adalah kredit/tempo maka masukkan ke table hutang
                if($request->input('tipe') == 'K'){
                    $hutang_id = \DB::table('hutang')->insertGetId([
                            'beli_id' => $beli_id,
                            'supplier_id' => $request->input('supplier'),
                            'grand_total' => $grandTotal,
                            'sisa_bayar' => $grandTotal,
                        ]);
                }
            }

            // //get data pembelian
            // $beli_on_db = \DB::table('beli')->find($request->id_pembelian);
            // $beli_barang_on_db = \DB::table('beli_barang')->where('beli_id',$beli_on_db->id)->get();
            // $stok_on_db = \DB::table('stok')->where('beli_id',$beli_on_db->id)->get();

            // foreach($beli_barang_on_db as $blbr){
            //     $adakah = false;
            //     $barang_id = null;
            //     $barang_index = null;
            //     $row_index = 0;
            //     foreach($barang as $br){
            //         if($br->id == $blbr->barang_id){
            //             $adakah = true;
            //             $barang_id = $br->id;
            //             $barang_index = $row_index;
            //         }
            //         $row_index++;
            //     }

            //     if($adakah){
            //         //jika ada di database maka di cek jumlah qty, harga satuan, jika berbeda harus di  rubah
            //         //langsung rubah qty, harga satuan, total
            //         // \DB::table('beli_barang')->where('id',$blbr->id)->update([
            //         //         'qty'=>$barang[$barang_index]->qty,
            //         //         'harga'=>'',
            //         //         'total'=>'',
            //         //     ]);

            //          echo 'update data beli_barang ' . $barang[$barang_index]->qty . ' ' . $barang[$barang_index]->harga . '<br/>'; 
            //     }else{
                    
            //     }
            // }
           

            // echo var_dump($barang);

            // $id = \DB::table('beli')->insertGetId([
            //         'no_inv' => $request->input('no_inv'),
            //         'tgl' => $_tgl,
            //         'supplier_id' => $request->input('supplier'),
            //         'tipe' => $request->input('tipe'),
            //         'status' => $status,
            //         'disc' => $request->input('disc'),
            //     ]);
            // //insert detil barang
            // 
            // $total = 0;
            // foreach($barang->barang as $dt){
            //     //input ke table beli_barang
            //     \DB::table('beli_barang')->insert([
            //             'beli_id' => $id,
            //             'barang_id' => $dt->id,
            //             'qty' => $dt->qty,
            //             'harga' => $dt->harga,
            //             'total' => $dt->qty * $dt->harga
            //         ]);
            //     $total += $dt->qty * $dt->harga;

            //     //inputkan ke tabel stok
            //     $stokid = \DB::table('stok')->insertGetId([
            //             'tgl' => $_tgl,
            //             'barang_id' =>$dt->id,
            //             'stok_awal' =>$dt->qty,
            //             'current_stok' =>$dt->qty,
            //             'tipe' =>'B',
            //             'harga' =>$dt->harga,
            //             'beli_id' =>$id,
            //         ]);

            //     //input ke stok_moving
            //     \DB::table('stok_moving')->insert([
            //             'stok_id' => $stokid,
            //             'jumlah' => $dt->qty,
            //             'tipe' => 'I',
            //         ]);

            //     //hitung grand total
            //     $grandTotal = $total - $request->input('disc');
            //     //update table beli
            
            //     \DB::table('beli')->whereId($id)->update([
            //             'total' => $total,
            //             'grand_total' => $grandTotal,
            //         ]);

            //     //jika poembayaran adalah kredit/tempo maka masukkan ke table hutang
            //     if($request->input('tipe') == 'K'){
            //         $hutang_id = \DB::table('hutang')->insertGetId([
            //                 'beli_id' => $id,
            //                 'supplier_id' => $request->input('supplier'),
            //                 'grand_total' => $grandTotal,
            //                 'sisa_bayar' => $grandTotal,
            //             ]);
            //     }
            // }
           

        //end of insert transaction    
        });

        if (!$request->ajax()) {
            return redirect('pembelian/beli');
        } else {
            // return json_encode(\DB::table('customer')->find($id));
        }
    }

    //Hapus data pembelian
    public function delete($id,Request $request){
        \DB::transaction(function()use($id){
            //get data pembelian
            $pembelian = \DB::table('beli')->find($id);
            //hapus data hutang dan otomatis data cicil akan ikut terhapus jika ada 
            \DB::table('hutang')->where('beli_id',$id)->delete();
            //hapus data stok dan otomatis data stok moving akan terhapus
            \DB::table('stok')->where('beli_id',$id)->delete();
            //hapus data pembelian
            \DB::table('beli')->delete($id);
        });

        return redirect('pembelian/beli');
    }

//==================================================================================
//end of code
}

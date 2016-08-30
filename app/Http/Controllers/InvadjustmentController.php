<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class InvadjustmentController extends Controller {

    // fungsi tampilkan halaman inventory adjustment
    public function index() {
        $data = \DB::table('inventory_adjustment')
                    ->orderBy('created_at','desc')
                    ->get();
        return view('inventory.adjustment.adjustment', [
            'data' => $data
        ]);
    }

    // tampilkan form add
    public function add(){
        $barang = \DB::table('VIEW_BARANG')->get();

        return view('inventory.adjustment.addadjustment',[
                'barang' => $barang
            ]);
    }

    // save iventory adjustment as draft and start inventory
    public function insert(Request $req){
        // generrate tanggal
        $tgl = $req->tanggal;
        $arr_tgl = explode('-',$tgl);
        $_tgl = new \DateTime();
        $_tgl->setDate($arr_tgl[2],$arr_tgl[1],$arr_tgl[0]);

        // simpan ke table inventory_adjustment
        $id = \DB::table('inventory_adjustment')->insertGetId([
                'inventory_reference' => $req->nama, 
                'inventory_of' => $req->inventory_of, 
                'product_of' => $req->product_of, 
                'barang_id' => $req->id_barang,
                'tgl' => $_tgl,
                'user_id' => \Auth::user()->id
            ]);

        // tampilkan form start inventory
        return redirect('inventory/adjustment/edit/'.$id);
    }

    // get data barang
    public function getBarang(Request $request){
        $barangs = \DB::select('select id as data,kode,nama,kategori,nama_full as value
            from VIEW_BARANG
            where (nama_full like "%'.$request->get('nama').'%")');
        
        $data_barang = ['query'=>'Unit','suggestions' => $barangs];
        echo json_encode($data_barang);
    }

    // tampilkan form edit
    public function edit($id){
        $adjustment_data = \DB::table('inventory_adjustment')->find($id);
        $barang = null;
        if($adjustment_data->inventory_of == 'O'){
            $barang = \DB::table('VIEW_BARANG')->find($adjustment_data->barang_id);
        }

        // jika barang sudah tervalidasi maka tampilkan halaman validated
        if($adjustment_data->status == 'V'){
            return redirect('inventory/adjustment/show-validated/' . $id);
        }elseif($adjustment_data->status == 'P'){
            // tampilkan view in progress
            return redirect('inventory/adjustment/edit-start-inventory/' . $id);
        }else{
            return view('inventory/adjustment/editadjustment',[
                'data' => $adjustment_data,
                'barang' => $barang
            ]);    
        }

        
    }

    // update data inventory adjustment on draft state
    public function update(Request $req){
        // generrate tanggal
        $tgl = $req->tanggal;
        $arr_tgl = explode('-',$tgl);
        $_tgl = new \DateTime();
        $_tgl->setDate($arr_tgl[2],$arr_tgl[1],$arr_tgl[0]);

        \DB::table('inventory_adjustment')
            ->where('id',$req->id)
            ->update([
                    'inventory_reference' => $req->nama, 
                    'inventory_of' => $req->inventory_of, 
                    'product_of' => $req->product_of, 
                    'barang_id' => $req->id_barang,
                    'tgl' => $_tgl,
                ]);

        return redirect()->back();
    }

    // Hapus Data Adjustment\
    public function delete(Request $req){
        return \DB::transaction(function()use($req){
            // delete data adjustment detail
            \DB::table('inventory_adjustment_detail')
            ->where('inventory_adjustment_id',$req->adjustment_id)
            ->delete();
            // delete data adjustment
            \DB::table('inventory_adjustment')->delete($req->adjustment_id);

            return redirect('inventory/adjustment');
        });
    }

    // start inventory
    public function start($id){
        $adjustment_data = \DB::table('inventory_adjustment')->find($id);

        return view('inventory/adjustment/start_initial_stock_all',[
            'adjustment_data' => $adjustment_data,
            'barang' => \DB::table('VIEW_STOK_BARANG')->get()
        ]);

        // if($adjustment_data->inventory_of == 'I'){
        //     if($adjustment_data->product_of == 'A'){
        //         // initial stock -> All Product
        //         return view('inventory/adjustment/start_initial_stock_all',[
        //                 'adjustment_data' => $adjustment_data,
        //                 'barang' => \DB::table('VIEW_STOK_BARANG')->get()
        //             ]);
        //     }            
        // }

        // if($adjustment_data->product_of == 'A'){
        //     // start inventory All Barang
        //     $barang = \DB::table('VIEW_STOK_BARANG')->get();

        //     return view('inventory/adjustment/startinventoryall',[
        //         'adjustment_data' => $adjustment_data,
        //         'barang' => $barang
        //     ]);
        // }else{
        //     return view('inventory/adjustment/startinventory',[
        //         'adjustment_data' => $adjustment_data
        //     ]);
        // }

    }

    public function saveStart(Request $req){
        return \DB::transaction(function()use($req){

            // delete data inventory_adjustment_detail yang lama
            \DB::table('inventory_adjustment_detail')
                ->where('inventory_adjustment_id',$req->inventory_adjustment_id)
                ->delete();

            // insert into inventory_adjustment_detail
            if($req->barang){
                foreach($req->barang as $dt){
                    \DB::table('inventory_adjustment_detail')
                        ->insert([
                                'user_id' => \Auth::user()->id,
                                'inventory_adjustment_id' => $req->inventory_adjustment_id,
                                'barang_id' => $dt,
                                'theoretical_qty' => $req->input('theo_qty_' . $dt),
                                'real_qty' => $req->input('real_qty_' . $dt),
                                'cost' => str_replace(".","",str_replace(",", "", $req->input('cost_' . $dt))),
                            ]);
                }
            }

            // update status inventory_adjustment ke in progress
            \DB::table('inventory_adjustment')
                ->where('id',$req->inventory_adjustment_id)
                ->update([
                        'status' => 'P'
                    ]);

            // redirect return ke halaman edit start
            return redirect('inventory/adjustment/edit-start-inventory/' . $req->inventory_adjustment_id);
        });
        // echo 'save start iventory <br/>';        
    }

    public function editStartInventory($inventory_adjustment_id){
        $adjustment_data = \DB::table('inventory_adjustment')->find($inventory_adjustment_id);
        $barang = \DB::select("select VIEW_STOK_BARANG.*,tb_inv.theoretical_qty,tb_inv.real_qty,
                        tb_inv.cost from 
                        VIEW_STOK_BARANG left join 
                        ( select * from inventory_adjustment_detail where 
                            inventory_adjustment_detail.inventory_adjustment_id = " . $inventory_adjustment_id . ") as tb_inv
                        on VIEW_STOK_BARANG.id  = tb_inv.barang_id");

        return view('inventory/adjustment/edit_start_initial_stock',[
            'adjustment_data' => $adjustment_data,
            'barang' => $barang
        ]);
    }

    public function cancelInventory($id){
        // echo 'Cancel Inventory';
        return \DB::transaction(function()use($id){
            // hapus data di inventory_adjustment_detail
            \DB::table('inventory_adjustment_detail')
                ->where('inventory_adjustment_id',$id)
                ->delete();
            // ganti status ke draft
            \DB::table('inventory_adjustment')
            ->where('id',$id)
            ->update([
                    'status' => 'D'
                ]);

            return redirect('inventory/adjustment/edit-start-inventory/'.$id);
        });
    }

    public function validateInventory($inventory_adjustment_id){
        return \DB::transaction(function()use($inventory_adjustment_id){
            // update status ke VALIDATED
            \DB::table('inventory_adjustment')
                ->where('id',$inventory_adjustment_id)
                ->update([
                        'status' => 'V'
                    ]);

            // inputkan data stok ke table stok dan stok moving
            // inputkan ke table stok
            $adj_detail = \DB::table('inventory_adjustment_detail')
                        ->where('inventory_adjustment_id',$inventory_adjustment_id)
                        ->get();

            foreach($adj_detail as $dt){
                $stok_id = \DB::table('stok')->insertGetId([
                    'barang_id' => $dt->barang_id,
                    'stok_awal' => $dt->real_qty,
                    'current_stok' => $dt->real_qty,
                    'tipe' => 'M',
                    'harga' => $dt->cost,
                    'user_id' => \Auth::user()->id,
                    'tgl' => \DB::raw('now()'),
                ]);

                // input ke table stok moving
                \DB::table('stok_moving')
                    ->insert([
                            'user_id' => \Auth::user()->id,
                            'stok_id' => $stok_id,
                            'jumlah' => $dt->real_qty,
                            'tipe' => 'I',
                            'inventory_adjustment_detail_id'  => $dt->id,       
                        ]);


            }
                    
            return redirect('inventory/adjustment/show-validated/' . $inventory_adjustment_id);
        });
        
    }

    public function showValidatedPage($inventory_adjustment_id){
        $adjustment_data = \DB::table('inventory_adjustment')->find($inventory_adjustment_id);
                $barang = \DB::select("select VIEW_STOK_BARANG.*,inventory_adjustment_detail.inventory_adjustment_id,inventory_adjustment_detail.theoretical_qty,inventory_adjustment_detail.real_qty,inventory_adjustment_detail.cost 
        from inventory_adjustment_detail 
        inner join VIEW_STOK_BARANG 
        on inventory_adjustment_detail.barang_id = VIEW_STOK_BARANG.id
        where inventory_adjustment_detail.inventory_adjustment_id = " . $inventory_adjustment_id );

        return view('inventory/adjustment/validated',[
            'adjustment_data' => $adjustment_data,
            'barang' => $barang
        ]);
    }

}

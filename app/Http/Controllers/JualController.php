<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class JualController extends Controller {

    public function index() {
        // $data = \DB::table('VIEW_PEMBELIAN')->orderBy('tgl','desc')->get();
// date_format(`b`.`tgl`,'%d-%m-%Y') AS `tgl_formatted`
        $jual = \DB::table('view_jual')
                    ->orderBy('created_at','desc')->get();

        return view('penjualan.jual.index', [
            'jual' => $jual
        ]);
    }

    //Penjualan/POS
    public function pos(){
        //buat tanggal dalam format indonesia
        $day = date('N');
        $hari = "";
        if($day == 1){
            $hari = "Senin";
        }else if($day == 2){
            $hari = "Selasa";
        }else if($day == 3){
            $hari = "Rabu";
        }else if($day == 4){
            $hari = "Kamis";
        }else if($day == 5){
            $hari = "Jumat";
        }else if($day == 6){
            $hari = "Sabtu";
        }else if($day == 7){
            $hari = "Minggu";
        }
        $tgl_indo = $hari . ", ". date('d-m-Y');

        return view('penjualan.jual.pos',[
                'tgl_indo' => $tgl_indo
            ]);
    }

    //get data barang JSON
    public function getBarang(Request $request){
        // $barangs = \DB::table('VIEW_STOK_BARANG')
            // ->select('id as data',\DB::raw('concat(kode," ", nama_full) as value'),'id','nama_full as nama','kode',
            //             'satuan as sat','harga_jual_current','stok')
            // ->where('nama_full','like','%'.$request->get('nama').'%')
            // ->orWhere('kode','like','%'.$request->get('nama').'%')
            // //dan select data yang stok > 0 dan telah di set harga jual
            // ->where('stok','>',0)
            // ->where('harga_jual_current','>',0)
            // ->get();

            $barangs = \DB::select('select id as data,concat(kode," ", nama_full) as value,id,nama_full as nama,
                kode,satuan as sat,harga_jual_current,stok 
                from VIEW_STOK_BARANG 
                where stok > 0 
                and harga_jual_current > 0
                and (nama_full like "%'.$request->get('nama').'%"
                or kode like "%'.$request->get('nama').'%")');
        // $barangs['nama'] = $request->input('nama');
        $data_barang = ['query'=>'Unit','suggestions' => $barangs];
        echo json_encode($data_barang);
    }


    //get data barang by kode return JSON
    public function getBarangByKode(Request $request){
         $barangs = \DB::table('VIEW_STOK_BARANG')
            ->select('id as data','id','kode','nama_full as nama','kode as value','satuan as sat',
                        'harga_jual_current','stok')
            ->where('kode','like','%'.$request->get('nama').'%')
            ->where('stok','>',0)
            ->where('harga_jual_current','>',0)
            ->get();
        // $barangs['nama'] = $request->input('nama');
        $data_barang = ['query'=>'Unit','suggestions' => $barangs];

        echo json_encode($data_barang);
    }

    public function getSalesman(Request $request){
        $salesman = \DB::table('sales')
            ->select('id as data',\DB::raw('concat(kode, " - ", nama) as value'))
            ->where('nama','like','%'.$request->get('nama').'%')
            ->orWhere('kode','like','%'.$request->get('nama').'%')
            ->get();
        $data_salesman = ['query'=>'Unit','suggestions' => $salesman];

        echo json_encode($data_salesman);
    }

    public function getCustomer(Request $request){
        $customer = \DB::table('customer')
                    ->select('id as data','nama as value')
                    ->where('nama','like','%'.$request->get('nama').'%')
                    ->get();
        $data_customer = ['query'=>'Unit','suggestions' => $customer];

        return json_encode($data_customer);
    }

    //save penjualan
    public function insert(Request $request){
        // echo 'input data penjualan <br/>';
        // echo $request->input('customer') . '<br/>';
        // echo $request->input('salesman') . '<br/>';
        // echo $request->input('tanggal') . '<br/>';
        // echo $request->input('pembayaran') . '<br/>';
        // echo $request->input('disc') . '<br/>';
        // echo $request->input('barang') . '<br/>';



        \DB::transaction(function()use($request){

            //generate tanggal
            $tgl = $request->input('tanggal');
            $arr_tgl = explode('-',$tgl);
            $_tgl = new \DateTime();
            $_tgl->setDate($arr_tgl[2],$arr_tgl[1],$arr_tgl[0]);

            //generatre no invoice penjualan
            $sales = \DB::table('sales')->find($request->input('salesman'));
            $penjualan_counter = \DB::table('appsetting')
                                ->whereName('penjualan_counter')
                                ->first();
            $no_inv = $sales->kode . '/' . $arr_tgl[0] . $arr_tgl[1] . '0'.$penjualan_counter->value;
            //update penjualan counter
            \DB::table('appsetting')
                                ->whereName('penjualan_counter')
                                ->update([
                                        'value' => $penjualan_counter->value + 1
                                    ]);

            //input table jual
            $jual_id = \DB::table('jual')
                            ->insertGetId([
                                    'tgl' => $_tgl,
                                    'customer_id' => $request->input('customer'),
                                    'sales_id' => $request->input('salesman'),
                                    'disc' => $request->input('disc'),
                                    'tipe' => $request->input('pembayaran'),
                                    'total' => $request->input('total'),
                                    'grand_total' => $request->input('grand_total'),
                                    'no_inv' => $no_inv,
                                ]);

            $barang = json_decode($request->input('barang'));

            //input detil barang
            foreach($barang->barang as $dt){
                //insert ke table jual_barang
                \DB::table('jual_barang')->insert([
                        'jual_id' => $jual_id,
                        'barang_id' => $dt->id,
                        'qty' => $dt->qty,
                        'harga_satuan' => $dt->harga_satuan,
                        'harga_salesman' => $dt->harga_salesman,
                        'total' => $dt->harga_salesman * $dt->qty,
                    ]);

                //Pengurangan/Update data STOK
                $stoks = \DB::table('stok')
                            ->where('barang_id',$dt->id)
                            ->where('current_stok','>',0)
                            ->orderBy('created_at','asc')
                            ->get();

                $qty_barang_di_jual = $dt->qty;

                foreach($stoks as $st){ 

                    if($qty_barang_di_jual > 0 ){

                        if($st->current_stok == $qty_barang_di_jual ){
                            //input ke stok moving
                            \DB::table('stok_moving')->insert([
                                    'stok_id' => $st->id,
                                    'jumlah' => $qty_barang_di_jual,
                                    'tipe' => 'O',
                                    'jual_id' => $jual_id
                                ]);
                            //update stok current
                            \DB::table('stok')->whereId($st->id)->update([
                                    'current_stok' => 0 
                                ]);
                            $qty_barang_di_jual = 0;
                        }else if($st->current_stok > $qty_barang_di_jual){
                            //input ke stok moving
                            \DB::table('stok_moving')->insert([
                                    'stok_id' => $st->id,
                                    'jumlah' => $qty_barang_di_jual,
                                    'tipe' => 'O',
                                    'jual_id' => $jual_id
                                ]);
                            //update stok current
                            $sisa_stok = $st->current_stok;
                            \DB::table('stok')->whereId($st->id)->update([
                                    'current_stok' => ($st->current_stok - $qty_barang_di_jual)  
                                ]);
                            $qty_barang_di_jual = 0;
                        }else{
                            //input ke stok moving
                            \DB::table('stok_moving')->insert([
                                    'stok_id' => $st->id,
                                    'jumlah' => $st->current_stok,
                                    'tipe' => 'O',
                                    'jual_id' => $jual_id
                                ]);
                            //update stok current
                            $sisa_stok = $st->current_stok;
                            \DB::table('stok')->whereId($st->id)->update([
                                    'current_stok' => 0
                                ]);
                            $qty_barang_di_jual = $qty_barang_di_jual - $st->current_stok;
                        }
                    }
                //END OF FOREACH STOK
                }

            //END OF FOREACH INSERT DETIL BARANG
            }


            if($request->input('pembayaran') == 'K'){
                //masukkan daftar piutang
                \DB::table('piutang')->insert([
                        'jual_id' => $jual_id,
                        'customer_id' => $request->input('customer'),
                        'total' => $request->input('total') - $request->input('disc'),
                        'sisa_bayar' => $request->input('total') - $request->input('disc'),
                    ]);
            }

        //END OF TRANSACTION INSERT JUAL
        });

        echo 'Penjualan Sukses';

        return redirect('penjualan/jual/pos');
    }


    //GET DATA PENJUALAN
    public function getJual($id){
        $jual = \DB::table('VIEW_JUAL')->find($id);
        return json_encode($jual);
    }

    //GET DATA DETIL PENJUALAN
    public function getJualBarang($jual_id){
        $jual_barang = \DB::table('VIEW_JUAL_BARANG')->where('jual_id',$jual_id)->get();
        return json_encode($jual_barang);
    }

//==================================================================================
//END OF CODE JualController.php
}

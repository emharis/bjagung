<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PurchaseOrderController extends Controller {


    // fungsi tampilkan halaman purchase order
    public function index() {
        $data = \DB::table('VIEW_BELI')->orderBy('tgl','desc')->get();
        return view('purchase.order.order', [
            'data' => $data,
        ]);
    }

    // TAMPILKAN HALAMAN ADD PURCHASE ORDER
    public function add(){
        return view('purchase.order.orderadd');
    }
    // END OF TAMPILKAN HALAMAN ADD PURCHASE ORDER

    // GET DATA SUPPLIER
    public function getSupplier(Request $req){
        $data = \DB::select('select id as data,nama as value , jatuh_tempo
                from supplier
                where nama like "%'.$req->get('nama').'%"');
        
        $data_res = ['query'=>'Unit','suggestions' => $data];
        echo json_encode($data_res);   
    }
    // END OF GET DATA SUPPLIER

    // GET DATA PRODUCT
    public function getProduct(Request $req){
        $data = "default";

        if($req->exceptdata){
            $exceptdata = json_decode($req->exceptdata);
            $except_data_string   = "0";
            // foreach($exceptdata->barangid as $dt){
            //     $except_data_string = $except_data_string .$dt . ',';
            // }

            for($i=0;$i<count($exceptdata->barangid);$i++){
                if($i < count($exceptdata->barangid)-1 ){
                    $except_data_string = $except_data_string . ",";
                }
                
                $except_data_string = $except_data_string .  $exceptdata->barangid[$i];
                
            }

            // $data = \DB::select('select id as data,nama_full as value,kode
            //     from VIEW_STOK_BARANG
            //     where nama_full like "%'.$req->get('nama').'%" and id not in (' . $except_data_string . ')');

            // $data = \DB::select('select id as data,nama_full as value,kode
            //     from VIEW_STOK_BARANG
            //     where nama_full like "%'. $req->get('nama') .'%" and id not in (' . $except_data_string . ')' );
            // echo 'ok';

            $data = \DB::select('select id as data,nama_full as value,kode
                from VIEW_STOK_BARANG
                where nama_full like "%'. $req->get('nama') .'%" and id not in (' . $except_data_string . ')' ) ;
        }else{
            $data = \DB::select('select id as data,nama_full as value,kode
                from VIEW_STOK_BARANG
                where nama_full like "%'.$req->get('nama').'%"');    

            // $data = 'select id as data,nama_full as value,kode
            //     from VIEW_STOK_BARANG
            //     where nama_full like "%'.$req->get('nama').'%"';    
            // echo 'preketek';
        }
        
        
        $data_res = ['query'=>'Unit','suggestions' => $data];
        echo json_encode($data_res);

        

        // substr_replace(",", "",  $except_data_string);

        // echo $except_data_string;
    }
    // END OF GET DATA PRODUCT

    // INSERT PURCHASE ORDER
    public function insert(Request $req){
        // echo 'insert open po <br/>';
        // echo $req->po_master . '<br/>';
        // echo $req->po_barang . '<br/>';

        // foreach($po_barang->barang as $dt){
        //     echo $dt->id . ' -- ' . $dt->qty . ' --- ' . $dt->unit_price . '<br>';
        // }

        return \DB::transaction(function()use($req){
            $po_master = json_decode($req->po_master);
            $po_barang = json_decode($req->po_barang);

            // get po_counter
            $po_counter = \DB::table('appsetting')->where('name','po_counter')->first();

            // generate tanggal
            //generate tanggal
            $tgl = $po_master->tanggal;
            $arr_tgl = explode('-',$tgl);
            $fix_tgl = new \DateTime();
            $fix_tgl->setDate($arr_tgl[2],$arr_tgl[1],$arr_tgl[0]);

            $tgl_jatuh_tempo = $po_master->jatuh_tempo;
            $arr_tgl = explode('-',$tgl_jatuh_tempo);
            $fix_tgl_jatuh_tempo = new \DateTime();
            $fix_tgl_jatuh_tempo->setDate($arr_tgl[2],$arr_tgl[1],$arr_tgl[0]);

            // input ke table beli/po_master
            $po_master_id = \DB::table('beli')->insertGetId([
                    'po_num' => 'PO00' . $po_counter->value,
                    'no_inv' => $po_master->no_inv,
                    'tgl' => $fix_tgl,
                    'jatuh_tempo' => $fix_tgl_jatuh_tempo,
                    'supplier_id' => $po_master->supplier_id,
                    // 'disc' => $po_master->disc,
                    'disc' => 0,
                    'status' => 'O',
                    'note' => $po_master->note,
                    'subtotal' => $po_master->subtotal,
                    'disc' => $po_master->disc,
                    'total' => $po_master->total,
                    'user_id' => \Auth::user()->id
                ]);

            // input ke table po_barang / beli_barang
            foreach($po_barang->barang as $dt){
                \DB::table('beli_barang')
                    ->insert([
                            'beli_id' => $po_master_id,
                            'barang_id' => $dt->id,
                            'qty' => $dt->qty,
                            'harga' => $dt->unit_price,
                            'subtotal' => $dt->subtotal,
                            'user_id' => \Auth::user()->id
                        ]);
            }

            // update PO_Counter
            \DB::table('appsetting')->where('name','po_counter')->update([
                    'value' => ($po_counter->value + 1)
                ]);

            return redirect('purchase/order/edit/' . $po_master_id);
        });

    }
    // END OF PURCHASE ORDER

    // EDIT PURCHASE ORDER
    public function edit($id){
        // echo 'edit purchase order';
        $po_master = \DB::table('VIEW_BELI')->find($id);
        $po_barang = \DB::table('VIEW_BELI_BARANG')->where('beli_id',$id)->get();

        if($po_master->status == "V"){
            return view('purchase.order.ordervalidated',[
                'po_master' => $po_master,
                'po_barang' => $po_barang,
            ]);
        }else{
            return view('purchase.order.orderedit',[
                'po_master' => $po_master,
                'po_barang' => $po_barang,
            ]);    
        }

        
    }
    // END OF EDIT PURCHASE ORDER


    // UPDATE PURCHASE ORDER
    public function update(Request $req){
        echo 'Update Purchase Order';

        return \DB::transaction(function()use($req){
            // update po_master
            $po_master = json_decode($req->po_master);
            $po_barang = json_decode($req->po_barang);

            // get po_counter
            // $po_counter = \DB::table('appsetting')->where('name','po_counter')->first();

            // generate tanggal
            //generate tanggal
            $tgl = $po_master->tanggal;
            $arr_tgl = explode('-',$tgl);
            $fix_tgl = new \DateTime();
            $fix_tgl->setDate($arr_tgl[2],$arr_tgl[1],$arr_tgl[0]);

            $tgl_jatuh_tempo = $po_master->jatuh_tempo;
            $arr_tgl = explode('-',$tgl_jatuh_tempo);
            $fix_tgl_jatuh_tempo = new \DateTime();
            $fix_tgl_jatuh_tempo->setDate($arr_tgl[2],$arr_tgl[1],$arr_tgl[0]);

            // update ke table beli/po_master
            \DB::table('beli')
                ->where('id',$po_master->id)
                ->update([
                    'no_inv' => $po_master->no_inv,
                    'tgl' => $fix_tgl,
                    'jatuh_tempo' => $fix_tgl_jatuh_tempo,
                    'supplier_id' => $po_master->supplier_id, 
                    'disc' => $po_master->disc,
                    'status' => 'O',
                    'note' => $po_master->note,
                    'subtotal' => $po_master->subtotal,
                    'disc' => $po_master->disc,
                    'total' => $po_master->total
                ]);

            // hapus barang yang lama dari table beli_barang
            \DB::table('beli_barang')
                ->where('beli_id',$po_master->id)
                ->delete();

            // input ke table po_barang / beli_barang
            foreach($po_barang->barang as $dt){
                \DB::table('beli_barang')
                    ->insert([
                            'beli_id' => $po_master->id,
                            'barang_id' => $dt->id,
                            'qty' => $dt->qty,
                            'harga' => $dt->unit_price,
                            'subtotal' => $dt->subtotal
                        ]);
            }

            // // update PO_Counter
            // \DB::table('appsetting')->where('name','po_counter')->update([
            //         'value' => ($po_counter->value + 1)
            //     ]);

            return redirect('purchase/order/edit/' . $po_master->id);
        });
    }
    // END OF UPDATE PURCHASE ORDER

    // VALIDATE PO
    public function validatePo(Request $req){
        return \DB::transaction(function()use($req){
            // update po_master status ke VALIDATED
            \DB::table('beli')
                ->where('id',$req->po_master_id)
                ->update([
                        'status' => 'V'
                    ]);
            // get po_master
            $po_master = \DB::table('beli')->find($req->po_master_id);

            // get po_barang
            $po_barang = \DB::table('beli_barang')
                            ->where('beli_id',$po_master->id)
                            ->get();
            // get jatuh tempo
            $supplier = \DB::table('supplier')->find($po_master->supplier_id);
            $bill_date = new \DateTime();
            $due_date = new \DateTime();
            $due_date = $due_date->modify('+' . $supplier->jatuh_tempo . ' days');

            // simpan stok barang
            foreach($po_barang as $dt){
                // insert ke table stok
                $stok_id = \DB::table('stok')
                    ->insertGetId([
                            'tgl' => date('Y-m-d'),
                            'barang_id' => $dt->barang_id,
                            'stok_awal' => $dt->qty,
                            'current_stok' => $dt->qty,
                            'tipe' => 'M',
                            'harga' => $dt->harga,
                            'beli_id' => $dt->id,
                            'user_id' => \Auth::user()->id,
                        ]);    
                // insert ke table stok_moving
                \DB::table('stok_moving')
                    ->insert([
                            'stok_id' => $stok_id,
                            'jumlah' => $dt->qty,
                            'tipe' => 'I',
                            'user_id' => \Auth::user()->id,
                        ]);

            }

            // create invoices
            // get supplier_bill_counter
            $supplier_bill_counter = \DB::table('appsetting')
                                ->where('name','supplier_bill_counter')
                                ->first();
            // generate bill number
            $bill_no = "BILL/" . date('Y') . "/000"  . $supplier_bill_counter->value++;
            // insert into table supplier_bill as invoice data 

            \DB::table('supplier_bill')
                ->insert([
                        'beli_id' => $po_master->id,
                        'bill_no' => $bill_no,
                        'status' => 'O',
                        'subtotal' => $po_master->subtotal,
                        'disc' => $po_master->disc,
                        'total' => $po_master->total,
                        'amount_due' => $po_master->total,
                        'bill_date' => $bill_date,
                        'due_date' => $due_date,
                    ]);
            // update supplier_bill_counter
            \DB::table('appsetting')
                ->where('name','supplier_bill_counter')
                ->update([
                        'value' => $supplier_bill_counter->value
                    ]);

            return redirect()->back();
            
        });
    }
    // END OF VALIDATE PO

    // PURCHASE ORDER INVOICE
    // menampilkan halaman invoice untuk PO
    // $id = po_master_id / beli->id
    public function poInvoice($id){
        // get po_master
        $po_master = \DB::table('VIEW_BELI')->find($id);
        // get po_barang
        $po_barang = \DB::table('VIEW_BELI_BARANG')
                        ->where('beli_id',$po_master->id)
                        ->get();
        // get supplier_bill
        $sup_bill = \DB::table('supplier_bill')
                    ->where('beli_id',$po_master->id)
                    ->select('supplier_bill.*',
                                \DB::raw("date_format(`bill_date`,'%d-%m-%Y') as bill_date_formatted"),
                                \DB::raw("date_format(`due_date`,'%d-%m-%Y') as due_date_formatted")
                            )
                    ->first();

        // get payments
        $payments = \DB::table('supplier_bill_payment')
                        ->where('supplier_bill_id',$sup_bill->id)
                        ->select('supplier_bill_payment.*',
                                \DB::raw("date_format(`tanggal`,'%d-%m-%Y') as payment_date_formatted")
                            )
                        ->get();

        return view('purchase.order.orderinvoice',[
                'po_master' => $po_master,
                'po_barang' => $po_barang,
                'sup_bill' => $sup_bill,
                'payments' => $payments
            ]);

    }
    // END OF PURCHASE ORDER INVOICE

    // REGISTER PAYMENT
    public function regPayment($po_aster_id){
        // get po_master
        $po_master = \DB::table('VIEW_BELI')->find($po_aster_id);
        // get supplier_bill
        $sup_bill = \DB::table('supplier_bill')
                    ->where('beli_id',$po_master->id)
                    ->select('supplier_bill.*',
                                \DB::raw("date_format(`bill_date`,'%d-%m-%Y') as bill_date_formatted"),
                                \DB::raw("date_format(`due_date`,'%d-%m-%Y') as due_date_formatted")
                            )
                    ->first();
        return view('purchase.order.regpayment',[
                'po_master' => $po_master,
                'sup_bill' => $sup_bill,
            ]);
    }
    // END OF REGISTER PAYMENT

    // SAVE PAYMENT
    public function savePayment(Request $req){
        return \DB::transaction(function()use($req){
            $po_master = \DB::table('beli')
                                ->find($req->po_master_id);
            $sup_bill = \DB::table('supplier_bill')
                    ->where('beli_id',$po_master->id)
                    ->select('supplier_bill.*',
                                \DB::raw("date_format(`bill_date`,'%d-%m-%Y') as bill_date_formatted"),
                                \DB::raw("date_format(`due_date`,'%d-%m-%Y') as due_date_formatted")
                            )
                    ->first();
            
            // generate tanggal
            $tgl = $req->payment_date;
            $arr_tgl = explode('-',$tgl);
            $payment_date = new \DateTime();
            $payment_date->setDate($arr_tgl[2],$arr_tgl[1],$arr_tgl[0]);

            // // generate total
            $total = $req->payment_amount;
            $total = str_replace(",", "", $total);
            $total = str_replace(".", "", $total);

            // cek if amount_due lebih besar atau sama dengan payment_due

            if($total <= $sup_bill->amount_due ){
                // generate payment number
                ////get supplier_payment_counter
                $payment_counter = \DB::table('appsetting')
                                    ->whereName('supplier_payment_counter')
                                    ->first()->value;
                // genereate reference
                $payment_number_reference = "SUPP.OUT./" . date('Y') . '/000' . $payment_counter;
                //// update payment counter ke database
                \DB::table('appsetting')
                    ->whereName('supplier_payment_counter')
                    ->update([
                            'value' => \DB::raw('value + 1')
                        ]);


                // save payment to table
                \DB::table('supplier_bill_payment')
                    ->insert([
                            'tanggal' => $payment_date,
                            'supplier_bill_id' => $sup_bill->id,
                            'total' => $total,
                            'payment_number' => $payment_number_reference
                        ]);
                        
                // update amount due di table supplier_bill
                \DB::table('supplier_bill')
                    ->where('id',$sup_bill->id)
                    ->update([
                            'amount_due' => ($sup_bill->amount_due - $total)
                        ]);   

                // jika amount_due nya 0 maka set status ke paid
                if(($sup_bill->amount_due - $total) == 0){
                    // update status
                    \DB::table('supplier_bill')
                        ->where('id',$sup_bill->id)
                        ->update([
                                'status' => 'P'
                            ]);
                }

            }            

            return redirect('purchase/order/invoice/' . $po_master->id);

        });
    }
    // END OF SAVE PAYMENT

    // DELETE PAYMENT
    public function deletePayment(Request $req){
        return \DB::transaction(function()use($req){
            // get payment
            $payment = \DB::table('supplier_bill_payment')
                        ->find($req->payment_id);

            // kembalikan payment_amount
            \DB::table('supplier_bill')
                ->where('id',$payment->supplier_bill_id)
                ->update([
                        'amount_due' => \DB::raw('amount_due + ' . $payment->total),
                        'status' => 'O'
                    ]);

            // delete payment from database
            \DB::table('supplier_bill_payment')
                ->where('id',$req->payment_id)
                ->delete();

            // 


            return redirect()->back();
        });

    }
    // END OF DELETE PAYMENT

}

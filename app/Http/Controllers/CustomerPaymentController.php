<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CustomerPaymentController extends Controller {


    // fungsi tampilkan halaman purchase order
    public function index() {
        $data = \DB::table('VIEW_CUSTOMER_PAYMENT')
                    ->orderBy('payment_date','desc')
                    ->get();

        return view('invoices.cipay.index',[
                'data' => $data
            ]);
    }

    public function create(){
        return view('invoices.cipay.create',[

            ]);
    }

    public function getCustomer(Request $req){
        $data = \DB::select('select id as data,nama as value, (select sum(amount_due) from VIEW_CUSTOMER_INVOICE where customer_id = customer.id) as amount_due 
                from customer
                where nama like "%'.$req->get('nama').'%"');
        
        $data_res = ['query'=>'Unit','suggestions' => $data];
        echo json_encode($data_res);   
    }

    public function getInvoices($customer_id){
        $invoices = \DB::table('VIEW_CUSTOMER_INVOICE')
                    ->where('customer_id',$customer_id)
                    ->where('status','O')
                    ->orderBy('id','asc')
                    ->orderBy('invoice_date','asc')
                    ->get();
        echo json_encode($invoices);
    }

    public function insert(Request $req){
        return \DB::transaction(function()use($req){
            $payment_detail = json_decode($req->payment_detail)->payment;
            foreach($payment_detail as $dt){
                // generate payment number
                $payment_counter = \DB::table('appsetting')->whereName('customer_payment_counter')->first()->value;
                $payment_prefix = \DB::table('appsetting')->whereName('customer_payment_prefix')->first()->value;
                $payment_number = $payment_prefix . '/' .date('Y') . '/000' . $payment_counter++;

                // update payment counter
                \DB::table('appsetting')->whereName('customer_payment_counter')->update([
                        'value' => \DB::raw('value + 1')
                    ]);

                // generate tanggal
                $payment_date = $req->payment_date;
                $arr_tgl = explode('-',$payment_date);
                $fix_payment_date = new \DateTime();
                $fix_payment_date->setDate($arr_tgl[2],$arr_tgl[1],$arr_tgl[0]);     

                // input ke table customer payment
                \DB::table('customer_invoice_payment')->insert([
                        'payment_number' => $payment_number,
                        'customer_invoice_id' => $dt->invoice_id,
                        'payment_amount' => $dt->payment_amount,
                        'payment_date' => $fix_payment_date
                    ]);
                // update amount due    
                \DB::table('customer_invoice')->where('id',$dt->invoice_id)->update([
                        'amount_due' => \DB::raw('amount_due - ' . $dt->payment_amount)
                    ]);

                // cek amount due lunas atau belum
                \DB::table('customer_invoice')
                    ->where('id',$dt->invoice_id)
                    ->where('amount_due',0)
                    ->update([
                            'status' => 'P'
                        ]);

            }

            return redirect('invoice/customer/payment');
            
        });
    }

    public function edit($payment_id){
        $data = \DB::table('VIEW_CUSTOMER_PAYMENT')
                        ->find($payment_id);
        return view('invoices.cipay.edit',[
                'data' => $data
            ]);
    }

    public function showSourceDocument($customer_invoice_id,$customer_payment_id){
        $customer_payment = \DB::table('VIEW_CUSTOMER_PAYMENT')->find($customer_payment_id);
        $data = \DB::table('VIEW_CUSTOMER_INVOICE')->find($customer_invoice_id);
        $barang = \DB::table('VIEW_SALES_ORDER_PRODUCTS')
                        ->where('jual_id',$data->jual_id)
                        ->whereRaw('VIEW_SALES_ORDER_PRODUCTS.barang_id in (select barang_id from customer_invoice_detail where customer_invoice_id = ' . $customer_invoice_id . ')')
                        // ->select('nama_full as nama','qty','harga_salesman','subtotal')
                        ->get();
        $payments = \DB::table('customer_invoice_payment')
                            ->where('customer_invoice_id',$customer_invoice_id)
                            ->select('customer_invoice_payment.*',
                                    \DB::raw("date_format(`payment_date`,'%d-%m-%Y') as payment_date_formatted")
                                )
                            ->get();
        // echo json_encode($data);
        return view('invoices.cipay.show_source_document',[
                'data' => $data,
                'barang' => $barang,
                'payments' => $payments,
                'customer_payment' => $customer_payment,
            ]);
    }

    public function delete($payment_id){
        \DB::table('customer_invoice_payment')->delete($payment_id);
        return redirect('invoice/customer/payment');
    }

}

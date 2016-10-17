<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApiController extends Controller {

    public function getPoInvoice(){
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

        return [
            'po_master' => $po_master,
            'po_barang' => $po_barang,
            'sup_bill' => $sup_bill,
            'payments' => $payments
        ];
    }

    // Delete data payment Customer Invoice
    public function deleteCustomerPayment(Request $req){
        \DB::transaction(function()use($req){
            // get payment
            $payment = \DB::table('customer_invoice_payment')
                ->find($req->payment_id);

            // update status customer_invoice
            // \DB::table('customer_invoice')
            //     ->where('id',$payment->customer_invoice_id)
            //     ->update([
            //             'status' => 'O',
            //             'amount_due' => \DB::raw('amount_due + ' . $payment->payment_amount)
            //         ]);

            // delete datta payment customer
            \DB::table('customer_invoice_payment')->delete($req->payment_id);
        });
        
    }

    /**
     * Simpan data Payment Customer
     **/
    public function regCustomerPayment(Request $req){
        \DB::transaction(function()use($req){
            // create payment_number
            $payment_counter = \DB::table('appsetting')->whereName('customer_payment_counter')->first()->value;
            $payment_prefix = \DB::table('appsetting')->whereName('customer_payment_prefix')->first()->value;

            $payment_number = $payment_prefix  . '/' . date('Y') . '/000'. $payment_counter;

            // update counter
            \DB::table('appsetting')
                    ->whereName('customer_payment_counter')
                    ->update([
                            'value' => \DB::raw('value + 1')
                        ]);

            $payment_date = $req->payment_date;
            $arr_tgl = explode('-',$payment_date);
            $fix_payment_date = new \DateTime();
            $fix_payment_date->setDate($arr_tgl[2],$arr_tgl[1],$arr_tgl[0]);     

            // input payment
            \DB::table('customer_invoice_payment')
            ->insert([
                    'customer_invoice_id' => $req->customer_inv_id,
                    'payment_amount' => $req->payment_amount,
                    'payment_date' => $fix_payment_date,
                    'payment_number' => $payment_number,
                ]);    

            // Update Status Invoice
            \DB::table('customer_invoice')
                ->where('id',$req->customer_inv_id)
                ->whereRaw('amount_due - ' . $req->payment_amount . ' = 0')
                ->update([
                        'status' => 'P'
                    ]);

            // update invoice , amount due
            \DB::table('customer_invoice')
                ->where('id',$req->customer_inv_id)
                ->update([
                        'amount_due' => \DB::raw('amount_due - ' . $req->payment_amount)
                    ]);

            // return redirect()->back();
        });
    }


    /**
     * Simpan data payment Supplier
     **/
    public function regSupplierPayment(Request $req){
        \DB::transaction(function()use($req){
            // create payment_number
            $sup_payment_counter = \DB::table('appsetting')->whereName('supplier_payment_counter')->first()->value;
            $sup_payment_prefix = \DB::table('appsetting')->whereName('supplier_payment_prefix')->first()->value;

            $sup_payment_number = $sup_payment_prefix  . '/' . date('Y') . '/000'. $sup_payment_counter;

            // update counter
            \DB::table('appsetting')
                    ->whereName('supplier_payment_counter')
                    ->update([
                            'value' => \DB::raw('value + 1')
                        ]);

            $sup_payment_date = $req->payment_date;
            $arr_tgl = explode('-',$sup_payment_date);
            $fix_payment_date = new \DateTime();
            $fix_payment_date->setDate($arr_tgl[2],$arr_tgl[1],$arr_tgl[0]);     

            // input payment
            \DB::table('supplier_bill_payment')
            ->insert([
                    'supplier_bill_id' => $req->supplier_bill_id,
                    'total' => $req->payment_amount,
                    'tanggal' => $fix_payment_date,
                    'payment_number' => $sup_payment_number,
                ]);    

            // Update Status Invoice
            \DB::table('supplier_bill')
                ->where('id',$req->supplier_bill_id)
                ->whereRaw('amount_due - ' . $req->payment_amount . ' = 0')
                ->update([
                        'status' => 'P'
                    ]);

            // update invoice , amount due
            \DB::table('supplier_bill')
                ->where('id',$req->supplier_bill_id)
                ->update([
                        'amount_due' => \DB::raw('amount_due - ' . $req->payment_amount)
                    ]);

            // return redirect()->back();
        });
    }


// ==================================================================================
// end of code
}

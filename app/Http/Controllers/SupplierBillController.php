<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SupplierBillController extends Controller {


    // fungsi tampilkan halaman purchase order
    public function index() {
        $data = \DB::table('VIEW_SUPPLIER_BILL')
        			->orderBy('bill_date','desc')
        			->get();
        return view('invoices.supplierbill.bill', [
            'data' => $data,
        ]);
    }

    // Show deteail supplier bill
    public function showBill($id){
    	// get supplier_bill
        $sup_bill = \DB::table('VIEW_SUPPLIER_BILL')->find($id);

        $po_master = \DB::table('VIEW_BELI')->find($sup_bill->beli_id);
        // get po_barang
        $po_barang = \DB::table('VIEW_BELI_BARANG')
                        ->where('beli_id',$po_master->id)
                        ->get();
       
        // get payments
        $payments = \DB::table('supplier_bill_payment')
                        ->where('supplier_bill_id',$id)
                        ->select('supplier_bill_payment.*',
                                \DB::raw("date_format(`tanggal`,'%d-%m-%Y') as payment_date_formatted")
                            )
                        ->get();


    	return view('invoices.supplierbill.show-bill', [
            'po_master' => $po_master,
                'po_barang' => $po_barang,
                'sup_bill' => $sup_bill,
                'payments' => $payments
        ]);
    }

    // Show Form Payment
    public function registerPayment($bill_id){
        $sup_bill = \DB::table('VIEW_SUPPLIER_BILL')->find($bill_id);

        // echo json_encode($sup_bill);

        return view('invoices.supplierbill.reg-payment',[
                'data' => $sup_bill
            ]);
    }

    // DELETE PAYMENT
    public function deletePayment($payment_bill_id){
        return \DB::transaction(function()use($payment_bill_id){
            $bill = \DB::table('supplier_bill')->find(
                        \DB::table('supplier_bill_payment')->find($payment_bill_id)->supplier_bill_id
                        );

            \DB::table('supplier_bill_payment')
                ->delete($payment_bill_id);

            return redirect('invoice/supplier-bill/show/'.$bill->id);
        });
    }
    // END OF DELETE PAYMENT



}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BillPaymentController extends Controller {


    // fungsi tampilkan halaman purchase order
    public function index() {
        $data = \DB::table('VIEW_SUPPLIER_PAYMENT')
                    ->orderBy('tanggal','desc')
                    ->get();

        return view('invoices.billpay.index',[
                'data' => $data
            ]);
    }
}

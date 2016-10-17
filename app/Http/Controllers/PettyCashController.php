<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PettyCashController extends Controller {

    public function index() {
        // $data = \DB::table('cashbook')
        //         ->orderBy('date','desc')
        //         ->where('type','EX')
        //         ->where('is_manual','Y')
        //         ->select('cashbook.*',\DB::raw('date_format(date,"%d-%m-%Y") as date_formatted'))
        //         ->get();

        return view('cashbook.pettycash.index', [
            // 'data' => $data
        ]);
    }

// ==================================================================================
// end of code
}

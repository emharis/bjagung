<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PurchaseReportController extends Controller {

    public function index() {

        $supplier = \DB::table('supplier')->get();
        $select_supplier = [];
        foreach($supplier as $dt){
          $select_supplier [$dt->id] = $dt->nama;
        }

        return view('purchase.reports.index', [
          'select_supplier' => $select_supplier
        ]);
    }

    public function showReport(Request $req){
      //generate tanggal
      $date_start = $req->date_start;
      $arr_tgl = explode('-',$date_start);
      $date_start = new \DateTime();
      $date_start->setDate($arr_tgl[2],$arr_tgl[1],$arr_tgl[0]);
      $date_start_str = $arr_tgl[2].'-'.$arr_tgl[1].'-'.$arr_tgl[0];

      $date_end = $req->date_end;
      $arr_tgl = explode('-',$date_end);
      $date_end = new \DateTime();
      $date_end->setDate($arr_tgl[2],$arr_tgl[1],$arr_tgl[0]);
      $date_end_str = $arr_tgl[2].'-'.$arr_tgl[1].'-'.$arr_tgl[0];

      $data = \DB::table('VIEW_BELI')
                  ->whereBetween('tgl',[$date_start_str,$date_end_str])
                  ->get();

      return view('purchase.reports.show-report',[
        'date_start' => $req->date_start,
        'date_end' => $req->date_end,
        'data' => $data,
      ]);
    }

    public function reportByDate(Request $req){
      //generate tanggal
      $start_date = $req->start_date;
      $arr_tgl = explode('-',$start_date);
      $start_date = new \DateTime();
      $start_date->setDate($arr_tgl[2],$arr_tgl[1],$arr_tgl[0]);
      $start_date_str = $arr_tgl[2].'-'.$arr_tgl[1].'-'.$arr_tgl[0];

      $end_date = $req->end_date;
      $arr_tgl = explode('-',$end_date);
      $end_date = new \DateTime();
      $end_date->setDate($arr_tgl[2],$arr_tgl[1],$arr_tgl[0]);
      $end_date_str = $arr_tgl[2].'-'.$arr_tgl[1].'-'.$arr_tgl[0];

      $data = \DB::table('view_beli')
                  ->whereBetween('tgl',[$start_date_str,$end_date_str])
                  ->get();
      $total = \DB::table('view_beli')
                  ->whereBetween('tgl',[$start_date_str,$end_date_str])
                  ->sum('total');

      $disc = \DB::table('view_beli')
                  ->whereBetween('tgl',[$start_date_str,$end_date_str])
                  ->sum('disc');
      
      $payment_amount = \DB::table('view_beli')
                  ->whereBetween('tgl',[$start_date_str,$end_date_str])
                  ->sum('grand_total');

      $amount_due = \DB::table('view_beli')
                  ->whereBetween('tgl',[$start_date_str,$end_date_str])
                  ->sum('amount_due');

      return view('purchase.reports.report-by-date',[
        'data' => $data,
        'total' => $total,
        'total_disc' => $disc,
        'total_payment_amount' => $payment_amount,
        'total_amount_due' => $amount_due,
      ])->with($req->all());

    }

    public function printReportToPdf(){

    }

  // END OF CODE
}

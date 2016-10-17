<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReceiptController extends Controller {

    public function index() {
        $data = \DB::table('cashbook')
                ->orderBy('date','desc')
                ->where('type','RC')
                ->where('is_manual','Y')
                ->select('cashbook.*',\DB::raw('date_format(date,"%d-%m-%Y") as date_formatted'))
                ->get();

        return view('cashbook.receipt.index', [
            'data' => $data
        ]);
    }

    public function add(){
        return view('cashbook.receipt.create');
    }

    public function insert(Request $req){
        return \DB::transaction(function()use($req){
            // generate tanggal
            $receipt_date = $req->date;
            $arr_tgl = explode('-',$receipt_date);
            $fix_receipt_date = new \DateTime();
            $fix_receipt_date->setDate($arr_tgl[2],$arr_tgl[1],$arr_tgl[0]);     

            $total = $req->total;
            $total = str_replace(',','',$total);
            $total = str_replace('.','',$total);

            \DB::table('cashbook')
                ->insert([
                        'date' => $fix_receipt_date,
                        'type' => 'RC',
                        'is_manual' => 'Y',
                        'desc' => $req->description,
                        'total' => $total,
                        'user_id' => \Auth::user()->id
                    ]);

            return redirect('cashbook/receipt');
        });
    }

    public function delete($receipt_id){
        \DB::table('cashbook')->delete($receipt_id);
        return redirect('cashbook/receipt');
    }

    public function edit($receipt_id){
        $data = \DB::table('cashbook')
                ->orderBy('date','desc')
                ->where('type','RC')
                ->where('is_manual','Y')
                ->select('cashbook.*',\DB::raw('date_format(date,"%d-%m-%Y") as date_formatted'))->
                find($receipt_id);

        return view('cashbook.receipt.edit',[
                'data' => $data
            ]);
    }

    public function update(Request $req){
        return \DB::transaction(function()use($req){
            // generate tanggal
            $receipt_date = $req->date;
            $arr_tgl = explode('-',$receipt_date);
            $fix_receipt_date = new \DateTime();
            $fix_receipt_date->setDate($arr_tgl[2],$arr_tgl[1],$arr_tgl[0]);     

            $total = $req->total;
            $total = str_replace(',','',$total);
            $total = str_replace('.','',$total);

            \DB::table('cashbook')
                ->where('id',$req->receipt_id)
                ->update([
                        'date' => $fix_receipt_date,
                        'desc' => $req->description,
                        'total' => $total
                    ]);

            return redirect('cashbook/receipt');
        });
    }

    public function filter(Request $req){
         $paging_item_number = \DB::table('appsetting')->where('name','paging_item_number')->first()->value; 

         if($req->filter_by == 'desc'){
            $data = \DB::table('cashbook')
                ->orderBy('date','desc')
                ->where('desc','like','%' . $req->filter_string . '%')
                ->where('type','RC')
                ->where('is_manual','Y')
                ->select('cashbook.*',\DB::raw('date_format(date,"%d-%m-%Y") as date_formatted'))
                ->paginate($paging_item_number)
                ->appends([
                    'filter_string' => $req->filter_string
                    ])
                ->appends([
                    'filter_by' => $req->filter_by
                    ]);
            

         }else if($req->filter_by == 'date'){
            // generate tanggal
            $date_start = $req->date_start;
            $arr_tgl = explode('-',$date_start);  
            $date_start = $arr_tgl[2]. '-' . $arr_tgl[1] . '-' . $arr_tgl[0];

            $date_end = $req->date_end;
            $arr_tgl = explode('-',$date_end);
            $date_end = $arr_tgl[2]. '-' . $arr_tgl[1] . '-' . $arr_tgl[0];

            // echo $date_start . '   -   ' . $date_end;

            $data = \DB::table('cashbook')
                ->orderBy('date','desc')
                // ->where('desc','like','%' . $req->filter_string . '%')
                ->whereBetween('date',[$date_start,$date_end])
                ->where('type','RC')
                ->where('is_manual','Y')
                ->select('cashbook.*',\DB::raw('date_format(date,"%d-%m-%Y") as date_formatted'))
                ->paginate($paging_item_number)
                ->appends([
                    'date_start' => $req->date_start
                    ])
                ->appends([
                    'date_end' => $req->date_end
                    ])
                ->appends([
                    'filter_by' => $req->filter_by
                    ]);

         }else{
            // generate operator
            $operator = $req->filter_operator;
            if($operator == 'equal'){
                $operator = '=';
            }else if($operator == 'lower_than'){
                $operator = '<';
            }else if($operator == 'higher_than'){
                $operator = '>';
            }else if($operator == 'lower_than_equal'){
                $operator = '<=';
            }else if($operator == 'higher_than_equal'){
                $operator = '>=';
            }

            // normalise total
            $total = $req->total;
            $total = str_replace(',', '', $total);
            $total = str_replace('.', '', $total);

            // Filter by total
            $data = \DB::table('cashbook')
                ->orderBy('date','desc')
                ->where('total',$operator,$total)
                ->where('type','RC')
                ->where('is_manual','Y')
                ->select('cashbook.*',\DB::raw('date_format(date,"%d-%m-%Y") as date_formatted'))
                ->paginate($paging_item_number)
                ->appends([
                    'filter_operator' => $req->filter_operator
                    ])
                ->appends([
                    'total' => $total
                    ]);
         }

         return view('cashbook.receipt.filter',[
                'data' => $data,
                'paging_item_number' => $paging_item_number
            ]);

    }

// ==================================================================================
// end of code
}

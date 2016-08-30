<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CustomerController extends Controller {

    public function index() {
        $data = \DB::table('customer')->get();

        return view('master.customer.index', [
            'data' => $data
        ]);
    }

    //insert new data customer
    public function insert(Request $request) {
        $id = \DB::table('customer')->insertGetId([
            'nama' => $request->input('nama'),
            'nama_kontak' => $request->input('nama_kontak'),
            'telp' => $request->input('telp'),
            'telp_2' => $request->input('telp_2'),
            'alamat' => $request->input('alamat'),
        ]);

        if (!$request->ajax()) {
            return redirect('master/customer');
        } else {
            return json_encode(\DB::table('customer')->find($id));
        }
    }

    //get data customer
    public function getCustomer($id) {
        $data = \DB::table('customer')->find($id);

        return json_encode($data);
    }

    //update data customer
    public function updateCustomer(Request $request) {
        \DB::table('customer')
                ->whereId($request->input('id'))
                ->update([
                    'nama' => $request->input('nama'),
                    'nama_kontak' => $request->input('nama_kontak'),
                    'telp' => $request->input('telp'),
                    'telp_2' => $request->input('telp_2'),
                    'alamat' => $request->input('alamat'),
        ]);

        if (!$request->ajax()) {
            return redirect('master/customer');
        } else {
            return json_encode(\DB::table('customer')->find($request->input('id')));
        }
    }

    //delete customer
    public function deleteCustomer($id, Request $request) {
        \DB::table('customer')->delete($id);

        if (!$request->ajax()) {
            return redirect('master/customer');
        }
    }

}

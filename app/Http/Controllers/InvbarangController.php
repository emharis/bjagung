<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class InvbarangController extends Controller {

    // fungsi index pertama kali view dijalankan
    public function index() {
        $data = \DB::table('VIEW_STOK_BARANG')
                ->orderBy('kategori', 'asc')
                ->orderBy('created_at', 'desc')
                ->get();

        $kategori = \DB::table('kategori')
                ->orderBy('created_at', 'desc')
                ->get();


        return view('inventory.barang.barang', [
            'data' => $data,
            'kategori' => $kategori,
        ]);
    }

    public function add(){
        $kategori = \DB::table('VIEW_KATEGORI')->get();
        // $satuan = \DB::table()

        return view('inventory.barang.addbarang',[
                'kategori' => $kategori
            ]);
    }

    public function insert(Request $req){
        $hasError = false;

        return \DB::transaction(function()use($req,$hasError){
            // insert data baru ke database
            \DB::table('barang')->insert([
                'kode' => $req->kode,
                'nama' => $req->nama,
                'kategori_id' => $req->kategori,
                'rol' => $req->rol,
                'berat' => $req->berat,
                'user_id' => \Auth::user()->id
            ]);

            return redirect('inventory/barang');
        });
        
    }

    public function edit($id){
        $kategori = \DB::table('kategori')->get();
        $barang = \DB::table('VIEW_STOK_BARANG')->find($id);
        $purchases = \DB::table('VIEW_BELI_BARANG')
                            ->where('barang_id',$id)
                            ->orderBy('created_at','desc')
                            ->get();

        // hitung HPP
        $stok_count = \DB::table('stok')
                    ->where('barang_id',$id)
                    ->where('current_stok','>',0)
                    ->count();

        $stok_awal_sum = \DB::table('stok')
                    ->where('barang_id',$id)
                    ->where('current_stok','>',0)
                    ->sum('stok_awal');

        $cost_sum = \DB::table('stok')
                    ->where('barang_id',$id)
                    ->where('current_stok','>',0)
                    ->sum(\DB::raw('harga * stok_awal'));

        if($stok_count > 0){
            $hpp  =  $cost_sum / $stok_awal_sum;
        }else
        {
            $hpp = 0;
        }

        // get harga jual terakhir
        $harga = \DB::table('harga_jual')
                        ->where('barang_id',$id)
                        ->orderBy('created_at','desc')
                        ->first();
        // jika harga belum di sett
        if(!$harga){
            // echo 'generate json_harga <br>';
            $harga = json_decode('{"harga_jual":0}');
        }

        return view('inventory.barang.editbarang',[
                'barang' => $barang,
                'kategori' => $kategori,
                'hpp' => $hpp,
                'harga' => $harga,
                'purchases' => $purchases
            ]);
    }

    // update data barang ke database
    public function update(Request $req){
        return \DB::transaction(function()use($req){
            // update data barang
            \DB::table('barang')
                ->where('id',$req->id)
                ->update([
                    'nama' => $req->nama,
                    'kode' => $req->kode,
                    'kategori_id' => $req->kategori,
                    'rol' => $req->rol,
                    'berat' => $req->berat,
                ]);

            return redirect('inventory/barang');
        });
    }


    // fungsi cek kode barang
    function cekKode($kode){
        return  \DB::table('barang')->where('kode',$kode)->count();

    }

    // fungsi create kategori barang baru
    function createKategori(Request $req){
        $newid = \DB::table('kategori')->insertGetId([
                'nama' => $req->nama,
                'satuan' => $req->satuan
            ]);

        return json_encode(\DB::table('kategori')->find($newid));
    }

    // fungsi hapus data barang dari database
    function delete(Request $req){
        return \DB::transaction(function()use($req){
            \DB::table('barang')->delete($req->barang_id);

            return redirect('inventory/barang');
        });
    }

    // UPDATE HARGA BARANG
    public function updateHarga(Request $req){
        // echo 'Update Harga Barang';
        return \DB::transaction(function()use($req){
            // format harga jual
            $harga_jual = str_replace(',','',str_replace('.', '', $req->sale_price));

            // insert harga barang baru
            \DB::table('harga_jual')
                ->insert([
                        'barang_id' => $req->barang_id,
                        'hpp' => $req->hpp_cost,
                        'harga_jual' => $harga_jual,
                        'user_id' => \Auth::user()->id,
                    ]);

            return redirect()->back();
        });
    }
    // END OF UPDATE HARGA BARANG

}

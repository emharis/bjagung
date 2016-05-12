<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::get('/', ['uses' => 'HomeController@index']);

Route::get('sidebar-update', function() {
    $value = \DB::table('appsetting')->whereName('sidebar_collapse')->first()->value;
    \DB::table('appsetting')->whereName('sidebar_collapse')->update(['value' => $value == 1 ? '0' : '1']);
});

Route::group(['middleware' => ['web']], function () {

    Route::get('home', ['as' => 'home', 'uses' => 'HomeController@index']);
    Route::group(['prefix' => 'master'], function () {
        //kategori
        Route::get('kategori', ['as' => 'master.kategori', 'uses' => 'KategoriController@index']);
        Route::get('kategori/get-kategori/{id}', ['as' => 'master.kategori.get-kategori', 'uses' => 'KategoriController@getKategori']);
        Route::get('kategori/delete-kategori/{id}', ['as' => 'master.kategori.delete-kategori', 'uses' => 'KategoriController@deleteKategori']);
        Route::post('kategori/insert', ['as' => 'master.kategori.insert', 'uses' => 'KategoriController@insert']);
        Route::post('kategori/update-kategori', ['as' => 'master.kategori.update-kategori', 'uses' => 'KategoriController@updateKategori']);
        //barang
        Route::get('barang', ['as' => 'master.barang', 'uses' => 'BarangController@index']);
        Route::get('barang/get-barang/{id}', ['as' => 'master.barang.get-barang', 'uses' => 'BarangController@getBarang']);
        Route::get('barang/get-satuan-barang/{id}', ['as' => 'master.barang.get-satuan-barang', 'uses' => 'BarangController@getSatuanBarang']);
        Route::get('barang/delete-barang/{id}', ['as' => 'master.barang.delete-barang', 'uses' => 'BarangController@deleteBarang']);
        Route::post('barang/insert', ['as' => 'master.barang.insert', 'uses' => 'BarangController@insert']);
        Route::post('barang/update-barang', ['as' => 'master.barang.update-barang', 'uses' => 'BarangController@updateBarang']);
        //satuan
        Route::get('satuan', ['as' => 'master.satuan', 'uses' => 'SatuanController@index']);
        Route::get('satuan/get-satuan/{id}', ['as' => 'master.satuan.get-satuan', 'uses' => 'SatuanController@getSatuan']);
        Route::get('satuan/delete-satuan/{id}', ['as' => 'master.satuan.delete-satuan', 'uses' => 'SatuanController@deleteSatuan']);
        Route::post('satuan/insert', ['as' => 'master.satuan.insert', 'uses' => 'SatuanController@insert']);
        Route::post('satuan/update-satuan', ['as' => 'master.satuan.update-satuan', 'uses' => 'SatuanController@updateSatuan']);
        //supplier
        Route::get('supplier', ['as' => 'master.supplier', 'uses' => 'SupplierController@index']);
        Route::get('supplier/get-supplier/{id}', ['as' => 'master.supplier.get-supplier', 'uses' => 'SupplierController@getSupplier']);
        Route::get('supplier/delete-supplier/{id}', ['as' => 'master.supplier.delete-supplier', 'uses' => 'SupplierController@deleteSupplier']);
        Route::post('supplier/insert', ['as' => 'master.supplier.insert', 'uses' => 'SupplierController@insert']);
        Route::post('supplier/update-supplier', ['as' => 'master.supplier.update-supplier', 'uses' => 'SupplierController@updateSupplier']);
        //customer
        Route::get('customer', ['as' => 'master.customer', 'uses' => 'CustomerController@index']);
        Route::get('customer/get-customer/{id}', ['as' => 'master.customer.get-customer', 'uses' => 'CustomerController@getCustomer']);
        Route::get('customer/delete-customer/{id}', ['as' => 'master.customer.delete-customer', 'uses' => 'CustomerController@deleteCustomer']);
        Route::post('customer/insert', ['as' => 'master.customer.insert', 'uses' => 'CustomerController@insert']);
        Route::post('customer/update-customer', ['as' => 'master.customer.update-customer', 'uses' => 'CustomerController@updateCustomer']);
        //sales
        Route::get('sales', ['as' => 'master.sales', 'uses' => 'SalesController@index']);
        Route::get('sales/get-sales/{id}', ['as' => 'master.sales.get-sales', 'uses' => 'SalesController@getSales']);
        Route::get('sales/delete-sales/{id}', ['as' => 'master.sales.delete-sales', 'uses' => 'SalesController@deleteSales']);
        Route::post('sales/insert', ['as' => 'master.sales.insert', 'uses' => 'SalesController@insert']);
        Route::post('sales/update-sales', ['as' => 'master.sales.update-sales', 'uses' => 'SalesController@updateSales']);
    });

    Route::group(['prefix' => 'setbar'], function () {
        //kategori
        Route::get('stok', ['as' => 'setbar.stok', 'uses' => 'StokController@index']);
        Route::get('stok/set-stok/{id}', ['as' => 'setbar.stok.set-stok', 'uses' => 'StokController@setStok']);
    });
    
    
});

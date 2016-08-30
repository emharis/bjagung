@extends('layouts.full')

@section('styles')
    <!--Bootsrap Data Table-->
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>
    <style>
        .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
        .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
        .autocomplete-selected { background: #FFE291; }
        .autocomplete-suggestions strong { font-weight: normal; color: red; }
        .autocomplete-group { padding: 2px 5px; }
        .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }

        #modal-show-barang .modal-dialog {
            width: 75%;
        }

        #table-barang > tfoot > tr:first-child > td{
            border-top-width: 3px; 
            border-top-color: grey;
        }
    </style>
@append

@section('content')
    <div class="container">

    </div>
    <div class="row" >
        <div class="col-sm-12 col-md-12 col-lg-12" >
            <div class="box box-solid" >
                <div class="box-header" >
                    <h3 class="box-title" >
                        <i class="fa fa-shopping-cart" ></i> PENJUALAN
                        
                    </h3>
                    <div class="pull-right" >
                        <!-- Tanggal indonesia -->
                        {{$tgl_indo}}
                    </div>  
                </div>
                <div class="box-body" >
                    <div class="row" >
                        <div class="col-sm-4 col-md-4 col-lg-4" >
                            <table class="table table-bordered table-condensed" >
                                <tbody>
                                    <tr>
                                        <td>Customer</td>
                                        <td>:</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" name="customer" class="form-control text-uppercase"  autofocus >
                                                <div class="input-group-btn">
                                                  <a id="btn-clear-customer" type="button" class="btn btn-danger"><i class="fa fa-close" ></i></a>
                                                </div><!-- /btn-group -->
                                            </div>
                                            
                                            <input type="hidden" name="customer_id" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Salesman</td>
                                        <td>:</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" name="salesman" class="form-control text-uppercase" >
                                                <div class="input-group-btn">
                                                  <a id="btn-clear-salesman" type="button" class="btn btn-danger"><i class="fa fa-close" ></i></a>
                                                </div><!-- /btn-group -->
                                            </div>
                                            
                                            <input type="hidden" name="salesman_id" >
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4" >
                            <table class="table table-bordered table-condensed" >
                                <tbody>
                                    <tr>
                                        <td>Tanggal</td>
                                        <td>:</td>
                                        <td>
                                            <input id="input-tanggal" type="text" name="tanggal" class="form-control" value="{{date('d-m-Y')}}" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Pembayaran</td>
                                        <td>:</td>
                                        <td>
                                            <select class="form-control" name="pembayaran" >\
                                                <option value="T">TUNAI/LUNAS</option>
                                                <option value="K">KREDIT/TEMPO</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4" >
                            <div class="bg-green" >
                                <label style="margin:5px;" >TOTAL BAYAR</label>
                                <h1 style="margin-bottom:5px;margin-right:5px;" class="text-right grand-total" id="grand-total-atas" >0</h1>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12" >
                            <input type="hidden" name="id_barang">
                            <input type="hidden" name="stok_barang">
                            <div class="table-responsive" >
                                <table class="table table-bordered table-condensed" id="table-barang" >
                                    <thead>
                                        <tr class="bg-blue" >
                                            <th class="col-sm-1 col-md-1 col-lg-1 hide" >KODE</th>
                                            <th>BARANG/KATEGORI <i class="pull-right" >STOK</i></th>
                                            <th class="col-sm-2 col-md-2 col-lg-2 " >HRG/SAT</th>
                                            <th class="col-sm-2 col-md-2 col-lg-2 " >HRG/SLS</th>
                                            <th class="col-sm-1 col-md-1 col-lg-1 " >QTY</th>
                                            <th style="width: 25px;padding:none;" >SAT</th>
                                            <th class="col-sm-2 col-md-2 col-lg-2 " >TOTAL</th>
                                            <th style="width: 10px;padding:none;" ></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="border-bottom:2px solid grey;"  >
                                            <td class="hide" >
                                                <input type="text" name="kode" class="form-control text-uppercase hide">
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" name="barang" class="form-control text-uppercase">
                                                    <span class="input-group-addon"></span>
                                                </div>
                                            </td>
                                            <td id="harga-satuan" class="text-right" >
                                                <!-- harga satuan -->
                                            </td>
                                            <td>
                                                <input type="text" name="harga_salesman" class="form-control text-right">
                                            </td> 
                                            <td>
                                                <input type="number" name="qty" class="form-control text-right">
                                            </td>
                                            <td id="label-satuan" ></td>
                                            <td id="harga-total" class="text-right" ></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="hide" ></td>
                                            <td colspan="5" class="text-right"  >
                                                <label>TOTAL</label>
                                            </td>
                                            <td id="sub-total" class="text-right" ></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="hide" ></td>
                                            <td colspan="5" class="text-right" >
                                                <label>DISC</label>
                                            </td>
                                            <td>
                                                <input type="text" name="disc" class="form-control text-right">
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="hide" ></td>
                                            <td colspan="5" class="text-right" >
                                                <label>TOTAL BAYAR</label>
                                            </td>
                                            <td id="grand-total-bawah" class="grand-total text-right" ></td>
                                            <td></td>
                                        </tr>

                                    </tfoot>
                                </table>
                            </div>
                            
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 text-right" >
                            <a class="btn btn-primary" id="btn-save" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SAVE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                            <!-- <a class="btn btn-success" id="btn-save-cetak" >&nbsp;&nbsp;&nbsp;&nbsp;SAVE & CETAK NOTA&nbsp;&nbsp;&nbsp;&nbsp;</a> -->
                            <a class="text-red" id="btn-exit" href="penjualan/jual" >&nbsp;&nbsp;&nbsp;&nbsp;EXIT&nbsp;&nbsp;&nbsp;&nbsp;</a>
                        </div>
                        <!-- End of input data barang -->
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->

    <div class="modal" id="modal-konfirmasi" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">PENJUALAN</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered" style="font-size:1.2em;" >
                        <tbody>
                            <tr>
                                <td><label>TOTAL</label></td>
                                <td><label>:</label></td>
                                <td class="text-right" ><label class="grand-total" ></labebl></td>
                            </tr>
                            <tr>
                                <td><label>BAYAR</label></td>
                                <td>:</td>
                                <td>
                                    <input style="font-size:1em;" type="text" name="bayar" class="form-control grand-total text-right" >
                                </td>
                            </tr>
                            <tr>
                                <td><label>KEMBALI</label></td>
                                <td>:</td>
                                <td id="kembalian" class="text-right" >
                                    0
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-center" >
                                    <button id="btn-confirm-save" class="btn btn-primary btn-sm " >SAVE</button>
                                    <button id="btn-confirm-save-print" class="btn btn-success btn-sm " >SAVE & PRINT</button>
                                    <a id="btn-confirm-cancel-save" data-dismiss="modal" class="btn btn-default btn-sm" >cancel</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- <div class="modal-footer" >
                    <a class="btn btn-danger btn-sm" data-dismiss="modal" ><i class="fa fa-close" ></i> Close</a>
                </div> -->
            </div> 
        </div> 
    </div>
@stop

@section('scripts')
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>
    <script src="plugins/autocomplete/jquery.autocomplete.min.js" type="text/javascript"></script>
    <script src="plugins/phpjs/numberformat.js" type="text/javascript"></script>
    <script src="plugins/autonumeric/autoNumeric-min.js" type="text/javascript"></script>
    <script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="plugins/numeraljs/numeral.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        (function ($) {

            //clear input on load
            $('input[name=customer]').val('');
            $('input[name=salesman]').val('');
            $('select[name=pembayaran]').val([]);

            var strBarang = '{"barang" : [] }';
            var brObj = JSON.parse(strBarang);

            //setting auto numeric
            $('input[name=disc],input[name=bayar], input[name=harga_salesman],input[name=bayar]').autoNumeric('init',{
                vMin:'0',
                vMax:'999999999'
            });

            //set datetimepicker
            $('#input-tanggal').datepicker({
                format: 'dd-mm-yyyy',
                todayHighlight: true,
                autoclose: true
            }).on('changeDate',function(env){
                $('select[name=pembayaran]').focus();
            });

            //sembunyikan input qty & harga salesman
            $('input[name=qty]').hide();
            $('input[name=harga_salesman]').hide();

            //set autocomplete
            $('input[name=barang]').autocomplete({
                serviceUrl: 'penjualan/jual/get-barang',
                params: {  'nama': function() {
                                return $('input[name=barang]').val();
                            }
                        },
                onSelect:function(suggestions){
                    setBarang(suggestions);
                }

            });
            //autocomplete dengan kode
            $('input[name=kode]').autocomplete({
                serviceUrl: 'penjualan/jual/get-barang-by-kode',
                params: {  'nama': function() {
                                return $('input[name=kode]').val();
                            }
                        },
                onSelect:function(suggestions){
                    setBarang(suggestions);
                }

            });

            //set barang 
            function setBarang(suggestions){
                //set kode dan satuan
                    $('input[name=barang]').val(suggestions.nama);
                    $('input[name=kode]').val(suggestions.kode);
                    $('input[name=qty]').parent().next().html(suggestions.sat);
                    $('input[name=id_barang]').val(suggestions.id);
                    $('input[name=stok_barang]').val(suggestions.stok);
                    $('#harga-satuan').text(numeral(suggestions.harga_jual_current).format('0,0'));
                     //set stok
                    $('input[name=barang]').next().text(suggestions.stok);
                    // $('#harga-satuan').numeral(suggestions.harga_jual_current,'0.0');
                    //fokuskan ke qty
                    //enablekan input qty
                    $('input[name=qty],input[name=harga_salesman]').show();
                    $('input[name=harga_salesman],input[name=qty]').val(numeral(suggestions.harga_jual_current).format('0,0'));
                    $('input[name=harga_salesman]').focus();
                    $('input[name=harga_salesman]').select();
            }

            //autocomplete salesman
            $('input[name=salesman]').autocomplete({
                serviceUrl: 'penjualan/jual/get-salesman',
                params: {  'nama': function() {
                                return $('input[name=salesman]').val();
                            }
                        },
                onSelect:function(suggestions){
                    //set salesman id
                    $('input[name=salesman_id]').val(suggestions.data);
                    //set focus ke tanggal
                    $('input[name=tanggal]').focus();
                }

            });
            //autocomplete customer
            $('input[name=customer]').autocomplete({
                serviceUrl: 'penjualan/jual/get-customer',
                params: {  'nama': function() {
                                return $('input[name=customer]').val();
                            }
                        },
                onSelect:function(suggestions){
                    //set customer id
                    $('input[name=customer_id]').val(suggestions.data);
                    //set focus ke salesman
                    $('input[name=salesman]').focus();
                }

            });

            $('input[name=qty], input[name=harga_salesman]').keypress(function(env){
                if(env.keyCode == 13){
                    var obj = $(this);

                    var harga_satuan = $('#harga-satuan').text();
                        harga_satuan = harga_satuan.replace(/\./g, "");
                        harga_satuan = harga_satuan.replace(/,/g, "");
                    
                    var harga_salesman = $('input[name=harga_salesman]').val();
                        harga_salesman = harga_salesman.replace(/\./g, "");
                        harga_salesman = harga_salesman.replace(/,/g, "");

                    //cek harga
                    if(Number(harga_salesman) >= Number(harga_satuan)){
                        if(obj.is( $('input[name=harga_salesman]'))){
                            //fokuskan ke input qty
                            $('input[name=qty]').focus();
                            $('input[name=qty]').select();
                        }else{
                            //check qty
                            var qty = $(this).val();
                            var stok = $('input[name=stok_barang]').val();

                            if(Number(qty) > 0){
                                //cek ketersediaan quantity
                                if(Number(qty) <= Number(stok)){
                                    //tambashkan barang
                                    var id_barang = $('input[name=id_barang]').val();
                                    var kode = $('input[name=kode]').val();
                                    var nama_barang = $('input[name=barang]').val();
                                    var satuan = $('input[name=qty]').parent().next().text();
                                    var total = qty * harga_salesman;
                                    
                                    //add barang ke JSON
                                    brObj.barang.push({
                                        id:id_barang,
                                        kode:kode,
                                        qty:qty,
                                        harga_satuan:harga_satuan,
                                        harga_salesman:harga_salesman,
                                        current_stok:stok
                                    });
                                    
                                    // tampilkan new row tabel barang
                                    var newrow = '<tr data-stok="' + $('input[name=stok_barang]').val() + '" >\n\
                                                    <td class="hide" >' + kode + '</td>\n\
                                                    <td>' + nama_barang + '</td>\n\
                                                    <td class="text-right" >' + numeral(harga_satuan).format('0,0') + '</td>\n\
                                                    <td class="text-right row-harga-salesman" >' + numeral(harga_salesman).format('0,0') + '</td>\n\
                                                    <td class="text-right row-qty" >' + qty + '</td>\n\
                                                    <td>' + satuan + '</td>\n\
                                                    <td class="text-right" >' + numeral(total).format('0,0') + '</td>\n\
                                                    <td><a class="btn btn-danger btn-xs btn-delete-barang" ><i class="fa fa-trash" ></i></a></td>\n\
                                                </tr>';
                                    //mamsukkan new row ke table
                                    $('#table-barang tbody').append(newrow);

                                    //clear input
                                    $('input[name=kode],input[name=barang],input[name=qty],input[name=harga_salesman]').val('')
                                    $('#harga-total,#harga-satuan,#label-satuan').text('');
                                    $('input[name=barang]').focus();
                                    //clear stok
                                    $('input[name=barang]').next().text('');
                                    //sembunyikan input qty
                                    $('input[name=qty],input[name=harga_salesman]').hide();

                                    //hitung grand total
                                    hitungGrandTotal();

                                }else{
                                    //qty melebihi stok
                                    alert('Quantity melebihi stok');
                                }
                            }else{
                                alert('Inputkan quantity');
                            }

                        }

                    }else{
                        alert('Harga salesman di bawah harga normal.');
                        $('input[name=harga_salesman]').focus();
                    }

                    // alert('enter press');
                }
            });

            //hitung total harga pada input qty keyup
            $('input[name=qty]').keyup(function(e){
                var qty = $(this).val();
                var harga = $('input[name=harga_salesman]').text();
                    harga = harga.replace(/\./g, "");
                    harga = harga.replace(/,/g, "");
                var total = harga * qty;

                $('#harga-total').text(numeral(total).format('0,0'));

            });

            //hitung grand total
            function hitungGrandTotal(){
                var sub_total = 0;
                var grand_total = 0;
                var disc = $('input[name=disc]').val();
                    disc = disc.replace(/\./g, "");
                    disc = disc.replace(/,/g, "");

                if(disc == "") disc = 0;

                $.each(brObj.barang,function(i,data){
                    sub_total = sub_total + (data.harga_salesman * data.qty);
                });

                //tampilkan sub_total 
                $('#sub-total').text(numeral(sub_total).format('0,0')); 

                //cek disc jika melebihi suc_total maka harus di rubah
                if(disc <= sub_total){
                    grand_total = sub_total - disc;

                    //tampilkan grand total
                    $('.grand-total').text(numeral(grand_total).format('0,0'));
                    $('input.grand-total').val(numeral(grand_total).format('0,0'));

                }else{
                    alert('Discount melebihi nilai total.');
                    //focuskan ke input disc
                    $('input[name=disc]').val(0);
                    $('input[name=disc]').focus();
                    $('input[name=disc]').select();
                    //kembalikan nilai sub_total
                    $('#sub-total').text(numeral(sub_total).format('0,0')); 
                }
            }

            //cancel add barang
            $('input[name=kode],input[name=barang],input[name=qty],input[name=harga_salesman]').keyup(function(e){
                //cancel button
                if(e.keyCode == 27){
                    //clear input
                    $('input[name=kode],input[name=barang],input[name=qty],input[name=harga_salesman]').val('')
                    $('#harga-total,#harga-satuan,#label-satuan').text('');
                    $('input[name=kode]').focus();
                    //sembunyikan input qty
                    $('input[name=qty]').hide();
                    $('input[name=harga_salesman]').hide();
                }
            });

            //clear customer
            $('#btn-clear-customer').click(function(){
                $('input[name=customer]').val('');
                $('input[name=customer_id]').val('');
            });

            //clear sales man
            $('#btn-clear-salesman').click(function(){
                $('input[name=salesman]').val('');
                $('input[name=salesman_id]').val('');
            });

            //disc key press
            $('input[name=disc]').keyup(function(){
                hitungGrandTotal();
            });

            //exit
            $('#btn-exit').click(function(){
                if(confirm('Anda akan keluar & membatalkan transaksi ini?')){

                }else{
                    return false;
                }
            });

            //SAVE SUBMIT PENJUALAN

            $('#btn-save').click(function(){
                var customer = $('input[name=customer_id]').val() ;
                var salesman = $('input[name=salesman_id]').val() ;
                var tanggal = $('input[name=tanggal]').val() ;
                var pembayaran = $('select[name=pembayaran]').val() ;

                if(customer != "" && salesman != "" && tanggal != "" && pembayaran != "" && brObj.barang.length > 0 ){

                    $('#modal-konfirmasi').modal('show');
                    //fokuskan ke input bayar
                    $('input[name=bayar]').focus();
                    $('input[name=bayar]').select();
                   
                }else{
                    alert('Lengkapi data yang kosong');
                    // fokuskan ke input no inv
                    $('input[name=customer]').focus();
                    $('input[name=customer]').select();
                }               
                

                return false;
            });

            //fungsi simpan data penjualan
            function savePenjualan(){
                //cek submit
                var customer = $('input[name=customer_id]').val() ;
                var salesman = $('input[name=salesman_id]').val() ;
                var tanggal = $('input[name=tanggal]').val() ;
                var pembayaran = $('select[name=pembayaran]').val() ;
                var disc = $('input[name=disc]').autoNumeric('get') ;
                var total = $('#sub-total').text();
                    total = total.replace(/\./g, "");
                    total = total.replace(/,/g, "");

                var grand_total = $('#grand-total-bawah').text();
                    grand_total = grand_total.replace(/\./g, "");
                    grand_total = grand_total.replace(/,/g, "");


                if(customer != "" && salesman != "" && tanggal != "" && pembayaran != "" && brObj.barang.length > 0 ){
                    var newForm = jQuery('<form>', {
                        'action': 'penjualan/jual/insert',
                        'method': 'POST'
                    }).append(jQuery('<input>', {
                        'name': 'customer',
                        'value': customer,
                        'type': 'hidden'
                    })).append(jQuery('<input>', {
                        'name': 'salesman',
                        'value': salesman,
                        'type': 'hidden'
                    })).append(jQuery('<input>', {
                        'name': 'tanggal',
                        'value': tanggal,
                        'type': 'hidden'
                    })).append(jQuery('<input>', {
                        'name': 'pembayaran',
                        'value': pembayaran,
                        'type': 'hidden'
                    })).append(jQuery('<input>', {
                        'name': 'barang',
                        'value': JSON.stringify(brObj),
                        'type': 'hidden'
                    })).append(jQuery('<input>', {
                        'name': 'disc',
                        'value': disc,
                        'type': 'hidden'
                    })).append(jQuery('<input>', {
                        'name': 'total',
                        'value': total,
                        'type': 'hidden'
                    })).append(jQuery('<input>', {
                        'name': 'grand_total',
                        'value': grand_total,
                        'type': 'hidden'
                    }));
                    // alert('submit penjualan');
                    // $('body').append(newForm);
                    newForm.appendTo('body').submit();
                    // newForm.submit();
                }else{
                    alert('Lengkapi data yang kosong');
                    // fokuskan ke input no inv
                    $('input[name=customer]').focus();
                    $('input[name=customer]').select();
                }
            }

            //END SAVE SUBMIT PENJUALAN

            //save & cetak
            $('#btn-save-cetak').click(function(){
                alert('save  & cetak');
            });


            //EDIT HARGA SALESMAN
            var is_edit_mode = false;

            $(document).on('dblclick','.row-harga-salesman',function(e){

                if(!is_edit_mode){
                    var col = $(this);
                    var harga = $(this).text();
                        harga = harga.replace(/\./g, "");
                        harga = harga.replace(/,/g, "");

                    //tampilkan input text
                    col.html('<input class="form-control text-right" name="input-edit-harga-salesman" value="' + harga + '" >');

                    //set auto numeric
                    $('input[name=input-edit-harga-salesman]').autoNumeric('init',{
                        vMin:'0',
                        vMax:'999999999'
                    });

                    //set edit mode
                    is_edit_mode = true;

                    //set focus & select
                    $('input[name=input-edit-harga-salesman]').focus();
                    $('input[name=input-edit-harga-salesman]').select();
                }
            });

            $(document).on('keypress','input[name=input-edit-harga-salesman]',function(e){
                var col = $(this).parent();
                var kode_barang = col.prev().prev().prev().text();
                if(e.keyCode == 13){
                    //submit perubahan harga
                    var harga_satuan = col.prev().text();
                        harga_satuan = harga_satuan.replace(/\./g, "");
                        harga_satuan = harga_satuan.replace(/,/g, "");

                    var harga_salesman = $(this).val();
                        harga_salesman = harga_salesman.replace(/\./g, "");
                        harga_salesman = harga_salesman.replace(/,/g, "");

                    //cek harga apakah lebih besar dari harga standard
                    if(Number(harga_salesman) >= Number(harga_satuan)){

                        col.text(numeral(harga_salesman).format('0,0'));

                        //hitung ulang sub total
                        var qty = col.next().text();
                        var sub_total = Number(harga_salesman) * Number(qty);
                        //set sub total
                        col.next().next().next().text(numeral(sub_total).format('0,0'));

                        //rubah data di json
                        $.each(brObj.barang,function(i,data){
                            if(data.kode == kode_barang){
                                data.harga_salesman = harga_salesman;
                            }
                        });

                        //hitung ulang grand total
                        hitungGrandTotal();

                        //set edit mode to false
                        is_edit_mode = false;
                    }else{
                        alert('Harga di bawah harga normal');
                    }
                }
            });

            //END RUBAH/EDIT HARGA SALESMAN

            //Edit Qty
            $(document).on('dblclick','.row-qty',function(env){
                if(!is_edit_mode){
                    var col = $(this);
                    var qty = $(this).text();
                    var stok = col.parent().data('stok');

                    //tampilkan input text
                    col.html('<input class="form-control text-right" name="input-edit-qty" value="' + qty + '" >');

                    //set edit mode
                    is_edit_mode = true;

                    //set focus & select
                    $('input[name=input-edit-qty]').focus();
                    $('input[name=input-edit-qty]').select();
                }
            });

            //save edit qty
            var default_qty;
            $(document).on('keyup','input[name=input-edit-qty]',function(env){
                if(env.keyCode == 13){
                    var col = $(this).parent();
                    var qty = $(this).val();
                    var stok = col.parent().data('stok');
                    var kode_barang = col.prev().prev().prev().prev().text();
                    
                    //cek qty
                    if(Number(qty) <= Number(stok)){
                        //rubah stok di table
                        col.text(qty);
                        //update di brObj
                        //rubah data di json
                        var new_sub_total = 0;
                        $.each(brObj.barang,function(i,data){
                            if(data.kode == kode_barang){
                                data.qty = qty;
                                new_sub_total = data.harga_salesman * qty;
                            }
                        });

                        //rubah sub total
                        col.next().next().text(numeral(new_sub_total).format('0,0'));

                        //hitung ulang grand total
                        hitungGrandTotal();

                        //set edit mode
                        is_edit_mode = false;
                    }else{
                        //qty melebihi stok
                        alert('Quantity melebihi stok');
                    }
                }
            });
            //End of Edit Qty

            //DELETE BARANG DALAM TABLE
            $(document).on('click','.btn-delete-barang',function(env){
                var col = $(this).parent();
                var kode_barang = col.parent().children('td:first').text();

                if(confirm('Anda akan menghapus data ini?')){
                    //hapus dari brObj
                    var ind;
                    $.each(brObj.barang,function(i,data){
                        if(data.kode == kode_barang){
                            ind = i;
                        }
                    });
                    //delete from brObj
                    brObj.barang.splice(ind,1);

                    //delete row
                    col.parent().fadeOut(250,null,function(env2){
                        col.parent().remove();
                    });

                    //hitung grand total
                    hitungGrandTotal();

                    //fokus ke input barang
                    $('input[name=barang]').focus();
                    $('input[name=barang]').select();
                    $('input[name=kode]').focus();
                    $('input[name=kode]').select();
                }
            });
            //END OF DELETE BARANG DALAM TABLE

            //HITUNG KEMBALIAN
            var confirm_grand_total=0;
            var confirm_bayar=0;
            $('input[name=bayar]').keyup(function(env){
                confirm_grand_total = $(this).parent().parent().prev().children('td:last').text();
                confirm_grand_total = confirm_grand_total.replace(/\./g, "");
                confirm_grand_total = confirm_grand_total.replace(/,/g, "");

                confirm_bayar = $(this).val();
                confirm_bayar = confirm_bayar.replace(/\./g, "");
                confirm_bayar = confirm_bayar.replace(/,/g, "");

                //hitung kembalian
                var kembali = Number(confirm_bayar) - Number(confirm_grand_total);
                //tampilkan kembalian
                $('#kembalian').text(numeral(kembali).format('0,0'));

                if(env.keyCode == 13){
                    if(Number(confirm_bayar) < Number(confirm_grand_total)){
                        alert('Jumlah bayar kurang dari total.');
                        //focuskan ke input bayar
                        $(this).focus();
                        $(this).select();
                    }else{
                        
                    }
                }
            });
            //END OF HITUNG KEMBALIAN

            //SAVE PENJUALAN
            $('#btn-confirm-save').click(function(env){
                // alert('simpan penjualan');
                if(Number(confirm_bayar) < Number(confirm_grand_total)){
                    alert('Jumlah bayar kurang dari total.');
                    //focuskan ke input bayar
                    $('input[name=bayar]').focus();
                    $('input[name=bayar]').select();
                }else{
                    savePenjualan();
                }
            });
            //END SAVE PENJUALAN




        // END OF JQUERY
        })(jQuery);
    </script>
@append
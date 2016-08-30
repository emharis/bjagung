@extends('layouts.master')

@section('styles')
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>

<style>
    #modal-show-jual .modal-dialog {
        width: 75%;
    }
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
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit Data Penjualan
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-body">
            <div class="row" >
                <div class="col-sm-4 col-md-4 col-lg-4" >
                    <table class="table table-bordered table-condensed" >
                        <tbody>
                            <tr>
                                <td>NO. INV</td>
                                <td>:</td>
                                <td>{{$jual->no_inv}}</td>
                            </tr>
                            <tr>
                                <td>CUSTOMER</td>
                                <td>:</td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" name="customer" value="{{$jual->customer}}" class="form-control">
                                        <div class="input-group-btn">
                                          <a id="btn-reset-customer" type="button" class="btn btn-success"><i class="fa fa-refresh" ></i></a>
                                        </div><!-- /btn-group -->
                                    </div>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>SALESMAN</td>
                                <td>:</td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" name="salesman" class="form-control" value="{{$jual->salesman}}" >
                                        <div class="input-group-btn">
                                          <a id="btn-reset-salesman" type="button" class="btn btn-success"><i class="fa fa-refresh" ></i></a>
                                        </div><!-- /btn-group -->
                                    </div>
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4" ></div>
                <div class="col-sm-4 col-md-4 col-lg-4" >
                    <table class="table table-bordered table-condensed" >
                        <tbody>
                            <tr>
                                <td>TANGGAL</td>
                                <td>:</td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" name="tgl" class="form-control" value="{{$jual->tgl_formatted}}">
                                        <div class="input-group-btn">
                                          <a id="btn-reset-tgl" type="button" class="btn btn-success"><i class="fa fa-refresh" ></i></a>
                                        </div><!-- /btn-group -->
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>PEMBAYARAN</td>
                                <td>:</td>
                                <td>
                                    <div class="input-group">
                                        <select name="tipe" class="form-control" >
                                            <option value="T" {{$jual->tipe == 'T' ? 'selected':''}} >TUNAI/LUNAS</option>
                                            <option value="K" {{$jual->tipe == 'K' ? 'selected':''}} >KREDIT/TEMPO</option>
                                        </select>
                                        <div class="input-group-btn">
                                          <a id="btn-reset-tipe" type="button" class="btn btn-success"><i class="fa fa-refresh" ></i></a>
                                        </div><!-- /btn-group -->
                                    </div>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>STATUS</td>
                                <td>:</td>
                                <td>
                                    @if($jual->status == 'N')
                                        -
                                    @else
                                        LUNAS
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="table-responsive" >
                <table class="table table-bordered table-condensed" id="table-barang" >
                    <thead>
                        <tr class="bg-blue">
                            <th>NO</th>
                            <th>KODE/KATEGORI/BARANG <i class="pull-right" >STOK</i></th>
                            <th class="col-sm-1 col-md-1 col-lg-1"  >QTY</th>
                            <th>SAT</th>
                            <th class="col-sm-2 col-md-2 col-lg-2" >HRG/SAT</th>
                            <th class="col-sm-2 col-md-2 col-lg-2"  >HRG/SLS</th>
                            <th class="col-sm-2 col-md-2 col-lg-2" >TOTAL</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- DAFTAR BARANG -->
                         <?php $rownum=1; ?>
                        @foreach($jual_barang as $dt)
                            <tr data-id="{{$dt->barang_id}}" data-stokondb="{{$dt->stok_on_db}}" >
                                <td class="text-right" >{{$rownum++}}</td>
                                <td>{{$dt->kode}} - {{$dt->nama_full}}</td>
                                <td class="text-right col-qty"  >{{$dt->qty}}</td>
                                <td>{{$dt->satuan}}</td>
                                <td class="text-right" >{{number_format($dt->harga_satuan,0,'.',',')}}</td>
                                <td class="text-right col-hrg-sls"  >{{number_format($dt->harga_salesman,0,'.',',')}}</td>
                                <td class="text-right" >{{number_format($dt->total,0,'.',',')}}</td>
                                <td class="text-center" >
                                    <a class="btn btn-success btn-xs btn-edit-barang" ><i class="fa fa-edit" ></i></a>
                                    <a class="btn btn-danger btn-xs btn-hapus-barang" ><i class="fa fa-trash" ></i></a>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="bg-red" style="border-top:3px #808080 solid;" >
                            <td></td>
                            <td colspan="7"  >
                                INPUT BARANG
                            </td>
                        </tr>
                        <tr  >
                            <td></td>
                            <td>
                                <input type="text" class="form-control" name="input-add-nama-barang">
                            </td>
                            <td>
                                <input type="number" class="form-control text-right" name="input-add-qty">
                            </td>
                            <td></td>
                            <td></td>
                            <td>
                                <input type="text" class="form-control text-right" name="input-add-hrg-sls">
                            </td>
                            <td></td>
                            <td class="text-center" >
                                <a class="btn btn-primary btn-sm" >&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus" ></i>&nbsp;&nbsp;&nbsp;&nbsp;</a>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr style="background:whitesmoke;" >
                            <td colspan="6" class="text-right" ><label>TOTAL</label></td>
                            <td class="text-right" ><label id="col-total">{{number_format($jual->total,0,'.',',')}}</label></td>
                            <td></td>
                        </tr>
                        <tr style="background:whitesmoke;" >
                            <td colspan="6" class="text-right" ><label>DISC</label></td>
                            <td class="text-right" style="background:#DFF1F7;" id="col-disc" ><label >{{number_format($jual->disc,0,'.',',')}}</label></td>
                            <td class="text-center" >
                                 <a class="btn btn-success btn-xs btn-edit-disc" ><i class="fa fa-edit" ></i></a>
                            </td>
                        </tr>
                        <tr style="background:whitesmoke;" >
                            <td colspan="6" class="text-right" ><label>JUMLAH BAYAR</label></td>
                            <td class="text-right" ><label id="col-jumlah-bayar">{{number_format($jual->grand_total,0,'.',',')}}</label></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div><!-- /.box-body -->
        <div class="box-footer text-right" >
            <a class="btn btn-primary" id="btn-save" >SAVE</a>
            <a class="btn btn-danger" id="btn-cancel" >CANCEL</a>
        </div>
    </div><!-- /.box -->

</section><!-- /.content -->

<div id="data-jual" class="hide" >{{json_encode($jual)}}</div>
<div id="data-jual-barang" class="hide" >{{json_encode($jual_barang)}}</div>

@stop

@section('scripts')
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>
<script src="plugins/autocomplete/jquery.autocomplete.min.js" type="text/javascript"></script>
<script src="plugins/phpjs/numberformat.js" type="text/javascript"></script>
<script src="plugins/autonumeric/autoNumeric-min.js" type="text/javascript"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="plugins/numeraljs/numeral.min.js" type="text/javascript"></script>

<script type="text/javascript">
(function ($) {

    var jual_obj = JSON.parse($('#data-jual').text());
    var jual_barang_obj = JSON.parse($('#data-jual-barang').text());

    var jual_obj_edited = JSON.parse($('#data-jual').text());
    var jual_barang_obj_edited = JSON.parse($('#data-jual-barang').text());


    //SET AUTOCOMPLETE & EDIT CUSTOMER
    $('input[name=customer]').autocomplete({
        serviceUrl: 'penjualan/jual/get-customer',
        params: {  'nama': function() {
                        return $('input[name=customer]').val();
                    }
                },
        onSelect:function(suggestions){
            //update data jual object
            jual_obj_edited.customer = suggestions.value;
            jual_obj_edited.customer_id = suggestions.data;
        }

    });
    $('input[name=salesman]').autocomplete({
        serviceUrl: 'penjualan/jual/get-salesman',
        params: {  'nama': function() {
                        return $('input[name=salesman]').val();
                    }
                },
        onSelect:function(suggestions){
            jual_obj_edited.salesman = suggestions.value;
            jual_obj_edited.sales_id = suggestions.data;
        }

    });
    //END OF SET AUTOCOMPLETE

    //SET DATE PICKER
    $('input[name=tgl]').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true
    }).on('changeDate',function(env){
        //update ke jual obj
        jual_obj_edited.tgl = $(this).val();
        jual_obj_edited.tgl_formatted = $(this).val();
    });
    //END OF SET DATEPICKER

    //RESET CUSTOMER
    $('#btn-reset-customer').click(function(){
        $('input[name=customer]').val(jual_obj.customer);
        //update di data object
        jual_obj_edited.customer = jual_obj.customer;
        jual_obj_edited.customer_id = jual_obj.customer_id;
    });
    //END OF RESET CUSTOMER

    //RESET SALESMAN
    $('#btn-reset-salesman').click(function(){
        $('input[name=salesman]').val(jual_obj.salesman);
        //update di data object
        jual_obj_edited.salesman = jual_obj.salesman;
        jual_obj_edited.sales_id = jual_obj.sales_id;

    });
    //END OF RESET SALESMAN

    //RESET SALESMAN
    $('#btn-reset-tgl').click(function(){
        $('input[name=tgl]').val(jual_obj.tgl_formatted);
        //update jual obj
        jual_obj_edited.tgl = jual_obj.tgl;
        jual_obj_edited.tgl_formatted = jual_obj.tgl_formatted;
    });
    //END OF RESET SALESMAN

    //EDIT QTY
    // var on_edit = false;
    // var qty_default;
    // var stok_on_db = 0;
    // $('.col-qty').dblclick(function(env){
    //     if(!on_edit){
    //         var qty = $(this).text();
    //         qty_default = $(this).text();
    //         var col = $(this);

    //         //stok on db
    //         stok_on_db = $(this).parent().data('stokondb');
    //         stok_on_db = Number(qty) + stok_on_db;

    //         //get stok qty dari database di tambahkan dengan qty yg mau di edit


    //         //ganti content column dengan input text
    //         col.html('<input type="text" name="input-edit-qty" class="form-control text-right" value="' + qty + '" >');
    //         //focuskan
    //         $('input[name=input-edit-qty]').select();
    //         //set on edit mode
    //         on_edit = true;
    //     }else{
    //         $('input[name=input-edit-qty]').focus();
    //         $('input[name=input-edit-qty]').select();
    //     }
    // });

    // // prevent input selain number
    // $(document).on('keydown','input[name=input-edit-qty]',function(env){

    //     if (env.which >= 65 && env.which <= 90)
    //     {
    //         env.preventDefault();
    //     }
    // });

    // //Input Edit on Edit
    // $(document).on('keypress','input[name=input-edit-qty]',function(env){
    //     if(env.keyCode == 13){
    //         var col = $(this).parent();
    //         var new_qty = $(this).val();
    //         var barang_id = $(this).parent().parent().data('id');
    //         //get harga salesman
    //         var harga_salesman = col.next().next().next().text();
    //         harga_salesman = harga_salesman.replace(/\./g, "");
    //         harga_salesman = harga_salesman.replace(/,/g, "");

    //         //cek number
    //         if(Number(new_qty)){
    //             //cek new_qty tidak melebihi stok yang ada
    //             if(Number(new_qty) <= Number(stok_on_db)){
    //                 //rubah qty di json obj
    //                 $.each(jual_barang_obj_edited,function(i,brg){
    //                     if(brg.barang_id == barang_id){
    //                         //update qty
    //                         brg.qty = new_qty;
    //                         //ganti input dengan text quatity
    //                         col.text(new_qty);
    //                         //hitung kembali total harga
    //                         var total = harga_salesman * new_qty;
    //                         col.next().next().next().next().text(numeral(total).format('0,0'));
    //                         //update total di json_obj
    //                         brg.total = total;

    //                         //hitung total & grand total
    //                         hitungTotalGrandTotal();

    //                         //set edit mode
    //                         on_edit = false;
    //                     }
    //                 });

    //             }else{
    //                 alert('Quantity melebihi persediaan.');
    //                 $(this).select();
    //             }

                
    //         }else{
    //             alert('Inputkan Quantity');
    //             $(this).select();
    //         }
            
    //     }else if(env.keyCode == 27){
    //         $(this).parent().text(qty_default);
    //         //set edit mode
    //         on_edit = false;
    //     }
    // });

    // // cancel edit qty
    // $(document).on('keyup','input[name=input-edit-qty]',function(env){
    //     if(env.keyCode == 27){
    //         $(this).parent().text(qty_default);
    //         //set edit mode
    //         on_edit = false;
    //     }
    // });

    //hitung total dan grand total
    // var new_grand_total=0;
    // var new_total=0;
    function hitungTotalGrandTotal(){
        // new_grand_total = 0;
        // new_total = 0;
        // $.each(jual_barang_obj_edited,function(i,brg){
        //     new_total = Number(new_total) +  Number(brg.qty) * Number(brg.harga_salesman);
            
        // });
        // new_grand_total = Number(new_total) - Number(jual_obj_edited.disc);

        // //set ke jual_barang_object
        // jual_barang_obj_edited.total = new_total;
        // jual_barang_obj_edited.grand_total = new_grand_total;

        var total_pembayaran_kotor=0;
        var disc=Number(jual_obj_edited.disc);
        var grand_total=0;

        $.each(jual_barang_obj_edited,function(i,data){
            total_pembayaran_kotor = Number(total_pembayaran_kotor) + Number(data.qty) * Number(data.harga_salesman);
        });
        grand_total = Number(total_pembayaran_kotor) - Number(disc);

        //set new grand total ke object
        jual_obj_edited.total = total_pembayaran_kotor;
        jual_obj_edited.grand_total = grand_total;
        // alert(JSON.stringify(jual_obj_edited));

        $('#col-total').text(numeral(total_pembayaran_kotor).format('0,0'));
        $('#col-jumlah-bayar').text(numeral(grand_total).format('0,0'));
    }
    //END OF EDIT QTY

    //EDIT HARGA SALESMAN
    // var hrg_sls_default = 0;
    // $('.col-hrg-sls').dblclick(function(env){
    //     if(!on_edit){
    //         var hrg_sls = $(this).text();
    //         hrg_sls = hrg_sls.replace(/\./g, "");
    //         hrg_sls = hrg_sls.replace(/,/g, "");

    //         hrg_sls_default = hrg_sls;
    //         var col = $(this);
    //         //ganti content column dengan input text
    //         col.html('<input type="text" name="input-edit-hrg-sls" class="form-control text-right" value="' + hrg_sls + '" >');
    //         //focuskan
    //         $('input[name=input-edit-hrg-sls]').select();
    //         //set on edit mode
    //         on_edit = true;
    //     }else{
    //         $('input[name=input-edit-hrg-sls]').focus();
    //         $('input[name=input-edit-hrg-sls]').select();
    //     }
    // });

    // $(document).on('keyup','input[name=input-edit-hrg-sls]',function(env){
    //     var col = $(this).parent();
    //     if(env.keyCode == 13){
    //         //set harga salesman baru
    //         var hrg_sls_baru = $(this).val();
    //         var qty = col.prev().prev().prev().text();
    //         var barang_id = $(this).parent().parent().data('id');
    //         //set ke table
    //         col.text(numeral(hrg_sls_baru).format('0,0'));
    //         //hitung total harga barang
    //         var total_harga_baru = Number(qty) * Number(hrg_sls_baru);
    //         //set total harga baru ke table
    //         col.next().text(numeral(total_harga_baru).format('0,0'));

    //         //rubah harga di json obj
    //         $.each(jual_barang_obj_edited,function(i,brg){
    //             if(brg.barang_id == barang_id){
    //                 //update qty
    //                 brg.harga_salesman = hrg_sls_baru;
    //                 //update total di json_obj
    //                 brg.total = total_harga_baru;

    //                 //hitung total & grand total
    //                 hitungTotalGrandTotal();

    //                 //set edit mode
    //                 on_edit = false;
    //             }
    //         });
    //     }else if(env.keyCode == 27){
    //         col.text(numeral(hrg_sls_default).format('0,0'));

    //         //set false on edit mode
    //         on_edit = false;
    //     }
    // });
    //END OF EDIT HARGA SALESMAN

    //EDIT DISC
    // var disc_default=0;
    // $('#col-disc').dblclick(function(env){
    //     if(!on_edit){
    //         disc_default = $(this).text();
    //         disc_default = disc_default.replace(/\./g, "");
    //         disc_default = disc_default.replace(/,/g, "");
    //         var col = $(this);
    //         //ganti content column dengan input text
    //         col.html('<input type="text" name="input-edit-disc" class="form-control text-right" value="' + disc_default + '" >');
    //         //focuskan
    //         $('input[name=input-edit-disc]').select();
    //         //set on edit mode
    //         on_edit = true;
    //     }else{
    //         $('input[name=input-edit-disc]').focus();
    //         $('input[name=input-edit-disc]').select();
    //     }

    // });

    // $(document).on('keyup','input[name=input-edit-disc]',function(env){
    //     var col = $(this).parent();

    //     if(env.keyCode == 13){
    //         var disc_baru = $(this).val();

    //         //update ke table
    //         col.html('<label>' + numeral(disc_baru).format('0,0') + '</label>');

    //         //update ke jual object
    //         jual_obj_edited.disc = disc_baru;

    //         //hitung ulang grand total
    //         hitungTotalGrandTotal();

    //         //set on edit false
    //         on_edit = false;
    //     }else if(env.keyCode == 27){
    //         //cancel edit disc
    //         //update ke table
            
    //         col.html('<label>' + numeral(disc_default).format('0,0') + '</label>');

    //         //set on edit false
    //         on_edit = false;
    //     }
    // });
    //END OF EDIT DISC


    //EDIT DATA BARANG
    //================================================================
    var default_qty=0;
    var default_hrg_sls=0;
    var on_edit_mode = false;
    var col_qty;
    var col_hrg_sls;
    var col_btn;
    var row;
    var stok_on_db=0;
    var editing_barang_id;

    $(document).on('click','.btn-edit-barang',function(){

        if(!on_edit_mode){
            on_edit_mode = true;

            //disable tombol save
            $('#btn-save').addClass('disabled');

            row = $(this).parent('td').parent('tr');
            col_qty = row.children('td:first').next().next();
            col_hrg_sls = row.children('td:first').next().next().next().next().next();
            col_btn = row.children('td:last');
            editing_barang_id = row.data('id');

            //get default harga salesman dan default qty
            default_qty = col_qty.text();
            default_hrg_sls = col_hrg_sls.text();
            default_hrg_sls = default_hrg_sls.replace(/\./g, "");
            default_hrg_sls = default_hrg_sls.replace(/,/g, "");  

            //ganti col qty & harga_salesman dengan input text
            //edit qty
            col_qty.html('<input name="input-edit-qty" type="number" class="form-control text-right" value="' + default_qty + '" > ');
            //edit harga_salesman
            col_hrg_sls.html('<input name="input-edit-hrg-sls" type="text" class="form-control text-right" value="' + default_hrg_sls + '" > ');

            //ganti tombol edit & delete dengan simpan & cancel
            col_btn.html('<a class="btn btn-primary btn-xs " id="btn-save-edit-barang" ><i class="fa fa-save" ></i></a> <a class="btn btn-danger btn-xs " id="btn-cancel-edit-barang" ><i class="fa fa-close" ></i></a>');

            //set row color
            row.css('background-color','#DFF1F7');

            //focuskan ke input edit qty
            $('input[name=input-edit-qty]').select();

            //set auto numeric
            $('input[name=input-edit-hrg-sls]').autoNumeric('init',{
                vMin:'0',
                vMax:'999999999'
            });

            // stok on db
            stok_on_db = row.data('stokondb');
            // stok_on_db = Number(stok_on_db) + Number(default_qty);
            //tampilkan stok pada table
            row.children('td:first').next().append('<i class="pull-right text-red" id="stok-info" ><b>'+stok_on_db+'</b></i>');

        }else{
            alert('Simpan/Batalkan edit data sebelumnya.');
        }       

    });

    //// save editing barang on row
    $(document).on('click','#btn-save-edit-barang',function(){
        //get qty baru
        var new_qty = $('input[name=input-edit-qty]').val();
        //get harga salesman baru
        var new_hrg_sls = $('input[name=input-edit-hrg-sls]').val();
        new_hrg_sls = new_hrg_sls.replace(/\./g, "");
        new_hrg_sls = new_hrg_sls.replace(/,/g, ""); 
        //set can_save
        var can_save = true;
        //get harga minimum barang
        var harga_minimum = row.children('td:first').next().next().next().next().text();
        harga_minimum = harga_minimum.replace(/\./g, "");
        harga_minimum = harga_minimum.replace(/,/g, "");

        //cek qty melebihi stok_on_db atau 0
        if(Number(new_qty) > 0){
            //cek qty melebihi stok
            if(Number(new_qty) > Number(stok_on_db)){
                alert('Quantity melebihi stok yang tersedia.');
                can_save = false;
                $('input[name=input-edit-qty]').select();
                
            }
        }else{
            alert('Input nilai quantity.');
            can_save = false;
            $('input[name=input-edit-qty]').select();
            
        }

        //cek harga salesman
        if(Number(new_hrg_sls) < Number(harga_minimum)){
            alert('Harga salesman di bawah harga minimum');
            can_save = false;
            $('input[name=input-edit-hrg-sls]').select();
        }

        //simpan perubahan data barang
        if(can_save){
            //update data ke jual_barang_obj_edited
            $.each(jual_barang_obj_edited,function(i,data){
                if(data.barang_id == editing_barang_id){
                    data.qty = new_qty;
                    data.harga_salesman = new_hrg_sls;
                    data.total = Number(new_hrg_sls) * Number(new_qty);
                }
            });

            hitungTotalGrandTotal();

            
            //set edit mode
            on_edit_mode = false;

            //rubah col qty dan harga salesman ke default
            col_qty.html(new_qty);
            col_hrg_sls.html(numeral(new_hrg_sls).format('0,0'));
            //ganti tombol dengan tombol edit & delte
            col_btn.html('<a class="btn btn-success btn-xs btn-edit-barang" ><i class="fa fa-edit" ></i></a> <a class="btn btn-danger btn-xs btn-hapus-barang" ><i class="fa fa-trash" ></i></a>');
            //reset color 
            row.css('background-color','#ffffff');
            //enable kan tombol save
            $('#btn-save').removeClass('disabled');
            //remove stok info
            $('#stok-info').remove();
        }
        
    });
    //// end of save editing barang on row

    //// cancel editing barang on row
    $(document).on('click','#btn-cancel-edit-barang',function(){
        //set edit mode
        on_edit_mode = false;
        //rubah col qty dan harga salesman ke default
        col_qty.html(default_qty);
        col_hrg_sls.html(default_hrg_sls);
        //ganti tombol dengan tombol edit & delte
        col_btn.html('<a class="btn btn-success btn-xs btn-edit-barang" ><i class="fa fa-edit" ></i></a> <a class="btn btn-danger btn-xs btn-hapus-barang" ><i class="fa fa-trash" ></i></a>');
        //reset color 
        row.css('background-color','#ffffff');
        //clear temp data
        default_qty = 0;
        default_hrg_sls = 0;
        //enable kan tombol save
        $('#btn-save').removeClass('disabled');
        //remove stok info
        $('#stok-info').remove();

    });
    //// end of cancel editing barang on row

    //// on edit qty on row
    $(document).on('keyup','input[name=input-edit-qty],input[name=input-edit-hrg-sls]',function(){
        // var new_qty = $(this).val();
        //hitung total harga barang
        hitungTotalHargaBarang();
    });
    //// end of edit qty on row

    //// hitung total harga per barang per row
    function hitungTotalHargaBarang(){
        var a_qty = $('input[name=input-edit-qty]').val();
        var a_hrg_sls = $('input[name=input-edit-hrg-sls]').val();
        a_hrg_sls = a_hrg_sls.replace(/\./g, "");
        a_hrg_sls = a_hrg_sls.replace(/,/g, "");
        var a_total_harga = Number(a_qty) * Number(a_hrg_sls);
        //set total harga ke colom total
        row.children('td:last').prev().text(numeral(a_total_harga).format('0,0'));
    }
    //// end of hitung total harga per barang per row

    //================================================================
    //END OF EDIT DATA BARANG


    //DELETE DATA BARANG
    //================================================================

    $('.btn-hapus-barang').click(function(){
        if(confirm('Anda akan menghapus data ini?')){
            var del_row = $(this).parent().parent(); 
            var barang_id = del_row.data('id');
            //hapus data dari jual_barang_obj_edited
            var del_index=0;
            var can_delete = false;
            $.each(jual_barang_obj_edited,function(i,data){
                if(data.barang_id == barang_id){
                    del_index = i;
                    can_delete = true;
                }
            });

            if(can_delete){
                //hapus data dari array barang
                jual_barang_obj_edited.splice(del_index,1);
                //delete row
                del_row.fadeOut(250,function(){
                    del_row.remove();

                    //re order row number
                    $('#table-barang > tbody > tr').each(function(i,data){
                        $(this).children('td:first').text(Number(i)+1);

                        //hapus content row terakhir
                        $('#table-barang > tbody > tr:last').prev().children('td:first').text('');
                        $('#table-barang > tbody > tr:last').children('td:first').text('');
                    });
                });
            }

            
        }
    });

    //================================================================
    //END OF DELETE DATA BARANG

    //SELECT CHANGE TIPE
    $('select[name=tipe]').change(function(){
        //update jual obj
        jual_obj_edited.tipe = $(this).val();
    });
    //END OF SELECT CHANGE TIPE

    //RESET TIPE
    $('#btn-reset-tipe').click(function(env){
        $('select[name=tipe]').val(jual_obj.tipe);
        //reset jual obj
        jual_obj_edited.tipe = jual_obj.tipe;
    });
    //END OF RESET TIPE

    //CANCEL EDIT DATA JUAL
    $('#btn-cancel').click(function(){
        if(confirm('Anda akan membatalkan perubahan data ini?')){
            location.href = "penjualan/jual";
        }
    });
    //END OF CANCEL EDIT DATA JUAL

    //SUBMIT/SAVE EDIT
    $('#btn-save').click(function(){
         $.each(jual_barang_obj_edited,function(i,brg){
            alert(brg.qty);
            alert(brg.harga_salesman);
         });
    });
    //END OF SUBMIT/SAVE EDIT

// END OF JQUERY
})(jQuery);
</script>
@append
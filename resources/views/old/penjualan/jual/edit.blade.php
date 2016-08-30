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
                        <tr>
                            <th>NO</th>
                            <th>KODE/KATEGORI/BARANG</th>
                            <th class="col-sm-1 col-md-1 col-lg-1"  >QTY</th>
                            <th>SAT</th>
                            <th class="col-sm-2 col-md-2 col-lg-2" >HRG/SAT</th>
                            <th class="col-sm-2 col-md-2 col-lg-2"  >HRG/SLS</th>
                            <th class="col-sm-2 col-md-2 col-lg-2" >TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- DAFTAR BARANG -->
                         <?php $rownum=1; ?>
                        @foreach($jual_barang as $dt)
                            <tr data-id="{{$dt->barang_id}}" data-stokondb="{{$dt->stok_on_db}}" >
                                <td class="text-right" >{{$rownum++}}</td>
                                <td>{{$dt->kode}} - {{$dt->nama_full}}</td>
                                <td class="text-right col-qty" style="background:#DFF1F7;" >{{$dt->qty}}</td>
                                <td>{{$dt->satuan}}</td>
                                <td class="text-right" >{{number_format($dt->harga_satuan,0,'.',',')}}</td>
                                <td class="text-right col-hrg-sls" style="background:#DFF1F7;" >{{number_format($dt->harga_salesman,0,'.',',')}}</td>
                                <td class="text-right" >{{number_format($dt->total,0,'.',',')}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr style="background:whitesmoke;" >
                            <td colspan="6" class="text-right" ><label>TOTAL</label></td>
                            <td class="text-right" ><label id="col-total">{{number_format($jual->total,0,'.',',')}}</label></td>
                        </tr>
                        <tr style="background:whitesmoke;" >
                            <td colspan="6" class="text-right" ><label>DISC</label></td>
                            <td class="text-right" style="background:#DFF1F7;" id="col-disc" ><label >{{number_format($jual->disc,0,'.',',')}}</label></td>
                        </tr>
                        <tr style="background:whitesmoke;" >
                            <td colspan="6" class="text-right" ><label>JUMLAH BAYAR</label></td>
                            <td class="text-right" ><label id="col-jumlah-bayar">{{number_format($jual->grand_total,0,'.',',')}}</label></td>
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


    // SET AUTOCOMPLETE & EDIT CUSTOMER
    $('input[name=customer]').autocomplete({
        serviceUrl: 'penjualan/jual/get-customer',
        params: {  'nama': function() {
                        return $('input[name=customer]').val();
                    }
                },
        onSelect:function(suggestions){
            // update data jual object
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
    // END OF SET AUTOCOMPLETE

    // SET DATE PICKER
    $('input[name=tgl]').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true
    }).on('changeDate',function(env){
        // update ke jual obj
        jual_obj_edited.tgl = $(this).val();
        jual_obj_edited.tgl_formatted = $(this).val();
    });
    // END OF SET DATEPICKER

    // RESET CUSTOMER
    $('#btn-reset-customer').click(function(){
        $('input[name=customer]').val(jual_obj.customer);
        // update di data object
        jual_obj_edited.customer = jual_obj.customer;
        jual_obj_edited.customer_id = jual_obj.customer_id;
    });
    // END OF RESET CUSTOMER

    // RESET SALESMAN
    $('#btn-reset-salesman').click(function(){
        $('input[name=salesman]').val(jual_obj.salesman);
        // update di data object
        jual_obj_edited.salesman = jual_obj.salesman;
        jual_obj_edited.sales_id = jual_obj.sales_id;

    });
    // END OF RESET SALESMAN

    // RESET SALESMAN
    $('#btn-reset-tgl').click(function(){
        $('input[name=tgl]').val(jual_obj.tgl_formatted);
        // update jual obj
        jual_obj_edited.tgl = jual_obj.tgl;
        jual_obj_edited.tgl_formatted = jual_obj.tgl_formatted;
    });
    // END OF RESET SALESMAN

    // EDIT QTY
    var on_edit = false;
    var qty_default;
    var stok_on_db = 0;
    $('.col-qty').dblclick(function(env){
        if(!on_edit){
            var qty = $(this).text();
            qty_default = $(this).text();
            var col = $(this);

            // stok on db
            stok_on_db = $(this).parent().data('stokondb');
            stok_on_db = Number(qty) + stok_on_db;

            // get stok qty dari database di tambahkan dengan qty yg mau di edit


            // ganti content column dengan input text
            col.html('<input type="text" name="input-edit-qty" class="form-control text-right" value="' + qty + '" >');
            // focuskan
            $('input[name=input-edit-qty]').select();
            // set on edit mode
            on_edit = true;
        }else{
            $('input[name=input-edit-qty]').focus();
            $('input[name=input-edit-qty]').select();
        }
    });

    // prevent input selain number
    $(document).on('keydown','input[name=input-edit-qty]',function(env){

        if (env.which >= 65 && env.which <= 90)
        {
            env.preventDefault();
        }
    });

    // Input Edit on Edit
    $(document).on('keypress','input[name=input-edit-qty]',function(env){
        if(env.keyCode == 13){
            var col = $(this).parent();
            var new_qty = $(this).val();
            var barang_id = $(this).parent().parent().data('id');
            // get harga salesman
            var harga_salesman = col.next().next().next().text();
            harga_salesman = harga_salesman.replace(/\./g, "");
            harga_salesman = harga_salesman.replace(/,/g, "");

            // cek number
            if(Number(new_qty)){
                // cek new_qty tidak melebihi stok yang ada
                if(Number(new_qty) <= Number(stok_on_db)){
                    // rubah qty di json obj
                    $.each(jual_barang_obj_edited,function(i,brg){
                        if(brg.barang_id == barang_id){
                            // update qty
                            brg.qty = new_qty;
                            // ganti input dengan text quatity
                            col.text(new_qty);
                            // hitung kembali total harga
                            var total = harga_salesman * new_qty;
                            col.next().next().next().next().text(numeral(total).format('0,0'));
                            // update total di json_obj
                            brg.total = total;

                            // hitung total & grand total
                            hitungTotalGrandTotal();

                            // set edit mode
                            on_edit = false;
                        }
                    });

                }else{
                    alert('Quantity melebihi persediaan.');
                    $(this).select();
                }

                
            }else{
                alert('Inputkan Quantity');
                $(this).select();
            }
            
        }else if(env.keyCode == 27){
            $(this).parent().text(qty_default);
            // set edit mode
            on_edit = false;
        }
    });

    // cancel edit qty
    $(document).on('keyup','input[name=input-edit-qty]',function(env){
        if(env.keyCode == 27){
            $(this).parent().text(qty_default);
            // set edit mode
            on_edit = false;
        }
    });

    // hitung total dan grand total
    var new_grand_total=0;
    var new_total=0;
    function hitungTotalGrandTotal(){
        new_grand_total = 0;
        new_total = 0;
        $.each(jual_barang_obj_edited,function(i,brg){
            new_total = Number(new_total) +  Number(brg.qty) * Number(brg.harga_salesman);
            
        });
        new_grand_total = Number(new_total) - Number(jual_obj_edited.disc);

        // set ke jual_barang_object
        jual_barang_obj_edited.total = new_total;
        jual_barang_obj_edited.grand_total = new_grand_total;

        $('#col-total').text(numeral(new_total).format('0,0'));
        $('#col-jumlah-bayar').text(numeral(new_grand_total).format('0,0'));
    }
    // END OF EDIT QTY

    // EDIT HARGA SALESMAN
    var hrg_sls_default = 0;
    $('.col-hrg-sls').dblclick(function(env){
        if(!on_edit){
            var hrg_sls = $(this).text();
            hrg_sls = hrg_sls.replace(/\./g, "");
            hrg_sls = hrg_sls.replace(/,/g, "");

            hrg_sls_default = hrg_sls;
            var col = $(this);
            // ganti content column dengan input text
            col.html('<input type="text" name="input-edit-hrg-sls" class="form-control text-right" value="' + hrg_sls + '" >');
            // focuskan
            $('input[name=input-edit-hrg-sls]').select();
            // set on edit mode
            on_edit = true;
        }else{
            $('input[name=input-edit-hrg-sls]').focus();
            $('input[name=input-edit-hrg-sls]').select();
        }
    });

    $(document).on('keyup','input[name=input-edit-hrg-sls]',function(env){
        var col = $(this).parent();
        if(env.keyCode == 13){
            // set harga salesman baru
            var hrg_sls_baru = $(this).val();
            var qty = col.prev().prev().prev().text();
            var barang_id = $(this).parent().parent().data('id');
            // set ke table
            col.text(numeral(hrg_sls_baru).format('0,0'));
            // hitung total harga barang
            var total_harga_baru = Number(qty) * Number(hrg_sls_baru);
            // set total harga baru ke table
            col.next().text(numeral(total_harga_baru).format('0,0'));

            // rubah harga di json obj
            $.each(jual_barang_obj_edited,function(i,brg){
                if(brg.barang_id == barang_id){
                    // update qty
                    brg.harga_salesman = hrg_sls_baru;
                    // update total di json_obj
                    brg.total = total_harga_baru;

                    // hitung total & grand total
                    hitungTotalGrandTotal();

                    // set edit mode
                    on_edit = false;
                }
            });
        }else if(env.keyCode == 27){
            col.text(numeral(hrg_sls_default).format('0,0'));

            // set false on edit mode
            on_edit = false;
        }
    });
    // END OF EDIT HARGA SALESMAN

    // EDIT DISC
    var disc_default=0;
    $('#col-disc').dblclick(function(env){
        if(!on_edit){
            disc_default = $(this).text();
            disc_default = disc_default.replace(/\./g, "");
            disc_default = disc_default.replace(/,/g, "");
            var col = $(this);
            // ganti content column dengan input text
            col.html('<input type="text" name="input-edit-disc" class="form-control text-right" value="' + disc_default + '" >');
            // focuskan
            $('input[name=input-edit-disc]').select();
            // set on edit mode
            on_edit = true;
        }else{
            $('input[name=input-edit-disc]').focus();
            $('input[name=input-edit-disc]').select();
        }

    });

    $(document).on('keyup','input[name=input-edit-disc]',function(env){
        var col = $(this).parent();

        if(env.keyCode == 13){
            var disc_baru = $(this).val();

            // update ke table
            col.html('<label>' + numeral(disc_baru).format('0,0') + '</label>');

            // update ke jual object
            jual_obj_edited.disc = disc_baru;

            // hitung ulang grand total
            hitungTotalGrandTotal();

            // set on edit false
            on_edit = false;
        }else if(env.keyCode == 27){
            // cancel edit disc
            // update ke table
            
            col.html('<label>' + numeral(disc_default).format('0,0') + '</label>');

            // set on edit false
            on_edit = false;
        }
    });
    // END OF EDIT DISC

    // SELECT CHANGE TIPE
    $('select[name=tipe]').change(function(){
        // update jual obj
        jual_obj_edited.tipe = $(this).val();
    });
    // END OF SELECT CHANGE TIPE

    // RESET TIPE
    $('#btn-reset-tipe').click(function(env){
        $('select[name=tipe]').val(jual_obj.tipe);
        // reset jual obj
        jual_obj_edited.tipe = jual_obj.tipe;
    });
    // END OF RESET TIPE

    // CANCEL EDIT DATA JUAL
    $('#btn-cancel').click(function(){
        if(confirm('Anda akan membatalkan perubahan data ini?')){
            location.href = "penjualan/jual";
        }
    });
    // END OF CANCEL EDIT DATA JUAL

    // SUBMIT/SAVE EDIT
    $('#btn-save').click(function(){
         $.each(jual_barang_obj_edited,function(i,brg){
            alert(brg.qty);
            alert(brg.harga_salesman);
         });
    });
    // END OF SUBMIT/SAVE EDIT

// END OF JQUERY
})(jQuery);
</script>
@append
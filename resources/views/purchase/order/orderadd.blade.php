@extends('layouts.master')

@section('styles')
<link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>
<style>
    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #FFE291; }
    .autocomplete-suggestions strong { font-weight: normal; color: red; }
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }

    .table-row-mid > tbody > tr > td {
        vertical-align:middle;
    }

    input.input-clear {
        display: block; 
        padding: 0; 
        margin: 0; 
        border: 0; 
        width: 100%;
        background-color:#EEF0F0;
        float:right;
        padding-right: 5px;
        padding-left: 5px;
    }
</style>

@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <a href="purchase/order" >Purchase Order</a> <i class="fa fa-angle-double-right" ></i> New
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-header with-border" style="padding-top:5px;padding-bottom:5px;" >
            <label> <small>Purchase Order</small> <h4 style="font-weight: bolder;margin-top:0;padding-top:0;margin-bottom:0;padding-bottom:0;" >New</h4></label>

            <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>
            <a class="btn  btn-arrow-right pull-right disabled bg-gray" >Validated</a>

            <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>

            <a class="btn btn-arrow-right pull-right disabled bg-gray" >Open PO</a>

            <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>

            <a class="btn btn-arrow-right pull-right disabled bg-blue" >Draft PO</a>
        </div>
        <div class="box-body">
            <table class="table" >
                <tbody>
                    <tr>
                        <td class="col-lg-2">
                            <label>Supplier</label>
                        </td>
                        <td class="col-lg-4" >
                            <input type="text" name="supplier" class="form-control" data-supplierid="" required>
                        </td>
                        <td class="col-lg-2" ></td>
                        <td class="col-lg-2" >
                            <label>Order Date</label>
                        </td>
                        <td class="col-lg-2" >
                            <input type="text" name="tanggal" class="input-tanggal form-control" value="{{date('d-m-Y')}}" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-lg-2">
                            <label>No. Invoice</label>
                        </td>
                        <td class="col-lg-4" >
                            <input type="text" name="no_inv" class="form-control" >
                        </td>
                        <td class="col-lg-2" ></td>
                        <td class="col-lg-2 hide" >
                            <label>Jatuh Tempo</label>
                        </td>
                        <td class="col-lg-2 hide" >
                            <input type="text" name="jatuh_tempo"  class="input-tanggal form-control" value="" >
                        </td>
                    </tr>
                </tbody>
            </table>

            <h4 class="page-header" style="font-size:14px;color:#3C8DBC"><strong>PRODUCT DETAILS</strong></h4>

            <table id="table-product" class="table table-bordered table-condensed" >
                <thead>
                    <tr>
                        <th style="width:25px;" >NO</th>
                        <th class="col-lg-4" >PRODUCT</th>
                        <th class="col-lg-1" >QUANTITY</th>
                        <th>UNIT PRICE</th>
                        <th>SUBTOTAL</th>
                        <th style="width:50px;" ></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hide" id="row-add-product"  >
                        <td class="text-right" ></td>
                        <td>
                            <input autocomplete="off" type="text"  data-barangid="" data-kode="" class="text-uppercase form-control input-product input-sm input-clear">
                        </td>
                        <td>
                            <input type="number" autocomplete="off" min="1" class="form-control text-right input-quantity input-sm input-clear">
                        </td>
                        <td>
                            <input autocomplete="off" type="text" class="text-right form-control input-unit-price input-sm input-clear">
                        </td>
                        <td>
                            <input autocomplete="off" type="text" readonly  class="text-right form-control input-subtotal input-sm input-clear">
                        </td>
                        <td class="text-center" >
                            <a href="#" class="btn-delete-row-product" ><i class="fa fa-trash" ></i></a>
                        </td>
                    </tr>
                    <tr id="row-btn-add-item">
                        <td></td>
                        <td colspan="5" >
                            <a id="btn-add-item" href="#">Add an item</a>
                        </td>
                    </tr>
                    
                    
                </tbody>
            </table>

            <div class="row" >
                <div class="col-lg-8" >
                    <textarea name="note" class="form-control" rows="4" style="margin-top:5px;" placeholder="Note" ></textarea>
                </div>
                <div class="col-lg-4" >
                    <table class="table table-condensed" >
                        <tbody>
                            <tr>
                                <td class="text-right">
                                    <label>Subtotal :</label>
                                </td>
                                <td class="label-total-subtotal text-right" >
                                    
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right" >
                                    <label>Disc :</label>
                                </td>
                                <td >
                                   <input style="font-size:14px;" type="text" name="disc" class="input-sm form-control text-right input-clear"> 
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right" style="border-top:solid darkgray 1px;" >
                                    Total :
                                </td>
                                <td class="label-total text-right" style="font-size:18px;font-weight:bold;border-top:solid darkgray 1px;" >
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12" >
                    <button type="submit" class="btn btn-primary" id="btn-save" >Save</button>
                            <a class="btn btn-danger" id="btn-cancel-save" >Cancel</a>
                </div>
            </div>



            {{-- <a id="btn-test" href="#" >TEST</a> --}}


        </div><!-- /.box-body -->
    </div><!-- /.box -->

</section><!-- /.content -->

@stop

@section('scripts')
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="plugins/autocomplete/jquery.autocomplete.min.js" type="text/javascript"></script>
<script src="plugins/autonumeric/autoNumeric-min.js" type="text/javascript"></script>

<script type="text/javascript">
(function ($) {
    // SET DATEPICKER
    $('.input-tanggal').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true
    });
    // END OF SET DATEPICKER

    // SET AUTOCOMPLETE SUPPLIER
    $('input[name=supplier]').autocomplete({
        serviceUrl: 'purchase/order/get-supplier',
        params: {  'nama': function() {
                        return $('input[name=supplier]').val();
                    }
                },
        onSelect:function(suggestions){
            // set data supplier
            $('input[name=supplier]').data('supplierid',suggestions.data);

            // tentukan tanggal jatuh tempo
            // alert(suggestions.jatuh_tempo);
            var tgl = $('input[name=tanggal]').val();
            var tgl_arr = tgl.split('-');
            var jq_tgl = new Date();
                jq_tgl.setDate(tgl_arr[0]);
                jq_tgl.setMonth(tgl_arr[1]-1);
                jq_tgl.setFullYear(tgl_arr[2]);

            jq_tgl.setDate(jq_tgl.getDate() + Number(suggestions.jatuh_tempo));
            // tampilkan tanggal jatuh tempo
            $("input[name=jatuh_tempo]").datepicker("update", jq_tgl);

        }

    });
    // END OF SET AUTOCOMPLETE SUPPLIER

    // BTN TEST
    // $('#btn-test').click(function(){
    //     // var exceptData = {"barangid":[]};
    //     // $('#table-product > tbody > tr.row-product').each(function(){
    //     //     exceptData.barangid.push($(this).children('td:first').next().children('input').data('barangid'));
    //     //     // alert(exceptData.barangid);
    //     // });

    //     // alert(getExceptionData());
    //     $.get('purchase/order/get-product',{
    //         'exceptdata' : JSON.stringify(getExceptionData())
    //     },function(res){
    //         alert(res);
    //     });

    //     return false;
    // });
    // END OF BTN TEST

    // -----------------------------------------------------
    // SET AUTO NUMERIC
    // =====================================================
    $('input[name=unit_price], input[name=subtotal], input[name=disc], .label-total, .label-total-subtotal').autoNumeric('init',{
        vMin:'0',
        vMax:'9999999999'
    });
    // END OF AUTONUMERIC

    // SET AUTOCOMPLETE PRODUCT
    // $('input[name=product]').autocomplete({
    //     serviceUrl: 'purchase/order/get-product',
    //     params: {  'nama': function() {
    //                     return $('input[name=product]').val();
    //                 }
    //             },
    //     onSelect:function(suggestions){
    //         $('input[name=product]').data('barangid',suggestions.data);
    //         $('input[name=product]').data('kode',suggestions.kode);
    //         // fokuskan ke input quantity
    //         $('input[name=quantity]').focus();
    //     }

    // });
    // END OF SET AUTOCOMPLETE PRODUCT

    function getExceptionData(){
        var exceptData = {"barangid":[]};
        $('#table-product > tbody > tr.row-product').each(function(){
            exceptData.barangid.push($(this).children('td:first').next().children('input').data('barangid'));
            // alert(exceptData.barangid);
        });

        return exceptData;
    }

    // FUNGSI REORDER ROWNUMBER
    function rownumReorder(){
        var rownum=1;
        $('#table-product > tbody > tr.row-product').each(function(){
            $(this).children('td:first').text(rownum++);
        });
    }
    // END OF FUNGSI REORDER ROWNUMBER

    // ~BTN ADD ITEM
    $('#btn-add-item').click(function(){
        // tampilkan form add new item
        var newrow = $('#row-add-product').clone();
        newrow.addClass('row-product');
        newrow.removeClass('hide');
        newrow.removeAttr('id');
        var input_product = newrow.children('td:first').next().children('input');
        // tambahkan newrow ke table
        $(this).parent().parent().prev().after(newrow);

        // Tampilkan & Reorder Row Number
        rownumReorder();
       
        // format autocomplete
        input_product.autocomplete({
            serviceUrl: 'purchase/order/get-product',
            params: {  
                        'nama' : function() {
                                    return input_product.val();
                                },
                        // 'exceptdata':JSON.stringify(getExceptionData())
                    },
            onSelect:function(suggestions){
                input_product.data('barangid',suggestions.data);
                input_product.data('kode',suggestions.kode);
                // disable input_product
                input_product.attr('readonly','readonly');
                // fokuskan ke input quantity
                input_product.parent().next().children('input').focus();
            }
        });

        // format auto numeric unit_price & subbtotal
        $('.input-unit-price, .input-subtotal').autoNumeric('init',{
            vMin:'0',
            vMax:'9999999999'
        });

        // fokuskan ke input product
        input_product.focus();

        return false;
    });
    // END OF ~BTN ADD ITEM

    // HITUNG SUBTOTAL
    $(document).on('keyup','.input-unit-price, .input-quantity',function(){
        calcSubtotal($(this));
    });
    $(document).on('input','.input-quantity',function(){
        calcSubtotal($(this));
    });

    function calcSubtotal(inputElm){
        var row = inputElm.parent().parent();
        var unit_price = row.children('td:first').next().next().next().children('input').autoNumeric('get');
        var qty = row.children('td:first').next().next().children('input').val();

        var subtotal = Number(unit_price) * Number(qty);
        // tampilkan subtotal
        row.children('td:first').next().next().next().next().children('input').autoNumeric("set",subtotal);

        // hitung TOTAL
        hitungTotal();
    }
    // END HITUNG SUBTOTAL

    // CANCEL ADD ITEM
    // $('#btn-cancel-add').click(function(){
    //     // clear input 
    //     $('input[name=product]').val('');
    //     $('input[name=quantity]').val('');

    //     // sembunyikan row add product
    //     $('#row-add-product').addClass('hide');

    //     return false;
    // });
    // END OF CANCEL ADD ITEM

    // DELETE ROW PRODUCT
    $(document).on('click','.btn-delete-row-product',function(){
        var row = $(this).parent().parent();
        row.fadeOut(250,null,function(){
            row.remove();
            // reorder row number
            rownumReorder();
            // hitung total
            hitungTotal();
        });

        return false;
    });
    // END OF DELETE ROW PRODUCT

    
    // BTN CANCEL SAVE
    $('#btn-cancel-save').click(function(){
        if(confirm('Anda akan membabtalkan transaksi ini?')){
            location.href = "purchase/order";
        }else
        {

        return false
        }
    });
    // END OF BTN CANCEL SAVE


    // BTN SAVE TRANSACTION
    $('#btn-save').click(function(){
        // cek kelengkapan data
        var po_master = {"supplier_id":"","no_inv":"","tanggal":"","jatuh_tempo":"","note":"","subtotal":"","disc":"","total":""};
        // set po_master data
        po_master.supplier_id = $('input[name=supplier]').data('supplierid');
        po_master.no_inv = $('input[name=no_inv]').val();
        po_master.tanggal = $('input[name=tanggal]').val();
        po_master.jatuh_tempo = $('input[name=jatuh_tempo]').val();
        po_master.note = $('textarea[name=note]').val();
        po_master.subtotal = $('.label-total-subtotal').autoNumeric('get');
        po_master.total = $('.label-total').autoNumeric('get');
        po_master.disc = $('input[name=disc]').autoNumeric('get');

        // get data barang
        // alert('btn-save');
        var po_barang = JSON.parse('{"barang" : [] }');
        // alert('set barang');

        $('#table-product > tbody > tr.row-product').each(function(){
            // alert('loop barang');
            var row = $(this);
            // alert('row obj created');
            var first_col = row.children('td:first');
            // alert('Create barang obj');
            // var barang = {"id":"","qty":"","unit_price":"","subtotal":""};
            // alert('Barang json has created');
            // cek apakah barang telah di input atau belum
            var barang_id = first_col.next().children('input').data('barangid');
            var barang_qty = first_col.next().next().children('input').val();
            var barang_unit_price = first_col.next().next().next().children('input').autoNumeric('get');
            var barang_subtotal = first_col.next().next().next().next().children('input').autoNumeric('get');

            if(barang_id != "" && barang_qty != "" && Number(barang_qty) > 0 && barang_unit_price != "" && Number(barang_unit_price) > 0 && barang_subtotal != "" && Number(barang_subtotal) > 0 ){
                // alert('insert to po_barang');
                // po_barang.id = barang_id;
                // po_barang.qty = barang_qty;
                // po_barang.unit_price = barang_unit_price;
                // po_barang.subtotal = barang_subtotal;

                po_barang.barang.push({
                    id:barang_id,
                    qty:barang_qty,
                    unit_price:barang_unit_price,
                    subtotal:barang_subtotal
                });    
            }

            // alert('almost to add barang to po_barang obj');
            
            // alert('Barang has added');
        });

        // alert(po_barang.barang.length);

        if(po_master.supplier_id != "" && po_master.no_inv != "" && po_master.tanggal != "" && po_barang.barang.length > 0){
            // posting purchase order to database
            // alert('insert ke database');
            var newform = $('<form>').attr('method','POST').attr('action','purchase/order/insert');
                newform.append($('<input>').attr('type','hidden').attr('name','po_master').val(JSON.stringify(po_master)));
                newform.append($('<input>').attr('type','hidden').attr('name','po_barang').val(JSON.stringify(po_barang)));
                newform.submit();
        }else{
            alert('Lengkapi data yang kosong.');
        }


        return false;
    });
    // END OF BTN SAVE TRANSACTION


    // INPUT DISC ON KEYUP
    $(document).on('keyup','input[name=disc]',function(){
        hitungTotal();
    });
    // END OF INPUT DISC ON KEYUP


    // FUNGSI HITUNG TOTAL KESELURUHAN
    function hitungTotal(){
        // var subtotal = $('.label-total-subtotal').autoNumeric('get');
        var disc = $('input[name=disc]').autoNumeric('get');
        var subtotal = 0;

        $('#table-product > tbody > tr.row-product').each(function(){
            var first_col = $(this).children('td:first');
            subtotal += Number(first_col.next().next().next().next().children('input').autoNumeric('get'));
        });

        // tampilkan subtotal dan total
        $('.label-total-subtotal').autoNumeric('set',subtotal);
        $('.label-total').autoNumeric('set',Number(subtotal) - Number(disc));
    }

    // $('#btn-test').click(function(){
    //     hitungTotal();
    //     return false;
    // });
    // END OF FUNGSI HITUNG TOTAL KESELURUHAN

})(jQuery);
</script>
@append
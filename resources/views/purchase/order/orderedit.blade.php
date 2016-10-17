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

    /*#table-product > tbody > tr > td > input {
        display: block;
        padding: 0;
        margin: 0;
        border: 0;
        width: 100%;
        background-color:#EEF0F0;
        float:right;
    }*/

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
        <a href="purchase/order" >Purchase Order</a> <i class="fa fa-angle-double-right" ></i> {{$po_master->po_num}}
    </h1>
</section>

<!-- Main content -->
<section class="content">
    {{-- data hidden  --}}
    <input type="hidden" name="po_master_id" value="{{$po_master->id}}">

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-header with-border" style="padding-top:5px;padding-bottom:5px;" >
            <a class="btn btn-primary" style="margin-top:0;" id="btn-validate-po" >Validate</a>

            <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>
            <a class="btn  btn-arrow-right pull-right disabled {{$po_master->status == 'V' ? 'bg-blue' : 'bg-gray'}}" >Validated</a>

            <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>

            <a class="btn btn-arrow-right pull-right disabled {{$po_master->status == 'O' ? 'bg-blue' : 'bg-gray'}}" >Open</a>

            <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>

            <a class="btn btn-arrow-right pull-right disabled bg-gray" >Draft</a>
        </div>
        <div class="box-body">
            <label> <small>Purchase Order</small> <h4 style="font-weight: bolder;margin-top:0;padding-top:0;margin-bottom:0;padding-bottom:0;" >{{$po_master->po_num}}</h4></label>
            {{-- <label>Purchase Order</label> --}}
            {{-- <h3 style="margin-top:0;" ><label>{{$po_master->po_num}}<label></h3> --}}

            <table class="table" >
                <tbody>
                    <tr>
                        <td class="col-lg-2">
                            <label>Supplier</label>
                        </td>
                        <td class="col-lg-4" >
                            <input type="text" name="supplier" class="form-control" data-supplierid="{{$po_master->supplier_id}}" value="{{$po_master->supplier}}" required>
                        </td>
                        <td class="col-lg-2" ></td>
                        <td class="col-lg-2" >
                            <label>Order Date</label>
                        </td>
                        <td class="col-lg-2" >
                            <input type="text" name="tanggal" class="input-tanggal form-control" value="{{$po_master->tgl_formatted}}" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-lg-2">
                            <label>Supplier Ref#</label>
                        </td>
                        <td class="col-lg-4" >
                            <input type="text" name="no_inv" class="form-control" value="{{$po_master->no_inv}}" >
                        </td>
                        <td class="col-lg-2" ></td>
                        <td class="col-lg-2 hide" >
                            <label>Jatuh Tempo</label>
                        </td>
                        <td class="col-lg-2 hide" >
                            <input type="text" name="jatuh_tempo"  class="input-tanggal form-control" value="{{$po_master->jatuh_tempo_formatted}}" >
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
                    <?php $rownum=1; ?>
                    @foreach($po_barang as $dt)
                        <tr class="row-product"  >
                            <td class="text-right" >{{$rownum++}}</td>
                            <td>
                                <input autocomplete="off" type="text"  data-barangid="{{$dt->barang_id}}" data-kode="" class="text-uppercase form-control input-product input-sm input-clear"  value="{{$dt->nama_barang_full}}" readonly >
                            </td>
                            <td>
                                <input type="number" autocomplete="off" min="1" class="form-control text-right input-quantity input-sm input-clear" value="{{$dt->qty}}" >
                            </td>
                            <td>
                                <input autocomplete="off" type="text" class="text-right form-control input-unit-price input-sm input-clear" value="{{$dt->harga}}" >
                            </td>
                            <td>
                                <input autocomplete="off" type="text" readonly  class="text-right form-control input-subtotal input-sm input-clear" value="{{$dt->subtotal}}" >
                            </td>
                            <td class="text-center" >
                                <a href="#" class="btn-delete-row-product" ><i class="fa fa-trash" ></i></a>
                            </td>
                        </tr>
                    @endforeach
                    <tr id="row-btn-add-item">
                        <td></td>
                        <td colspan="5" >
                            <a id="btn-add-item" href="#">Add an item</a>
                        </td>
                    </tr>
                    {{-- <tr>
                        <td></td>
                        <td colspan="5" >
                            <button type="submit" class="btn btn-primary" id="btn-save" >Save</button>
                            <a class="btn btn-danger" id="btn-cancel-save" >Cancel</a>
                        </td>
                    </tr> --}}

                </tbody>
            </table>

            <div class="row" >
                <div class="col-lg-8" >
                    <textarea name="note" class="form-control" rows="4" style="margin-top:5px;" placeholder="Note" >{{$po_master->note}}</textarea>
                </div>
                <div class="col-lg-4" >
                    <table class="table table-condensed" >
                        <tbody>
                            <tr>
                                <td class="text-right">
                                    <label>Subtotal :</label>
                                </td>
                                <td id="label-total-subtotal" class=" text-right" >
                                    {{$po_master->total}}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right" >
                                    <label>Disc :</label>
                                </td>
                                <td >
                                   <input style="font-size:14px;" type="text" name="disc" class="input-sm form-control text-right input-clear" value="{{$po_master->disc}}" >
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right" style="border-top:solid darkgray 1px;" >
                                    Total :
                                </td>
                                <td id="label-total" class=" text-right" style="font-size:18px;font-weight:bold;border-top:solid darkgray 1px;" >
                                    {{$po_master->grand_total}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12" >
                    <button type="submit" class="btn btn-primary" id="btn-save" >Save</button>
                    <a class="btn btn-danger"  href="purchase/order" >Close</a>
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

    // -----------------------------------------------------
    // SET AUTO NUMERIC
    // =====================================================
    $('input[name=unit_price], input[name=subtotal], .input-unit-price, .input-subtotal, input[name=disc]').autoNumeric('init',{
        vMin:'0',
        vMax:'9999999999'
    });

    $('#label-total-subtotal, #label-total').autoNumeric('init',{
            vMin:'0',
            vMax:'9999999999'
        });
    // bersihkan jika di depan ada angka nol pada label-total-subtotal
    $('#label-total-subtotal').autoNumeric('set', Number($('#label-total-subtotal').autoNumeric('get')));
    $('#label-total').autoNumeric('set', Number($('#label-total').autoNumeric('get')));
    // END OF AUTONUMERIC

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


    // BTN SAVE UPDATE TRANSACTION
    $('#btn-save').click(function(){
        // cek kelengkapan data
        var po_master = {"id":"","supplier_id":"","no_inv":"","tanggal":"","jatuh_tempo":""};
        // set po_master data
        po_master.id = $('input[name=po_master_id]').val();
        po_master.supplier_id = $('input[name=supplier]').data('supplierid');
        po_master.no_inv = $('input[name=no_inv]').val();
        po_master.tanggal = $('input[name=tanggal]').val();
        po_master.jatuh_tempo = $('input[name=jatuh_tempo]').val();
        po_master.note = $('textarea[name=note]').val();
        po_master.subtotal = $('#label-total-subtotal').autoNumeric('get');
        po_master.total = $('#label-total').autoNumeric('get');
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
            // cek apakah barang telah di input atau belum
            var barang_id = first_col.next().children('input').data('barangid');
            var barang_qty = first_col.next().next().children('input').val();
            var barang_unit_price = first_col.next().next().next().children('input').autoNumeric('get');
            var barang_subtotal = first_col.next().next().next().next().children('input').autoNumeric('get');

            if(barang_id != "" && barang_qty != "" && Number(barang_qty) > 0 && barang_unit_price != "" && Number(barang_unit_price) > 0 && barang_subtotal != "" && Number(barang_subtotal) > 0 ){

                po_barang.barang.push({
                    id:barang_id,
                    qty:barang_qty,
                    unit_price:barang_unit_price,
                    subtotal:barang_subtotal
                });
            }
        });

        // alert(po_barang.barang.length);

        if(po_master.supplier_id != "" && po_master.no_inv != "" && po_master.tanggal != "" && po_barang.barang.length > 0){
            // posting purchase order to database
            // alert('insert ke database');
            var newform = $('<form>').attr('method','POST').attr('action','purchase/order/update');
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
        // var subtotal = $('#label-total-subtotal').autoNumeric('get');
        // alert('hitung total');
        var disc = $('input[name=disc]').autoNumeric('get');
        var subtotal = 0;

        $('#table-product > tbody > tr.row-product').each(function(){
            var first_col = $(this).children('td:first');
            subtotal += Number(first_col.next().next().next().next().children('input').autoNumeric('get'));
        });

        $('#label-total-subtotal, #label-total').text('');
        // format autonumeric
        $('#label-total-subtotal, #label-total').autoNumeric('init',{
            vMin:'0',
            vMax:'9999999999'
        });

        // alert('formateed');

        // tampilkan subtotal dan total
        $('#label-total-subtotal').autoNumeric('set',subtotal);
        $('#label-total').autoNumeric('set',Number(subtotal) - Number(disc));
    }

    // END OF FUNGSI HITUNG TOTAL KESELURUHAN

    // VALIDATE PO
    $('#btn-validate-po').click(function(){
        // create form for validate po
        var validateForm = $('<form>').attr('method','POST').attr('action','purchase/order/validate');
        validateForm.append($('<input>').attr('type','hidden').attr('name','po_master_id').val($('input[name=po_master_id]').val()));
        validateForm.submit();
    });
    // END OF VALIDATE PO

})(jQuery);
</script>
@append

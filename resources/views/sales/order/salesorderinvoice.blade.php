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
        <a href="sales/order" >Sales Order</a> 
        <i class="fa fa-angle-double-right" ></i> 
        <a href="sales/order/edit/{{$so_master->id}}" >{{$so_master->so_no}}</a> 
        <i class="fa fa-angle-double-right" ></i> 
        @if($multi_invoice)
        <a href="sales/order/invoice/{{$so_master->id}}" >Customer Invoices</a> 
        <i class="fa fa-angle-double-right" ></i> 
        @endif
        {{$cust_inv->no_inv}}
    </h1>
</section>

<!-- Main content -->
<section class="content">
    {{-- data hidden  --}}
    <input type="hidden" name="customer_invoice_id" value="{{$cust_inv->id}}">

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-header with-border" style="padding-top:5px;padding-bottom:5px;" >
            
        @if($cust_inv->status == "O")
            <a class="btn btn-primary" style="margin-top:0;" id="btn-reg-payment" href="sales/order/reg-payment/{{$cust_inv->id}}" >Register Payment</a>
        @else
            <label> <small>Invoice</small> <h4 style="font-weight: bolder;margin-top:0;padding-top:0;margin-bottom:0;padding-bottom:0;" >{{$cust_inv->no_inv}}</h4></label>
        @endif

            <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>
            <a class="btn  btn-arrow-right pull-right disabled {{$cust_inv->status == 'P' ? 'bg-blue' : 'bg-gray'}}" >Paid</a>

            <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>

            <a class="btn btn-arrow-right pull-right disabled {{$cust_inv->status == 'O' ? 'bg-blue' : 'bg-gray'}}" >Open</a>

            {{-- <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>

            <a class="btn btn-arrow-right pull-right disabled bg-gray" >Draft PO</a> --}}
        </div>
        <div class="box-body">
            {{-- header --}}
            
            {{-- modul invoices --}}
            {{-- <a class="btn btn-app pull-right" href="sales/order/invoice/{{$so_master->id}}" > --}}
                    {{-- <span class="badge bg-green">1</span> --}}
                    {{-- <i class="fa fa-newspaper-o"></i> Invoices --}}
                  {{-- </a> --}}

            {{-- <label>Purchase Order</label> --}}
            {{-- <h3 style="margin-top:0;" ><label>{{$so_master->no_inv}}<label></h3> --}}
            @if($cust_inv->status == "O")
            <label> <small>Invoice</small> <h4 style="font-weight: bolder;margin-top:0;padding-top:0;margin-bottom:0;padding-bottom:0;" >{{$cust_inv->no_inv}}</h4></label>
            @endif

            <table class="table" >
                <tbody>
                    <tr>
                        <td class="col-lg-2">
                            <label>Supplier</label>
                        </td>
                        <td class="col-lg-4" >
                            {{-- <input type="text" name="supplier" class="form-control" data-supplierid="{{$so_master->supplier_id}}" value="{{$so_master->supplier}}" required> --}}
                            {{$so_master->customer}}
                        </td>
                        <td class="col-lg-2" ></td>
                        <td class="col-lg-2" >
                            <label>Bill Date</label>
                        </td>
                        <td class="col-lg-2" >
                            {{-- <input type="text" name="tanggal" class="input-tanggal form-control" value="{{$so_master->tgl_formatted}}" required> --}}
                            {{$cust_inv->invoice_date_formatted}}
                        </td>
                    </tr>
                    <tr>
                        <td class="col-lg-2">
                            <label>Source Document</label>
                        </td>
                        <td class="col-lg-4" >
                            {{-- <input type="text" name="no_inv" class="form-control" value="{{$so_master->no_inv}}" > --}}
                            {{-- <a href="sales/order/edit/{{$so_master->id}}" >{{$so_master->so_no}}</a>  --}}
                            {{$so_master->so_no}}
                        </td>
                        <td class="col-lg-2" ></td>
                        <td class="col-lg-2" >
                            <label>Due Date</label>
                        </td>
                        <td class="col-lg-2" >
                            {{-- <input type="text" name="jatuh_tempo"  class="input-tanggal form-control" value="{{$so_master->jatuh_temso_formatted}}" > --}}
                            {{-- {{$so_master->jatuh_temso_formatted}} --}}
                            {{$cust_inv->due_date_formatted}}
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
                        <th class="col-lg-1" >SATUAN</th>
                        <th class="col-lg-1" >BERAT</th>
                        <th>UNIT PRICE</th>
                        <th>SUBTOTAL</th>
                        {{-- <th style="width:50px;" ></th> --}}
                    </tr>
                </thead>
                <tbody>
                    <?php $rownum=1; ?>
                    @foreach($barang as $dt)
                        <tr>
                            <td>{{$rownum++}}</td>
                            <td>
                                {{$dt->nama}}
                            </td>
                            <td class="text-right" >
                                {{$dt->qty}}
                            </td>
                            <td>{{$dt->satuan}}</td>
                            <td class="text-right" >{{$dt->berat}}</td>
                            <td class="text-right" >
                                {{number_format($dt->harga_salesman,0,'.',',')}}
                            </td>
                            <td class="text-right" >
                                {{number_format($dt->subtotal,0,'.',',')}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="row" >
                <div class="col-lg-8" >
                    {{-- <textarea name="note" class="form-control" rows="4" style="margin-top:5px;" placeholder="Note" >{{$so_master->note}}</textarea> --}}
                    {{-- <br/>
                    <label>Note :</label> <i>{{$so_master->note}}</i> --}}
                </div>
                <div class="col-lg-4" >
                    <table class="table table-condensed" >
                        <tbody>
                            <tr>
                                <td class="text-right">
                                    <label>Subtotal :</label>
                                </td>
                                <td id="label-total-subtotal" class=" text-right" >
                                    {{$cust_inv->subtotal}}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right" >
                                    <label>Disc :</label>
                                </td>
                                <td class="text-right" id="label-disc" >
                                   {{-- <input style="font-size:14px;" type="text" name="disc" class="input-sm form-control text-right input-clear" value="{{$so_master->disc}}" >  --}}
                                   {{$cust_inv->disc}}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right" style="border-top:solid darkgray 1px;" >
                                    Total :
                                </td>
                                <td id="label-total" class=" text-right" style="font-size:18px;font-weight:bold;border-top:solid darkgray 1px;" >
                                    {{$cust_inv->total}}
                                </td>
                            </tr>
                            @if(count($payments) > 0)
                            @foreach($payments as $dt)
                                <tr style="background-color:#EEF0F0;" >
                                    <td class="text-right" >
                                        <a class="btn-delete-payment" data-paymentid="{{$dt->id}}" href="#" ><i class="fa fa-trash-o pull-left" ></i></a>
                                        <i>Paid on {{$dt->payment_date_formatted}}</i>
                                    </td>
                                    <td class="text-right" >
                                        <i>{{number_format($dt->payment_amount,0,'.',',')}}</i>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                            <tr>
                                <td class="text-right" style="border-top:solid darkgray 1px;" >
                                    Amount Due :
                                </td>
                                <td id="label-amount-due" class=" text-right" style="font-size:18px;font-weight:bold;border-top:solid darkgray 1px;" >
                                    {{$cust_inv->amount_due}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12" >
                    @if($multi_invoice)
                    <a class="btn btn-danger" href="sales/order/invoice/{{$so_master->id}}" >Close</a>
                    @else
                        <a class="btn btn-danger" href="sales/order/edit/{{$so_master->id}}" >Close</a>
                    @endif
                </div>
            </div>
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
        serviceUrl: 'sales/order/get-supplier',
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

    $('#label-total-subtotal, #label-total, #label-disc, #label-amount-due').autoNumeric('init',{
            vMin:'0',
            vMax:'9999999999'
        });
    // bersihkan jika di depan ada angka nol pada label-total-subtotal
    $('#label-total-subtotal').autoNumeric('set', Number($('#label-total-subtotal').autoNumeric('get')));
    $('#label-total').autoNumeric('set', Number($('#label-total').autoNumeric('get')));
    $('#label-disc').autoNumeric('set', Number($('#label-disc').autoNumeric('get')));
    $('#label-amount-due').autoNumeric('set', Number($('#label-amount-due').autoNumeric('get')));
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
            serviceUrl: 'sales/order/get-product',
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
            location.href = "sales/order";
        }else
        {

        return false
        }
    });
    // END OF BTN CANCEL SAVE


    // BTN SAVE UPDATE TRANSACTION
    $('#btn-save').click(function(){
        // cek kelengkapan data
        var so_master = {"id":"","supplier_id":"","no_inv":"","tanggal":"","jatuh_tempo":""};
        // set so_master data
        so_master.id = $('input[name=so_master_id]').val();
        so_master.supplier_id = $('input[name=supplier]').data('supplierid');
        so_master.no_inv = $('input[name=no_inv]').val();
        so_master.tanggal = $('input[name=tanggal]').val();
        so_master.jatuh_tempo = $('input[name=jatuh_tempo]').val();
        so_master.note = $('textarea[name=note]').val();
        so_master.subtotal = $('#label-total-subtotal').autoNumeric('get');
        so_master.total = $('#label-total').autoNumeric('get');
        so_master.disc = $('input[name=disc]').autoNumeric('get');

        // get data barang
        // alert('btn-save');
        var so_barang = JSON.parse('{"barang" : [] }');
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

                so_barang.barang.push({
                    id:barang_id,
                    qty:barang_qty,
                    unit_price:barang_unit_price,
                    subtotal:barang_subtotal
                });    
            }
        });

        // alert(so_barang.barang.length);

        if(so_master.supplier_id != "" && so_master.no_inv != "" && so_master.tanggal != "" && so_barang.barang.length > 0){
            // posting sales order to database
            // alert('insert ke database');
            var newform = $('<form>').attr('method','POST').attr('action','sales/order/update');
                newform.append($('<input>').attr('type','hidden').attr('name','so_master').val(JSON.stringify(so_master)));
                newform.append($('<input>').attr('type','hidden').attr('name','so_barang').val(JSON.stringify(so_barang)));
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
        var validateForm = $('<form>').attr('method','POST').attr('action','sales/order/validate');
        validateForm.append($('<input>').attr('type','hidden').attr('name','so_master_id').val($('input[name=so_master_id]').val()));
        validateForm.submit();
    });
    // END OF VALIDATE PO

    // DELETE PAYMENT 
    $('.btn-delete-payment').click(function(){
        if(confirm('Anda akan menghapus data ini?')){
            // delete payment
            var payment_id = $(this).data('paymentid');
            var deleteform = $('<form>').attr('method','POST').attr('action','sales/order/delete-payment');
            deleteform.append($('<input>').attr('type','hidden').attr('name','payment_id').val(payment_id));
            deleteform.submit();

            // posting delete payment
        }

        return false;
    });
    // END OF DELETE PAYMENT

})(jQuery);
</script>
@append
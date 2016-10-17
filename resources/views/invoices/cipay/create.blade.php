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
        <a href="invoice/customer/payment" >Customer Payments</a>
        <i class="fa fa-angle-double-right" ></i>
        Register Payment
    </h1>
</section>

<!-- Main content -->
<section class="content">
    {{-- <input type="hidden" name="so_master_id" value="{{$so_master->id}}"> --}}
    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-header with-border" style="padding-top:5px;padding-bottom:5px;" >
            <label> <small>Register Payment</small> <h4 style="font-weight: bolder;margin-top:0;padding-top:0;margin-bottom:0;padding-bottom:0;" >NEW</h4></label>

            <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>
            <a class="btn  btn-arrow-right pull-right disabled bg-gray" >Posted</a>

            {{-- <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label> --}}
            {{-- <a class="btn btn-arrow-right pull-right disabled bg-gray" >Open</a> --}}

            <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>
            <a class="btn btn-arrow-right pull-right disabled bg-blue" >Draft</a>
        </div>
        <div class="box-body">
            {{-- <form method="POST" action="sales/order/save-payment" > --}}

                <table class="table" >
                    <tbody>
                        <tr>
                            <td class="col-lg-2">
                                <label>Customer</label>
                            </td>
                            <td class="col-lg-3" >
                                <input autofocus type="text" name="customer" class="form-control text-uppercase">
                                <input type="hidden" name="customer_id">
                            </td>
                            <td class="col-lg-2" ></td>
                            <td class="col-lg-2">
                                <label>Payment Date</label>
                            </td>
                            <td class="col-lg-3" >
                                <input value="{{date('d-m-Y')}}" type="text" name="payment_date" class="form-control input-tanggal"  required>
                            </td>
                        </tr>
                        <tr>
                            <td >
                                <label>Amount Due</label>
                            </td>
                            <td  >
                                <input type="text" name="amount_due" class="form-control text-right"  readonly>
                            </td>
                            <td  ></td>
                            <td >
                                <label>Payment Amount</label>
                            </td>
                            <td >
                                <input type="text" name="payment_amount" class="form-control text-right"  autofocus required>
                            </td>
                        </tr>

                        {{-- <tr>
                            <td colspan="5" >
                                <button type="submit" class="btn btn-primary" id="btn-save" >Save</button>
                                <a class="btn btn-danger" id="btn-cancel" href="invoice/customer/payment" >Cancel</a>
                            </td>
                        </tr> --}}

                    </tbody>
                </table>
            {{-- </form> --}}

            <h4 class="page-header" style="font-size:14px;color:#3C8DBC"><strong>INVOICES</strong></h4>
            <table id="table-invoices" class="table table-bordered table-condensed" >
                <thead>
                    <tr>
                        <th>REF#</th>
                        <th>TOTAL</th>
                        <th>AMOUNT DUE</th>
                        <th>PAYMENT AMOUNT</th>
                    </tr>
                    <tbody></tbody>
            </table>

        </div><!-- /.box-body -->
        <div class="box-footer" >
            <button type="submit" class="btn btn-primary" id="btn-save" >Save</button>
            <a class="btn btn-danger" id="btn-cancel" href="invoice/customer/payment" >Cancel</a>
        </div>
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

    // SET AUTO COMPLETE
    $('input[name=customer]').autocomplete({
        serviceUrl: 'invoice/customer/payment/get-customer',
        params: {  'nama': function() {
                        return $('input[name=customer]').val();
                    }
                },
        onSelect:function(suggestions){
            // set data supplier
            $('input[name=customer_id]').val(suggestions.data);

            $('input[name=amount_due]').autoNumeric('set',suggestions.amount_due);
            $('input[name=payment_amount]').autoNumeric('set',suggestions.amount_due);

            // cek amount due
            if(suggestions.amount_due > 0){
                $('input[name=payment_amount]').removeAttr('disabled');
                $('#btn-save').removeClass('disabled');
                // focuskan ke payment amount
                $('input[name=payment_amount]').focus();

                // alert('invoice/customer/payment/get-invoice/' + suggestions.data);
                // get customer invoice
                $.get('invoice/customer/payment/get-invoices/' + suggestions.data,null,function(data_invoice){

                    var dataInvoice = JSON.parse(data_invoice);
                    $.each(dataInvoice,function(i,data){
                        // add data invoice ke table
                        var newrow = $('<tr>').attr('data-soid',data.id).append($('<td>').text(data.no_inv))
                                                .append($('<td>').addClass('uang text-right').text(data.total))
                                                .append($('<td>').addClass('uang text-right').text(data.amount_due))
                                                .append($('<td>').addClass('uang text-right col-payment-amount'));
                        $('#table-invoices tbody').append(newrow);
                    });

                    // set autonumeric colom uang
                    $('.uang').autoNumeric('init',{
                        vMin:'0',
                        vMax:'9999999999'
                    });

                    // share payment amount
                    sharePaymentAmountToAmountDue();

                });

            }else{
                // disable input & button save
                $('input[name=payment_amount]').attr('disabled','disabled');
                $('#btn-save').addClass('disabled');
                // $('input[name=payment_amount]').addClass('disabled');
                alert('Tidak ada invoice yang tersedia.');
            }

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
    // END OF SET AUTO COMPLETE

    // PEMBAGIAN JUMLAH PEMBAYARAN KE SEJUMLAH INVOICE
    function sharePaymentAmountToAmountDue(){
        // clear payment amount
        $('.col-payment-amount').text('');
        var payment_amount = $('input[name=payment_amount]').autoNumeric('get');
        $('#table-invoices tbody tr').each(function(i,data){
            var amount_due = $(this).children('td:first').next().next().autoNumeric('get');

            if(Number(payment_amount) <= Number(amount_due)){
                // tampilkan payment amount
                // alert('kondisi 1');
                $(this).children('td:first').next().next().next().autoNumeric('set',payment_amount);
                exit;
            }else{
                // alert('kondisi 2');

                // tampilkan payment amount
                $(this).children('td:first').next().next().next().autoNumeric('set',amount_due);
                payment_amount = Number(payment_amount) - Number(amount_due);
            }
        });
    }
    // END OF PEMBAGIAN JUMLAH PEMBAYARAN KE SEJUMLAH INVOICE

    // -----------------------------------------------------
    // SET AUTO NUMERIC
    // =====================================================
    $('input[name=payment_amount], input[name=amount_due]').autoNumeric('init',{
        vMin:'0',
        vMax:'9999999999'
    });
    // END OF AUTONUMERIC

    // INPUT PAYMENT AMOUNT ON CHANGE
    $('input[name=payment_amount]').keyup(function(e){
        // cek payment amount apakah melebihi tagihan
        var payment_amount = $(this).autoNumeric('get');
        var amount_due = $('input[name=amount_due]').autoNumeric('get');
        if(Number(payment_amount) > Number(amount_due)){
            alert('Paymen amount melebihi amount due');
            $(this).autoNumeric('set',0);
        }
        sharePaymentAmountToAmountDue();
    });
    // END OF INPUT PAYMENT AMOUNT ON CHANGE

    // SIMPAN DATA PAYMENT
    $('#btn-save').click(function(){
        var customer = $('input[name=customer]').val();
        var customer_id = $('input[name=customer_id]').val();
        var payment_date = $('input[name=payment_date]').val();
        var payment_amount = $('input[name=payment_amount]').autoNumeric('get');
        var amount_due = $('input[name=amount_due]').autoNumeric('get');

        // cek apakah payment amount sesuai
        if(Number(payment_amount) > 0 && customer != "" && customer_id != "" && payment_date != "" ){
            if(Number(payment_amount) > Number(amount_due)){
                alert('Payment amount melebihi amount due.');
            }else{
                 // generate data detail payment
                var payment_detail = JSON.parse('{"payment" : [] }');

                $('#table-invoices tbody tr').each(function(i,data){
                    var payment_amount_on_row = $(this).children('td:first').next().next().next().autoNumeric('get');
                    if(Number(payment_amount_on_row > 0)){
                        payment_detail.payment.push({
                            invoice_id:$(this).data('soid'),
                            payment_amount:payment_amount_on_row
                        });
                    }

                });

                // save data ke database
                var postform = $('<form>').attr('method','POST').attr('action','invoice/customer/payment/insert');
                postform.append($('<input>').attr('type','hidden').attr('name','customer').val(customer));
                postform.append($('<input>').attr('type','hidden').attr('name','customer_id').val(customer_id));
                postform.append($('<input>').attr('type','hidden').attr('name','payment_date').val(payment_date));
                postform.append($('<input>').attr('type','hidden').attr('name','payment_amount').val(payment_amount));
                postform.append($('<input>').attr('type','hidden').attr('name','amount_due').val(amount_due));
                postform.append($('<input>').attr('type','hidden').attr('name','payment_detail').val(JSON.stringify(payment_detail)));



                // generate detail payment


                postform.submit();
            }
        }else{
            alert('Lengkapi data yang kosong.');
        }
    });
    // END OF SIMPAN DATA PAYMENT


    // // CEK PAYMENT AMOUNT APAKAH LEBIH BESAR DARI AMOUNT DUE
    // $('#btn-save').click(function(){
    //     var amount_due = $('input[name=amount_due]').autoNumeric('get');
    //     var payment_amount = $('input[name=payment_amount]').autoNumeric('get');
    //     // var so_master_id = $('input[name=so_master_id]').val();
    //     var payment_date = $('input[name=payment_date]').val();
    //     var customer_inv_id = $('input[name=customer_inv_id]').val();

    //     if(Number(payment_amount) > Number(amount_due)){
    //         alert('Payment amount lebih besar dari amount due.');
    //         // fokuskan
    //         $('input[name=payment_amount]').select();
    //     }else{
    //         var newform = $('<form>').attr('method','POST').attr('action','api/reg-customer-payment');
    //         newform.append($('<input>').attr('type','hidden').attr('name','payment_amount').val(payment_amount));
    //         // newform.append($('<input>').attr('type','hidden').attr('name','so_master_id').val(so_master_id));
    //         // newform.append($('<input>').attr('type','hidden').attr('name','payment_date').val(payment_date));
    //         // newform.append($('<input>').attr('type','hidden').attr('name','customer_inv_id').val(customer_inv_id));
    //         // newform.submit();

    //         $.post('api/reg-customer-payment',{
    //             'payment_amount' : payment_amount,
    //             'payment_date' : payment_date,
    //             'customer_inv_id' : customer_inv_id
    //         },function(){
    //             location.href = "invoice/customer-invoice/show/" + customer_inv_id;
    //         });
    //     }

    //     return false;
    // });
    // // END OF CEK PAYMENT AMOUNT APAKAH LEBIH BESAR DARI AMOUNT DUE


})(jQuery);
</script>
@append

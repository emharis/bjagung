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
        {{$cust_inv->no_inv}}
    </h1>
</section>

<!-- Main content -->
<section class="content">
    {{-- data hidden  --}}
    <input type="hidden" name="customer_inv_id" value="{{$cust_inv->id}}">
    <input type="hidden" name="so_master_id" value="{{$so_master->id}}">
    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-header with-border" style="padding-top:5px;padding-bottom:5px;" >
            {{-- <a class="btn btn-primary" style="margin-top:0;" id="btn-reg-payment" href="sales/order/reg-payment/{{$so_master->id}}" >Register Payment</a> --}}

            <label> 
                <small>Register Payment</small> 
                <h4 style="font-weight: bolder;margin-top:0;padding-top:0;margin-bottom:0;padding-bottom:0;" >{{$cust_inv->no_inv}}</h4>
            </label>

            {{-- <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label> --}}
            {{-- <a class="btn  btn-arrow-right pull-right disabled {{$cust_inv->status == 'P' ? 'bg-blue' : 'bg-gray'}}" >Paid</a> --}}

            {{-- <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label> --}}

            {{-- <a class="btn btn-arrow-right pull-right disabled {{$cust_inv->status == 'O' ? 'bg-blue' : 'bg-gray'}}" >Open</a> --}}

            {{-- <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>

            <a class="btn btn-arrow-right pull-right disabled bg-gray" >Draft PO</a> --}}
        </div>
        <div class="box-body">
            {{-- <form method="POST" action="sales/order/save-payment" > --}}
                
                <table class="table" >
                    <tbody>
                        <tr>
                            <td class="col-lg-2">
                                <label>Source Document</label>
                            </td>
                            <td class="col-lg-3" >
                                {{$cust_inv->no_inv}}
                            </td>
                            <td class="col-lg-2" ></td>
                            <td class="col-lg-2">
                                <label>Payment Date</label>
                            </td>
                            <td class="col-lg-3" >
                                <input type="text" name="payment_date" class="form-control input-tanggal" value="{{date('d-m-Y')}}" required>
                            </td>
                        </tr>
                        <tr>
                            <td >
                                <label>Amount Due</label>
                            </td>
                            <td  >
                                <input type="text" name="amount_due" class="form-control text-right" value="{{$cust_inv->amount_due}}" readonly>
                            </td>
                            <td  ></td>
                            <td >
                                <label>Payment Amount</label>
                            </td>
                            <td >
                                <input type="text" name="payment_amount" class="form-control text-right" value="{{$cust_inv->amount_due}}" autofocus required>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="5" >
                                <button type="submit" class="btn btn-primary" id="btn-save" >Save</button>
                                <a class="btn btn-danger" id="btn-cancel" href="sales/order/invoice/{{$so_master->id}}" >Cancel</a>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            {{-- </form> --}}


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

    // -----------------------------------------------------
    // SET AUTO NUMERIC
    // =====================================================
    $('input[name=payment_amount], input[name=amount_due]').autoNumeric('init',{
        vMin:'0',
        vMax:'9999999999'
    });
    // END OF AUTONUMERIC

    // CEK PAYMENT AMOUNT APAKAH LEBIH BESAR DARI AMOUNT DUE
    $('#btn-save').click(function(){
        var amount_due = $('input[name=amount_due]').autoNumeric('get');
        var payment_amount = $('input[name=payment_amount]').autoNumeric('get');
        var so_master_id = $('input[name=so_master_id]').val();
        var payment_date = $('input[name=payment_date]').val();
        var customer_inv_id = $('input[name=customer_inv_id]').val();
        
        if(Number(payment_amount) > Number(amount_due)){
            alert('Payment amount lebih besar dari amount due.');
            // fokuskan
            $('input[name=payment_amount]').select();
        }else{
            var newform = $('<form>').attr('method','POST').attr('action','sales/order/save-payment');
            newform.append($('<input>').attr('type','hidden').attr('name','payment_amount').val(payment_amount));
            newform.append($('<input>').attr('type','hidden').attr('name','so_master_id').val(so_master_id));
            newform.append($('<input>').attr('type','hidden').attr('name','payment_date').val(payment_date));
            newform.append($('<input>').attr('type','hidden').attr('name','customer_inv_id').val(customer_inv_id));
            newform.submit();
        }

        return false;
    });
    // END OF CEK PAYMENT AMOUNT APAKAH LEBIH BESAR DARI AMOUNT DUE


})(jQuery);
</script>
@append
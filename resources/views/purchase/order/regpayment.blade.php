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
        <a href="purchase/order" >Purchase Order</a> 
        <i class="fa fa-angle-double-right" ></i> 
        <a href="purchase/order/edit/{{$po_master->id}}" >{{$po_master->po_num}}</a> 
        <i class="fa fa-angle-double-right" ></i> 
        {{$sup_bill->bill_no}}
    </h1>
</section>

<!-- Main content -->
<section class="content">
    {{-- data hidden  --}}
    <input type="hidden" name="supplier_bill_id" value="{{$sup_bill->id}}">

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-header with-border" style="padding-top:5px;padding-bottom:5px;" >
            {{-- <a class="btn btn-primary" style="margin-top:0;" id="btn-reg-payment" href="purchase/order/reg-payment/{{$po_master->id}}" >Register Payment</a> --}}

            <label> 
                <small>Register Payment</small> 
                <h4 style="font-weight: bolder;margin-top:0;padding-top:0;margin-bottom:0;padding-bottom:0;" >{{$sup_bill->bill_no}}</h4>
            </label>

            {{-- <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label> --}}
            {{-- <a class="btn  btn-arrow-right pull-right disabled {{$sup_bill->status == 'P' ? 'bg-blue' : 'bg-gray'}}" >Paid</a> --}}

            {{-- <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label> --}}

            {{-- <a class="btn btn-arrow-right pull-right disabled {{$sup_bill->status == 'O' ? 'bg-blue' : 'bg-gray'}}" >Open</a> --}}

            {{-- <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>

            <a class="btn btn-arrow-right pull-right disabled bg-gray" >Draft PO</a> --}}
        </div>
        <div class="box-body">
            <form method="POST" action="purchase/order/save-payment" >
                <input type="hidden" name="po_master_id" value="{{$po_master->id}}">
                <table class="table" >
                    <tbody>
                        <tr>
                            <td class="col-lg-2">
                                <label>Source Document</label>
                            </td>
                            <td class="col-lg-3" >
                                {{$sup_bill->bill_no}}
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
                                <input type="text" name="amount_due" class="form-control text-right" value="{{number_format($sup_bill->total,0,'.',',')}}" readonly>
                            </td>
                            <td  ></td>
                            <td >
                                <label>Payment Amount</label>
                            </td>
                            <td >
                                <input type="text" name="payment_amount" class="form-control text-right" value="{{$sup_bill->total}}" autofocus required>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="5" >
                                <button type="submit" class="btn btn-primary"  >Save</button>
                                <a class="btn btn-danger" id="btn-cancel" >Cancel</a>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </form>

            

            {{-- <h4 class="page-header" style="font-size:14px;color:#3C8DBC"><strong>PRODUCT DETAILS</strong></h4> --}}

            

            <!-- <div class="row" >
                <div class="col-lg-8" >
                    {{-- <textarea name="note" class="form-control" rows="4" style="margin-top:5px;" placeholder="Note" >{{$po_master->note}}</textarea> --}}
                    {{-- <br/>
                    <label>Note :</label> <i>{{$po_master->note}}</i> --}}
                </div>
                <div class="col-lg-4" >
                    <table class="table table-condensed" >
                        <tbody>
                            <tr>
                                <td class="text-right">
                                    <label>Subtotal :</label>
                                </td>
                                <td id="label-total-subtotal" class=" text-right" >
                                    {{$sup_bill->subtotal}}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right" >
                                    <label>Disc :</label>
                                </td>
                                <td class="text-right" id="label-disc" >
                                   {{-- <input style="font-size:14px;" type="text" name="disc" class="input-sm form-control text-right input-clear" value="{{$po_master->disc}}" >  --}}
                                   {{$sup_bill->disc}}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right" style="border-top:solid darkgray 1px;" >
                                    Total :
                                </td>
                                <td id="label-total" class=" text-right" style="font-size:18px;font-weight:bold;border-top:solid darkgray 1px;" >
                                    {{$sup_bill->total}}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right" style="border-top:solid darkgray 1px;" >
                                    Amount Due :
                                </td>
                                <td id="label-amount-due" class=" text-right" style="font-size:18px;font-weight:bold;border-top:solid darkgray 1px;" >
                                    {{$sup_bill->amount_due}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12" >
                    {{-- <button type="submit" class="btn btn-primary" id="btn-save" >Save</button> --}}
                            <a class="btn btn-danger" href="purchase/order/edit/{{$po_master->id}}" >Close</a>
                </div>
            </div> -->

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

    // -----------------------------------------------------
    // SET AUTO NUMERIC
    // =====================================================
    $('input[name=payment_amount]').autoNumeric('init',{
        vMin:'0',
        vMax:'9999999999'
    });
    // END OF AUTONUMERIC

})(jQuery);
</script>
@append
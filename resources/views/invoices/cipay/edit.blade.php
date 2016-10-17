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
    {{-- <a class="btn btn-success btn-sm pull-right" ><i class="fa fa-print" ></i> Print</a> --}}
    <div class="btn-group pull-right" >
        <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown">
        <i class="fa fa-print " ></i> &nbsp;Print &nbsp;
        <span class="caret"> </span>
        <span class="sr-only">Toggle Dropdown</span>
      </button>
      <ul class="dropdown-menu" role="menu">
        <li><a href="#" onclick="return false;">Printer</a></li>
        <li><a href="#" onclick="return false;" >PDF</a></li>

      </ul>
    </div>

    <h1>
        <a href="invoice/customer/payment" >Customer Payments</a>
        <i class="fa fa-angle-double-right" ></i>
        {{$data->payment_number}}
    </h1>


</section>

<!-- Main content -->
<section class="content">
    <input type="hidden" name="payment_id" value="{{$data->id}}">
    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-header with-border" style="padding-top:5px;padding-bottom:5px;" >
            <label> <small>Customer Payment</small> <h4 style="font-weight: bolder;margin-top:0;padding-top:0;margin-bottom:0;padding-bottom:0;" >{{$data->payment_number}}</h4></label>

            <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>
            <a class="btn  btn-arrow-right pull-right disabled bg-blue" >Posted</a>

            {{-- <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label> --}}
            {{-- <a class="btn btn-arrow-right pull-right disabled bg-gray" >Open</a> --}}

            <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>
            <a class="btn btn-arrow-right pull-right disabled bg-gray" >Draft</a>
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
                                {{$data->customer}}
                            </td>
                            <td class="col-lg-2" ></td>
                            <td class="col-lg-2">
                                <label>Payment Date</label>
                            </td>
                            <td class="col-lg-3" >
                                {{$data->payment_date_formatted}}
                            </td>
                        </tr>
                        <tr>
                            <td >
                                <label>Source Document</label>
                            </td>
                            <td  >
                                <a href="invoice/customer/payment/show-source-document/{{$data->customer_invoice_id}}/{{$data->id}}" >{{$data->source_document}}</a>
                            </td>
                            <td  ></td>
                            <td >
                                <label>Payment Amount</label>
                            </td>
                            <td class="uang" >
                                {{$data->payment_amount}}
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

            {{-- <h4 class="page-header" style="font-size:14px;color:#3C8DBC"><strong>INVOICES</strong></h4>
            <table id="table-invoices" class="table table-bordered table-condensed" >
                <thead>
                    <tr>
                        <th>REF#</th>
                        <th>TOTAL</th>
                        <th>AMOUNT DUE</th>
                        <th>PAYMENT AMOUNT</th>
                    </tr>
                    <tbody></tbody>
            </table> --}}

        </div><!-- /.box-body -->
        <div class="box-footer" >
            {{-- <button type="submit" class="btn btn-primary" id="btn-save" >Save</button> --}}
            <a class="btn btn-danger" id="btn-cancel" href="invoice/customer/payment" >Close</a>
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

    // -----------------------------------------------------
    // SET AUTO NUMERIC
    // =====================================================
    $('.uang').autoNumeric('init',{
        vMin:'0',
        vMax:'9999999999'
    });
    // END OF AUTONUMERIC

    // normalize field payment amount
    $('.uang').autoNumeric('set',$('.uang').autoNumeric('get'));


})(jQuery);
</script>
@append

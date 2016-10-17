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
        <a href="cashbook/expense" >Cash Expense</a> 
        <i class="fa fa-angle-double-right" ></i> 
        Add Expense
    </h1>
</section>

<!-- Main content -->
<section class="content">
    {{-- <input type="hidden" name="so_master_id" value="{{$so_master->id}}"> --}}
    <!-- Default box -->
    <div class="box box-solid">
        <form method="POST" action="cashbook/expense/insert" >
            <div class="box-header with-border" style="padding-top:5px;padding-bottom:5px;" >
                <label> <small>Add Expense</small> <h4 style="font-weight: bolder;margin-top:0;padding-top:0;margin-bottom:0;padding-bottom:0;" >NEW</h4></label>

                <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>
                <a class="btn  btn-arrow-right pull-right disabled bg-gray" >Posted</a>

                {{-- <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label> --}}
                {{-- <a class="btn btn-arrow-right pull-right disabled bg-gray" >Open</a> --}}

                <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>
                <a class="btn btn-arrow-right pull-right disabled bg-blue" >Draft</a>
            </div>
            <div class="box-body">                
                    <table class="table" >
                        <tbody>
                            <tr>
                                <td class="col-lg-2">
                                    <label>Description</label>
                                </td>
                                <td colspan="4" >
                                    <input autofocus type="text" name="description" class="form-control" required autocomplete="off" >
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    <label>Date</label>
                                </td>
                                <td  >
                                    <input value="{{date('d-m-Y')}}" type="text" name="date" class="form-control input-tanggal"  required>
                                </td>
                                <td  ></td>
                                <td >
                                    <label>Total</label>
                                </td>
                                <td >
                                    <input type="text" name="total" class="form-control text-right uang"  autocomplete="off" required>
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
            </div><!-- /.box-body -->
            <div class="box-footer" >
                <button type="submit" class="btn btn-primary" id="btn-save" >Save</button>
                <a class="btn btn-danger" id="btn-cancel" href="cashbook/expense" >Cancel</a>
            </div>
        <form>
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

    // SET AUTO NUMERIC UANG
    $('.uang').autoNumeric('init',{
        vMin:'0',
        vMax:'9999999999'
    });


})(jQuery);
</script>
@append
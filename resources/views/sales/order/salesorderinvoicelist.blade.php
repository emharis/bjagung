 @extends('layouts.master')

@section('styles')
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <a href="sales/order" >Sales Order</a> 
        <i class="fa fa-angle-double-right" ></i> 
        <a href="sales/order/edit/{{$so_master->id}}" >{{$so_master->so_no}}</a> 
        <i class="fa fa-angle-double-right" ></i> 
        Customer Invoices
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-body">
            {{-- <a class="btn btn-primary btn-sm" id="btn-add" href="sales/order/add" ><i class="fa fa-plus" ></i> Add Sales Order</a> --}}
            {{-- <div class="clearfix" ></div> --}}
            {{-- <br/> --}}

            <?php $rownum=1; ?>
            <table class="table table-bordered table-condensed table-striped table-hover" id="table-order" >
                <thead>
                    <tr>
                        <th style="width:30px;" >NO</th>
                        <th>CUSTOMER</th>
                        <th>INVOICE DATE</th>
                        <th>NUMBER</th>
                        <th>DUE DATE</th>
                        <th>SOURCE DOCUMENT</th>
                        <th>TOTAL</th>
                        <th>TO PAY</th>
                        <th>STATUS</th>
                        <th style="width:30px;" ></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $rownum=1; ?>
                    @foreach($cust_invoice as $dt)
                        <tr>
                            <td>
                                {{$rownum++}}
                            </td>
                            <td>
                                {{$dt->customer}}
                            </td>
                            <td>
                                {{$dt->invoice_date_formatted}}
                            </td>
                            <td>
                                {{$dt->no_inv}}
                            </td>
                            <td>
                                {{$dt->due_date_formatted}}
                            </td>
                            <td>
                                {{$dt->so_no}}
                            </td>
                            <td class="text-right" >
                                {{number_format($dt->total,0,'.',',')}}
                            </td>
                            <td class="text-right" >
                                {{number_format($dt->amount_due,0,'.',',')}}
                            </td>
                            <td>
                                @if($dt->status == 'O')
                                    Open
                                @else
                                    Paid
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-success btn-xs" href="sales/order/show-invoice-multi/{{$dt->id }}" ><i class="fa fa-edit" ></i></a>
                                @if($dt->status == 'O')
                                {{-- <a class="btn btn-danger btn-xs btn-delete-so" href="sales/order/delete/{{$dt->id}}" ><i class="fa fa-trash" ></i></a> --}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <a class="btn btn-danger" href="sales/order/edit/{{$so_master->id}}" >Close</a>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

</section><!-- /.content -->


<!-- MODAL DELETE DATA -->
<div class="modal modal-danger" id="modal-delete" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">DELETE</h4>
            </div>
        <div class="modal-body">
            <p>Anda akan menghapus data ini?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
            <button data-orderid="" data-rowid="" type="button" class="btn btn-outline" data-dismiss="modal" id="btn-modal-delete-yes" >Yes</button>
        </div>
        </div>
    <!-- /.modal-content -->
    </div>
  <!-- /.modal-dialog -->
</div>

@stop

@section('scripts')
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>

<script type="text/javascript">
(function ($) {
    //required checkbox
    var requiredCheckboxes = $('.order_jual');
    requiredCheckboxes.change(function () {
        if (requiredCheckboxes.is(':checked')) {
            requiredCheckboxes.removeAttr('required');
        } else {
            requiredCheckboxes.attr('required', 'required');
        }
    });

    var TBL_KATEGORI = $('#table-order').DataTable({
        "columns": [
            {className: "text-right"},
            null,
            null,
            null,
            null,
            null,
            null,
            {className: "text-right"},
            null,
            {className: "text-center"}
        ]
    });

    // DELETE DATA SALES ORDER
    $('.btn-delete-so').click(function(){
        if(confirm('Anda akan menghapus data ini?')){

        }else{
            return false;
        }
    });
    // END OF DELETE DATA SALES ORDER

   
})(jQuery);
</script>
@append
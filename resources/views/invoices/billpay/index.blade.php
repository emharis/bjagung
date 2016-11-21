 @extends('layouts.master')

@section('styles')
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Bill Payments
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-header" >
            <a class="btn btn-sm btn-primary" href="invoice/customer/payment/create" >Register Payment</a>
        </div>
        <div class="box-body">

            <?php $rownum=1; ?>
            <table class="table table-bordered table-condensed table-striped table-hover" id="table-order" >
                <thead>
                    <tr>
                        <th style="width:30px;" >NO</th>
                        <th>PAYMENT DATE</th>
                        <th>REFERENCE</th>
                        <th>SUPPLIER</th>
                        <th>SOURCE DOCUMENT</th>
                        <th>PAYMENT AMOUNT</th>
                        <th class="col-sm-1 col-md-1 col-lg-1" ></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $rownum=1; ?>
                    @foreach($data as $dt)
                        <tr>
                            <td>
                                {{$rownum++}}
                            </td>
                            <td>
                                {{$dt->tanggal_formatted}}
                            </td>
                            <td>
                                {{$dt->payment_number}}
                            </td>
                            <td>
                                {{$dt->supplier}}
                            </td>
                            <td>
                                <a href="invoice/supplier/bill-payment/show-source-doc/{{$dt->id}}" >{{$dt->bill_no}}</a>

                            </td>
                            <td class="text-right" >
                                {{number_format($dt->total,0,'.',',')}}
                            </td>
                            <td>
                                <a class="btn btn-success btn-xs" href="invoice/customer/payment/edit/{{$dt->id }}" ><i class="fa fa-edit" ></i></a>
                                <a class="btn btn-danger btn-xs btn-delete-payment" href="invoice/customer/payment/delete/{{$dt->id}}" ><i class="fa fa-trash-o" ></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- <a class="btn btn-danger" href="sales/order/edit/{{$so_master->id}}" >Close</a> --}}
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

    var TBL_KATEGORI = $('#table-order').DataTable({
        "columns": [
            {className: "text-right"},
            null,
            null,
            null,
            null,
            {className: "text-right"},
            {className: "text-center"}
        ],
         "bSortClasses": false
    });

    // DELETE PAYMENT
    $('.btn-delete-payment').click(function(){
        if(confirm('Anda akan menghapus data ini?')){

        }else{

            return false;
        }
    });
    // END OF DELETE PAYMENT


})(jQuery);
</script>
@append

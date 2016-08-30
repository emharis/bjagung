@extends('layouts.master')

@section('styles')
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Purchase Order
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-body">
            <a class="btn btn-primary btn-sm" id="btn-add" href="purchase/order/add" ><i class="fa fa-plus" ></i> Add Purchase Order</a>
            <div class="clearfix" ></div>
            <br/>

            <?php $rownum=1; ?>
            <table class="table table-bordered table-condensed table-striped table-hover" id="table-order" >
                <thead>
                    <tr>
                        <th style="width:50px;" >No</th>
                        <th class="col-lg-1" >PO Num</th>
                        <th class="col-lg-1" >No. Inv</th>
                        <th class="col-lg-1" >Tanggal</th>
                        <th>Supplier</th>
                        <th>Total</th>
                        <th class="col-lg-1" >Status</th>
                        <th style="width:65px;" ></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $dt)
                    <tr data-rowid="{{$rownum}}" data-orderid="{{$dt->id}}">
                        <td>{{$rownum++}}</td>
                        <td>{{$dt->po_num}}</td>
                        <td>{{$dt->no_inv}}</td>
                        <td>{{$dt->tgl_formatted}}</td>
                        <td>{{$dt->supplier}}</td>
                        <td>
                            {{number_format($dt->grand_total,0,'.',',')}}
                        </td>
                        <td>
                            @if($dt->status == 'O')
                                Open PO
                            @elseif($dt->status == 'V')
                                Validated
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-success btn-xs btn-edit-order" href="purchase/order/edit/{{$dt->id}}" ><i class="fa fa-edit" ></i></a>
                            {{-- @if($dt->ref == 0)
                            <a class="btn btn-danger btn-xs btn-delete-order" ><i class="fa fa-trash" ></i></a>
                            @endif --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
            {className: "text-right"},
            null,
            {className: "text-center"}
        ]
    });

    // DELETE KATEGORI
    $(document).on('click', '.btn-delete-order', function(){
        //set data rowid dan order id
        var rowid = $(this).parent().parent().data('rowid');
        var orderid = $(this).parent().parent().data('orderid');
        
        $('#btn-modal-delete-yes').data('rowid',rowid);
        $('#btn-modal-delete-yes').data('orderid',orderid);
        // tampilkan modal delete
        $('#modal-delete').modal('show');
    });

    // modal delete klik yes
    $(document).on('click', '#btn-modal-delete-yes', function(){
        var rowid = $(this).data('rowid');
        var orderid = $(this).data('orderid');
        // delete data order dari database
        $.post('purchase/order/delete',{
            'id' : orderid
        },function(){
            // hapus row order
            var row = $('#table-order > tbody > tr[data-rowid=' + rowid + ']');
            row.fadeOut(250,null,function(){
                TBL_KATEGORI.row(row).remove().draw();

                // reorder row number
                var rownum=1;
                TBL_KATEGORI.rows().iterator( 'row', function ( context, index ) {
                    this.cell(index,0).data(rownum++);
                    // this.invalidate();
                } );
                
                TBL_KATEGORI.draw();
            });
        });

    });
    // END OF DELETE KATEGORI

})(jQuery);
</script>
@append
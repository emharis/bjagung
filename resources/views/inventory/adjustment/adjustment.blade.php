@extends('layouts.master')

@section('styles')
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Inventory Adjustment
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-body">
            <a class="btn btn-primary btn-sm" id="btn-add" href="inventory/adjustment/add" ><i class="fa fa-plus" ></i> Add</a>
            <div class="clearfix" ></div>
            <br/>

            <?php $rownum=1; ?>
            <table class="table table-bordered table-condensed table-striped table-hover" id="table-data" >
                <thead>
                    <tr>
                        <th style="width:50px;" >No</th>
                        <th>Inventory Reference</th>
                        <th>Inventory Date</th>
                        <th class="col-sm-2" >Status</th>
                        <th style="width:65px;" ></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $rownum=1; ?>
                    @foreach($data as $dt)
                        <tr data-dataid="{{$dt->id}}" data-rowid="{{$rownum}}">
                            <td>{{$rownum++}}</td>
                            <td>
                                {{$dt->inventory_reference}}
                            </td>
                            <td>
                                {{date('d-m-Y',strtotime($dt->tgl))}}
                            </td>
                            <td>
                                @if($dt->status == 'D')
                                    Draft
                                @elseif($dt->status == 'P')
                                    In Progress
                                @else
                                    Validated
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-success btn-xs btn-edit-barang" href="inventory/adjustment/edit/{{$dt->id}}" ><i class="fa fa-edit" ></i></a>
                                @if($dt->status != 'V')
                                <a class="btn btn-danger btn-xs btn-delete-data" ><i class="fa fa-trash" ></i></a>
                                @endif
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
            <button data-dataid="" data-rowid="" type="button" class="btn btn-outline" data-dismiss="modal" id="btn-modal-delete-yes" >Yes</button>
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
    // Set Table Data
    var TBL_DATA = $('#table-data').DataTable({
        "columns": [
            {className: "text-right"},
            null,
            null,
            null,
            {className: "text-center"}
        ]
    });

    // DELETE DATA
    $(document).on('click', '.btn-delete-data', function(){
        //set data rowid dan barang id
        var rowid = $(this).parent().parent().data('rowid');
        var dataid = $(this).parent().parent().data('dataid');
        
        $('#btn-modal-delete-yes').data('rowid',rowid);
        $('#btn-modal-delete-yes').data('dataid',dataid);
        // tampilkan modal delete
        $('#modal-delete').modal('show');
    });

    // modal delete klik yes
    $(document).on('click', '#btn-modal-delete-yes', function(){
        var rowid = $(this).data('rowid');
        var dataid = $(this).data('dataid');

        // delete data barang dari database

        $.post('inventory/adjustment/delete',{
            'adjustment_id' : dataid
        },function(datares){
            // hapus row data
            var row = $('#table-data > tbody > tr[data-rowid=' + rowid + ']');
            row.fadeOut(250,null,function(){
                TBL_DATA.row(row).remove().draw();

                // reorder row number
                var rownum=1;
                TBL_DATA.rows().iterator( 'row', function ( context, index ) {
                    this.cell(index,0).data(rownum++);
                    // this.invalidate();
                } );
                
                TBL_DATA.draw();
            });
        });
    });
    // END OF DELETE DATA

})(jQuery);
</script>
@append
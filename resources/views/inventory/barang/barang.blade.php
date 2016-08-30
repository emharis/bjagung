@extends('layouts.master')

@section('styles')
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Barang
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-body">
            <a class="btn btn-primary btn-sm" id="btn-add" href="inventory/barang/add" ><i class="fa fa-plus" ></i> Add Barang</a>
            <div class="clearfix" ></div>
            <br/>

            <?php $rownum=1; ?>
            <table class="table table-bordered table-condensed table-striped table-hover" id="table-barang" >
                <thead>
                    <tr>
                        <th style="width:50px;" >No</th>
                        <th>Nama</th>
                        <th>Kode</th>
                        {{-- <th class="col-sm-2" >Cost</th> --}}
                        <th class="col-sm-2" >Price</th>
                        <th class="col-sm-1" >Stok</th>
                        <th class="col-sm-1" >Berat</th>
                        <th style="width:65px;" ></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $dt)
                    <tr data-rowid="{{$rownum}}" data-barangid="{{$dt->id}}">
                        <td>{{$rownum++}}</td>
                        <td>{{$dt->kategori . ' ' . $dt->nama}}</td>
                        <td>{{$dt->kode}}</td>
                        {{-- <td></td> --}}
                        <td  >{{number_format($dt->harga_jual,0,'.',',')}}</td>
                        <td>{{$dt->stok}}</td>
                        <td>{{$dt->berat}}</td>
                        <td>
                            <a class="btn btn-success btn-xs btn-edit-barang" href="inventory/barang/edit/{{$dt->id}}" ><i class="fa fa-edit" ></i></a>
                            @if($dt->can_delete == 1)
                            <a class="btn btn-danger btn-xs btn-delete-barang" ><i class="fa fa-trash" ></i></a>
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
            <button data-barangid="" data-rowid="" type="button" class="btn btn-outline" data-dismiss="modal" id="btn-modal-delete-yes" >Yes</button>
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
<script src="plugins/autonumeric/autoNumeric-min.js" type="text/javascript"></script>

<script type="text/javascript">
(function ($) {
    //required checkbox
    var requiredCheckboxes = $('.satuan_jual');
    requiredCheckboxes.change(function () {
        if (requiredCheckboxes.is(':checked')) {
            requiredCheckboxes.removeAttr('required');
        } else {
            requiredCheckboxes.attr('required', 'required');
        }
    });

    var TBL_BARANG = $('#table-barang').DataTable({
        "columns": [
            {className: "text-right"},
            null,
            null,
            // {className: "text-right"},
            {className: "text-right"},
            {className: "text-right"},
            {className: "text-right"},
            {className: "text-center"}
        ]
    });

    // DELETE BARANG
    $(document).on('click', '.btn-delete-barang', function(){
        //set data rowid dan barang id
        var rowid = $(this).parent().parent().data('rowid');
        var barangid = $(this).parent().parent().data('barangid');
        
        $('#btn-modal-delete-yes').data('rowid',rowid);
        $('#btn-modal-delete-yes').data('barangid',barangid);
        // tampilkan modal delete
        $('#modal-delete').modal('show');
    });

    // modal delete klik yes
    $(document).on('click', '#btn-modal-delete-yes', function(){
        var rowid = $(this).data('rowid');
        var barangid = $(this).data('barangid');
        // delete data barang dari database
        // var newform = $('<form>').attr('method','POST').attr('action','inventory/barang/delete');
        // newform.append($('<input>').attr('type','text').attr('name','barang_id').val(barangid));
        // newform.submit();

        $.post('inventory/barang/delete',{
            'barang_id' : barangid
        },function(datares){
            // hapus row barang
            var row = $('#table-barang > tbody > tr[data-rowid=' + rowid + ']');
            row.fadeOut(250,null,function(){
                TBL_BARANG.row(row).remove().draw();

                // reorder row number
                var rownum=1;
                TBL_BARANG.rows().iterator( 'row', function ( context, index ) {
                    this.cell(index,0).data(rownum++);
                    // this.invalidate();
                } );
                
                TBL_BARANG.draw();
            });
        });
    });
    // END OF DELETE BARANG

    // // -----------------------------------------------------
    // // SET AUTO NUMERIC
    // // =====================================================
    // $('.uang').autoNumeric('init',{
    //     vMin:'0',
    //     vMax:'9999999999'
    // });

})(jQuery);
</script>
@append
<?php $__env->startSection('styles'); ?>
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

<?php $__env->appendSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Satuan
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-body">
            <a class="btn btn-primary btn-sm" id="btn-add" href="inventory/satuan/add" ><i class="fa fa-plus" ></i> Add Satuan</a>
            <div class="clearfix" ></div>
            <br/>

            <?php $rownum=1; ?>
            <table class="table table-bordered table-condensed table-striped table-hover" id="table-satuan" >
                <thead>
                    <tr>
                        <th style="width:50px;" >No</th>
                        <th>Nama</th>
                        <th style="width:65px;" ></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $dt): ?>
                    <tr data-rowid="<?php echo e($rownum); ?>" data-satuanid="<?php echo e($dt->id); ?>">
                        <td><?php echo e($rownum++); ?></td>
                        <td><?php echo e($dt->nama); ?></td>
                        <td>
                            <a class="btn btn-success btn-xs btn-edit-satuan" href="inventory/satuan/edit/<?php echo e($dt->id); ?>" ><i class="fa fa-edit" ></i></a>
                            <?php if($dt->ref == 0): ?>
                            <a class="btn btn-danger btn-xs btn-delete-satuan" ><i class="fa fa-trash" ></i></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
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
            <button data-satuanid="" data-rowid="" type="button" class="btn btn-outline" data-dismiss="modal" id="btn-modal-delete-yes" >Yes</button>
        </div>
        </div>
    <!-- /.modal-content -->
    </div>
  <!-- /.modal-dialog -->
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>

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

    var TBL_KATEGORI = $('#table-satuan').DataTable({
        "columns": [
            {className: "text-right"},
            null,
            {className: "text-center"}
        ]
    });

    // DELETE KATEGORI
    $(document).on('click', '.btn-delete-satuan', function(){
        //set data rowid dan satuan id
        var rowid = $(this).parent().parent().data('rowid');
        var satuanid = $(this).parent().parent().data('satuanid');
        
        $('#btn-modal-delete-yes').data('rowid',rowid);
        $('#btn-modal-delete-yes').data('satuanid',satuanid);
        // tampilkan modal delete
        $('#modal-delete').modal('show');
    });

    // modal delete klik yes
    $(document).on('click', '#btn-modal-delete-yes', function(){
        var rowid = $(this).data('rowid');
        var satuanid = $(this).data('satuanid');
        // delete data satuan dari database
        $.post('inventory/satuan/delete',{
            'id' : satuanid
        },function(){
            // hapus row satuan
            var row = $('#table-satuan > tbody > tr[data-rowid=' + rowid + ']');
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
<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
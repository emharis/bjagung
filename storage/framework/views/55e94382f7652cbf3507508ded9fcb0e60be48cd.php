 

<?php $__env->startSection('styles'); ?>
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

<?php $__env->appendSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Supplier Bills
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-body">
            <?php $rownum=1; ?>
            <table class="table table-bordered table-condensed table-striped table-hover" id="table-order" >
                <thead>
                    <tr>
                        <th style="width:30px;" >NO</th>
                        <th>SUPPLIER</th>
                        <th>BILL DATE</th>
                        <th>REF#</th>
                        <th>SUPPLIER REF#</th>
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
                    <?php foreach($data as $dt): ?>
                        <tr>
                            <td>
                                <?php echo e($rownum++); ?>

                            </td>
                            <td>
                                <?php echo e($dt->supplier); ?>

                            </td>
                            <td>
                                <?php echo e($dt->bill_date_formatted); ?>

                            </td>
                            <td>
                                <?php echo e($dt->bill_no); ?>

                            </td>
                            <td>
                                <?php echo e($dt->no_inv); ?>

                            </td>
                            <td>
                                <?php echo e($dt->due_date_formatted); ?>

                            </td>
                            <td  >
                                <?php echo e($dt->po_num); ?>

                            </td>
                            <td class="text-right" >
                                <?php echo e(number_format($dt->total,0,'.',',')); ?>

                            </td>
                            <td class="text-right" >
                                <?php echo e(number_format($dt->amount_due,0,'.',',')); ?>

                            </td>
                            <td>
                                <?php if($dt->status == 'O'): ?>
                                    Open
                                <?php else: ?>
                                    Paid
                                <?php endif; ?>
                            </td>
                            <td>
                                <a class="btn btn-success btn-xs" href="invoice/supplier-bill/show/<?php echo e($dt->id); ?>" ><i class="fa fa-edit" ></i></a>
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
            <button data-orderid="" data-rowid="" type="button" class="btn btn-outline" data-dismiss="modal" id="btn-modal-delete-yes" >Yes</button>
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
            null,
            {className: "text-right"},
            null,
            {className: "text-center"}
        ],
         "bSortClasses": false
    });


})(jQuery);
</script>
<?php $__env->appendSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 

<?php $__env->startSection('styles'); ?>
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

<?php $__env->appendSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Customer Payments
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
                        <th>REF#</th>
                        <th>CUSTOMER</th>
                        <th>SOURCE DOCUMENT</th>
                        <th>PAYMENT AMOUNT</th>
                        <th class="col-sm-1 col-md-1 col-lg-1" ></th>
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
                                <?php echo e($dt->payment_date_formatted); ?>

                            </td>
                            <td>
                                <?php echo e($dt->payment_number); ?>

                            </td>
                            <td>
                                <?php echo e($dt->customer); ?>

                            </td>
                            <td>
                                <a href="invoice/customer/payment/show-source-document/<?php echo e($dt->customer_invoice_id); ?>/<?php echo e($dt->id); ?>" ><?php echo e($dt->source_document); ?></a>

                            </td>
                            <td class="text-right" >
                                <?php echo e(number_format($dt->payment_amount,0,'.',',')); ?>

                            </td>
                            <td>
                                <a class="btn btn-success btn-xs" href="invoice/customer/payment/edit/<?php echo e($dt->id); ?>" ><i class="fa fa-edit" ></i></a>
                                <a class="btn btn-danger btn-xs btn-delete-payment" href="invoice/customer/payment/delete/<?php echo e($dt->id); ?>" ><i class="fa fa-trash-o" ></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php /* <a class="btn btn-danger" href="sales/order/edit/<?php echo e($so_master->id); ?>" >Close</a> */ ?>
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

    var TBL_KATEGORI = $('#table-order').DataTable({
        "columns": [
            {className: "text-right"},
            null,
            null,
            null,
            null,
            {className: "text-right"},
            {className: "text-center"}
        ]
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
<?php $__env->appendSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
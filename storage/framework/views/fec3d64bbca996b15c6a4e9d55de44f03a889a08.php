<?php $__env->startSection('styles'); ?>
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>

<?php $__env->appendSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <a href="purchase/report" >Purchase Orders Reports</a> <i class="fa fa-angle-double-right" ></i> Report
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-solid">
      <div class="box-header with-border">
        <label>
          <h3 style="margin:0;padding:0;font-weight:bold;" >Purchase Orders Report</h3>
        </label>
        <a class="btn btn-success pull-right" >Print</a>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table class="table table-condensed" >
          <tbody>
            <tr>
              <td class="col-sm-2" >
                <label>Date range</label>
              </td>
              <td>
                <div class="row" >
                  <div class="col-sm-2" >
                    <input type="text" class="form-control" readonly value="<?php echo e($date_start); ?>"/>
                  </div>
                  <div class="col-sm-1" >
                    <label>to</label>
                  </div>
                  <div class="col-sm-2" >
                    <input type="text" class="form-control" readonly value="<?php echo e($date_end); ?>"/>
                  </div>
                </div>

                  <?php /* <?php echo $date_start . ' <label>to</label> ' . $date_end; ?> */ ?>
              </td>
            </tr>
          </tbody>
        </table>

        <h4 class="page-header" style="font-size:14px;color:#3C8DBC"><strong>ORDER DETAILS</strong></h4>

        <table class="table table-bordered table-condensed" >
          <thead>
            <tr>
              <th>NO</th>
              <th>REF#</th>
              <th>SUPPLIER</th>
              <th>SUPPLIER REF#</th>
              <th>ORDER DATE</th>
              <th>DUE DATE</th>
              <th>TOTAL</th>
              <th>DISC</th>
              <th>PAYMENT AMOUNT</th>
            </tr>
          </thead>
          <tbody>
            <?php $rownum=1; ?>
            <?php $payment_total = 0;?>
            <?php foreach($data as $dt): ?>
              <tr>
                <td><?php echo e($rownum++); ?></td>
                <td>
                  <?php echo e($dt->po_num); ?>

                </td>
                <td>
                  <?php echo e($dt->supplier); ?>

                </td>
                <td>
                  <?php echo e($dt->no_inv); ?>

                </td>
                <td>
                  <?php echo e($dt->tgl_formatted); ?>

                </td>
                <td>
                  <?php echo e($dt->jatuh_tempo_formatted); ?>

                </td>
                <td class="uang text-right" >
                  <?php echo e($dt->total); ?>

                </td>
                <td class="uang text-right" >
                  <?php echo e($dt->disc); ?>

                </td>
                <td class="uang text-right" >
                  <?php echo e($dt->grand_total); ?>

                </td>
              </tr>
              <?php $payment_total += $dt->grand_total; ?>
            <?php endforeach; ?>

          </tbody>
        </table>

        <div class="row">
                <div class="col-lg-8">
                </div>
                <div class="col-lg-4">
                    <table class="table table-condensed">
                        <tbody>
                          <tr>
                            <td colspan="2" ></td>
                          </tr>
                          <tr>
                              <td class="text-right" style="border-top:solid darkgray 1px;">
                                  Total :
                              </td>
                              <td  class="uang text-right" style="font-size:18px;font-weight:bold;border-top:solid darkgray 1px;">
                                <?php echo e($payment_total); ?>

                              </td>
                          </tr>
                        </tbody>
                    </table>
                </div>
            </div>

      </div><!-- /.box-body -->
      <div class="box-footer" >
        <a class="btn btn-danger" href="purchase/report" >Close</a>
      </div>
    </div><!-- /.box -->

</section><!-- /.content -->


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="plugins/autonumeric/autoNumeric-min.js" type="text/javascript"></script>

<script type="text/javascript">
(function ($) {
  // SET AUTO NUMERIC
  $('.uang').autoNumeric('init',{
      vMin:'0',
      vMax:'9999999999'
  });
  $('.uang').each(function(){
    $(this).autoNumeric('set',$(this).autoNumeric('get'));
  });
  // END OF SET AUTO NUMERIC

})(jQuery);
</script>
<?php $__env->appendSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
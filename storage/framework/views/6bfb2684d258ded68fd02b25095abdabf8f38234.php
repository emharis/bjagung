<?php $__env->startSection('styles'); ?>
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

<?php $__env->appendSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <a href="invoice/supplier-bill" >Supplier Bills</a>
        <i class="fa fa-angle-double-right" ></i>
        <a href="invoice/supplier-bill/show/<?php echo e($data->id); ?>" ><?php echo e($data->bill_no); ?></a>
        <i class="fa fa-angle-double-right" ></i>
        Register Payment
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <?php /* data hidden  */ ?>
    <input type="hidden" name="supplier_bill_id" value="<?php echo e($data->id); ?>">
    <?php /* <input type="hidden" name="so_master_id" value="<?php echo e($so_master->id); ?>"> */ ?>
    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-header with-border" style="padding-top:5px;padding-bottom:5px;" >
            <?php /* <a class="btn btn-primary" style="margin-top:0;" id="btn-reg-payment" href="sales/order/reg-payment/<?php echo e($so_master->id); ?>" >Register Payment</a> */ ?>

            <label>
                <small>Register Payment</small>
                <h4 style="font-weight: bolder;margin-top:0;padding-top:0;margin-bottom:0;padding-bottom:0;" ><?php echo e($data->bill_no); ?></h4>
            </label>

            <?php /* <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label> */ ?>
            <?php /* <a class="btn  btn-arrow-right pull-right disabled <?php echo e($data->status == 'P' ? 'bg-blue' : 'bg-gray'); ?>" >Paid</a> */ ?>

            <?php /* <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label> */ ?>

            <?php /* <a class="btn btn-arrow-right pull-right disabled <?php echo e($data->status == 'O' ? 'bg-blue' : 'bg-gray'); ?>" >Open</a> */ ?>

            <?php /* <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>

            <a class="btn btn-arrow-right pull-right disabled bg-gray" >Draft PO</a> */ ?>
        </div>
        <div class="box-body">
            <?php /* <form method="POST" action="sales/order/save-payment" > */ ?>

                <table class="table" >
                    <tbody>
                        <tr>
                            <td class="col-lg-2">
                                <label>Source Document</label>
                            </td>
                            <td class="col-lg-3" >
                                <?php echo e($data->po_num); ?>

                            </td>
                            <td class="col-lg-2" ></td>
                            <td class="col-lg-2">
                                <label>Payment Date</label>
                            </td>
                            <td class="col-lg-3" >
                                <input type="text" name="payment_date" class="form-control input-tanggal" value="<?php echo e(date('d-m-Y')); ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td >
                                <label>Supplier Ref#</label>
                            </td>
                            <td  >
                                <?php /* <input type="text" name="supplier_reference" class="form-control text-right" value="<?php echo e($data->no_inv); ?>" readonly> */ ?>
                                <?php echo e($data->no_inv); ?>

                            </td>
                            <td  ></td>
                            <td >
                                <?php /* <label>Payment Amount</label> */ ?>
                            </td>
                            <td >
                                <?php /* <input type="text" name="payment_amount" class="form-control text-right" value="<?php echo e($data->amount_due); ?>" autofocus required> */ ?>
                            </td>
                        </tr>
                        <tr>
                            <td >
                                <label>Amount Due</label>
                            </td>
                            <td  >
                                <input type="text" name="amount_due" class="form-control text-right" value="<?php echo e($data->amount_due); ?>" readonly>
                            </td>
                            <td  ></td>
                            <td >
                                <label>Payment Amount</label>
                            </td>
                            <td >
                                <input type="text" name="payment_amount" class="form-control text-right" value="<?php echo e($data->amount_due); ?>" autofocus required>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="5" >
                                <button type="submit" class="btn btn-primary" id="btn-save" >Save</button>
                                <a class="btn btn-danger" id="btn-cancel" href="invoice/supplier-bill/show/<?php echo e($data->id); ?>" >Cancel</a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            <?php /* </form> */ ?>


        </div><!-- /.box-body -->
    </div><!-- /.box -->

</section><!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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

    // -----------------------------------------------------
    // SET AUTO NUMERIC
    // =====================================================
    $('input[name=payment_amount], input[name=amount_due]').autoNumeric('init',{
        vMin:'0',
        vMax:'9999999999'
    });
    // END OF AUTONUMERIC

    // CEK PAYMENT AMOUNT APAKAH LEBIH BESAR DARI AMOUNT DUE
    $('#btn-save').click(function(){
        var amount_due = $('input[name=amount_due]').autoNumeric('get');
        var payment_amount = $('input[name=payment_amount]').autoNumeric('get');
        // var so_master_id = $('input[name=so_master_id]').val();
        var payment_date = $('input[name=payment_date]').val();
        var supplier_bill_id = $('input[name=supplier_bill_id]').val();

        if(Number(payment_amount) > Number(amount_due)){
            alert('Payment amount melebihi amount due.');
            // fokuskan
            $('input[name=payment_amount]').select();
        }else{

            // var newform = $('<form>').attr('method','POST').attr('action','api/reg-supplier-payment');
            // newform.append($('<input>').attr('type','hidden').attr('name','payment_amount').val(payment_amount));
            // newform.append($('<input>').attr('type','hidden').attr('name','payment_date').val(payment_date));
            // newform.append($('<input>').attr('type','hidden').attr('name','supplier_bill_id').val(supplier_bill_id));
            // newform.submit();

            // newform.append($('<input>').attr('type','hidden').attr('name','so_master_id').val(so_master_id));

            $.post('api/reg-supplier-payment',{
                'payment_amount' : payment_amount,
                'payment_date' : payment_date,
                'supplier_bill_id' : supplier_bill_id
            },function(){
                location.href = "invoice/supplier-bill/show/" + supplier_bill_id;
            });
        }

        return false;
    });
    // END OF CEK PAYMENT AMOUNT APAKAH LEBIH BESAR DARI AMOUNT DUE


})(jQuery);
</script>
<?php $__env->appendSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
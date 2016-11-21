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
        <a href="invoice/customer/payment" >Customer Payments</a> 
        <i class="fa fa-angle-double-right" ></i> 
        <a href="invoice/customer/payment/edit/<?php echo e($customer_payment->id); ?>" ><?php echo e($customer_payment->payment_number); ?></a>
        <i class="fa fa-angle-double-right" ></i> 
        <?php echo e($data->no_inv); ?>

    </h1>
</section>

<!-- Main content -->
<section class="content">
    <?php /* data hidden  */ ?>
    <input type="hidden" name="customer_invoice_id" value="<?php echo e($data->id); ?>">

    <div class="box box-solid" >
        <div class="box-header with-border" style="padding-top:5px;padding-bottom:5px;" >
                
            <?php /* <?php if($data->status == "O"): ?>
                <a class="btn btn-primary" style="margin-top:0;" id="btn-reg-payment" href="sales/order/reg-payment/<?php echo e($data->id); ?>" >Register Payment</a>
            <?php else: ?>
                <label> <small>Invoice</small> <h4 style="font-weight: bolder;margin-top:0;padding-top:0;margin-bottom:0;padding-bottom:0;" ><?php echo e($data->no_inv); ?></h4></label>
            <?php endif; ?> */ ?>
                <label> <small>Customer Invoice</small> <h4 style="font-weight: bolder;margin-top:0;padding-top:0;margin-bottom:0;padding-bottom:0;" ><?php echo e($data->no_inv); ?></h4></label>

                <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>
                <a class="btn  btn-arrow-right pull-right disabled <?php echo e($data->status == 'P' ? 'bg-blue' : 'bg-gray'); ?>" >Paid</a>

                <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>

                <a class="btn btn-arrow-right pull-right disabled <?php echo e($data->status == 'O' ? 'bg-blue' : 'bg-gray'); ?>" >Open</a>

                <?php /* <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>

                <a class="btn btn-arrow-right pull-right disabled bg-gray" >Draft PO</a> */ ?>
            </div>
            <div class="box-body">
                <table class="table" >
                    <tbody>
                        <tr>
                            <td class="col-lg-2">
                                <label>Supplier</label>
                            </td>
                            <td class="col-lg-4" >
                                <?php /* <input type="text" name="supplier" class="form-control" data-supplierid="<?php echo e($so_master->supplier_id); ?>" value="<?php echo e($so_master->supplier); ?>" required> */ ?>
                                <?php echo e($data->customer); ?>

                            </td>
                            <td class="col-lg-2" ></td>
                            <td class="col-lg-2" >
                                <label>Bill Date</label>
                            </td>
                            <td class="col-lg-2" >
                                <?php /* <input type="text" name="tanggal" class="input-tanggal form-control" value="<?php echo e($so_master->tgl_formatted); ?>" required> */ ?>
                                <?php echo e($data->invoice_date_formatted); ?>

                            </td>
                        </tr>
                        <tr>
                            <td class="col-lg-2">
                                <label>Source Document</label>
                            </td>
                            <td class="col-lg-4" >
                                <?php /* <input type="text" name="no_inv" class="form-control" value="<?php echo e($so_master->no_inv); ?>" > */ ?>
                                <a href="#" ><?php echo e($data->so_no); ?></a> 
                            </td>
                            <td class="col-lg-2" ></td>
                            <td class="col-lg-2" >
                                <label>Due Date</label>
                            </td>
                            <td class="col-lg-2" >
                                <?php /* <input type="text" name="jatuh_tempo"  class="input-tanggal form-control" value="<?php echo e($so_master->jatuh_temso_formatted); ?>" > */ ?>
                                <?php /* <?php echo e($so_master->jatuh_temso_formatted); ?> */ ?>
                                <?php echo e($data->due_date_formatted); ?>

                            </td>
                        </tr>
                    </tbody>
                </table>

                <h4 class="page-header" style="font-size:14px;color:#3C8DBC"><strong>PRODUCT DETAILS</strong></h4>

                <table id="table-product" class="table table-bordered table-condensed table-striped" >
                    <thead>
                        <tr>
                            <th style="width:25px;" >NO</th>
                            <th class="col-lg-4" >PRODUCT</th>
                            <th class="col-lg-1" >QUANTITY</th>
                            <th class="col-lg-1" >UNIT</th>
                            <th class="col-lg-1" >WEIGHT</th>
                            <th>UNIT PRICE</th>
                            <th>SUBTOTAL</th>
                            <?php /* <th style="width:50px;" ></th> */ ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $rownum=1; ?>
                        <?php foreach($barang as $dt): ?>
                            <tr>
                                <td class="text-right"><?php echo e($rownum++); ?></td>
                                <td>
                                    <?php echo e($dt->nama_full); ?>

                                </td>
                                <td class="text-right" >
                                    <?php echo e($dt->qty); ?>

                                </td>
                                <td class="text-right" >
                                    <?php echo e($dt->satuan); ?>

                                </td>
                                <td class="text-right" >
                                    <?php echo e($dt->berat); ?>

                                </td>
                                <td class="text-right" >
                                    <?php echo e(number_format($dt->harga_salesman,0,'.',',')); ?>

                                </td>
                                <td class="text-right" >
                                    <?php echo e(number_format($dt->subtotal,0,'.',',')); ?>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="row" >
                    <div class="col-lg-8" >
                        <?php /* <textarea name="note" class="form-control" rows="4" style="margin-top:5px;" placeholder="Note" ><?php echo e($so_master->note); ?></textarea> */ ?>
                        <?php /* <br/>
                        <label>Note :</label> <i><?php echo e($so_master->note); ?></i> */ ?>
                    </div>
                    <div class="col-lg-4" >
                        <table class="table table-condensed" >
                            <tbody>
                                <tr>
                                    <td class="text-right">
                                        <label>Subtotal :</label>
                                    </td>
                                    <td id="label-total-subtotal" class=" text-right" >
                                        <?php echo e(number_format($data->subtotal,0,'.',',')); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right" >
                                        <label>Disc :</label>
                                    </td>
                                    <td class="text-right" id="label-disc" >
                                        <?php echo e(number_format($data->disc,0,'.',',')); ?>

                                       <?php /* <input style="font-size:14px;" type="text" name="disc" class="input-sm form-control text-right input-clear" value="<?php echo e($so_master->disc); ?>" >  */ ?>
                                       
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right" style="border-top:solid darkgray 1px;" >
                                        Total :
                                    </td>
                                    <td id="label-total" class=" text-right" style="font-size:18px;font-weight:bold;border-top:solid darkgray 1px;" >
                                        <?php echo e(number_format($data->total,0,'.',',')); ?>

                                    </td>
                                </tr>
                                <?php if(count($payments) > 0): ?>
                                <?php foreach($payments as $dt): ?>
                                    <tr style="background-color:#EEF0F0;" >
                                        <td class="text-right" >
                                            <?php /* <a class="btn-delete-payment" data-paymentid="<?php echo e($dt->id); ?>" href="#" ><i class="fa fa-trash-o pull-left" ></i></a> */ ?>
                                            <i>Paid on <?php echo e($dt->payment_date_formatted); ?></i>
                                        </td>
                                        <td class="text-right" >
                                            <i><?php echo e(number_format($dt->payment_amount,0,'.',',')); ?></i>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                                <tr>
                                    <td class="text-right" style="border-top:solid darkgray 1px;" >
                                        Amount Due :
                                    </td>
                                    <td id="label-amount-due" class=" text-right" style="font-size:18px;font-weight:bold;border-top:solid darkgray 1px;" >
                                        <?php echo e(number_format($data->amount_due,0,'.',',')); ?>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12" >
                        <?php /* <?php if($multi_invoice): ?>
                        <a class="btn btn-danger" href="sales/order/invoice/<?php echo e($so_master->id); ?>" >Close</a>
                        <?php else: ?> */ ?>
                            
                        <?php /* <?php endif; ?> */ ?>
                    </div>
                </div>
            </div><!-- /.box-body -->
            <div class="box-footer" >
                <a class="btn btn-danger" href="invoice/customer/payment/edit/<?php echo e($customer_payment->id); ?>" >Close</a>
            </div>
    </div>

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

})(jQuery);
</script>
<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
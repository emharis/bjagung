<?php $__env->startSection('styles'); ?>
<style>
    .col-top-item{
        cursor:pointer;
        border: thin solid #CCCCCC;
        
    }
    .table-top-item > tbody > tr > td{
        border-top-color: #CCCCCC;
    }
</style>
<?php $__env->appendSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <a href="inventory/kategori" >Kategori</a> <i class="fa fa-angle-double-right" ></i> New
    </h1>
</section>

<!-- Main content -->
<section class="content">
  <form method="POST" action="inventory/kategori/insert" >
    <div class="box box-primary" >
      <div class="box-body" >
        <div class="form-group">
            <label >Nama Kategori</label>
            <input autofocus autocomplete="off" required type="text" class="form-control input-lg" placeholder="Nama Kategori" name="nama" value="">
        </div>
        <div class="form-group">
            <label >Satuan</label>
            <select name="satuan" class="form-control" required>
              <?php foreach($satuan as $dt): ?>
                <option value="<?php echo e($dt->id); ?>" ><?php echo e($dt->nama); ?></option>
              <?php endforeach; ?>
            </select>                              
        </div>                    
      </div>
      <div class="box-footer" >
        <button type="submit" class="btn btn-primary" >Save</button>
        <a class="btn btn-danger" href="inventory/kategori" >Cancel</a>
      </div>
    </div>
  </form>
</section><!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>
<script type="text/javascript">
(function ($) {
    

})(jQuery);
</script>
<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
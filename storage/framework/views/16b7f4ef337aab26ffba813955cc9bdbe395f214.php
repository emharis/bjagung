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
        <a href="inventory/barang" >Barang</a> <i class="fa fa-angle-double-right" ></i> New
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <?php if(session('status')): ?>
        <div class="callout callout-danger">
            <h4>ERROR</h4>

            <p><?php echo e(session('status')); ?></p>
        </div>
    <?php endif; ?>

    <form method="POST" action="inventory/barang/insert" >
          <div class="box box-primary" >
            <div class="box-body" >
              <div class="form-group">
                  <label >Nama Barang</label>
                  <input autofocus autocomplete="off" type="text" class="form-control input-lg" placeholder="Nama Barang" name="nama" value="" required>
              </div>
              <div class="form-group">
                  <label >Kode</label>
                  <div class="row" >
                    <div class="col-lg-4" >
                      <input autocomplete="off" type="text" class="form-control " placeholder="Kode" name="kode" value="" required >
                      <i class="text-red"></i>
                    </div>
                  </div>
              </div>
              <div class="form-group">
                  <label >Kategori</label>
                  <div class="row" >
                    <div class="col-lg-4" >
                      <select name="kategori" class="form-control">
                        <?php foreach($kategori as $dt): ?>
                        <option value="<?php echo e($dt->id); ?>" ><?php echo e($dt->nama); ?></option>
                        <?php endforeach; ?>
                       </select>
                      <?php /* <div class="input-group" >
                        
                        <span class="input-group-btn">
                          <a class="btn btn-primary hide" id="btn-create-kategori" >Create</a>
                        </span>
                      </div>
                    </div> */ ?>
                  </div>                             
              </div>
              <div class="form-group">
                  <label >Berat</label>
                  <div class="row" >
                    <div class="col-lg-2" >
                      <input autocomplete="off" type="number" class="form-control text-right"  placeholder="Berat" name="berat" value="" required>
                    </div>
                  </div>
              </div>
              <div class="form-group">
                  <label >Minimum Quantity</label>
                  <div class="row" >
                    <div class="col-lg-2" >
                      <input autocomplete="off" type="number" class="form-control text-right"  placeholder="Minimum Quantity" name="rol" value="" >
                    </div>
                  </div>
              </div>                      
            </div>
            <div class="box-footer" >
              <button type="submit" class="btn btn-primary" id="btn-save" >Save</button>
              <a class="btn btn-danger" href="inventory/barang" >Cancel</a>
            </div>
          </div>
        </form>

</section><!-- /.content -->

<div class="modal" id="modal-create-kategori" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Create Kategori</h4>
      </div>
      <div class="modal-body">
        <form name="form-create-kategori" method="POST" action="inventory/barang/create-kategori" >
          <div class="form-group" >
            <label>Nama</label>
            <input class="form-control" name="nama" required >
          </div>
          <div class="form-group" >
            <button type="submit" class="btn btn-primary" >Save</button>
            <a class="btn btn-danger" data-dismiss="modal" >Cancel</a>
          </div>
        </form>            
      </div>
    </div>           
  </div>         
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>
<script type="text/javascript">
(function ($) {
    // CEK OTOMATIS KODE BARANG
    $('input[name=kode]').keyup(function(){
      var kode = $(this).val();
        $.get('inventory/barang/cek-kode/'+kode,null,function(res){
          if(res > 0){
            // disaBLE tombol save
            $('#btn-save').attr('disabled','disabled');
            // tampilkan pesan error
            $('input[name=kode]').next().text('* KODE BARANG telah digunakan');
          }else{
            // enable tombol save
            $('#btn-save').removeAttr('disabled');
            // clear info error
            $('input[name=kode]').next().text('');
          }
        });
    });

    // TAMPILKAN FORM CREATE KATEGORI
    $('#btn-create-kategori').click(function(){
      $('#modal-create-kategori').modal('show');
    });

    // SAVE KATEGORI
    // $('form[name=form-create-kategori]').ajaxForm({
    //     beforeSubmit: function () {
            
    //     },
    //     success: function (datares) {
    //         var data = JSON.parse(datares);
            
    // });
                        
})(jQuery);
</script>
<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
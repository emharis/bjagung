<?php $__env->startSection('styles'); ?>
<link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>
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
        <a href="inventory/adjustment" >Inventory Adjustment</a> <i class="fa fa-angle-double-right" ></i> New
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

    <form method="POST" action="inventory/adjustment/insert" >
          <div class="box box-primary" >
            <div class="box-body" >
              <div class="form-group">
                  <label >Inventory Reference</label>
                  <input autofocus autocomplete="off" type="text" class="form-control input-lg" placeholder="Inventory Reference" name="nama" value="" required>
              </div>
              <div class="row" >
                <div class="col-lg-6" >
                  <table class="table table-clear" >
                    <tbody>
                    <tr>
                        <td>
                          <label>Inventory of</label>
                        </td>
                        <td>
                          <select class="form-control" name="inventory_of"  >
                            <option value="I" >Initial Stock</option>
                            <option value="S" >Stock Opname</option>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <?php /* <label>Products</label> */ ?>
                        </td>
                        <td>
                          <?php /* <select class="form-control" name="product_of"  >
                            <option value="A" >All products</option>\
                            <option value="S" >Select product manually</option>
                          </select> */ ?>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-lg-6" >
                  <table class="table table-clear" >
                    <tbody>
                      <tr>
                        <td>
                          <label>Inventory date</label>
                        </td>
                        <td>
                          <input id="input-tanggal" type="text" name="tanggal" class="form-control" value="<?php echo e(date('d-m-Y')); ?>" >
                        </td>
                      </tr>
                      <tr class="hide" id="row-inventoried-product">
                        <td>
                          <label>Inventoried Product</label>
                        </td>
                        <td>
                          <input type="text" name="inventoried_product" class="form-control" required value="x" >
                          <input type="hidden" name="kode_barang">
                          <input type="hidden" name="id_barang">
                          <input type="hidden" name="nama_barang">
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            <div class="box-footer" >
              <button type="submit" class="btn btn-primary " id="btn-save" >Save</button>
              <a class="btn btn-danger" href="inventory/adjustment" >Cancel</a>
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
        <form name="form-create-kategori" method="POST" action="inventory/adjustment/create-kategori" >
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
<script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="plugins/autocomplete/jquery.autocomplete.min.js" type="text/javascript"></script>
<script type="text/javascript">
(function ($) {
  // set datetimepicker
  $('#input-tanggal').datepicker({
      format: 'dd-mm-yyyy',
      todayHighlight: true,
      autoclose: true
  }).on('changeDate',function(env){
      
  });

  // set autocomplete inventoried product
  $('input[name=inventoried_product]').autocomplete({
      serviceUrl: 'inventory/adjustment/get-barang',
      params: {  'nama': function() {
                      return $('input[name=inventoried_product]').val();
                  }
              },
      onSelect:function(suggestions){
          // set barang yang dipilih
          $('input[name=id_barang]').val(suggestions.data);
          $('input[name=kode_barang]').val(suggestions.kode);
          $('input[name=nama_barang]').val(suggestions.nama);
      }

  });

  // Inventory of change
  // $('select[name=product_of]').change(function(){
  //   if($(this).val() == 'S'){
  //     // tampilkan input pilih barang
  //     $('#row-inventoried-product').removeClass('hide');
  //     // clear value
  //     $('input[name=inventoried_product]').val('');
  //   }else{
  //     $('#row-inventoried-product').addClass('hide');
  //     // add value
  //     $('input[name=inventoried_product]').val('x');
  //   }
  // });

})(jQuery);
</script>
<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
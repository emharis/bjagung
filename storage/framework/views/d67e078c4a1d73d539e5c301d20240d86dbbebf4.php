<?php $__env->startSection('styles'); ?>
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<?php /* <link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/> */ ?>
<link href="plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css"/>

<?php $__env->appendSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Purchase Order Reports
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-solid">
      <div class="box-header with-border" >
        <label>
          <h3 style="margin:0;padding:0;font-weight:bold;" >Report Options</h3>
        </label>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table class="table table-condensed" >
          <tbody>
            <?php /* BY DATE RANGE */ ?>
            <tr>
              <td class="col-sm-2 col-md-2 col-lg-2" >
                <label>Order Date</label>
              </td>
              <td class="col-sm-4 col-md-4 col-lg-4" >
                <input type="text" name="date_range" class="form-control">
                <?php /* <input type="text" name="date_start" class="input-date form-control row-date-range" /> */ ?>
              </td>
              <?php /* <td >to</td> */ ?>
              <td >
                <?php /* <input type="text" name="date_end" class="input-date form-control row-date-range" /> */ ?>
              </td>
            </tr>
            <?php /* BY SUPPLIER */ ?>
            <tr>
              <td>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="ck_by_supplier"/> Supplier
                  </label>
                </div>
              </td>
              <td  >
                <input type="text" name="supplier" class="form-control row-by-supplier" readonly/>
              </td>
            </tr>
            <?php /* BY DUE DATE */ ?>
            <?php /* <tr>
              <td>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="ck_due_date"/> Due date on
                  </label>
                </div>
              </td>
              <td>
                <div class="input-group">
                  <input type="number" min="0" name="days_to_due_date" class="form-control text-right row-by-due-date" readonly>
                  <span class="input-group-addon">days</span>
                </div>
              </td>
              <td></td>
              <td></td>
            </tr> */ ?>
            <?php /* BY STATUS */ ?>
            <?php /* <tr>
              <td>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="ck_status"/> Status
                  </label>
                </div>
              </td>
              <td>
                <select name="status" class="form-control row-by-status" disabled>
                  <option value="O">Open</option>
                  <option value="V">Validated</option>
                </select>
              </td>
              <td></td>
              <td></td>
            </tr> */ ?>

            <tr>
              <td></td>
              <td>
                <button class="btn btn-primary " id="btn-submit" >Submit</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->

</section><!-- /.content -->


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>
<?php /* <script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script> */ ?>
<script src="plugins/bootstrap-daterangepicker/moment.js" type="text/javascript"></script>
<script src="plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>

<script type="text/javascript">
(function ($) {

  // // SET DATEPICKER
  // $('.input-date').datepicker({
  //   format: 'dd-mm-yyyy',
  //     todayHighlight: true,
  //     autoclose: true,
  //     endDate : 'now'
  // });
  // // END OF SET DATEPICKER

  // SET DATE PICKER
  var start_date;
  var end_date;
  $('input[name=date_range]').daterangepicker({
            "autoApply": true,
            locale: {
              format: 'DD/MM/YYYY'
            },
        }, 
        function(start, end, label) {
            // alert("A new date range was chosen: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            start_date = start.format('DD-MM-YYYY');
            end_date = end.format('DD-MM-YYYY');
        });
    // END OF SET DATEPICKER

  // INPUT-DATE-RANGE SET RANGE
  // $('input[name=date_start]').change(function(){
  //     // sett start date on end_date
  //     $('input[name=date_end]').datepicker('remove');
  //     $('input[name=date_end]').datepicker({
  //       format: 'dd-mm-yyyy',
  //       todayHighlight: true,
  //       autoclose: true,
  //       startDate : $('input[name=date_start]').val(),
  //       endDate : 'now'
  //     });
  //   });
  // INPUT-DATE-RANGE SET RANGE

  // check change
  // $('input[name=ck_date_range]').change(function(){
  //   if($(this).prop('checked')){
  //     $('input.row-date-range').removeAttr('readonly');
  //   }else{
  //     $('input.row-date-range').attr('readonly','readonly');
  //   }
  //
  // });

  $('input[name=ck_by_supplier]').change(function(){
    if($(this).prop('checked')){
      $('input.row-by-supplier').removeAttr('readonly');
      $('input.row-by-supplier').focus();
    }else{
      $('input.row-by-supplier').attr('readonly','readonly');
    }
  });

  $('input[name=ck_due_date]').change(function(){
    if($(this).prop('checked')){
      $('input.row-by-due-date').removeAttr('readonly');
      $('input.row-by-due-date').focus();
    }else{
      $('input.row-by-due-date').attr('readonly','readonly');
    }
  });

  $('input[name=ck_status]').change(function(){
    if($(this).prop('checked')){
      $('select.row-by-status').removeAttr('disabled');
      $('select.row-by-status').focus();
    }else{
      $('select.row-by-status').attr('disabled','disabled');
    }
  });

  // SUBMIT REPORT WITH OPTIONS
  $('#btn-submit').click(function(){
    // var date_start = $('input[name=date_start]').val();
    // var date_end = $('input[name=date_end]').val();

    // if(date_start != "" && date_end != ""){
    //   var newform = $('<form>').attr('method','POST').attr('action','purchase/report/show-report');
    //   newform.append($('<input>').attr('type','hidden').attr('name','date_start').val(date_start));
    //   newform.append($('<input>').attr('type','hidden').attr('name','date_end').val(date_end));
    //   newform.submit();
    // }else{
    //   alert('Lengkapi data yang kosong.');
    // }

    var newform = $('<form>').attr('method','POST').attr('action','purchase/report/report-by-date');

    if(start_date != '' && end_date != ''){
        
            newform.append($('<input>').attr('type','hidden').attr('name','start_date').val(start_date));
            newform.append($('<input>').attr('type','hidden').attr('name','end_date').val(end_date));
    }else{
      alert('Lengkapi data yang kosong.');
    }

    newform.submit();

  });
  // END OF SUBMIT REPORT WITH OPTIONS

})(jQuery);
</script>
<?php $__env->appendSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
@extends('layouts.master')

@section('styles')
<link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<style>
    .col-top-item{
        cursor:pointer;
        border: thin solid #CCCCCC;
        
    }
    .table-top-item > tbody > tr > td{
        border-top-color: #CCCCCC;
    }

    /*input on table row with no bezel*/
    .real-qty-input-on-row, .real-cost-input-on-row{
      display: block; 
      padding: 0; 
      margin: 0; 
      border: 0; 
      width: 100%;
      background-color:inherit;
      float:right;
    }

    /*minimalkan row table condensed*/
    .table.table-condensed > tbody > tr > td{
      padding-top:0;
      padding-bottom:0;
    }
</style>
@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{-- <a href="inventory/adjustment" >Inventory Adjustment</a> <i class="fa fa-angle-double-right" ></i> Edit Start Inventory --}}
        <a href="inventory/adjustment" >Inventory Adjustment</a> 
        <i class="fa fa-angle-double-right" ></i> 
        {{$adjustment_data->inventory_reference}}
        {{-- <a href="inventory/adjustment/edit/{{$adjustment_data->id}}" >{{$adjustment_data->inventory_reference}}</a>  --}}
        {{-- <i class="fa fa-angle-double-right" ></i>  --}}
        {{-- Start Inventory --}}
    </h1>
</section>

<!-- Main content -->
<section class="content">

  <form method="POST" action="inventory/adjustment/save-start" name="form-edit-start" >
    <input type="hidden" name="inventory_adjustment_id" value="{{$adjustment_data->id}}" >
    <div class="box box-solid" >
      <div class="box-header with-border" style="padding-top:5px;padding-bottom:5px;" >
        <a class="btn btn-primary" id="btn-validate-start-inventory" href="inventory/adjustment/validate/{{$adjustment_data->id}}" >Validate Inventory</a>
        <a class="btn btn-danger" id="btn-cancel-inventory" href="inventory/adjustment/cancel-inventory/{{$adjustment_data->id}}" >Cancel Inventory</a>
              
        <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>
        <a class="btn {{$adjustment_data->status == 'V' ? 'bg-blue' : 'bg-gray'}} btn-arrow-right pull-right disabled" >Validated</a>

        <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>

        <a class="btn {{$adjustment_data->status == 'P' ? 'bg-blue' : 'bg-gray'}} btn-arrow-right pull-right disabled" >In Progress</a>

        <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>

        <a class="btn {{$adjustment_data->status == 'D' ? 'bg-blue' : 'bg-gray'}} btn-arrow-right pull-right disabled" >Draft</a>
      </div>
      <div class="box-body" >
        <div class="row" >
          <div class="col-lg-12" >
            {{-- PAGE TITLE --}}
            <label> <small>Inventory Reference</small> <h4 style="font-weight: bolder;margin-top:0;padding-top:0;margin-bottom:0;padding-bottom:0;" >{{$adjustment_data->inventory_reference}}</h4></label>
            {{-- <label>Inventory Reference</label>
            <h3 style="margin-top:0;" ><label>{{$adjustment_data->inventory_reference}}<label></h3> --}}

            <table class="table " >
              <tbody>
                <tr>
                  <td class="col-lg-2"  >
                    <label>Inventory of</label>
                  </td>
                  <td>
                    @if($adjustment_data->inventory_of == 'I')
                      Initial Stock
                    @else
                      Stock Opname
                    @endif
                  </td>
                  <td class="col-lg-2" >
                    <label>Inventory Date</label>
                  </td>
                  <td>
                    {{date('d-m-Y',strtotime($adjustment_data->tgl))}}
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <h4 class="page-header" style="font-size:14px;color:#3C8DBC" ><strong>INVENTORY DETAILS</strong></h4>
        
        <table class="table table-bordered table-condensed table-striped table-condensed" id="table-barang"  >
          <thead>
            <tr>
              <th style="width:10px;" >No</th>
              <th style="width:10px;" ></th>
              <th>Product</th>
              <th class="col-lg-2" >Theoretical Quantity</th>
              <th class="col-lg-2" >Real Quantity</th>
              <th class="col-lg-2" >Cost</th>
            </tr>
          </thead>
          <tbody>
            <?php $rownum = 1; ?>
            @foreach($barang as $dt)
              <tr >
                <td class="text-right" >{{$rownum++}}</td>
                <td class="text-center" >
                  <input type="checkbox" class="cb-on-row" value="{{$dt->id}}" name="barang[]" {{$dt->real_qty > 0 ? 'checked':''}} >
                </td>
                <td>{{$dt->nama_full}}</td>
                <td class="text-right" >
                  @if($adjustment_data->status == 'P')
                    {{$dt->stok}}
                  @else
                    @if($dt->theoretical_qty == "")
                      0
                    @else
                      {{$dt->theoretical_qty}}
                    @endif
                  @endif
                  <input type="hidden" name="theo_qty_{{$dt->id}}" value="{{$dt->theoretical_qty}}">
                </td>
                <td>
                  <input type="text" name="real_qty_{{$dt->id}}" class="{{$dt->real_qty > 0 ? '':'hide'}} form-control real-qty-input-on-row text-right" value="{{$dt->real_qty > 0 ? $dt->real_qty:''}}" min="0" >
                </td>
                <td>
                  <input type="text" name="cost_{{$dt->id}}" class="{{$dt->real_qty > 0 ? '':'hide'}} form-control real-cost-input-on-row text-right" value="{{$dt->real_qty > 0 ? $dt->cost:''}}" min="0">
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

      <div class="box-footer" >
        <button type="submit" class="btn btn-primary" id="btn-save" >Save</button>
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

@stop

@section('scripts')
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="plugins/autonumeric/autoNumeric-min.js" type="text/javascript"></script>
<script src="plugins/datatables/fnGetHiddenNodes.js" ></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
(function ($) {
  // set datetimepicker
  $('#input-tanggal').datepicker({
      format: 'dd-mm-yyyy',
      todayHighlight: true,
      autoclose: true
  }).on('changeDate',function(env){
      
  });

  // -----------------------------------------------------
  // SET AUTO NUMERIC
  // =====================================================
  $('input.real-qty-input-on-row, input.real-cost-input-on-row').autoNumeric('init',{
      vMin:'0',
      vMax:'9999999999'
  });

  // -----------------------------------------------------
  // SETTING DATATABLE
  // =====================================================
  /* Create an array with the values of all the checkboxes in a column */
  $.fn.dataTable.ext.order['dom-checkbox'] = function  ( settings, col )
  {
      return this.api().column( col, {order:'index'} ).nodes().map( function ( td, i ) {
          return $('input', td).prop('checked') ? '1' : '0';
      } );
  };


  
  var tableBarang = $('#table-barang').DataTable({
      // "sort":false,
      "aaSorting": [[ 1, 'desc' ]], 
        "columns": [
            null,
            { "orderDataType": "dom-checkbox" },
            null,
            null,
            null,
            null,
        ]
    } );

  // -----------------------------------------------------
  // CHECKBOX ON ROW CLICKED
  // =====================================================
  $(document).on('change','input.cb-on-row', function(){
    if($(this).prop('checked')){
      // tampilkan input on row
      $(this).parent().next().next().next().children('input').removeClass('hide').focus();
      $(this).parent().next().next().next().next().children('input').removeClass('hide');
    }else{
      // sembunyikan dan clear data
      $(this).parent().next().next().next().children('input').val('').addClass('hide');
      $(this).parent().next().next().next().next().children('input').val('').addClass('hide');
    }
  });


  // $('form[name=form-edit-start]').ajaxForm({
  //   beforeSerialize: function($form, options) { 
  //     $('form[name=form-edit-start]').unbind('submit');
  //     tableBarang.$('input').each(function(){
  //       var elm = $(this);
  //       elm.addClass('hide');
  //       $('form[name=form-edit-start]').append(elm);
  //     });

  //     alert('before serialize');                  
  //   }
  // });

  $('form[name=form-edit-start]').submit(function(){
    // beforeSerialize: function($form, options) { 
      $('form[name=form-edit-start]').unbind('submit');
      tableBarang.$('input').each(function(){
        var elm = $(this);
        elm.addClass('hide');
        $('form[name=form-edit-start]').append(elm);
      });

    //   alert('before serialize');                  
    // }
  });

                        
})(jQuery);
</script>
@append
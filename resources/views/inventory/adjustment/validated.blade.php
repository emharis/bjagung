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
        <a href="inventory/adjustment" >Inventory Adjustment</a> <i class="fa fa-angle-double-right" ></i> {{$adjustment_data->inventory_reference}}
    </h1>
</section>

<!-- Main content -->
<section class="content">

  {{-- <form method="POST" action="inventory/adjustment/save-start" > --}}
    {{-- <input type="hidden" name="inventory_adjustment_id" value="{{$adjustment_data->id}}" > --}}
    <div class="box box-solid" >
      <div class="box-header with-border" style="padding-top:5px;padding-bottom:5px;">
        {{-- PAGE TITLE --}}
        <label> <small>Inventory Reference</small> <h4 style="font-weight: bolder;margin-top:0;padding-top:0;margin-bottom:0;padding-bottom:0;" >{{$adjustment_data->inventory_reference}}</h4></label>

        {{-- <label>Inventory Reference</label> --}}
            {{-- <h3 style="margin-top:0;" ><label>{{$adjustment_data->inventory_reference}}<label></h3> --}}
              
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
                {{-- <tr>
                  <td class="col-lg-2"  >
                    <label>Product</label>
                  </td>
                  <td>
                    All of products
                  </td>
                  <td class="col-lg-2" >
                    
                  </td>
                  <td>
                    
                  </td>
                </tr> --}}
              </tbody>
            </table>
          </div>
        </div>

        <h4 class="page-header" style="font-size:14px;color:#3C8DBC" ><strong>INVENTORY DETAILS</strong></h4>
        
        <table class="table table-bordered table-condensed table-striped table-condensed" id="table-barang"  >
          <thead>
            <tr>
              <th style="width:10px;" >No</th>
              {{-- <th style="width:10px;" ></th> --}}
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
                {{-- <td class="text-center" >
                  <input type="checkbox" class="cb-on-row" value="{{$dt->id}}" name="barang[]" {{$dt->real_qty > 0 ? 'checked':''}} >
                </td> --}}
                <td>{{$dt->nama_full}}</td>
                <td class="text-right" >
                  {{$dt->theoretical_qty}}
                  <input type="hidden" name="theo_qty_{{$dt->id}}" value="{{$dt->theoretical_qty}}">
                </td>
                <td>
                  {{-- <input type="text" name="real_qty_{{$dt->id}}" class="{{$dt->real_qty > 0 ? '':'hide'}} form-control real-qty-input-on-row text-right" value="{{$dt->real_qty > 0 ? $dt->real_qty:''}}" min="0" > --}}
                  {{$dt->real_qty}}
                </td>
                <td>
                  {{-- <input type="text" name="cost_{{$dt->id}}" class="{{$dt->real_qty > 0 ? '':'hide'}} form-control real-cost-input-on-row text-right" value="{{$dt->real_qty > 0 ? $dt->cost:''}}" min="0"> --}}
                  {{number_format($dt->cost,0,'.',',')}}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

      <div class="box-footer" >
        {{-- <button type="submit" class="btn btn-primary" id="btn-save" >Save</button> --}}
        <a class="btn btn-danger" href="inventory/adjustment" >Close</a>
      </div>
    </div>
  </form>

</section><!-- /.content -->

@stop

@section('scripts')
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="plugins/autonumeric/autoNumeric-min.js" type="text/javascript"></script>
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
      
  });;

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
  }
  $('#table-barang').DataTable({
        "columns": [
            {className: "text-right"},
            
            null,
            {className: "text-right"},
            {className: "text-right"},
            {className: "text-right"},
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
  })
                        
})(jQuery);
</script>
@append
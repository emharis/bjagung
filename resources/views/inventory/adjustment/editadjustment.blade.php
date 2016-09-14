@extends('layouts.master')

@section('styles')
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
@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <a href="inventory/adjustment" >Inventory Adjustment</a> <i class="fa fa-angle-double-right" ></i> {{$data->inventory_reference}}
    </h1>
</section>

<!-- Main content -->
<section class="content">

    @if(session('status'))
        <div class="callout callout-danger">
            <h4>ERROR</h4>

            <p>{{session('status')}}</p>
        </div>
    @endif

    <form method="POST" action="inventory/adjustment/update" >
      <input type="hidden" name="id" value="{{$data->id}}">
          <div class="box box-solid" >
            <div class="box-header with-border" style="padding-top:5px;padding-bottom:5px;">
              <a class="btn btn-primary" id="btn-start-inventory" href="inventory/adjustment/start/{{$data->id}}" >Start Inventory</a>

              <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>
              <a class="btn {{$data->status == 'V' ? 'bg-blue' : 'bg-gray'}} btn-arrow-right pull-right disabled" >Validated</a>

              <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>

              <a class="btn {{$data->status == 'P' ? 'bg-blue' : 'bg-gray'}} btn-arrow-right pull-right disabled" >In Progress</a>

              <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>

              <a class="btn {{$data->status == 'D' ? 'bg-blue' : 'bg-gray'}} btn-arrow-right pull-right disabled" >Draft</a>
              

            </div>
            <div class="box-body" >
              <div class="form-group">
                  <label >Inventory Reference</label>
                  <input autofocus autocomplete="off" type="text" class="form-control input-lg" placeholder="Inventory Reference" name="nama" value="{{$data->inventory_reference}}" required>
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
                            <option {{$data->inventory_of == 'I' ? 'selected':''}} value="I" >Initial Stock</option>
                            <option {{$data->inventory_of == 'S' ? 'selected':''}} value="S" >Stock Opname</option>
                          </select>
                        </td>
                      </tr>
                      {{-- <tr>
                        <td>
                          <label>Products</label>
                        </td>
                        <td>
                          <select class="form-control" name="product_of"  >
                            <option {{$data->product_of == "A" ? 'selected':''}} value="A" >All products</option>
                            <option {{$data->product_of == "S" ? 'selected':''}} value="S" >Select product manually</option>
                          </select>
                        </td>
                      </tr> --}}
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
                          <input id="input-tanggal" type="text" name="tanggal" class="form-control" value="{{date('d-m-Y',strtotime($data->tgl))}}" >
                        </td>
                      </tr>
                      <tr class="{{$data->inventory_of == 'O' ? '':'hide'}}" id="row-inventoried-product">
                        <td>
                          <label>Inventoried Product</label>
                        </td>
                        <td>
                          <input type="text" name="inventoried_product" class="form-control" required value="{{$data->inventory_of == 'O' ? $barang->nama_full :'x'}}" >
                          <input type="hidden" name="kode_barang" value="{{$data->inventory_of == 'O' ? $barang->kode :''}}">
                          <input type="hidden" name="id_barang" value="{{$data->inventory_of == 'O' ? $barang->id :''}}" >
                          <input type="hidden" name="nama_barang" value="{{$data->inventory_of == 'O' ? $barang->nama :''}}" >
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

@stop

@section('scripts')
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="plugins/autocomplete/jquery.autocomplete.min.js" type="text/javascript"></script>
<script type="text/javascript">
(function ($) {
  //set datetimepicker
  $('#input-tanggal').datepicker({
      format: 'dd-mm-yyyy',
      todayHighlight: true,
      autoclose: true
  }).on('changeDate',function(env){
      
  });;

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

  // Product of change
  $('select[name=product_of]').change(function(){
    if($(this).val() == 'O'){
      // tampilkan input pilih barang
      $('#row-inventoried-product').removeClass('hide');
      // clear value
      $('input[name=inventoried_product]').val('');
      $('input[name=id_barang]').val('');
      $('input[name=kode_barang]').val('');
      $('input[name=nama_barang]').val('');

    }else{
      $('#row-inventoried-product').addClass('hide');
      // add value
      $('input[name=inventoried_product]').val('x');
    }
  });

                        
})(jQuery);
</script>
@append
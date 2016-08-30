@extends('layouts.master')

@section('styles')
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
        <a href="inventory/kategori" >Kategori</a> <i class="fa fa-angle-double-right" ></i> Edit
    </h1>
</section>

<!-- Main content -->
<section class="content">
  <form method="POST" action="inventory/kategori/update" >
    <input type="hidden" name="id" value="{{$data->id}}">
    <div class="box box-primary" >
      <div class="box-body" >
        <div class="form-group">
            <label >Nama Kategori</label>
            <input autofocus autocomplete="off" required type="text" class="form-control input-lg" placeholder="Nama Kategori" name="nama" value="{{$data->nama}}">
        </div>
        <div class="form-group">
            <label >Satuan</label>
            <select name="satuan" class="form-control" required>
              @foreach($satuan as $dt)
                <option value="{{$dt->id}}" {{$dt->id == $data->satuan_id ? 'selected':''}}  >{{$dt->nama}}</option>
              @endforeach
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

@stop

@section('scripts')
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>
<script type="text/javascript">
(function ($) {
    

})(jQuery);
</script>
@append
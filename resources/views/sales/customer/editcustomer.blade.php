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
        <a href="sales/customer" >Customer</a> <i class="fa fa-angle-double-right" ></i> Edit
    </h1>
</section>

<!-- Main content -->
<section class="content">
  <form method="POST" action="sales/customer/update" >
    <input type="hidden" name="id" value="{{$data->id}}">
    <div class="box box-primary" >
      <div class="box-body" >
        <div class="form-group">
            <label >Nama Customer</label>
            <input autofocus autocomplete="off" required type="text" class="form-control input-lg" placeholder="Nama Customer" name="nama" value="{{$data->nama}}">
        </div>
        <div class="form-group">
            <label >Nama Kontak</label>
            <input autocomplete="off" type="text" class="form-control" placeholder="Nama Kontak" name="nama_kontak" value="{{$data->nama_kontak}}">
        </div>
        <div class="form-group">
            <label >Alamat</label>
            <input autocomplete="off" type="text" class="form-control" placeholder="Alamat" name="alamat" value="{{$data->alamat}}">
        </div>
        <div class="form-group">
            <label >Telp</label>
            <input autocomplete="off" type="text" class="form-control" placeholder="Telp" name="telp" value="{{$data->telp}}">
        </div>          
        <div class="form-group">
            <input autocomplete="off" type="text" class="form-control" placeholder="Telp 2" name="telp2" value="{{$data->telp_2}}">
        </div>                  
        <div class="form-group">
            <label >Note</label>
            <textarea class="form-control" name="note" placeholder="Note" rows="8">{!! $data->note !!}</textarea>
        </div> 
      </div>
      <div class="box-footer" >
        <button type="submit" class="btn btn-primary" >Save</button>
        <a class="btn btn-danger" href="sales/customer" >Cancel</a>
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
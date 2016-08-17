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
        <a href="inventory/barang" >Barang</a> <i class="fa fa-angle-double-right" ></i> Edit
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
      <div class="col-md-9">
        <form method="POST" action="inventory/barang/update" >
          <div class="box box-primary" >
            <div class="box-body" >
              <div class="form-group">
                  <label >Nama Barang</label>
                  <input  type="text" class="form-control input-lg" placeholder="Nama Barang" name="nama" value="{{$barang->nama}}">
              </div>
              <div class="form-group">
                  <label >Kode</label>
                  <input  type="text" class="form-control " placeholder="Kode" name="kode" value="{{$barang->kode}}" >
              </div>
              <div class="form-group">
                  <label >Kategori</label>
                  <div class="row" >
                      @foreach($kategori as $dt)
                          <div class="col-sm-3" >
                              <div class="radio" >
                              <label>
                                  <input {{$dt->id == $barang->kategori_id ? 'checked':''}} type="radio" name="kategori" > {{$dt->nama}}
                              </label>
                              </div>
                          </div>
                      @endforeach
                  </div>                                
              </div>
              <div class="form-group">
                  <label >Berat</label>
                  <input  type="number" class="form-control"  placeholder="Berat" name="berat" value="{{$barang->berat}}" >
              </div>
              <div class="form-group">
                  <label >Minimum Quantity</label>
                  <input  type="number" class="form-control"  placeholder="Berat" name="rol" value="{{$barang->rol}}" >
              </div>                    
            </div>
            <div class="box-footer" >
              <button type="submit" class="btn btn-primary" >Save</button>
              <a class="btn btn-danger" href="inventory/barang" >Cancel</a>
            </div>
          </div>
        </form>
      </div><!-- /.col -->

        <div class="col-md-3">

              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <i class="fa fa-cubes" ></i> Quantity on hand <a class="pull-right">0</a>
                    </li>
                    <li class="list-group-item">
                      <i class="fa fa-shopping-cart" ></i> Purchases <a class="pull-right">0</a>
                    </li>
                    <li class="list-group-item">
                      <i class="fa fa-usd" ></i> Sales <a class="pull-right">0</a>
                    </li>
                  </ul>

                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
            
    </div><!-- /.row -->

</section><!-- /.content -->

@stop

@section('scripts')
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>
<script type="text/javascript">
(function ($) {
    // Tampilkan satuan barang
    $('select[name=kategori]').change(function(){
        $('#label-satuan').text($('select[name=kategori] option:selected').data('satuan'));
    });

})(jQuery);
</script>
@append
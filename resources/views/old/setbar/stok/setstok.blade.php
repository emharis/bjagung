@extends('layouts.master')

@section('styles')
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Pengaturan Stok Barang
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <div class="row" >
        <div class="col-sm-4 col-md-4 col-lg-4" >
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Data Barang</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-condensed" >
                        <tbody>
                            <tr>
                                <td><label>Nama</label></td>
                                <td>:</td>
                                <td>{{$data->nama}}</td>
                            </tr>
                            <tr>
                                <td><label>Kategori</label></td>
                                <td>:</td>
                                <td>{{$data->kategori}}</td>
                            </tr>
                            <tr>
                                <td><label>Satuan Pembelian</label></td>
                                <td>:</td>
                                <td>
                                    {{$data->satuan_beli}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-header with-border">
                    <h3 class="box-title">Satuan Penjualan</h3>
                </div>
                <div class="box-body" >
                    <table class="table table-bordered" >
                        <thead>
                            <tr>
                                <th>Satuan</th>
                                <th class="col-sm-1 col-md-1 col-lg-1">Konversi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($satuan_jual as $dt)
                            <tr>
                                <td>{{$dt->satuan}}</td>
                                <td class="text-right" >{{$dt->konversi}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-8 col-md-8 col-lg-8" >
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Data Stok</h3>
                    <a class="btn btn-primary pull-right btn-sm" ><i class="fa fa-plus" id="btn-add" ></i>  Add Manual Stok</a>
                </div>
                <div class="box-body">
                    <table class="table table-bordered" >
                        <thead>
                            <tr>
                                <th>Stok Awal</th>
                                <th>Sisa Stok</th>
                                <th>Tanggal Stok</th>
                                <th>Reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($stok)>0)
                            @foreach($stok as $dt)
                            <tr>
                                <td>
                                    {{$dt->stok_awal}}
                                </td>
                                <td>
                                    {{$dt->current_stok}}
                                </td>
                                <td>
                                    {{$dt->created_at}}
                                </td>
                                <td>

                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="4" >Belum ada data stok</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div>
        </div>
    </div>

    <!-- Default box -->
    <!-- /.box -->

</section><!-- /.content -->
@stop

@section('scripts')
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>

<script type="text/javascript">
(function ($) {

})(jQuery);
</script>
@append
@extends('layouts.master')

@section('styles')
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Pengaturan Barang
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-body">

            <div id="table-data" class="table-responsive" >
                <!--table data barang-->
                <table class="table table-bordered table-hover table-striped" id="table-datatable" >
                    <thead>
                        <tr>
                            <th class="col-sm-1 col-md-1 col-lg-1" >No</th>
                            <th class="col-sm-1 col-md-1 col-lg-1" >Kode</th>
                            <th  >Kategori/Barang</th>
                            <th class="col-sm-1 col-md-1 col-lg-1"  >Stok</th>
                            <th class="col-sm-1 col-md-1 col-lg-1"  >Satuan</th>
                            <th>Harga Jual</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $dt)
                        <tr>
                            <td class="text-right" ></td>
                            <td>{{$dt->kode}}</td>
                            <td >{{$dt->kategori . ' ' .$dt->nama}}</td>
                            <td>{{$dt->stok>0 ? $dt->stok : 0}}</td>
                            <td>{{$dt->satuan }}</td>
                            <td>{{number_format($dt->harga_jual_current,0,'.',',')}}</td>
                            <td class="text-center" >
                                <!--<a data-id="{{$dt->id}}" class="btn btn-success btn-xs btn-edit-barang" href="setbar/manstok/set-stok/{{$dt->id}}" ><i class="fa fa-edit" ></i></a>-->
                                <a class="btn btn-primary btn-sm btn-set-man-stok" href="setbar/manstok/set-stok/{{$dt->id}}" ><i class="fa fa-download" ></i> Manual Stok</a>
                                <a class="btn btn-success btn-sm btn-set-harga" href="setbar/manstok/set-harga/{{$dt->id}}" ><i class="fa fa-dollar" ></i> Set Harga Jual</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div><!-- /.box-body -->
    </div><!-- /.box -->

</section><!-- /.content -->
@stop

@section('scripts')
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>

<script type="text/javascript">
(function ($) {
    //format datatable
    var tableData = $('#table-datatable').DataTable({
        "aaSorting": [[2, "asc"]],
        "columns": [
            {className: "text-right"},
            null,
            null,
            {className: "text-right"},
            {className: "text-left"},
            {className: "text-right"},
            {className: "text-center"}
        ],
        "fnRowCallback": function (nRow, aData, iDisplayIndex) {
            var index = iDisplayIndex + 1;
            $('td:eq(0)', nRow).html(index);
            return nRow;
        }
    });


    //SET AUTOFOCUS KE FILTER TABLE
    $('input[type=search]').focus();

})(jQuery);
</script>
@append
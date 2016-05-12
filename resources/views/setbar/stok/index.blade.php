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

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-body">
<!--            <a class="btn btn-primary btn-sm" id="btn-add" ><i class="fa fa-plus" ></i> Add Barang</a>
            <div class="clearfix" ></div>
            <br/>-->

            <div id="table-data" >
                <!--table data barang-->
                <table class="table table-bordered table-condensed" id="table-datatable" >
                    <thead>
                        <tr>
                            <th class="col-sm-1 col-md-1 col-lg-1" >No</th>
                            <th class="col-sm-3 col-md-3 col-lg-3" >Kategori</th>
                            <th   >Barang</th>
                            <th class="col-sm-1 col-md-1 col-lg-1"  >Stok</th>
                            <th class="col-sm-2 col-md-2 col-lg-2"  >Date</th>
                            <th class="col-sm-1 col-md-1 col-lg-1" ></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $dt)
                        <tr>
                            <td class="text-right" ></td>
                            <td class="col-sm-2 col-md-2 col-lg-2 text-right" >{{$dt->kategori}}</td>
                            <td>{{$dt->nama}}</td>
                            <td>0</td>
                            <td>{{$dt->created_at}}</td>
                            <td class="text-center" >
                                <a data-id="{{$dt->id}}" class="btn btn-success btn-xs btn-edit-barang" href="setbar/stok/set-stok/{{$dt->id}}" ><i class="fa fa-edit" ></i></a>
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
        "aaSorting": [[4, "desc"]],
        "columns": [
            {className: "text-right"},
            {className: "text-right"},
            null,
            {className: "text-right"},
            {className: "text-right"},
            {className: "text-center"}
        ],
        "fnRowCallback": function (nRow, aData, iDisplayIndex) {
            var index = iDisplayIndex + 1;
            $('td:eq(0)', nRow).html(index);
            return nRow;
        }
    });
})(jQuery);
</script>
@append
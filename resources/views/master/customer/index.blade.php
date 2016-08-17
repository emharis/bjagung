@extends('layouts.master')

@section('styles')
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Master Customer
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-body">
            <a class="btn btn-primary btn-sm" id="btn-add" ><i class="fa fa-plus" ></i> Add Customer</a>
            <div class="clearfix" ></div>
            <br/>
            <!-- Form add customer -->
            <form class="hide" id="form-add" name="form-add" method="POST" action="master/customer/insert" >
                <table class="table table-bordered table-condensed" >
                    <tbody>
                        <tr>
                            <td class="col-sm-2 col-md-2 col-lg-2" >Nama Toko</td>
                            <td>
                                <input autocomplete="off" required type="text" class="form-control" name="nama" />
                            </td>
                        </tr>
                        <tr>
                            <td class="col-sm-2 col-md-2 col-lg-2" >Nama Kontak</td>
                            <td>
                                <input autocomplete="off" required type="text" class="form-control" name="nama_kontak" />
                            </td>
                        </tr>
                        <tr>
                            <td>Telp</td>
                            <td>
                                <input autocomplete="off" type="text" class="form-control" name="telp" />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input autocomplete="off" type="text" class="form-control" name="telp_2" />
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>
                                <input autocomplete="off" type="text" class="form-control" name="alamat" />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button type="submit" class="btn btn-primary btn-sm" >Save</button>
                                <a href="#" class="btn btn-danger btn-sm" id="btn-cancel-add" >Cancel</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>

            <!--Form Edit Customer-->
            <form id="form-edit" class="hide" method="POST" action="master/customer/update-customer" name="form-edit-customer" >
                <input type="hidden" name="id" />
                <table class="table table-bordered table-condensed" >
                    <tbody>
                        <tr>
                            <td>Nama Toko</td>
                            <td>
                                <input required type="text" name="nama" class="form-control" autocomplete="OFF" />
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Kontak</td>
                            <td>
                                <input required type="text" name="nama_kontak" class="form-control" autocomplete="OFF" />
                            </td>
                        </tr>
                        <tr>
                            <td>Telp</td>
                            <td>
                                <input autocomplete="off" type="text" class="form-control" name="telp" />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input autocomplete="off" type="text" class="form-control" name="telp_2" />
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>
                                <input autocomplete="off" type="text" class="form-control" name="alamat" />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button type="submit" class="btn btn-primary btm-sm">Save</button>
                                <a id="btn-cancel-edit" data-dismiss="modal" class="btn btn-danger btn-sm" >Cancel</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>

            <!--table data customer-->
            <div id="table-data"  class="table-responsive" >
                <table class="table table-bordered table-condensed" id="table-datatable" >
                    <thead>
                        <tr>
                            <th class="col-sm-1 col-md-1 col-lg-1" >No</th>
                            <th>Nama Toko</th>
                            <th>Kontak</th>
                            <th>Telp</th>
                            <th>Alamat</th>
                            <th>Date</th>
                            <th class="col-sm-1 col-md-1 col-lg-1" ></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $dt)
                        <tr>
                            <td class="text-right" ></td>
                            <td>{{$dt->nama}}</td>
                            <td>{{$dt->nama_kontak}}</td>
                            <td>{!! $dt->telp . '<br/>' .$dt->telp_2 !!}</td>
                            <td>{{$dt->alamat}}</td>
                            <td>{{$dt->created_at}}</td>
                            <td class="text-center" >
                                <a data-id="{{$dt->id}}" class="btn btn-success btn-xs btn-edit" href="master/customer/edit/{{$dt->id}}" ><i class="fa fa-edit" ></i></a>
                                <a data-id="{{$dt->id}}" class="btn btn-danger btn-xs btn-delete" href="master/customer/delete-customer/{{$dt->id}}" ><i class="fa fa-trash" ></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div><!-- /.box-body -->
    </div><!-- /.box -->

</section><!-- /.content -->

<!-- MODAL DELETE DATA -->
<div class="modal modal-danger" id="modal-delete" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">DELETE</h4>
            </div>
        <div class="modal-body">
            <p>Anda akan menghapus data ini?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-outline" data-dismiss="modal" id="btn-modal-delete-yes" >Yes</button>
        </div>
        </div>
    <!-- /.modal-content -->
    </div>
  <!-- /.modal-dialog -->
</div>

@stop

@section('scripts')
<!--Datatable-->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>

<script type="text/javascript">
(function ($) {
    // format datatable
    var tableData = $('#table-datatable').DataTable({
        "aaSorting": [[5, "desc"]],
        "columns": [
            {className: "text-right"},
            null,
            null,
            null,
            null,
            null,
            {className: "text-center"}
        ],
        "fnRowCallback": function (nRow, aData, iDisplayIndex) {
            var index = iDisplayIndex + 1;
            $('td:eq(0)', nRow).html(index);
            return nRow;
        }
    });

    // tampilkan form new customer
    $('#btn-add').click(function () {
        // tampilkan form new customer
        $('#form-add').hide();
        $('#form-add').removeClass('hide');
        $('#form-add').slideDown(250, null, function () {
            // fokuskan
            $('#form-add input[name=nama]').focus();
        });
        // sembunyikan table data
//        $('#table-datatable').fadeOut(200);
        $('#table-data').hide();
        // disable btn add
        $('#btn-add').addClass('disabled');
    });

    // cancel add new
    $('#btn-cancel-add').click(function () {
        $('#form-add').slideUp(250, null, function () {
            // clear input
            $('#form-add input').val(null);
        });

        // tampilkan table data
        $('#table-data').fadeIn(200);

        // enable kan btn add
        $('#btn-add').removeClass('disabled');

        return false;
    });

    // submit add new
    $('#form-add').ajaxForm({
        success: function (datares) {
            var data = JSON.parse(datares);

            // tampilkan data ke table
            var telp = "";
            if (data.telp_2 != "") {
                telp = data.telp + " / " + data.telp_2;
            } else {
                telp = data.telp;
            }

            tableData.row.add([
                '',
                data.nama,
                data.nama_kontak,
                telp,
                data.alamat,
                data.created_at,
                '<td class="text-center" >\n\
                        <a data-id="' + data.id + '" class="btn btn-success btn-xs btn-edit" href="master/customer/edit/' + data.id + '" ><i class="fa fa-edit" ></i></a>\n\
                        <a data-id="' + data.id + '" class="btn btn-danger btn-xs btn-delete" href="master/customer/delete-customer/' + data.id + '" ><i class="fa fa-trash" ></i></a>\n\
                    </td>'
            ]).draw(false);

            // close form add
            $('#btn-cancel-add').click();

        }
    });

    // =============================================================================================

    // edit customer
    $(document).on('click', '.btn-edit', function () {
        var url = $(this).attr('href');
        var id = $(this).data('id');

        // get data customer
        $.get('master/customer/get-customer/' + id, null, function (datares) {
            var data = JSON.parse(datares);

            // tampilkan data ke modal edit
            $('#form-edit input[name=id]').val(data.id);
            $('#form-edit input[name=nama]').val(data.nama);
            $('#form-edit input[name=nama_kontak]').val(data.nama_kontak);
            $('#form-edit input[name=telp]').val(data.telp);
            $('#form-edit input[name=telp_2]').val(data.telp_2);
            $('#form-edit input[name=alamat]').val(data.alamat);

            // tampilkan form edit
            $('#form-edit').removeClass('hide');
            $('#form-edit').hide();
            $('#form-edit').slideDown(250, null, function () {
                // fokuskan ke input
                $('#form-edit input[name=nama]').focus();
            });

            // sembunyikan tabel data
            $('#table-data').fadeOut(200);

            // disable button add
            $('#btn-add').addClass('disabled');

        });

        return false;
    });

    // cancel edit
    $('#btn-cancel-edit').click(function () {
        $('#form-edit').slideUp(250, null, function () {
            // clear input
            $('#form-edit input').val(null);
        });

        // tampilkan table data
        $('#table-data').fadeIn(200);

        // enable kan btn add
        $('#btn-add').removeClass('disabled');

        return false;
    });

    // submit edit 
    $('#form-edit').ajaxForm({
        success: function (datares) {
            var data = JSON.parse(datares);

            var btnEdit = $('#table-datatable tbody tr td a.btn-edit[data-id="' + data.id + '"]');
            var tdOpsi = btnEdit.parent();

            var telp = "";
            if (data.telp_2 != "") {
                telp = data.telp + " / " + data.telp_2;
            } else {
                telp = data.telp;
            }

            // update data row
            tdOpsi.prev().html(data.created_at);
            tdOpsi.prev().prev().html(data.alamat);
            tdOpsi.prev().prev().prev().html(telp);
            tdOpsi.prev().prev().prev().prev().html(data.nama_kontak);
            tdOpsi.prev().prev().prev().prev().prev().html(data.nama);
            // close form add
            $('#btn-cancel-edit').click();
        }
    });

    // delete customer
    var row_for_delete;
    var url_for_delete;
    var id_for_delete;

    $(document).on('click','.btn-delete', function () {
        var id = $(this).data('id');
        var url = $(this).attr('href');
        var row = $(this).parent().parent();

        url_for_delete = url;
        row_for_delete = row;
        id_for_delete = id;

        // tampilkan modal confirm delete
        $('#modal-delete').modal('show');

        // if (confirm('Anda akan menghapus data ini..?')) {
        //     $.get(url, null, function () {
        //         // delete row
        //         row.fadeOut(250, null, function () {
        //             // delete row dari jquery datatable
        //             tableData
        //                     .row(row)
        //                     .remove()
        //                     .draw();

        //         });
        //     });
        // }

        return false;
    });

    // BUTTON MODAL DELETE YES CLICK
    $('#btn-modal-delete-yes').click(function(){
        // delete data users
        $.get(url_for_delete, null, function () {
            // delete row
            row_for_delete.fadeOut(250, null, function () {
                // delete row dari jquery datatable
                tableData.row(row_for_delete).remove().draw();

            });
        });
    });

})(jQuery);
</script>
@append
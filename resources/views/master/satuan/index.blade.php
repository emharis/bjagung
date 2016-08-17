@extends('layouts.master')

@section('styles')
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Master Satuan Barang
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-body">
            <a class="btn btn-primary btn-sm" id="btn-add" ><i class="fa fa-plus" ></i> Add Satuan</a>
            <div class="clearfix" ></div>
            <br/>
            <!-- Form add satuan -->
            <form class="hide" name="form-add" id="form-add" method="POST" action="master/satuan/insert" >
                <table class="table table-bordered table-condensed" >
                    <tbody>
                        <tr>
                            <td class="col-sm-2 col-md-2 col-lg-2" >Nama</td>
                            <td>
                                <input autocomplete="off" required type="text" class="form-control" name="nama" />
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

            <form method="POST" action="master/satuan/update-satuan" name="form-edit" id="form-edit" class="hide" >
                <input type="hidden" name="id" />
                <table class="table table-bordered table-condensed" >
                    <tbody>
                        <tr>
                            <td>Nama</td>
                            <td>
                                <input type="text" name="nama" class="form-control" autocomplete="OFF" />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button type="submit" class="btn btn-primary btm-sm">Save</button>
                                <a id="btn-cancel-edit" class="btn btn-danger btn-sm" >Cancel</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>

            <div id="table-data" class="table-responsive" >
                <!--table data satuan-->
                <table class="table table-bordered table-condensed" id="table-datatable" >
                    <thead>
                        <tr>
                            <th class="col-sm-1 col-md-1 col-lg-1" >No</th>
                            <th>Nama</th>
                            <th class="col-sm-2 col-md-2 col-lg-2" >Date</th>
                            <th class="col-sm-1 col-md-1 col-lg-1" ></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $dt)
                        <tr>
                            <td class="text-right" ></td>
                            <td>{{$dt->nama}}</td>
                            <td>{{$dt->created_at}}</td>
                            <td class="text-center" >
                                <a data-id="{{$dt->id}}" class="btn btn-success btn-xs btn-edit-satuan" href="master/satuan/edit/{{$dt->id}}" ><i class="fa fa-edit" ></i></a>
                                @if($dt->ref == 0)
                                <a data-id="{{$dt->id}}" class="btn btn-danger btn-xs btn-delete-satuan" href="master/satuan/delete-satuan/{{$dt->id}}" ><i class="fa fa-trash" ></i></a>
                                @endif
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
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>

<script type="text/javascript">
(function ($) {

    //format datatable
    var tableData = $('#table-datatable').DataTable({
        "aaSorting": [[2, "desc"]],
        "columns": [
            {className: "text-right"},
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

    //tampilkan form new satuan
    $('#btn-add').click(function () {
        //tampilkan form new satuan
        $('form[name=form-add]').removeClass('hide');
        $('form[name=form-add]').hide();
        $('form[name=form-add]').slideDown(250, null, function () {
            //fokuskan
            $('form[name=form-add] input[name=nama]').focus();
        });

        //sembunyikan table data
        $('#table-data').fadeOut(200);

        //disable btn-add
        $('#btn-add').addClass('disabled');
    });

    //cancel add new
    $('#btn-cancel-add').click(function () {
        $('form[name=form-add]').slideUp(250, null, function () {
            //clear input
            $('form[name=form-add] input').val(null);
        });

        //tampilkan table data
        $('#table-data').fadeIn(200);

        //enable btn add
        $('#btn-add').removeClass('disabled');

        return false;
    });

    $('#form-add').ajaxForm({
        success: function (datares) {
            var data = JSON.parse(datares);
            //tambahkan new row
            tableData.row.add([
                '',
                data.nama,
                data.created_at,
                '<td class="text-center" >\n\
                        <a data-id="' + data.id + '" class="btn btn-success btn-xs btn-edit-satuan" href="master/satuan/edit/' + data.id + '" ><i class="fa fa-edit" ></i></a>\n\
                        <a data-id="' + data.id + '" class="btn btn-danger btn-xs btn-delete-satuan" href="master/satuan/delete-satuan/' + data.id + '" ><i class="fa fa-trash" ></i></a>\n\
                    </td>'
            ]).draw(false);

            //close form add
            $('#btn-cancel-add').click();
        }
    });


    //===============================================================

    //edit satuan
    $(document).on('click', '.btn-edit-satuan', function () {
        var url = $(this).attr('href');
        var id = $(this).data('id');

        //get data satuan
        $.get('master/satuan/get-satuan/' + id, null, function (data) {
            var dataSatuan = JSON.parse(data);

            //tampilkan form edit
            $('#form-edit').hide();
            $('#form-edit').removeClass('hide');
            $('#form-edit').slideDown(250, null, function () {
                //tampilkan data ke form
                $('#form-edit input[name=id]').val(dataSatuan.id);
                $('#form-edit input[name=nama]').val(dataSatuan.nama);

                //focuskan
                $('#form-edit input[name=nama]').focus();
            });

            //sebunyikan table data
            $('#table-data').fadeOut(200);

            //disable btn add
            $('#btn-add').addClass('disabled');

        });

        return false;
    });

    //cancel edit
    $('#btn-cancel-edit').click(function () {
        //sembunyikan form edit
        $('#form-edit').slideUp(250, null, function () {
            //clear input
            $('#form-edit input').val('');
        });

        //tapilkan table data
        $('#table-data').fadeIn(200);

        //enable btn add
        $('#btn-add').removeClass('disabled');
    });

    //submit edit
    $('#form-edit').ajaxForm({
        success: function (datares) {
            var data = JSON.parse(datares);
            //update row
            var btnEdit = $('#table-datatable tbody tr td a.btn-edit-satuan[data-id="' + data.id + '"]');
            var tdOpsi = btnEdit.parent();
            //update data row
            tdOpsi.prev().html(data.created_at);
            tdOpsi.prev().prev().html(data.nama);

            //tutup form edit
            $('#btn-cancel-edit').click();
//            alert('Update sukses');
        }
    });

    //delete satuan
    var row_for_delete;
    var url_for_delete;
    var id_for_delete;
    $(document).on('click', '.btn-delete-satuan', function () {
        var id = $(this).data('id');
        var url = $(this).attr('href');
        var row = $(this).parent().parent();

        url_for_delete = url;
        row_for_delete = row;
        id_for_delete = id;

        // tampilkan modal confirm delete
        $('#modal-delete').modal('show');

//         if (confirm('Anda akan menghapus data ini..?')) {
// //            location.href = url;
//             //delete by ajax
//             $.get(url, null, function () {
//                 //delete row
//                 row.fadeOut(250, null, function () {
//                     tableData
//                             .row(row)
//                             .remove()
//                             .draw();
//                 });
//             });
//         }

        return false;
    });

    // BUTTON MODAL DELETE YES CLICK
    $('#btn-modal-delete-yes').click(function(){
        //delete data users
        $.get(url_for_delete, null, function () {
            //delete row
            row_for_delete.fadeOut(250, null, function () {
                //delete row dari jquery datatable
                tableData.row(row_for_delete).remove().draw();

            });
        });
    });

})(jQuery);
</script>
@append
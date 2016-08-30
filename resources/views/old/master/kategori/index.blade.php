@extends('layouts.master')

@section('styles')
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Master Kategori Barang
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-body">
            <a class="btn btn-primary btn-sm" id="btn-add-kategori" ><i class="fa fa-plus" ></i> Add Kategori</a>
            <div class="clearfix" ></div>
            <br/>
            <!-- Form add kategori -->
            <form class="hide" name="form-add-kategori" method="POST" action="master/kategori/insert" id="form-add-kategori" >
                <table class="table table-bordered table-condensed" >
                    <tbody>
                        <tr>
                            <td class="col-sm-2 col-md-2 col-lg-2" >Nama</td>
                            <td>
                                <input autocomplete="off" required type="text" class="form-control" name="nama" />
                            </td>
                        </tr>
                        <tr>
                            <td class="col-sm-2 col-md-2 col-lg-2" >Satuan</td>
                            <td>
                                @foreach($satuan as $dt)
                                <div class="radio" >
                                    <label>
                                        <input type="radio" name="satuan" value="{{$dt->id}}" >
                                        {{$dt->nama}}
                                    </label>
                                </div>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button type="submit" class="btn btn-primary btn-sm" >Save</button>
                                <a href="#" class="btn btn-danger btn-sm" id="btn-cancel-add-kategori" >Cancel</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>

            <form method="POST" action="master/kategori/update-kategori" name="form-edit-kategori" id="form-edit-kategori" class="hide" >
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
                            <td class="col-sm-2 col-md-2 col-lg-2" >Satuan</td>
                            <td>
                                @foreach($satuan as $dt)
                                <div class="radio" >
                                    <label>
                                        <input type="radio" name="satuan" value="{{$dt->id}}" >
                                        {{$dt->nama}}
                                    </label>
                                </div>
                                @endforeach
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
                <!--table data kategori-->
                <table class="table table-bordered table-condensed" id="table-datatable" >
                    <thead>
                        <tr>
                            <th class="col-sm-1 col-md-1 col-lg-1" >No</th>
                            <th>Nama</th>
                            <th class="col-sm-2 col-md-2 col-lg-2" >Satuan</th>
                            <th class="col-sm-2 col-md-2 col-lg-2" >Date</th>
                            <th class="col-sm-1 col-md-1 col-lg-1" ></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $dt)
                        <tr>
                            <td class="text-right" ></td>
                            <td>{{$dt->nama}}</td>
                            <td>{{$dt->satuan}}</td>
                            <td>{{$dt->created_at}}</td>
                            <td class="text-center" >
                                <a data-id="{{$dt->id}}" class="btn btn-success btn-xs btn-edit-kategori" href="master/kategori/get-kategori/{{$dt->id}}" ><i class="fa fa-edit" ></i></a>
                                @if($dt->ref == 0)
                                <a data-id="{{$dt->id}}" class="btn btn-danger btn-xs btn-delete-kategori" href="master/kategori/delete-kategori/{{$dt->id}}" ><i class="fa fa-trash" ></i></a>
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
        "aaSorting": [[3, "desc"]],
        "columns": [
            {className: "text-right"},
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

    //tampilkan form new kategori
    $('#btn-add-kategori').click(function () {
        //tampilkan form new kategori
        $('form[name=form-add-kategori]').removeClass('hide');
        $('form[name=form-add-kategori]').hide();
        $('form[name=form-add-kategori]').slideDown(250, null, function () {
            //fokuskan
            $('form[name=form-add-kategori] input[name=nama]').focus();
        });

        //sembunyikan table data
        $('#table-data').fadeOut(200);

        //disable btn add
        $('#btn-add-kategori').addClass('disabled');
    });

    //cancel add new
    $('#btn-cancel-add-kategori').click(function () {
        $('form[name=form-add-kategori]').slideUp(250, null, function () {
            //clear input
            $('#form-add-kategori').clearForm();
        });

        //tampilkan table data
        $('#table-data').fadeIn(200);

        //enable btn add
        $('#btn-add-kategori').removeClass('disabled');

        return false;
    });

    //submit add new
    $('#form-add-kategori').ajaxForm({
        beforeSubmit: function () {
            //cek data
            var ischeck = $("#form-add-kategori input[name='satuan']:checked").val();
            if (ischeck) {

            } else {
                alert('Data satuan belum diinputkan.');
                return false;
            }
        },
        success: function (datares) {
            var data = JSON.parse(datares);

//            //add new row
            tableData.row.add([
                '',
                data.nama,
                data.satuan,
                data.created_at,
                '<td class="text-center" >\n\
                        <a data-id="' + data.id + '" class="btn btn-success btn-xs btn-edit-kategori" href="master/kategori/edit/' + data.id + '" ><i class="fa fa-edit" ></i></a>\n\
                        <a data-id="' + data.id + '" class="btn btn-danger btn-xs btn-delete-kategori" href="master/kategori/delete-kategori/' + data.id + '" ><i class="fa fa-trash" ></i></a>\n\
                    </td>'
            ]).draw(false);

            //tutup form add
            $('#btn-cancel-add-kategori').click();
        }
    });

    //==========================================================================================

    //edit kategori
    $(document).on('click', '.btn-edit-kategori', function () {
        var url = $(this).attr('href');
        var id = $(this).data('id');

        //get data kategori
        $.get(url, null, function (data) {
            var dataKategori = JSON.parse(data);

            //tampilkan data ke modal edit
            $('#form-edit-kategori input[name=id]').val(dataKategori.id);
            $('#form-edit-kategori input[name=nama]').val(dataKategori.nama);
            $('#form-edit-kategori input[type=radio][value=' + dataKategori.satuan_id + ']').prop('checked', true);

            //tampilkan form edit
            $('#form-edit-kategori').hide();
            $('#form-edit-kategori').removeClass('hide');

            //sembunyikan table data
            $('#table-data').fadeOut(200);

            //tampilkan form edit
            $('#form-edit-kategori').slideDown(250, null, function () {
                //focuskan 
                $('#form-edit-kategori input[name=nama]').focus();
            });


        });

        //disable btn add
        $('#btn-add-kategori').addClass('disabled');

        return false;
    });

    //cancel edit
    $('#btn-cancel-edit').click(function () {
        $('#form-edit-kategori').slideUp(250, null, function () {
            //clear input
            $('#form-edit-kategori').clearForm();
        });
        $('#table-data').fadeIn(200);
        //enable btn add
        $('#btn-add-kategori').removeClass('disabled');
    });

    //submit edit
    $('#form-edit-kategori').ajaxForm({
        beforeSubmit: function () {
            //cek data
            var ischeck = $("#form-edit-kategori input[name='satuan']:checked").val();
            if (ischeck) {

            } else {
                alert('Data satuan belum diinputkan.');
                return false;
            }
        },
        success: function (datares) {
            var data = JSON.parse(datares);
            //update row
            var btnEdit = $('#table-datatable tbody tr td a.btn-edit-kategori[data-id="' + data.id + '"]');
            var tdOpsi = btnEdit.parent();
            //update data row
            tdOpsi.prev().prev().html(data.satuan);
            tdOpsi.prev().prev().prev().html(data.nama);

            //tutup form edit
            $('#btn-cancel-edit').click();
        }
    });

    //delete kategori
    var row_for_delete;
    var url_for_delete;
    var id_for_delete;
    $(document).on('click', '.btn-delete-kategori', function () {
        var id = $(this).data('id');
        var url = $(this).attr('href');
        var row = $(this).parent().parent();
        
        url_for_delete = url;
        row_for_delete = row;
        id_for_delete = id;

        // tampilkan modal confirm delete
        $('#modal-delete').modal('show');

        // if (confirm('Anda akan menghapus data ini..?')) {
        //     //delete by ajax
        //     $.get(url, null, function () {
        //         //delete row
        //         row.fadeOut(250, null, function () {
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
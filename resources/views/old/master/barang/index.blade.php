@extends('layouts.master')

@section('styles')
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Master Barang
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-body">
            <a class="btn btn-primary btn-sm" id="btn-add" ><i class="fa fa-plus" ></i> Add Barang</a>
            <div class="clearfix" ></div>
            <br/>
            <!-- Form add barang -->
            <form class="hide" name="form-add" id="form-add" method="POST" action="master/barang/insert" >
                <table class="table table-bordered table-condensed" >
                    <tbody>
                        <tr>
                            <td class="col-sm-2 col-md-2 col-lg-2" >Nama</td>
                            <td>
                                <input autocomplete="off" required type="text" class="form-control" name="nama" />
                            </td>
                        </tr>
                        <tr>
                            <td class="col-sm-2 col-md-2 col-lg-2" >Kode</td>
                            <td>
                                <input autocomplete="off" required type="text" class="form-control" name="kode" />
                            </td>
                        </tr>
                        <tr>
                            <td class="col-sm-2 col-md-2 col-lg-2" >Kategori</td>
                            <td>
                                @foreach($kategori as $dt)
                                <div class="radio " >
                                    <label>
                                        <input type="radio" name="kategori" value="{{$dt->id}}">
                                        {{$dt->nama}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </label>
                                </div>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td class="col-sm-2 col-md-2 col-lg-2" >Reorder Level</td>
                            <td>
                                <div class="row" >
                                    <div class="col-sm-2 col-md-2 col-lg-2" >
                                        <input autocomplete="off" required type="text" class="form-control text-right" name="rol" />
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-sm-2 col-md-2 col-lg-2" >Berat</td>
                            <td>
                                <div class="row" >
                                    <div class="col-sm-2 col-md-2 col-lg-2" >
                                        <input autocomplete="off" required type="text" class="form-control text-right" name="berat" />
                                    </div>
                                </div>
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

            <!--Form Edit Barang-->
            <form method="POST" action="master/barang/update-barang" name="form-edit" id="form-edit" class="hide" >
                <input type="hidden" name="id" />
                <table class="table table-bordered table-condensed" >
                    <tbody>
                        <tr>
                            <td class="col-sm-2 col-md-2 col-lg-2" >Nama</td>
                            <td>
                                <input autocomplete="off" required type="text" class="form-control" name="nama" />
                            </td>
                        </tr>
                        <tr>
                            <td class="col-sm-2 col-md-2 col-lg-2" >Kode</td>
                            <td>
                                <input autocomplete="off" required type="text" class="form-control" name="kode" />
                            </td>
                        </tr>
                        <tr>
                            <td class="col-sm-2 col-md-2 col-lg-2" >Kategori</td>
                            <td>
                                @foreach($kategori as $dt)
                                <div class="radio " >
                                    <label>
                                        <input type="radio" name="kategori" value="{{$dt->id}}">
                                        {{$dt->nama}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </label>
                                </div>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td class="col-sm-2 col-md-2 col-lg-2" >Reorder Level</td>
                            <td>
                                <div class="row" >
                                    <div class="col-sm-2 col-md-2 col-lg-2" >
                                        <input autocomplete="off" required type="text" class="form-control text-right" name="rol" />
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-sm-2 col-md-2 col-lg-2" >Berat</td>
                            <td>
                                <div class="row" >
                                    <div class="col-sm-2 col-md-2 col-lg-2" >
                                        <input autocomplete="off" required type="text" class="form-control text-right" name="berat" />
                                    </div>
                                </div>
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
                <!--table data barang-->
                <table class="table table-bordered table-condensed" id="table-datatable" >
                    <thead>
                        <tr>
                            <th class="col-sm-1 col-md-1 col-lg-1" >No</th>
                            <th class="col-sm-1 col-md-1 col-lg-1" >Kode</th>
                            <th class="col-sm-3 col-md-3 col-lg-3" >Kategori</th>
                            <th   >Barang</th>
                            <th   >Berat</th>
                            <th class="col-sm-2 col-md-2 col-lg-2"  >Date</th>
                            <th class="col-sm-1 col-md-1 col-lg-1" ></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $dt)
                        <tr>
                            <td class="text-right" ></td>
                            <td  >{{$dt->kode}}</td>
                            <td class="col-sm-2 col-md-2 col-lg-2 text-right" >{{$dt->kategori}}</td>
                            <td>{{$dt->nama}}</td>
                            <td>{{$dt->berat}}</td>
                            <td>{{$dt->created_at}}</td>
                            <td class="text-center" >
                                <a data-id="{{$dt->id}}" class="btn btn-success btn-xs btn-edit-barang" href="master/barang/edit/{{$dt->id}}" ><i class="fa fa-edit" ></i></a>
                                <a data-id="{{$dt->id}}" class="btn btn-danger btn-xs btn-delete-barang" href="master/barang/delete-barang/{{$dt->id}}" ><i class="fa fa-trash" ></i></a>
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
    //required checkbox
    var requiredCheckboxes = $('.satuan_jual');
    requiredCheckboxes.change(function () {
        if (requiredCheckboxes.is(':checked')) {
            requiredCheckboxes.removeAttr('required');
        } else {
            requiredCheckboxes.attr('required', 'required');
        }
    });

    //format datatable
    var tableData = $('#table-datatable').DataTable({
        "aaSorting": [[5, "desc"]],
        "columns": [
            {className: "text-right"},
            null,
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

    //kosongkan selectbox
    $('#form-add select').val([]);

    //tampilkan form new barang
    $('#btn-add').click(function () {
        //tampilkan form new barang
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
            //clear form
            $('#form-add').clearForm();
        });

        //tampilkan table data
        $('#table-data').fadeIn(200);

        //enable btn add
        $('#btn-add').removeClass('disabled');

        return false;
    });

    //submit add new barang
    $('#form-add').ajaxForm({
        beforeSubmit: function () {
            //cek data
            var ischeck = $("#form-add input[name='kategori']:checked").val();
            if (ischeck) {

            } else {
                alert('Data kategori belum ditentukan.');
                return false;
            }
        },
        success: function (datares) {
            var data = JSON.parse(datares);
            //tambahkan new row
            tableData.row.add([
                '',
                data.kode,
                data.kategori,
                data.nama,
                data.berat,
                data.created_at,
                '<td class="text-center" >\n\
                        <a data-id="' + data.id + '" class="btn btn-success btn-xs btn-edit-barang" href="master/barang/edit/' + data.id + '" ><i class="fa fa-edit" ></i></a>\n\
                        <a data-id="' + data.id + '" class="btn btn-danger btn-xs btn-delete-barang" href="master/barang/delete-barang/' + data.id + '" ><i class="fa fa-trash" ></i></a>\n\
                    </td>'
            ]).draw(false);

            //close form add
            $('#btn-cancel-add').click();
        }
    });


    //===============================================================

    //edit barang
    $(document).on('click', '.btn-edit-barang', function () {
        var url = $(this).attr('href');
        var id = $(this).data('id');

        //get data barang
        $.get('master/barang/get-barang/' + id, null, function (data) {
            var dataBarang = JSON.parse(data);

            //tampilkan form edit
            $('#form-edit').hide();
            $('#form-edit').removeClass('hide');
            //sebunyikan table data
            $('#table-data').fadeOut(200);
            //tampilkan form edit
            $('#form-edit').slideDown(250, null, function () {
                //tampilkan data ke form
                $('#form-edit input[name=id]').val(dataBarang.id);
                $('#form-edit input[name=kode]').val(dataBarang.kode);
                $('#form-edit input[name=nama]').val(dataBarang.nama);
                $('#form-edit input[name=rol]').val(dataBarang.rol);
                $('#form-edit input[name=berat]').val(dataBarang.berat);
                $('#form-edit input[type=radio][value=' + dataBarang.kategori_id + ']').prop('checked', true);

                //focuskan
                $('#form-edit input[name=nama]').focus();
            });

            //disable btn add
            $('#btn-add').addClass('disabled');

        });

        return false;
    });

    //cancel edit
    $('#btn-cancel-edit').click(function () {
        //sembunyikan form edit
        $('#form-edit').slideUp(250, null, function () {
            $('#form-edit').clearForm();
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
            var btnEdit = $('#table-datatable tbody tr td a.btn-edit-barang[data-id="' + data.id + '"]');
            var tdOpsi = btnEdit.parent();
            //update data row
//            tdOpsi.prev().html(data.created_at);
            tdOpsi.prev().prev().html(data.berat);
            tdOpsi.prev().prev().prev().html(data.nama);
            tdOpsi.prev().prev().prev().prev().html(data.kategori);
            tdOpsi.prev().prev().prev().prev().prev().html(data.kode);

            //tutup form edit
            $('#btn-cancel-edit').click();
//            alert('Update sukses');
        }
    });

    //delete barang
    var row_for_delete;
    var url_for_delete;
    var id_for_delete; 

    $(document).on('click', '.btn-delete-barang', function () {
//        var id = $(this).data('id');
        var url = $(this).attr('href');
        var row = $(this).parent().parent();

        url_for_delete = url;
        row_for_delete = row;

        // tampilkan modal confirm delete
        $('#modal-delete').modal('show');

//         if (confirm('Anda akan menghapus data ini..?')) {
// //            location.href = url;
//             //delete by ajax
//             $.get(url, null, function () {
//                 //delete row
//                 row.fadeOut(250, null, function () {
//                     //delete row dari jquery datatable
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

    //checkbox change
    $('#form-add input[type=checkbox],#form-edit input[type=checkbox]').change(function () {
        var ischeck = $(this).prop('checked');
        var checkitem = $(this);
        if (ischeck == false) {
            checkitem.parent().parent().next().val('');
        } else {
            //focuskan
            checkitem.parent().parent().next().focus();
        }
    });

})(jQuery);
</script>
@append
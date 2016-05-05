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

            <div id="table-data" >
                <!--table data satuan-->
                <table class="table table-bordered table-condensed" id="table-datatable" >
                    <thead>
                        <tr>
                            <th class="col-sm-1 col-md-1 col-lg-1" >No</th>
                            <th>Nama</th>
                            <th class="col-sm-1 col-md-1 col-lg-1" ></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $rownum = 1; ?>
                        @foreach($data as $dt)
                        <tr>
                            <td class="text-right" >{{$rownum++}}</td>
                            <td>{{$dt->nama}}</td>
                            <td class="text-center" >
                                <a data-id="{{$dt->id}}" class="btn btn-success btn-xs btn-edit-satuan" href="master/satuan/edit/{{$dt->id}}" ><i class="fa fa-edit" ></i></a>
                                <a data-id="{{$dt->id}}" class="btn btn-danger btn-xs btn-delete-satuan" href="master/satuan/delete-satuan/{{$dt->id}}" ><i class="fa fa-trash" ></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div><!-- /.box-body -->
    </div><!-- /.box -->

    <!--    <div class="modal" id="modal-edit-satuan" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit Satuan</h4>
                    </div>
                    <div class="modal-body">
                            <form method="POST" action="master/satuan/update-satuan" name="form-edit-satuan" >
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
                                                <a data-dismiss="modal" class="btn btn-danger btn-sm" >Cancel</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                    </div>
                </div> 
            </div> 
        </div>-->

</section><!-- /.content -->
@stop

@section('scripts')
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>

<script type="text/javascript">
(function ($) {
    //reorder row number
    function tableRowReorder() {
        var rownum = 1;
        $('#table-datatable tbody tr').each(function (i, data) {
            $(this).children('td:first').text(rownum++);

        });
    }
    //format datatable
    $('#table-datatable').dataTable();

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
            var newrow = '<tr>\n\\n\
                    <td class="text-right" ></td>\n\
                    <td>' + data.nama + '</td>\n\
                    <td class="text-center" >\n\
                        <a data-id="' + data.id + '" class="btn btn-success btn-xs btn-edit-sales" href="master/sales/edit/' + data.id + '" ><i class="fa fa-edit" ></i></a>\n\
                        <a data-id="' + data.id + '" class="btn btn-danger btn-xs btn-delete-sales" href="master/sales/delete-sales/' + data.id + '" ><i class="fa fa-trash" ></i></a>\n\
                    </td>\n\
                    </tr>';
            $('#table-datatable tbody tr:first').before(newrow);
            //reorder row number
            tableRowReorder();
            //close form add
//            afterInsert = true;
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
            tdOpsi.prev().html(data.nama);

            //tutup form edit
            $('#btn-cancel-edit').click();
//            alert('Update sukses');
        }
    });

    //delete satuan
    $('.btn-delete-satuan').click(function () {
        var id = $(this).data('id');
        var url = $(this).attr('href');
        var row = $(this).parent().parent();
        if (confirm('Anda akan menghapus data ini..?')) {
//            location.href = url;
            //delete by ajax
            $.get(url, null, function () {
                //delete row
                row.fadeOut(250, null, function () {
                    row.remove();
                    tableRowReorder();
                });
            });
        }

        return false;
    });

})(jQuery);
</script>
@append
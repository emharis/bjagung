@extends('layouts.master')

@section('styles')
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Master Supplier
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-body">
            <a class="btn btn-primary btn-sm" id="btn-add-supplier" ><i class="fa fa-plus" ></i> Add Supplier</a>
            <div class="clearfix" ></div>
            <br/>
            <!-- Form add supplier -->
            <form class="hide" id="form-add-supplier" name="form-add-supplier" method="POST" action="master/supplier/insert" >
                <table class="table table-bordered table-condensed" >
                    <tbody>
                        <tr>
                            <td class="col-sm-2 col-md-2 col-lg-2" >Nama</td>
                            <td>
                                <input autocomplete="off" required type="text" class="form-control" name="nama" />
                            </td>
                        </tr>
                        <tr>
                            <td>Kontak</td>
                            <td>
                                <input autocomplete="off" type="text" class="form-control" name="nama_kontak" />
                            </td>
                        </tr>
                        <tr>
                            <td>Telp</td>
                            <td>
                                <div class="row" >
                                    <div class="col-sm-6 col-md-6 col-lg-6" >
                                        <input autocomplete="off" type="text" class="form-control" name="telp" />
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6" >
                                        <input autocomplete="off" type="text" class="form-control" name="telp_2" />
                                    </div>
                                </div>

                            </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>
                                <input autocomplete="off" type="text" class="form-control" name="alamat" />
                            </td>
                        </tr>
                        <tr>
                            <td>Rekening</td>
                            <td>
                                <input autocomplete="off" type="text" class="form-control" name="rek" />
                            </td>
                        </tr>
                        <tr>
                            <td>Jatuh Tempo/Minggu</td>
                            <td>
                                <div class="row" >
                                    <div class="col-sm-8 col-md-8 col-lg-8" >
                                        <input autocomplete="off" type="range" min="0" max="10" step="1" value="1"  name="jatuh_tempo" />
                                        <small id="jatuh_tempo_label_add" >1</small>
                                    </div>

                                </div>

                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button type="submit" class="btn btn-primary btn-sm" >Save</button>
                                <a href="#" class="btn btn-danger btn-sm" id="btn-cancel-add-supplier" >Cancel</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <!--End of Form add Supplier-->

            <!--Form Edit Supplier-->
            <form method="POST" action="master/supplier/update-supplier" name="form-edit-supplier" id="form-edit-supplier" class="hide" >
                <input type="hidden" name="id" />
                <table class="table table-bordered table-condensed" >
                    <tbody>
                        <tr>
                            <td>Nama</td>
                            <td>
                                <input required type="text" name="nama" class="form-control" autocomplete="OFF" />
                            </td>
                        </tr>
                        <tr>
                            <td>Kontak</td>
                            <td>
                                <input autocomplete="off" type="text" class="form-control" name="nama_kontak" />
                            </td>
                        </tr>
                        <tr>
                            <td>Telp</td>
                            <td>
                                <div class="row" >
                                    <div class="col-sm-6 col-md-6 col-lg-6" >
                                        <input autocomplete="off" type="text" class="form-control" name="telp" />
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6" >
                                        <input autocomplete="off" type="text" class="form-control" name="telp_2" />
                                    </div>
                                </div>

                            </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>
                                <input autocomplete="off" type="text" class="form-control" name="alamat" />
                            </td>
                        </tr>
                        <tr>
                            <td>Rekening</td>
                            <td>
                                <input autocomplete="off" type="text" class="form-control" name="rek" />
                            </td>
                        </tr>
                        <tr>
                            <td>Jatuh Tempo/Minggu</td>
                            <td>
                                <div class="row" >
                                    <div class="col-sm-8 col-md-8 col-lg-8" >
                                        <input autocomplete="off" type="range" min="0" max="10" step="1" value="1"  name="jatuh_tempo" />
                                        <small id="jatuh_tempo_label_edit" >1</small>
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
            <!--End of Form edit Supplier-->

            <!--table data supplier-->
            <div id="table-data" class="table-responsive" >
                <table class="table table-bordered table-condensed" id="table-datatable" >
                    <thead>
                        <tr>
                            <th class="col-sm-1 col-md-1 col-lg-1" >No</th>
                            <th>Nama</th>
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
                                <a title="edit data" data-id="{{$dt->id}}" class="btn btn-success btn-xs btn-edit-supplier" href="master/supplier/edit/{{$dt->id}}" ><i class="fa fa-edit" ></i></a>
                                <a title="delete data" data-id="{{$dt->id}}" class="btn btn-danger btn-xs btn-delete-supplier" href="master/supplier/delete-supplier/{{$dt->id}}" ><i class="fa fa-trash" ></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!--end of table data-->

        </div><!-- /.box-body -->
    </div><!-- /.box -->

</section><!-- /.content -->

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
    //format datatable
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

    //jatuh tempo add
    $('#form-add-supplier input[name=jatuh_tempo]').change(function () {
        $('#jatuh_tempo_label_add').text($(this).val());
    });

    //tampilkan form new supplier
    $('#btn-add-supplier').click(function () {
        //tampilkan form new supplier
        $('form[name=form-add-supplier]').removeClass('hide');
        $('form[name=form-add-supplier]').hide();
        $('form[name=form-add-supplier]').slideDown(250, null, function () {
            //fokuskan
            $('form[name=form-add-supplier] input[name=nama]').focus();
        });
        //sembunyikan table data
        $('#table-data').fadeOut(200);
        //disable btn add
        $('#btn-add-supplier').addClass('disabled');
    });

    //cancel add new
    $('#btn-cancel-add-supplier').click(function () {
        $('form[name=form-add-supplier]').slideUp(250, null, function () {
            //clear input
            $('form[name=form-add-supplier] input[name=nama]').val(null);
        });

        //tampilkan table data
        $('#table-data').fadeIn(200);

        //enable kan btn add
        $('#btn-add-supplier').removeClass('disabled');


        return false;
    });

    //submit add new supplier
    $('form[name=form-add-supplier]').ajaxForm({
        success: function (datares) {
            var data = JSON.parse(datares);
            //tambahkan new row            
            var telp = data.telp;
            if (data.telp_2 !== '') {
                telp = data.telp + '  |  ' + data.telp_2;
            }

            //add new row
            tableData.row.add([
                '',
                data.nama,
                data.nama_kontak,
                telp,
                data.alamat,
                data.created_at,
                '<td class="text-center" >\n\
                        <a data-id="' + data.id + '" class="btn btn-success btn-xs btn-edit-supplier" href="master/supplier/edit/' + data.id + '" ><i class="fa fa-edit" ></i></a>\n\
                        <a data-id="' + data.id + '" class="btn btn-danger btn-xs btn-delete-supplier" href="master/supplier/delete-supplier/' + data.id + '" ><i class="fa fa-trash" ></i></a>\n\
                    </td>'
            ]).draw(false);

            //close form add
            $('#btn-cancel-add-supplier').click();
            //clear input form
            $('form[name=form-add-supplier] input').val('');
        }
    });
    
    //=============================================================================
    
    //jatuh tempo edit
    $('#form-edit-supplier input[name=jatuh_tempo]').change(function () {
        $('#jatuh_tempo_label_edit').text($(this).val());
    });


    //edit supplier
    $(document).on('click', '.btn-edit-supplier', function () {
        var url = $(this).attr('href');
        var id = $(this).data('id');

        //get data supplier
        $.get('master/supplier/get-supplier/' + id, null, function (data) {
            var dataSupplier = JSON.parse(data);

            //tampilkan data ke form edit
            $('#form-edit-supplier input[name=id]').val(dataSupplier.id);
            $('#form-edit-supplier input[name=nama]').val(dataSupplier.nama);
            $('#form-edit-supplier input[name=nama_kontak]').val(dataSupplier.nama_kontak);
            $('#form-edit-supplier input[name=telp]').val(dataSupplier.telp);
            $('#form-edit-supplier input[name=telp_2]').val(dataSupplier.telp_2);
            $('#form-edit-supplier input[name=alamat]').val(dataSupplier.alamat);
            $('#form-edit-supplier input[name=rek]').val(dataSupplier.rek);
            $('#form-edit-supplier input[name=jatuh_tempo]').val(dataSupplier.jatuh_tempo);
            $('#form-edit-supplier #jatuh_tempo_label_edit').text(dataSupplier.jatuh_tempo);

            //tampilkan form edit
            $('#form-edit-supplier').removeClass('hide');
            $('#form-edit-supplier').hide();
            $('#form-edit-supplier').slideDown(250, null, function () {
                //fokuskan ke input
                $('#form-edit-supplier input[name=nama]').focus();
            });

            //sembunyikan tabel data
            $('#table-data').fadeOut(200);

            //disable button add
            $('#btn-add-supplier').addClass('disabled');
        });

        return false;
    });

    //cancel edit
    $('#btn-cancel-edit').click(function () {
        //tutup form edit
        $('#form-edit-supplier').slideUp(250, null, function () {

        });
        //tampilkan tabel data
        $('#table-data').fadeIn(200);
        //enable btn add
        $('#btn-add-supplier').removeClass('disabled');
    });

    //submit edit new supplier
    $('form[name=form-edit-supplier]').ajaxForm({
        success: function (datares) {
            var data = JSON.parse(datares);

            var btnEdit = $('#table-datatable tbody tr td a.btn-edit-supplier[data-id="' + data.id + '"]');
            var tdOpsi = btnEdit.parent();
            //update data row
            tdOpsi.prev().html(data.created_at);
            tdOpsi.prev().prev().html(data.alamat);
            tdOpsi.prev().prev().prev().html(data.telp + '<br/>' + data.telp_2);
            tdOpsi.prev().prev().prev().prev().html(data.nama_kontak);
            tdOpsi.prev().prev().prev().prev().prev().html(data.nama);
            //close form add
            $('#btn-cancel-edit').click();
        }
    });

    //delete supplier
    var row_for_delete;
    var url_for_delete;
    var id_for_delete;
    $(document).on('click', '.btn-delete-supplier', function () {
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

})(jQuery);
</script>
@append
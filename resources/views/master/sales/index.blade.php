@extends('layouts.master')

@section('styles')
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Master Salesman
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-body">
            <a class="btn btn-primary btn-sm" id="btn-add-sales" ><i class="fa fa-plus" ></i> Add Salesman</a>
            <div class="clearfix" ></div>
            <br/>
            <!-- Form add sales -->
            <div class="hide" id="form-add-salesman" >
                <form  name="form-add-sales" method="POST" action="master/sales/insert" >
                    <table class="table table-bordered table-condensed" >
                        <tbody>
                            <tr>
                                <td class="col-sm-2 col-md-2 col-lg-2" >Kode</td>
                                <td>
                                    <input autocomplete="off" required type="text" class="form-control" name="kode" />
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-2 col-md-2 col-lg-2" >Nama</td>
                                <td>
                                    <input autocomplete="off" required type="text" class="form-control" name="nama" />
                                </td>
                            </tr>
                            <tr>
                                <td class="" >KTP</td>
                                <td>
                                    <input autocomplete="off" required type="text" class="form-control" name="ktp" />
                                </td>
                            </tr>
                            <tr>
                                <td>Telp</td>
                                <td>
                                    <input autocomplete="off" type="number" class="form-control" name="telp" />
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
                                    <a href="#" class="btn btn-danger btn-sm" id="btn-cancel-add-sales" >Cancel</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <div id="form-edit-salesman" class="hide" >
                <form method="POST" action="master/sales/update-sales" name="form-edit-sales" >
                    <input type="hidden" name="id" />
                    <table class="table table-bordered table-condensed" >
                        <tbody>
                            <tr>
                                <td>Kode</td>
                                <td>
                                    <input required type="text" name="kode" class="form-control" autocomplete="OFF" />
                                </td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>
                                    <input required type="text" name="nama" class="form-control" autocomplete="OFF" />
                                </td>
                            </tr>
                            <tr>
                                <td>KTP</td>
                                <td>
                                    <input required type="text" name="ktp" class="form-control" autocomplete="OFF" />
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
                                    <a id="btn-cancel-edit-salesman" data-dismiss="modal" class="btn btn-danger btn-sm" >Cancel</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>

            <!--table data sales-->
            <div id="table-salesman" class="table-responsive" >
                <table class="table table-bordered table-striped table-hover" id="table-datatable" >
                    <thead>
                        <tr>
                            <th class="col-sm-1 col-md-1 col-lg-1" >No</th>
                            <th class="col-sm-1 col-md-1 col-lg-1" >Kode</th>
                            <th>Nama</th>
                            <th>KTP</th>
                            <th>Telp</th>
                            <th class="col-sm-2 col-md-2 col-lg-2" >Date</th>
                            <th class="col-sm-1 col-md-1 col-lg-1" ></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $rownum = 1; ?>
                        @foreach($data as $dt)
                        <tr>
                            <td class="text-right" ></td>
                            <td>{{$dt->kode}}</td>                            
                            <td>{{$dt->nama}}</td>                            
                            <td>{{$dt->ktp}}</td>                            
                            <td>{!! $dt->telp !!} {!!$dt->telp_2 != '' ? '&nbsp;|&nbsp;' . $dt->telp_2 : '' !!} </td>
                            <td>{{$dt->created_at}}</td>
                            <td class="text-center" >
                                <a title="edit data" data-id="{{$dt->id}}" class="btn btn-success btn-xs btn-edit-sales" href="master/sales/edit/{{$dt->id}}" ><i class="fa fa-edit" ></i></a>
                                <a title="delete data" data-id="{{$dt->id}}" class="btn btn-danger btn-xs btn-delete-sales" href="master/sales/delete-sales/{{$dt->id}}" ><i class="fa fa-trash" ></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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

    //clear input
    function clearInput() {
        $('form[name=form-add-sales] input').val('');
//        $('form[name=form-edit-sales] input').val('');
    }


    //tampilkan form new sales
    $('#btn-add-sales').click(function () {
        //tampilkan form new sales
        $('#form-add-salesman').removeClass('hide');
        $('#form-add-salesman').hide();
        $('#form-add-salesman').slideDown(250, null, function () {
            //fokuskan
            $('form[name=form-add-sales] input[name=kode]').focus();
        });
        $('#table-salesman').fadeOut(100);

        //disable btn add
        $('#btn-add-sales').addClass('disabled');
    });

    //cancel add new
    $('#btn-cancel-add-sales').click(function () {
        $('#form-add-salesman').slideUp(250, null, function () {
            //clear input
            clearInput();

        });
        $('#table-salesman').fadeIn(300);

        //enable btn add
        $('#btn-add-sales').removeClass('disabled');
        return false;
    });

    //submit add new salesman
    $('form[name=form-add-sales]').ajaxForm({
        success: function (datares) {
            var data = JSON.parse(datares);
            //tambahkan new row
            var telp = data.telp;
            if(data.telp_2 !== ''){
                telp = data.telp + '  |  ' + data.telp_2;
            }
            tableData.row.add([
                '',
                data.kode,
                data.nama,
                data.ktp,
                telp,
                data.created_at,
                '<td class="text-center" >\n\
                        <a data-id="' + data.id + '" class="btn btn-success btn-xs btn-edit-sales" href="master/sales/edit/' + data.id + '" ><i class="fa fa-edit" ></i></a>\n\
                        <a data-id="' + data.id + '" class="btn btn-danger btn-xs btn-delete-sales" href="master/sales/delete-sales/' + data.id + '" ><i class="fa fa-trash" ></i></a>\n\
                    </td>'
            ]).draw(false);
//            
            //close form add
            $('#btn-cancel-add-sales').click();
        }
    });

    //edit sales
    $(document).on('click', '.btn-edit-sales', function () {
        var url = $(this).attr('href');
        var id = $(this).data('id');

        //get data sales
        $.get('master/sales/get-sales/' + id, null, function (data) {
            var dataSales = JSON.parse(data);

            //tampilkan data ke modal edit
            $('#form-edit-salesman input[name=id]').val(dataSales.id);
            $('#form-edit-salesman input[name=kode]').val(dataSales.kode);
            $('#form-edit-salesman input[name=nama]').val(dataSales.nama);
            $('#form-edit-salesman input[name=ktp]').val(dataSales.ktp);
            $('#form-edit-salesman input[name=telp]').val(dataSales.telp);
            $('#form-edit-salesman input[name=telp_2]').val(dataSales.telp_2);
            $('#form-edit-salesman input[name=alamat]').val(dataSales.alamat);

            $('#form-edit-salesman').removeClass('hide');
            $('#form-edit-salesman').hide();
            $('#form-edit-salesman').slideDown(250, null, function () {
                //fokuskan
                $('#form-edit-salesman input[name=kode]').focus();
            });
            $('#table-salesman').fadeOut(100);

            //disable btn add
            $('#btn-add-sales').addClass('disabled');
        });

        return false;
    });

    //cancel edit 
    $('#btn-cancel-edit-salesman').click(function () {
        $('#form-edit-salesman').slideUp(250);
        $('#table-salesman').fadeIn(300);

        //enable btn add
        $('#btn-add-sales').removeClass('disabled');

        return false;
    });

    //submit edit
    $('form[name=form-edit-sales]').ajaxForm({
        success: function (datares) {
            var data = JSON.parse(datares);
            //update row
            var btnEdit = $('#table-datatable tbody tr td a.btn-edit-sales[data-id="' + data.id + '"]');
            var tdOpsi = btnEdit.parent();
            //update data row
            tdOpsi.prev().html(data.created_at);
            tdOpsi.prev().prev().html(data.telp + '<br/>' + data.telp_2);
            tdOpsi.prev().prev().prev().html(data.ktp);
            tdOpsi.prev().prev().prev().prev().html(data.nama);
            tdOpsi.prev().prev().prev().prev().prev().html(data.kode);

            //tutup form edit
            $('#btn-cancel-edit-salesman').click();
//            alert('Update sukses');
        }
    });

    //delete sales
    var row_for_delete;
    var url_for_delete;
    $(document).on('click', '.btn-delete-sales', function () {
        var id = $(this).data('id');
        var url = $(this).attr('href');
        url_for_delete = url;
        var row = $(this).parent().parent();
        row_for_delete = row;

        $('#modal-delete').modal('show');

        // if (confirm('Anda akan menghapus data ini..?')) {
        //     //delete by ajax
        //     $.get(url, null, function () {
        //         //delete row
        //         row.fadeOut(250, null, function () {
        //             //delete row dari jquery datatable
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
        //delete data salesman
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
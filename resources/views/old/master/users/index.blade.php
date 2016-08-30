@extends('layouts.master')

@section('styles')
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

<style>
    .table > tbody > tr > td{
        vertical-align: middle;
    } 
</style>
@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Users
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-body">
            <a class="btn btn-primary btn-sm" id="btn-add-users" ><i class="fa fa-plus" ></i> Add Users</a>
            <div class="clearfix" ></div>
            <br/>
            <!-- Form add users -->
            <div class="hide" id="form-add-users" >
                <form  name="form-add-users" method="POST" action="master/users/insert" >
                    <table class="table table-bordered table-condensed" >
                        <tbody>
                            <tr>
                                <td class="col-sm-2 col-md-2 col-lg-2" >Username</td>
                                <td>
                                    <input autocomplete="off" required type="text" class="form-control" name="username" />
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-2 col-md-2 col-lg-2" >Password</td>
                                <td>
                                    <input autocomplete="off" required type="text" class="form-control" name="password" />
                                </td>
                            </tr>
                            <tr>
                                <td>Tipe</td>
                                <td>
                                   <select class="form-control" name="tipe" >
                                       @foreach($tipe as $dt)
                                        <option value="{{$dt->id}}" >{{'['.$dt->nama . '] ' . $dt->description}}</option>
                                       @endforeach
                                   </select> 
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <button type="submit" class="btn btn-primary btn-sm" >Save</button>
                                    <a href="#" class="btn btn-danger btn-sm" id="btn-cancel-add-users" >Cancel</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <div id="form-edit-users" class="hide" >
                <form method="POST" action="master/users/update-user" name="form-edit-users" >
                    <input type="hidden" name="id" />
                    <table class="table table-bordered table-condensed" >
                        <tbody>
                            <tr>
                                <td>Username</td>
                                <td>
                                    <input required type="text" name="username" class="form-control" autocomplete="OFF" />
                                </td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td>
                                    <input type="text" name="password" class="form-control" placeholder="Inputkan untuk mengganti password" />
                                </td>
                            </tr>
                            <tr>
                                <td>Tipe</td>
                                <td>
                                    <select class="form-control" name="tipe" >
                                       @foreach($tipe as $dt)
                                        <option value="{{$dt->id}}" >{{'['.$dt->nama . '] ' . $dt->description}}</option>
                                       @endforeach
                                   </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <button type="submit" class="btn btn-primary btm-sm">Save</button>
                                    <a id="btn-cancel-edit-users" data-dismiss="modal" class="btn btn-danger btn-sm" >Cancel</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>

            <!--table data users-->
            <div id="table-users" class="table-responsive" >
                <table class="table table-bordered table-striped table-hover" id="table-datatable" >
                    <thead>
                        <tr>
                            <th class="col-sm-1 col-md-1 col-lg-1" >No</th>
                            <th class="col-sm-1 col-md-1 col-lg-1" >Username</th>
                            <th>Tipe</th>
                            <th class="col-sm-1 col-md-1 col-lg-1" ></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $rownum = 1; ?>
                        @foreach($data as $dt)
                        <tr>
                            <td class="text-right" ></td>
                            <td>{{$dt->username}}</td>                            
                            <td>{{$dt->role}}</td>                            
                            <td class="text-center" >
                                <a title="edit data" data-id="{{$dt->id}}" class="btn btn-success btn-xs btn-edit-users" href="master/users/edit/{{$dt->id}}" ><i class="fa fa-edit" ></i></a>
                                @if($dt->username != 'admin')
                                <a title="delete data" data-id="{{$dt->id}}" class="btn btn-danger btn-xs btn-delete-users" href="#" ><i class="fa fa-trash" ></i></a>
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
        "aaSorting": [[0, "asc"]],
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

    //clear input
    function clearInput() {
        $('form[name=form-add-users] input').val('');
        $('form[name=form-add-users] select').val([]);

//        $('form[name=form-edit-users] input').val('');
    }


    //tampilkan form new users
    $('#btn-add-users').click(function () {
        //tampilkan form new users
        $('#form-add-users').removeClass('hide');
        $('#form-add-users').hide();
        $('#form-add-users').slideDown(250, null, function () {
            //fokuskan
            $('form[name=form-add-users] input[name=username]').focus();
        });
        $('#table-users').fadeOut(100);

        //disable btn add
        $('#btn-add-users').addClass('disabled');
    });

    //cancel add new
    $('#btn-cancel-add-users').click(function () {
        $('#form-add-users').slideUp(250, null, function () {
            //clear input
            clearInput();

        });
        $('#table-users').fadeIn(300);

        //enable btn add
        $('#btn-add-users').removeClass('disabled');
        return false;
    });

    //submit add new users
    $('form[name=form-add-users]').ajaxForm({
        success: function (datares) {
            var data = JSON.parse(datares);
            //add new row to table
            tableData.row.add([
                '',
                data.username,
                data.role,
                '<td class="text-center" >\n\
                        <a data-id="' + data.id + '" class="btn btn-success btn-xs btn-edit-users" href="master/users/edit/' + data.id + '" ><i class="fa fa-edit" ></i></a>\n\
                        <a data-id="' + data.id + '" class="btn btn-danger btn-xs btn-delete-users" href="#" ><i class="fa fa-trash" ></i></a>\n\
                    </td>'
            ]).draw(false);
//            
            //close form add
            $('#btn-cancel-add-users').click();
        }
    });

    //edit users
    $(document).on('click', '.btn-edit-users', function () {
        var url = $(this).attr('href');
        var id = $(this).data('id');

        //get data users
        $.get('master/users/get-user/' + id, null, function (data) {
            var datauser = JSON.parse(data);

            //tampilkan data ke modal edit
            $('#form-edit-users input[name=id]').val(datauser.id);
            $('#form-edit-users input[name=username]').val(datauser.username);
            $('#form-edit-users select[name=tipe]').val(datauser.role_id);

            // if username is admin ... disable edit username & tipe
            if(datauser.username == 'admin'){
                $('#form-edit-users input[name=username]').attr('readonly','readonly');
                $('#form-edit-users select[name=tipe]').attr('readonly','readonly');
            }else{
                $('#form-edit-users input[name=username]').removeAttr('readonly');
                $('#form-edit-users select[name=tipe]').removeAttr('readonly');
            }

            $('#form-edit-users').removeClass('hide');
            $('#form-edit-users').hide();
            $('#form-edit-users').slideDown(250, null, function () {
                //fokuskan
                $('#form-edit-users input[name=kode]').focus();
            });
            $('#table-users').fadeOut(100);

            //disable btn add
            $('#btn-add-users').addClass('disabled');
        });

        return false;
    });

    //cancel edit 
    $('#btn-cancel-edit-users').click(function () {
        $('#form-edit-users').slideUp(250);
        $('#table-users').fadeIn(300);

        //enable btn add
        $('#btn-add-users').removeClass('disabled');

        return false;
    });

    //submit edit
    $('form[name=form-edit-users]').ajaxForm({
        success: function (datares) {
            var data = JSON.parse(datares);
            //update row
            var btnEdit = $('#table-datatable tbody tr td a.btn-edit-users[data-id="' + data.id + '"]');
            var tdOpsi = btnEdit.parent();
            //update data row
            tdOpsi.prev().text(data.role);
            tdOpsi.prev().prev().text(data.username);

            //tutup form edit
            $('#btn-cancel-edit-users').click();
//            alert('Update sukses');
        }
    });

    //delete users
    var row_for_delete;
    var url_for_delete;
    var id_for_delete;
    $(document).on('click', '.btn-delete-users', function () {
        var id = $(this).data('id');
        var url = $(this).attr('href');
        url_for_delete = url;
        var row = $(this).parent().parent();
        row_for_delete = row;
        id_for_delete = id;

        $('#modal-delete').modal('show');

        return false;
    });

    // BUTTON MODAL DELETE YES CLICK
    $('#btn-modal-delete-yes').click(function(){
        //delete data users
        $.post('master/users/delete', {
            'id' : id_for_delete
        }, function () {
            //delete row
            row_for_delete.fadeOut(250, null, function () {
                //delete row dari jquery datatable
                tableData.row(row_for_delete).remove().draw();

            });
        });


        // var newForm = jQuery('<form>', {
        //                     'action': 'master/users/delete',
        //                     'method': 'POST'
        //                 }).append(jQuery('<input>', {
        //                     'name': 'id',
        //                     'value': id_for_delete,
        //                     'type': 'hidden'
        //                 }));
        //                 //submit form simpan penjualan
        //                 newForm.appendTo('body').submit();
    });

})(jQuery);
</script>
@append
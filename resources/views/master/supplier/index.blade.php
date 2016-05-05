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
            <form class="hide" name="form-add-supplier" method="POST" action="master/supplier/insert" >
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
                                <a id="btn-cancel-edit" class="btn btn-danger btn-sm" >Cancel</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <!--End of Form edit Supplier-->

            <!--table data supplier-->
            <div id="table-data" >
                <table class="table table-bordered table-condensed" id="table-datatable" >
                    <thead>
                        <tr>
                            <th class="col-sm-1 col-md-1 col-lg-1" >No</th>
                            <th>Nama</th>
                            <th>Kontak</th>
                            <th>Telp</th>
                            <th>Alamat</th>
                            <th class="col-sm-1 col-md-1 col-lg-1" ></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $rownum = 1; ?>
                        @foreach($data as $dt)
                        <tr>
                            <td class="text-right" >{{$rownum++}}</td>
                            <td>{{$dt->nama}}</td>
                            <td>{{$dt->nama_kontak}}</td>
                            <td>{!! $dt->telp . '<br/>' .$dt->telp_2 !!}</td>
                            <td>{{$dt->alamat}}</td>
                            <td class="text-center" >
                                <a data-id="{{$dt->id}}" class="btn btn-success btn-xs btn-edit-supplier" href="master/supplier/edit/{{$dt->id}}" ><i class="fa fa-edit" ></i></a>
                                <a data-id="{{$dt->id}}" class="btn btn-danger btn-xs btn-delete-supplier" href="master/supplier/delete-supplier/{{$dt->id}}" ><i class="fa fa-trash" ></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!--end of table data-->

        </div><!-- /.box-body -->
    </div><!-- /.box -->

    <!--    <div class="modal" id="modal-edit-supplier" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit Supplier</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="master/supplier/update-supplier" name="form-edit-supplier" >
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
<!--Datatable-->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>

<script type="text/javascript">
(function ($) {
    //format datatable
    $('#table-datatable').dataTable();

    //reorder row number
    function tableRowReorder() {
        var rownum = 1;
        $('#table-datatable tbody tr').each(function (i, data) {
            $(this).children('td:first').text(rownum++);

        });
    }

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
            var newrow = '<tr>\n\
                            <td class="text-right" ></td>\n\
                            <td>' + data.nama + '</td>\n\
                            <td>' + data.nama_kontak + '</td>\n\
                            <td>' + data.telp + '/' + data.telp_2 + '</td>\n\
                            <td>' + data.alamat + '</td>\n\
                            <td class="text-center" >\n\
                                <a data-id="' + data.id + '" class="btn btn-success btn-xs btn-edit-supplier" href="master/supplier/edit/{{$dt->id}}" ><i class="fa fa-edit" ></i></a>\n\
                                <a data-id="' + data.id + '" class="btn btn-danger btn-xs btn-delete-supplier" href="master/supplier/delete-supplier/{{$dt->id}}" ><i class="fa fa-trash" ></i></a>\n\
                            </td>\n\
                        </tr>';
            $('#table-datatable tbody tr:first').before(newrow);
            //reorder row number
            tableRowReorder();
            //close form add
//            afterInsert = true;
            $('#btn-cancel-add-supplier').click();
            //clear input form
            $('form[name=form-add-supplier] input').val('');
        }
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


//            //tampilkan data ke modal edit
//            $('#modal-edit-supplier input[name=id]').val(dataSupplier.id);
//            $('#modal-edit-supplier input[name=nama]').val(dataSupplier.nama);
//            $('#modal-edit-supplier input[name=nama_kontak]').val(dataSupplier.nama_kontak);
//            $('#modal-edit-supplier input[name=telp]').val(dataSupplier.telp);
//            $('#modal-edit-supplier input[name=telp_2]').val(dataSupplier.telp_2);
//            $('#modal-edit-supplier input[name=alamat]').val(dataSupplier.alamat);
//            
//            //fokuskan & tampilkan modal                
//            $('#modal-edit-supplier').modal('show');
//            $('#modal-edit-supplier input[name=nama]').focus();
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
            tdOpsi.prev().html(data.alamat);
            tdOpsi.prev().prev().html(data.telp + '<br/>' + data.telp_2);
            tdOpsi.prev().prev().prev().html(data.nama_kontak);
            tdOpsi.prev().prev().prev().prev().html(data.nama);
            //reorder row number
            tableRowReorder();
            //close form add
//            afterInsert = true;
            $('#btn-cancel-edit').click();
        }
    });

    //delete supplier
    $('.btn-delete-supplier').click(function () {
        var id = $(this).data('id');
        var url = $(this).attr('href');
        var row = $(this).parent().parent();
        if (confirm('Anda akan menghapus data ini..?')) {
//            location.href = url;
            $.get(url, null, function () {
                row.fadeOut(250,null,function(){
                    //remove
                    row.remove();
                    //reorder number
                    tableRowReorder();
                });
            });

        }

        return false;
    });

})(jQuery);
</script>
@append
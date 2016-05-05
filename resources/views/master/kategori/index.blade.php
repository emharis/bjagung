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
                <!--table data kategori-->
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
                                <a data-id="{{$dt->id}}" class="btn btn-success btn-xs btn-edit-kategori" href="master/kategori/get-kategori/{{$dt->id}}" ><i class="fa fa-edit" ></i></a>
                                <a data-id="{{$dt->id}}" class="btn btn-danger btn-xs btn-delete-kategori" href="master/kategori/delete-kategori/{{$dt->id}}" ><i class="fa fa-trash" ></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div><!-- /.box-body -->
    </div><!-- /.box -->

    <!--    <div class="modal" id="modal-edit-kategori" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit Kategori</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="master/kategori/update-kategori" name="form-edit-kategori" >
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
            $('form[name=form-add-kategori] input[name=nama]').val(null);
        });

        //tampilkan table data
        $('#table-data').fadeIn(200);

        //clear input
        $('#form-add-kategori input').val('');
        
        //enable btn add
        $('#btn-add-kategori').removeClass('disabled');

        return false;
    });

    //submit add new
    $('#form-add-kategori').ajaxForm({
        success: function (datares) {
            alert(datares);
            var data = JSON.parse(datares);
            //tutup form add
            $('#btn-cancel-add-kategori').click();
            //add new row
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
        }
    });


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
            
            //tampilkan form edit
            $('#form-edit-kategori').hide();
            $('#form-edit-kategori').removeClass('hide');
            $('#form-edit-kategori').slideDown(250,null,function(){
                //focuskan 
                $('#form-edit-kategori input[name=nama]').focus();
            });
            
            //sembunyikan table data
            $('#table-data').fadeOut(200);
        });
        
        //disable btn add
        $('#btn-add-kategori').addClass('disabled');

        return false;
    });
    
    //cancel edit
    $('#btn-cancel-edit').click(function(){
        $('#form-edit-kategori').slideUp(250);
        $('#table-data').fadeIn(200);
        //enable btn add
        $('#btn-add-kategori').removeClass('disabled');
    });
    
    //submit edit
    $('#form-edit-kategori').ajaxForm({
        success:function(datares){
            var data = JSON.parse(datares);
            //update row
            var btnEdit = $('#table-datatable tbody tr td a.btn-edit-kategori[data-id="' + data.id + '"]');
            var tdOpsi = btnEdit.parent();
            //update data row
            tdOpsi.prev().html(data.nama);
            
            //tutup form edit
            $('#btn-cancel-edit').click();
        }
    });

    //delete kategori
    $('.btn-delete-kategori').click(function () {        
        var id = $(this).data('id');
        var url = $(this).attr('href');
        var row = $(this).parent().parent();
        if (confirm('Anda akan menghapus data ini..?')) {
                //delete by ajax
                $.get(url,null,function(){
                    //delete row
                    row.fadeOut(250,null,function(){
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
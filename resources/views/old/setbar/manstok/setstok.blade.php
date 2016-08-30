@extends('layouts.master')

@section('styles')
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>
@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Pengaturan Stok Manual Barang
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <div class="row" >
        
        <!--Data Barang-->
        <div class="col-sm-4 col-md-4 col-lg-4" >
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Data Barang</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-condensed" >
                        <tbody>
                            <tr>
                                <td><label>Nama</label></td>
                                <td>:</td>
                                <td>{{$data->nama}}</td>
                            </tr>
                            <tr>
                                <td><label>Kategori</label></td>
                                <td>:</td>
                                <td>{{$data->kategori}}</td>
                            </tr>
                            <tr>
                                <td><label>Satuan</label></td>
                                <td>:</td>
                                <td>
                                    {{$data->satuan}}
                                </td>
                            </tr>
                            <tr>
                                <td><label>Berat/Satuan</label></td>
                                <td>:</td>
                                <td>
                                    {{$data->berat}}
                                </td>
                            </tr>
                            <tr>
                                <td><label>Jumlah Stok</label></td>
                                <td>:</td>
                                <td>
                                    {{$data->stok}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!--Table riwayat stok manual-->
        <div class="col-sm-8 col-md-8 col-lg-8" >
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Riwayat Stok Manual</h3>
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" id="btn-add" ><i class="fa fa-plus"  ></i>  Add Manual Stok</a>
                        <a class="btn btn-danger btn-sm" href="setbar/manstok" ><i class="fa fa-remove" ></i> Close</a>
                    </div>
                </div>
                <div class="box-body">
                    <!--Form add stok manual-->
                    <form name="form-add" id="form-add" method="POST" action="setbar/manstok/insert" class="hide" >
                        <input type="hidden" name="barang_id" value="{{$data->id}}">
                        <table class="table table-bordered" >
                            <tbody>
                                <tr class="hide" >
                                    <td>
                                        Tanggal
                                        <small>(YYYY/MM/DD)</small>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <input required type="text" name="tanggal" class="form-control  tanggal" placeholder="yyyy/mm/dd" value="{{date('Y/m/d')}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jumlah</td>
                                    <td>:</td>
                                    <td>
                                        <div class="input-group">
                                            <input required type="text" name="jumlah" class="form-control text-right">
                                            <span class="input-group-addon">{{$data->satuan}}</span>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Harga Pembelian </td>
                                    <td>:</td>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp.</span>
                                            <input required type="text" name="harga" class="form-control text-right for-money">
                                            <span class="input-group-addon">/{{$data->satuan}}</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="2" >
                                        <button type="submit" class="btn btn-primary" >Save</button>
                                        <a class="btn btn-danger" id="btn-cancel" >Cancel</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>

                    <!--table riwayat stok manual-->
                    <div id="table-data" class="table-responsive" >
                        <table class="table table-bordered" id="table-history-stok" >
                            <thead>
                                <tr>
                                    <th>Tanggal Stok</th>
                                    <th>Jumlah</th>
                                    <th>Harga Pembelian</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($manual_stok)>0)
                                @foreach($manual_stok as $dt)
                                <tr>
                                    <td>
                                        {{date('d-m-Y',strtotime($dt->tgl))}}
                                    </td>
                                    <td class="text-right">
                                        {{$dt->stok_awal}}
                                    </td>
                                    <td class="text-right">
                                        {{number_format($dt->harga,0,'.',',')}}
                                    </td>
                                    <td class="text-center" >
                                        <a class="btn btn-danger btn-delete btn-sm" href="setbar/manstok/delete/{{$dt->id}}" ><i class="fa fa-trash" ></i></a>
                                    </td>
                                </tr>
                                @endforeach                                
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div><!-- /.box-body -->
            </div>
        </div>
    </div>

    <!-- Default box -->
    <!-- /.box -->

</section><!-- /.content -->
@stop

@section('scripts')
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="plugins/autonumeric/autoNumeric-min.js" type="text/javascript"></script>

<script type="text/javascript">
(function ($) {
    //setting auto numeric
    $('.for-money').autoNumeric('init',{
        vMin:'0',
        vMax:'999999999'
    });

    //format datatable  
    var tableStok = $('#table-history-stok').DataTable({
        "aaSorting": [[0, "desc"]],
        "columns": [
            null,
            {className: "text-right"},
            {className: "text-right"},
            {className: "text-center"},
        ]
    });

    //add manual stok
    $('#btn-add').click(function () {
        $('#form-add').hide();
        $('#form-add').removeClass('hide');
        $('#table-data').fadeOut(200);
        $('#form-add').slideDown(250, null, function () {
            //focuskan ke input jumlah stok
            $('#form-add input[name=jumlah]').focus();
        });

        //disable btn add
        $('#btn-add').addClass('disabled');
    });

    //cancel add 
    $('#btn-cancel').click(function () {
        $('#form-add').slideUp(250, null, function () {
            //clear form
            $('#form-add').clearForm();
            //set default tanggal ke hari ini
            var dat = new Date();
            var tgl = dat.getDate();
            if(tgl.toString().length == 1){
                tgl = "0" + tgl.toString();
            }

            var bln = dat.getMonth()+1;
            if(bln.toString().length == 1){
                bln = "0" + bln.toString();
            }

            var thn = dat.getFullYear();
            
            $('#form-add input[name=tanggal]').val(thn + "/" + bln + "/" + tgl);

        });
        $('#table-data').fadeIn(200);

        //enable btn add
        $('#btn-add').removeClass('disabled');
    });

    //format number uang
    // $('.for-money').change(function () {
    //     var val = $(this).val();
    //     val = val.replace(".", "");
    //     val = val.replace(",", "");
    //     $(this).val(number_format(val, 0, ',', '.'));
    // });

    $('.tanggal').datepicker({
        format: 'yyyy/mm/dd',
        todayHighlight: true
    });
    
    //delete stok manual
    $(document).on('click','.btn-delete',function(){
        var url = $(this).attr('href');
        if(confirm('Anda akan menghapus data ini?')){
            location.href = url;
        }
        return false;
    });
})(jQuery);
</script>
@append
@extends('layouts.master')

@section('styles')
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<link href="plugins/calculator/jquery.calculator.css" rel="stylesheet" type="text/css"/>
@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Pengaturan Harga Barang
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <div class="row" >
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
        
         <div class="col-sm-4 col-md-4 col-lg-4" >
            <div class="box box-solid {{ $hpp_tab[0] && $current_harga ?  $hpp_tab[0]->hpp_fix_up != $current_harga->hpp ? 'label-warning':'' : ''}}">
                <div class="box-header with-border">
                    <h3 class="box-title">Harga Beli Terbaru</h3>
                </div>
                <div>
                    <table class="table table-bordered " >
                        <tbody>
                            <tr >
                                <td>Harga Beli</td>
                                <td>:</td>
                                <td class='text-right'>
                                    {{$harga_beli_terbaru ? number_format($harga_beli_terbaru->harga,0,',','.') : 0}}
                                </td>
                            </tr>
                            <tr>
                                <td>HPP</td>
                                <td>:</td>
                                <td class="text-right" >
                                    {{number_format($hpp_tab[0]->hpp_fix_up,0,',','.')}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-sm-4 col-md-4 col-lg-4" >
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Harga Barang Saat Ini</h3>
                    <div class="pull-right">
                        <!--jika stok kosong, maka tidak boleh ganti harga-->
                        @if($data->stok > 0)
                        <a class="btn btn-primary btn-sm" id="btn-set" ><i class="fa fa-edit"  ></i>  Update Harga</a>
                        @else
                        <!--tampilkan tombol untuk add manual stok-->
                        <a class="btn btn-success btn-sm" href="setbar/manstok/set-stok/{{$data->id}}" ><i class="fa fa-line-chart" ></i> Tambah Stok</a>
                        @endif
                        <a class="btn btn-danger btn-sm" href="setbar/manstok" ><i class="fa fa-remove" ></i> Close</a>
                    </div>
                </div>
                
                <!--Form Update Harga-->
                <div class="box-body">
                    <form id="form-edit" name="form-edit" action="setbar/manstok/update-harga" class="hide" method="POST" >
                        <input type="hidden" name="id" value="{{$data->id}}" >
                        <table class="table table-bordered table-condensed" >
                            <tbody>
                                <tr>
                                    <td class="col-sm-4 col-md-4 col-lg-4" >Harga Beli</td>
                                    <td>:</td>
                                    <td>
                                        <input type="text" name="harga_beli" readonly class="form-control text-right input-sm" value="{{$harga_beli_terbaru ? number_format($harga_beli_terbaru->harga,0,',','.') : 0}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>HPP</td>
                                    <td>:</td>
                                    <td>
                                        <input type="text" name="hpp" readonly class="form-control text-right input-sm" value="{{number_format($hpp_tab[0]->hpp_fix_up,0,',','.')}}" >
                                    </td>
                                </tr>
                                <tr>
                                    <td>Harga Jual</td>
                                    <td>:</td>
                                    <td class="text-right" >
                                        <!--<div class="input-group" >-->
                                        <div class="input-group" >
                                            <div class="input-group-btn" >
                                               
                                            </div>
                                            <input type="text" id="harga_jual" name="harga_jual"  class="text-right  for-money form-control" value="0" >
                                                
                                            </div>
                                        <!--</div>-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>Laba</td>
                                    <td>:</td>
                                    <td>
                                        <input type="text" name="margin" readonly class="form-control text-right">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" >Save</button>
                                        <a id="btn-cancel" class="btn btn-danger btn-sm" >Cancel</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>

                    <!--Table Hargag Barang-->
                    <div id="table-harga" >
                        <table class="table table-bordered table-condensed" >
                            <tbody>
                                <tr>
                                    <td>Harga Beli</td>
                                    <td>:</td>
                                    <td class="text-right" >
                                        {{ $current_harga?number_format($current_harga->harga_beli,0,',','.'):0 }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>HPP</td>
                                    <td>:</td>
                                    <td class="text-right" >
                                        {{ $current_harga?number_format($current_harga->hpp,0,',','.'):0 }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Harga Jual</td>
                                    <td>:</td>
                                    <td class="text-right" >
                                        {{ $current_harga?number_format($current_harga->harga_jual,0,',','.'):0 }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Laba</td>
                                    <td>:</td>
                                    <td class="text-right" >
                                        {{ $current_harga?number_format($current_harga->harga_jual -  $current_harga->hpp,0,',','.'):0 }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-12" >
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Riwayat Harga Barang</h3>

                </div>
                <div class="box-body">
                    <!--table riwayat harga barang-->
                    <div id="table-data" class="table-responsive" >
                        <table class="table table-bordered table-striped" id="table-history-harga" >
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Harga Beli</th>
                                    <th>HPP</th>
                                    <th>Harga Jual</th>
                                    <th>Laba</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach($history_harga as $dt)
                                    <tr>
                                        <td>{{date('d-m-Y',strtotime($dt->created_at))}}</td>
                                        <td>{{number_format($dt->harga_beli,0,',','.')}}</td>
                                        <td>{{number_format($dt->hpp,0,',','.')}}</td>
                                        <td>{{number_format($dt->harga_jual,0,',','.')}}</td>
                                        <td>{{number_format($dt->harga_jual - $dt->hpp,0,',','.')}}</td>
                                        <td>
                                            <a class="btn btn-primary btn-danger btn-xs btn-delete-harga" href="setbar/manstok/delete-harga/{{$dt->id}}" ><i class="fa fa-trash" ></i></a>
                                        </td>
                                    </tr>
                                @endforeach
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
<script src="plugins/calculator/jquery.plugin.min.js" type="text/javascript"></script>
<script src="plugins/calculator/jquery.calculator.min.js" type="text/javascript"></script>
<script src="plugins/autonumeric/autoNumeric-min.js" type="text/javascript"></script>
<script src="plugins/numeraljs/numeral.min.js" type="text/javascript"></script>

<script type="text/javascript">
(function ($) {
    var tableData = $('#table-history-harga').DataTable({
        bSort:false,
        "columns": [
            null,
            {className: "text-right"},
            {className: "text-right"},
            {className: "text-right"},
            {className: "text-right"},
            {className: "text-center"}
        ]
    });

    //setting auto numeric
    $('.for-money').autoNumeric('init',{
        vMin:'0',
        vMax:'999999999'
    });

    //format number uang
    $('.for-money').blur(function () {
        // var val = $(this).val();
        // //bulatkan dulu
        // val = Math.round(val);
        
        // // val = val.replace(/\./g, '');
        // // val = val.replace(/\,/g, '');
        // $(this).val(number_format(val, 0, ',', '.'));
        calculate_keuntungan();
        // alert('toket');
    });
    // $('.for-money').focus(function () {
    //     var val = $(this).val();
    //     val = val.replace(/\./g, '');
    //     val = val.replace(/\,/g, '');
    //     $(this).val(val);
    // });
    
    //hitung margin keuntungan
    function calculate_keuntungan(){
        //normalisasi hpp
        if($('input[name=hpp]').val() != "" && $('input[name=harga_jual]').val() != ""){
            var hpp = $('input[name=hpp]').val();
            hpp = hpp.replace(/\./g, '');
            hpp = hpp.replace(/\,/g, '');
            
            var harga_jual = $('input[name=harga_jual]').val();
            harga_jual = harga_jual.replace(/\./g, '');
            harga_jual = harga_jual.replace(/\,/g, '');
            
            //hitung keuntungan
            var keuntungan = harga_jual - hpp;

            // $('input[name=margin]').val(number_format(keuntungan, 0, ',', '.'));
            $('input[name=margin]').val(numeral(keuntungan).format('0,0'));
        }
    }

    //edit harga jual
    $('#btn-set').click(function () {
        //disable btn edit
        $('#btn-set').addClass('disabled');
        //tampilkan form edit harga
        $('#form-edit').hide();
        $('#form-edit').removeClass('hide');
        $('#table-harga').slideUp(100, null, function () {
            $('#form-edit').slideDown(250, null, function () {
                //fokuskan
                $('#form-edit input[name=harga_jual]').focus();

            });
        });
    });

    //Cancel edit
    $('#btn-cancel').click(function () {
        //tutup form edit
        $('#form-edit').slideUp(100, null, function () {
            //clear input
            $('#form-edit input[name=harga_jual]').val('');
            $('#form-edit input[name=margin]').val('');
            //tampilkan table harga
            $('#table-harga').slideDown(200, null, function () {});
            //enablekan btn-add
            $('#btn-set').removeClass('disabled');
        });
    });

    //set calculator
    $('#harga_jual').calculator({
        layout: $.calculator.scientificLayout,
        showOn: 'button',
        buttonImageOnly: true,
        buttonImage: 'img/calculator_48.png'
    });

    //pindahkan kalkulator trigger ke smping
    $('.calculator-trigger').appendTo($('#harga_jual').prev());
    
    //CANCEL KEYPRESS ENTER
    $('#form-edit input').keypress(function(e){
        if(e.keyCode == 13){
            return false;
        };
    });
    
    //delete history harga
    $('.btn-delete-harga').click(function(){
        if(confirm('Anda akan menghapus data ini?')){
            
        }else{
            return false;
        }
    });


})(jQuery);
</script>
@append
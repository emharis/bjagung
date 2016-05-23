@extends('layouts.master')

@section('styles')
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

<style>
    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #F0F0F0; }
    .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }
</style>
@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Add Data Pembelian
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-body">
        <div class="row" >
            <div class="col-sm-4 col-md-4 col-lg-4" >
                <table class="table table-bordered table-condensed" >
                    <tbody>
                        <tr>
                            <td>No. Invoice</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="no_inv" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="tanggal" class="form-control" >
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4" ></div>
            <div class="col-sm-4 col-md-4 col-lg-4" >
                <table class="table table-bordered table-condensed" >
                    <tbody>
                        <tr>
                            <td>Supplier</td>
                            <td>:</td>
                            <td>
                                <select name="supplier" class="form-control" >
                                    @foreach($suppliers as $dt)
                                        <option value="{{$dt->id}}" data-tempo="{{$dt->jatuh_tempo}}" >{{strtoupper($dt->nama)}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Pembayaran</td>
                            <td>:</td>
                            <td>
                                <select class="form-control" name="pebayaran" >
                                    <option value="T" >TUNAI/LUNAS</option>
                                    <option value="K" >KREDIT/TEMPO</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- <div class="col-sm-12 col-md-12 col-lg-12 " > -->

            <table class="table table-bordered table-condensed table-striped table-hover" id="table-barang" >
                <thead>
                    <tr>
                        <th class="col-sm-2 col-md-2 col-lg-2" >KODE</th>
                        <th>KATEGORI/NAMA</th>
                        <th class="col-sm-1 col-md-1 col-lg-1" >QTY</th>
                        <th>SAT</th>
                        <th class="col-sm-2 col-md-2 col-lg-2" >HARGA/SATUAN</th>
                        <th>TOTAL</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="text" name="kode" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="nama" id="nama_autocomplete" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="qty" class="form-control text-right">
                        </td>
                        <td></td>
                        <td>
                            <input type="text" name="harga" class="form-control text-right">
                        </td>
                        <td class="text-right" id="col-total" ></td>
                        <td  ></td>
                    </tr>
                </tbody>
            </table>
            <!-- hidden id barang -->
            <input type="hidden" name="id_barang">
        <!-- </div> -->

        </div><!-- /.box-body -->
    </div><!-- /.box -->

</section><!-- /.content -->
@stop

@section('scripts')
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>
<script src="plugins/autocomplete/jquery.autocomplete.min.js" type="text/javascript"></script>
<script src="plugins/phpjs/numberformat.js" type="text/javascript"></script>
<script src="plugins/autonumeric/autoNumeric-min.js" type="text/javascript"></script>

<script type="text/javascript">
(function ($) {
    //set autocomplete
    $('#nama_autocomplete').autocomplete({
        serviceUrl: 'pembelian/beli/get-barang',
        params: {  'nama': function() {
                        return $('input[name=nama]').val();
                    }
                },
        onSelect:function(suggestions){
            //set kode dan satuan
            $('input[name=kode]').val(suggestions.kode);
            $('input[name=qty]').parent().next().html(suggestions.sat);
            $('input[name=id_barang]').val(suggestions.data);
            //fokuskan ke qty
            $('input[name=qty]').focus();
        }

    });
    //autocomplete dengan kode
    $('input[name=kode]').autocomplete({
        serviceUrl: 'pembelian/beli/get-barang-by-kode',
        params: {  'nama': function() {
                        return $('input[name=kode]').val();
                    }
                },
        onSelect:function(suggestions){
            //set kode dan satuan
            $('input[name=nama]').val(suggestions.nama);
            $('input[name=qty]').parent().next().html(suggestions.sat);
            $('input[name=id_barang]').val(suggestions.data);
            //fokuskan ke qty
            $('input[name=qty]').focus();
        }

    });
    var colTotal = $('input[nae=harga]').parent().next();
    $('input[name=harga]').autoNumeric('init',{
        aSep:'.',
        aDec:',',
        vMin:'1',
        vMax:'999999999'
    }); 
    $('#col-total').autoNumeric('init',{
        aSep:'.',
        aDec:',',
        vMin:'1',
        vMax:'999999999'
    });  

    //hitung jumlah total
    $('input[name=harga]').keyup(function(){
        var qty = $('input[name=qty]').val();
        var harga = $(this).autoNumeric('get');
        var total = qty * harga;
        // var total_formatted = number_format(total,0,',','.');
        $('#col-total').autoNumeric('set',total);
        // $(this).parent().next().html(total);
    });

    //tambahkan barang
    $('input[name=harga]').keyup(function(e){
        if(e.keyCode == 13){
            var newrow = "<tr>\n\
            <td>" + $('input[name=kode]').val() + "</td>\n\
            <td>" + $('input[name=nama]').val() + "</td>\n\
            <td class='text-right' >" + $('input[name=qty]').val() + "</td>\n\
            <td>" + $('input[name=qty]').parent().next().text() + "</td>\n\
            <td class='text-right' >" + $('input[name=harga]').val() + "</td>\n\
            <td class='text-right' >" + $('input[name=harga]').parent().next().text() + "</td>\n\
            <td></td>\n\
            </tr>";

            $('#table-barang tbody').append(newrow);

            //clear input
            $('input[name=kode]').val('');
            $('input[name=nama]').val('');
            $('input[name=harga]').val('');
            $('input[name=harga]').parent().next().html('');
            $('input[name=qty]').val('');
            $('input[name=qty]').parent().next().html('');
            //fokuskan ke input kode
            $('input[name=kode]').focus();
        }
    });


})(jQuery);
</script>
@append

@extends('layouts.master')

@section('styles')
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<style>
    #modal-show-barang .modal-dialog {
        width: 75%;
    }
</style>
@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Pembelian

        <div class="pull-right" >
            <a class="btn btn-primary btn-sm" href="pembelian/beli/add" ><i class="fa fa-plus" ></i> Add Data Pembelian</a>
        </div>
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-body">

            <div id="table-data" class="table-responsive" >
                <!--table data barang-->
                <table class="table table-bordered table-hover table-condensed table-striped" id="table-datatable" >
                    <thead>
                        <tr>
                            <th style="padding-right:5px;padding-left:5px;" >NO</th>
                            <th>No INV</th>
                            <th>TGL</th>
                            <th>SUPPLIER</th>
                            <th style="padding-right:1px;padding-left:1px;" >T/K</th>
                            <th  style="padding-right:1px;padding-left:1px;" >STS</th>
                            <th>SUB TOTAL</th>
                            <th>DISC</th>
                            <th>TOTAL</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $dt)
                        <tr>
                            <td class="text-right" ></td>
                            <td>{{$dt->no_inv}}</td>
                            <td>{{$dt->tgl_formatted}}</td>
                            <td>{{$dt->supplier}}</td>
                            <td class="{{$dt->status == 'N' ? 'bg-red':''}}" >
                                @if($dt->tipe == 'T')
                                    T
                                @else
                                    K
                                @endif
                            </td>
                            <td class="{{$dt->status == 'N' ? 'bg-red':''}}" >
                                @if($dt->status == 'Y')
                                    Y
                                @else
                                    N
                                @endif
                            </td>
                            <td>{{number_format($dt->total,0,'.',',')}}</td>
                            <td>{{number_format($dt->disc,0,'.',',')}}</td>
                            <td>
                                <label>{{number_format($dt->grand_total,0,'.',',') }}</label>
                            </td>
                            <td class="text-center" >
                                <a class="btn btn-primary btn-xs btn-show" href="pembelian/beli/show/{{$dt->id}}" ><i class="fa fa-eye" ></i></a>
                                <a class="btn-edit btn btn-xs btn-success" href="pembelian/beli/edit/{{$dt->id}}" ><i class="fa fa-edit" ></i></a> 
                                <a class="btn-delete btn btn-xs btn-danger" href="pembelian/beli/delete/{{$dt->id}}" ><i class="fa fa-trash" ></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div><!-- /.box-body -->
    </div><!-- /.box -->

</section><!-- /.content -->

<!-- modal show detil pembelian -->
<div class="modal" id="modal-show-barang" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Data Pembelian Barang</h4>
                </div>
                <div class="modal-body">
                    <div class="row" >
                        <div class="col-sm-4 col-md-4 col-lg-4" >
                            <table class="table table-bordered table-condensed" >
                                <tbody>
                                    <tr>
                                        <td><label>NO. INV</label></td>
                                        <td>:</td>
                                        <td id="show-no-inv" ></td>
                                    </tr>
                                    <tr>
                                        <td><label>TANGGAL</label></td>
                                        <td>:</td>
                                        <td id="show-tgl" ></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4" ></div>
                        <div class="col-sm-4 col-md-4 col-lg-4" >
                            <table class="table table-bordered table-condensed" >
                                <tbody>
                                    <tr>
                                        <td><label>SUPPLIER</label></td>
                                        <td>:</td>
                                        <td id="show-supplier" ></td>
                                    </tr>
                                    <tr>
                                        <td><label>PEMBAYARAN</label></td>
                                        <td>:</td>
                                        <td id="show-pembayaran" ></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12" >
                            <table id="table-show-barang" class="table table-bordered table-striped table-hover table-condensed" >
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th >KODE</th>
                                        <th>KATEGORI/BARANG</th>
                                        <th>QTY</th>
                                        <th>SAT</th>
                                        <th>HARGA/SAT</th>
                                        <th>TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" >
                    <a class="btn btn-danger btn-sm" data-dismiss="modal" ><i class="fa fa-close" ></i> Close</a>
                </div>
            </div> 
        </div> 
    </div>



@stop

@section('scripts')
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>
<script src="plugins/numeraljs/numeral.min.js" type="text/javascript"></script>

<script type="text/javascript">
(function ($) {
    //format datatable
    var tableData = $('#table-datatable').DataTable({
        "sort":false,
        "columns": [
            {className: "text-right"},
            null,
            null,
            null,
            null,
            null,
            {className: "text-right"},
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

    //show data pembelian
    $('.btn-show').click(function(){
        var url = $(this).attr('href');
        $.get(url,null,function(res){
            var data = JSON.parse(res);
            // $.each(data.barang,function(i,data){
            //     alert(data.id);
            // });

            //tampilkan data pembelian
            $('#show-no-inv').html(data.master.no_inv);
            $('#show-tgl').html(data.master.tgl_formatted);
            $('#show-supplier').html(data.master.supplier);
            var tipe_pembayaran = "";
            if(data.master.tipe == 'K'){
                tipe_pembayaran = 'KREDIT/TEMPO';
            }else{
                tipe_pembayaran = 'TUNAI/LUNAS';
            }
            $('#show-pembayaran').html(tipe_pembayaran);

            //tampilkan detil barang
            var rownum=0;
            //clear table
            $('#table-show-barang tbody').empty();
            //add row to table
            $.each(data.barang ,function(i,dt){

                var newrow = '<tr>\n\
                                <td class="text-right" >' + (i+1) + '</td>\n\
                                <td>' + dt.kode + '</td>\n\
                                <td>' + dt.nama_barang_full + '</td>\n\
                                <td class="text-right" >' + dt.qty + '</td>\n\
                                <td>' + dt.satuan + '</td>\n\
                                <td class="text-right" >' + numeral(dt.harga).format('0,0') + '</td>\n\
                                <td class="text-right" >' + numeral(dt.total).format('0,0') + '</td>\n\
                                </tr>';

                $('#table-show-barang tbody').append(newrow);
                rownum = i+1;
            });

            //add total row
            var subtotalrow = '<tr>\n\
                                <td colspan="6" class="text-right" ><label>SUB TOTAL</label></td>\n\
                                <td class="text-right" ><label>' + numeral(data.master.total).format('0,0') + '</label></td>\n\
                            </tr>';
            $('#table-show-barang tbody').append(subtotalrow);
            //disc row
            var discrow = '<tr>\n\
                                <td colspan="6" class="text-right" ><label>DISC</label></td>\n\
                                <td class="text-right" ><label>' + numeral(data.master.disc).format('0,0') + '</label></td>\n\
                            </tr>';
            $('#table-show-barang tbody').append(discrow);
            //grand total row
            var grandtotalrow = '<tr>\n\
                                <td colspan="6" class="text-right" ><label>JUMLAH TOTAL</label></td>\n\
                                <td class="text-right" ><label>' + numeral((data.master.total - data.master.disc)).format('0,0') + '</label></td>\n\
                            </tr>';
            $('#table-show-barang tbody').append(grandtotalrow);

            var discrow

            //tampilkan modal barang
            $('#modal-show-barang').modal('show');
        });

        return false;
    });


    //hapus data pembelian
    $(document).on('click','.btn-delete',function(){
        if(confirm('Anda akan menghapus data ini?')){
            //delete data pembelian
        }else{
            return false;
        }        
    });


// END OF JQUERY
})(jQuery);
</script>
@append
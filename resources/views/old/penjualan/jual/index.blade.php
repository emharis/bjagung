@extends('layouts.master')

@section('styles')
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<style>
    #modal-show-jual .modal-dialog {
        width: 75%;
    }
</style>
@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Penjualan

        <!-- <div class="pull-right" >
            <a class="btn btn-primary btn-sm" href="Penjualan/beli/add" ><i class="fa fa-plus" ></i> Add Data Penjualan</a>
        </div> -->
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <div class="row" >
        <div class="col-sm-9 " >
            <div class="box box-solid" >
                <table class="table table-bordered" >
                    <tbody>
                        <tr>
                            <td><label>FILTER</label></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm-3 text-right" >
            <a class="btn btn-app bg-blue " style="width: 100%;margin-left:0;" href="penjualan/jual/pos" ><i class="fa fa-shopping-cart" ></i>JUAL</a>
            
        </div>
    </div>

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-body">

            <div id="table-data" class="table-responsive" >
                <!--table data barang-->
                <table class="table table-bordered table-hover table-condensed table-striped" id="table-datatable" >
                    <thead>
                        <tr>
                            <th style="padding-right:5px;padding-left:5px;" >NO</th>
                            <th>NO INV</th>
                            <th>TGL</th>
                            <th>CUSTOMER</th>
                            <th style="padding-right:1px;padding-left:1px;" >T/K</th>
                            <th  style="padding-right:1px;padding-left:1px;" >STS</th>
                            <th>SUB TOTAL</th>
                            <th>DISC</th>
                            <th>TOTAL</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $rownum=1; ?>
                        @foreach($jual as $dt)
                        <tr data-id="{{$dt->id}}" >
                            <td class="text-right" >{{$rownum++}}</td>
                            <td>{{$dt->no_inv}}</td>
                            <td>{{$dt->tgl_formatted}}</td>
                            <td>{{$dt->customer}}</td>
                            <td>{{$dt->tipe}}</td>
                            <td></td>
                            <td class="text-right" >{{number_format($dt->total,0,'.',',')}}</td>
                            <td class="text-right" >{{number_format($dt->disc,0,'.',',')}}</td>
                            <td class="text-right" >{{number_format($dt->grand_total,0,'.',',')}}</td>                            
                            <td class="text-center" >
                                <a class="btn btn-primary btn-xs btn-show-jual" ><i class="fa fa-eye" ></i></a>
                                <a class="btn btn-success btn-xs btn-edit-jual" href="penjualan/jual/edit/{{$dt->id}}" ><i class="fa fa-edit" ></i></a>
                                <a class="btn btn-danger btn-xs btn-delete-jual" ><i class="fa fa-trash" ></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div><!-- /.box-body -->
    </div><!-- /.box -->

</section><!-- /.content -->

<!-- modal show detil Penjualan -->
<div class="modal" id="modal-show-jual" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">DATA PENJUALAN</h4>
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
                                    <tr>
                                        <td><label>SALESMAN</label></td>
                                        <td>:</td>
                                        <td id="show-salesman" ></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3" ></div>
                        <div class="col-sm-5 col-md-5 col-lg-5" >
                            <table class="table table-bordered table-condensed" >
                                <tbody>
                                    <tr>
                                        <td><label>CUSTOMER</label></td>
                                        <td>:</td>
                                        <td id="show-customer" ></td>
                                    </tr>
                                    <tr>
                                        <td><label>PEMBAYARAN</label></td>
                                        <td>:</td>
                                        <td id="show-pembayaran" ></td>
                                    </tr>
                                    <tr>
                                        <td><label>STATUS</label></td>
                                        <td>:</td>
                                        <td id="show-status" ></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12" >
                            <table id="table-show-barang" class="table table-bordered table-striped table-hover table-condensed" >
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>KODE</th>
                                        <th>KATEGORI/BARANG</th>
                                        <th>QTY</th>
                                        <th>SAT</th>
                                        <th>HARGA/SAT</th>
                                        <th>HARGA SALESMAN</th>
                                        <th>TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7" class="text-right" ><label>TOTAL</label></td>
                                        <td id="show-total" class="text-right" style="font-weight:bold;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" class="text-right" ><label>DISC</label></td>
                                        <td id="show-disc" class="text-right" style="font-weight:bold;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" class="text-right" ><label>JUMLAH BAYAR</label></td>
                                        <td id="show-grand-total" class="text-right" style="font-weight:bold;"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" >
                    <a class="btn btn-success btn-sm" id="btn-cetak-nota" ><i class="fa fa-print" ></i> CETAK NOTA</a>
                    <a class="btn btn-danger btn-sm" data-dismiss="modal" ><i class="fa fa-close" ></i> CLOSE</a>
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
    //VIEW DATA PENJUALAN
    $('.btn-show-jual').click(function(){
        var jual_id = $(this).parent().parent().data('id');

        //clear table
        $('#table-show-barang tbody').empty();  

        //get data jual
        $.get('penjualan/jual/get-jual/' + jual_id,null,function(datares){
            var data_jual = JSON.parse(datares);

            //tampilkan data jual ke modal
            $('#show-no-inv').text(data_jual.no_inv);
            $('#show-tgl').text(data_jual.tgl_formatted);
            $('#show-salesman').text(data_jual.salesman);
            $('#show-customer').text(data_jual.customer);
            $('#show-grand-total').text(numeral(data_jual.grand_total).format('0,0'));
            $('#show-total').text(numeral(data_jual.total).format('0,0'));
            $('#show-disc').text(numeral(data_jual.disc).format('0,0'));
            
            if(data_jual.tipe == 'K'){
                $('#show-pembayaran').text('KREDIT/TEMPO');
            }else{
                $('#show-pembayaran').text('TUNAI/LUNAS');
            }

            if(data_jual.status == 'N'){
                $('#show-status').text('-');
            }else{
                $('#show-status').text('LUNAS');
            }

            //tampilkan data detil jual / data barang
            $.get('penjualan/jual/get-jual-barang/' + jual_id,null,function(databar){
                var data_barang = JSON.parse(databar);
                var table_barang = $('#table-show-barang');
                
                var rownum=1;
                $.each(data_barang,function(i,data){
                    var newrow = "<tr>\n\
                                    <td class='text-right'  >" + rownum++ + "</td>\n\
                                    <td>" + data.kode + "</td>\n\
                                    <td>" + data.nama_full + "</td>\n\
                                    <td class='text-right'>" + data.qty + "</td>\n\
                                    <td>" + data.satuan + "</td>\n\
                                    <td class='text-right'  >" + numeral(data.harga_satuan).format('0,0') + "</td>\n\
                                    <td class='text-right' >" + numeral(data.harga_salesman).format('0,0') + "</td>\n\
                                    <td class='text-right' >" + numeral(data.total).format('0,0') + "</td>\n\
                                  </tr>";

                    $('#table-show-barang tbody').append(newrow);

                    //tampilkan modal
                    $('#modal-show-jual').modal('show');
                });
            });            
        });
    });
    //END VIEW DATA PENJUALAN

    //CETAK NOTA
    $('#btn-cetak-nota').click(function(){
        if(confirm('Anda akan mencetak nota ini?')){
            alert('cetak nota');    
        }
        
    });
    //END OF CETAK NOTA

    // DELETE DATA JUAL
    $('.btn-delete-jual').click(function(e){
        if(confirm('Anda akan menghapus data ini?')){
            var row = $(this).parent().parent();
            var jual_id = row.data('id');
            

            var newForm = jQuery('<form>', {
                            'action': 'penjualan/delete',
                            'method': 'POST'
                        }).append(jQuery('<input>', {
                            'name': 'jual_id',
                            'value': jual_id,
                            'type': 'hidden'
                        }));
            //submit form simpan penjualan
            newForm.appendTo('body').submit();

            // $.post('penjualan/delete',{'jual_id':jual_id},function(ref){
            //         alert(ref);
            //     });

            // row.fadeOut(250,null,function(){
            //     var jual_id = row.data('id');
            //     $.post('penjualan/delete',{'jual_id':jual_id},function(ref){
            //         alert(ref);
            //     });
            // });
        }else{
            e.preventDefault();
            return false;
        }
    });
    // END OF DELETE DATA JUAL



// END OF JQUERY
})(jQuery);
</script>
@append
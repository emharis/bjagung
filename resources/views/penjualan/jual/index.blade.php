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
            <a class="btn btn-app bg-blue " style="width: 90%;" href="penjualan/jual/pos" ><i class="fa fa-shopping-cart" ></i>JUAL</a>
            
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
                        
                    </tbody>
                </table>
            </div>


        </div><!-- /.box-body -->
    </div><!-- /.box -->

</section><!-- /.content -->

<!-- modal show detil Penjualan -->
<div class="modal" id="modal-show-barang" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Data Penjualan Barang</h4>
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
                                        <th>KODE</th>
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


// END OF JQUERY
})(jQuery);
</script>
@append
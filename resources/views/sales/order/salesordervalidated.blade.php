@extends('layouts.master')

@section('styles')
<link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>
<style>
    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #FFE291; }
    .autocomplete-suggestions strong { font-weight: normal; color: red; }
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }

    .table-row-mid > tbody > tr > td {
        vertical-align:middle;
    }

    input.input-clear {
        display: block; 
        padding: 0; 
        margin: 0; 
        border: 0; 
        width: 100%;
        background-color:#EEF0F0;
        float:right;
        padding-right: 5px;
        padding-left: 5px;
    }
</style>

@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <a href="sales/order" >Sales Order</a> <i class="fa fa-angle-double-right" ></i> {{$so_master->so_no}}
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-header with-border" style="padding-top:5px;padding-bottom:5px;" >
            {{-- button VALIDATE --}}
            {{-- <a class="btn btn-primary" style="margin-top:0;" id="btn-validate-so" href="sales/order/validate/{{$so_master->id}}" >Validate</a> --}}
            {{-- sales order title --}}
            <label> <small>Sales Order</small> <h4 style="font-weight: bolder;margin-top:0;padding-top:0;margin-bottom:0;padding-bottom:0;" >{{$so_master->so_no}}</h4></label>
            
            <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>
            <a class="btn  btn-arrow-right pull-right disabled bg-blue"" >Validated</a>

            <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>

            <a class="btn btn-arrow-right pull-right disabled bg-gray" >Open</a>

            <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>

            <a class="btn btn-arrow-right pull-right disabled bg-gray" >Draft</a>
        </div>
        <div class="box-body">
            

            {{-- Data Hidden --}}
            <input type="hidden" name="so_master_id" value="{{$so_master->id}}">

            <div class="row" >
                <div class="col-lg-10" >
                    <table class="table" >
                <tbody>
                    <tr>
                        <td class="col-lg-2">
                            <label>Customer</label>
                        </td>
                        <td class="col-lg-3" >
                            {{-- <input type="text" name="customer" autofocus class="form-control text-uppercase" data-customerid="{{$so_master->customer_id}}" value="{{$so_master->customer}}" required> --}}
                            {{$so_master->customer}}
                        </td>
                        <td class="col-lg-2" ></td>
                        <td class="col-lg-2" >
                            <label>Order Date</label>
                        </td>
                        <td class="col-lg-3" >
                            {{-- <input type="text" name="tanggal" class="input-tanggal form-control" value="{{$so_master->tgl_formatted}}" required> --}}
                            {{$so_master->tgl_formatted}}
                        </td>
                        
                    </tr>
                    <tr>
                        <td class="">
                            <label>Salesperson</label>
                        </td>
                        <td class="" >
                            {{-- <input type="text" name="salesperson" class="form-control text-uppercase" data-salespersonid="{{$so_master->salesman_id}}" value="{{$so_master->nama_salesman_full}}" required > --}}
                            {{$so_master->nama_salesman_full}}
                        </td>
                        <td class="" ></td>
                        <td class=" hide" >
                            <label>Inv. No.</label>
                        </td>
                        <td class="hide" >
                            {{-- <input type="text" name="no_inv"  class="input-tanggal form-control" value="{{$so_master->no_inv}}"  readonly> --}}
                            {{$so_master->no_inv}}
                        </td>
                        
                    </tr>
                </tbody>
            </table>
                </div>
                <div class="col-lg-2" >
                    {{-- widget invoices --}}
                    <a class="btn btn-app pull-right" href="sales/order/invoice/{{$so_master->id}}" >
                            <span class="badge bg-green">{{$invoice_num}}</span>
                            <i class="fa fa-newspaper-o"></i> Invoices
                          </a>
                </div>
            </div>

            <h4 class="page-header" style="font-size:14px;color:#3C8DBC"><strong>PRODUCT DETAILS</strong></h4>

            <table id="table-product" class="table table-bordered table-condensed" >
                <thead>
                    <tr>
                        <th style="width:25px;" >NO</th>
                        <th  >PRODUCT</th>
                        <th class="col-lg-1" >QUANTITY</th>
                        <th class="col-lg-1" >SATUAN</th>
                        <th class="col-lg-1" >BERAT</th>
                        {{-- <th class="col-lg-2" >UNIT PRICE</th> --}}
                        <th class="col-lg-2" >UNIT PRICE</th>
                        <th class="col-lg-2" >SUBTOTAL</th>
                        {{-- <th style="width:50px;" ></th> --}}
                    </tr>
                </thead>
                <tbody>
                    <?php $rownum=1; ?>
                    @foreach($so_barang as $dt)
                        <tr class="row-product"  >
                            <td class="text-right" >{{$rownum++}}</td>
                            <td>
                                {{-- <input autocomplete="off" type="text"  data-barangid="{{$dt->barang_id}}" data-kode="{{$dt->kode}}"  value="{{$dt->nama_full}}" class="text-uppercase form-control input-product input-sm input-clear" > --}}
                                {{$dt->nama_full}}
                            </td>
                            <td class="text-right" >
                                {{-- <input type="number" autocomplete="off" min="1" class="form-control text-right input-quantity input-sm input-clear" value="{{$dt->qty}}" > --}}
                                {{$dt->qty}}
                            </td>
                            <td>
                                {{$dt->satuan}}
                            </td>
                            <td>
                                {{$dt->berat}}
                            </td>
                            {{-- <td class="text-right" > --}}
                                {{-- <input autocomplete="off" type="text" class="text-right form-control input-unit-price input-sm input-clear" readonly="" value="{{$dt->harga_satuan}}" > --}}
                                {{-- {{number_format($dt->harga_satuan,0,'.',',')}} --}}
                            {{-- </td> --}}
                            <td class="text-right" >
                                {{-- <input autocomplete="off" type="text" class="text-right form-control input-salesperson-unit-price input-sm input-clear" value="{{$dt->harga_salesman}}" > --}}
                                {{number_format($dt->harga_salesman,0,'.',',')}}
                            </td>
                            <td class="text-right" >
                                {{-- <input autocomplete="off" type="text" readonly  class="text-right form-control input-subtotal input-sm input-clear" value="{{$dt->subtotal}}" > --}}
                                {{number_format($dt->subtotal,0,'.',',')}}
                            </td>
                            {{-- <td class="text-center" >
                                <a href="#" class="btn-delete-row-product" ><i class="fa fa-trash" ></i></a>
                            </td> --}}
                        </tr>
                    @endforeach
                    {{-- <tr id="row-btn-add-item">
                        <td></td>
                        <td colspan="7" >
                            <a id="btn-add-item" href="#">Add an item</a>
                        </td>
                    </tr> --}}
                    
                    
                </tbody>
            </table>

            <div class="row" >
                <div class="col-lg-8" >
                    {{-- <textarea name="note" class="form-control" rows="3" style="margin-top:5px;" placeholder="Note" >{{$so_master->note}}</textarea> --}}
                    {{-- <i>* <span>Q.O.H : Quantity on Hand</span></i>
                    <i>&nbsp;|&nbsp;</i>
                    <i><span>S.U.P : Salesperson Unit Price</span></i> --}}
                    <span>Note : <i>{{$so_master->note}}</i></span>
                </div>
                <div class="col-lg-4" >
                    <table class="table table-condensed" >
                        <tbody>
                            <tr>
                                <td class="text-right">
                                    <label>Subtotal :</label>
                                </td>
                                <td class="label-total-subtotal text-right" >
                                    {{number_format($so_master->subtotal,0,'.',',')}}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right" >
                                    <label>Disc :</label>
                                </td>
                                <td class="text-right" >
                                   {{-- <input style="font-size:14px;" type="text" name="disc" class="input-sm form-control text-right input-clear" value="{{$so_master->disc}}" >  --}}
                                   {{number_format($so_master->disc,0,'.',',')}}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right" style="border-top:solid darkgray 1px;" >
                                    Total :
                                </td>
                                <td class="label-total text-right" style="font-size:18px;font-weight:bold;border-top:solid darkgray 1px;" >
                                    {{number_format($so_master->total,0,'.',',')}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12" >
                    {{-- <button type="submit" class="btn btn-primary" id="btn-save" >Save</button> --}}
                    <a class="btn btn-danger" href="sales/order" >Close</a>
                </div>
            </div>



            {{-- <a id="btn-test" href="#" >TEST</a> --}}


        </div><!-- /.box-body -->
    </div><!-- /.box -->

</section><!-- /.content -->

@stop

@section('scripts')
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="plugins/autocomplete/jquery.autocomplete.min.js" type="text/javascript"></script>
<script src="plugins/autonumeric/autoNumeric-min.js" type="text/javascript"></script>

<script type="text/javascript">
(function ($) {

})(jQuery);
</script>
@append
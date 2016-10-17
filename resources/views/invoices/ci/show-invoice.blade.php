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
        <a href="invoice/customer-invoice" >Customer Invoices</a>
        <i class="fa fa-angle-double-right" ></i>
        {{$data->no_inv}}
    </h1>
</section>

<!-- Main content -->
<section class="content">
    {{-- data hidden  --}}
    <input type="hidden" name="customer_invoice_id" value="{{$data->id}}">

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_data" data-toggle="tab">Invoice</a></li>
          <li><a href="#tab_payment" data-toggle="tab">Payments</a></li>
          <li class="pull-right header" >
              <a class="" id="btn-print-invoice" href="#" ><i class="fa fa-print" ></i></a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_data">
            <div class="box-header with-border" style="padding-top:5px;padding-bottom:5px;" >

            {{-- @if($data->status == "O")
                <a class="btn btn-primary" style="margin-top:0;" id="btn-reg-payment" href="sales/order/reg-payment/{{$data->id}}" >Register Payment</a>
            @else
                <label> <small>Invoice</small> <h4 style="font-weight: bolder;margin-top:0;padding-top:0;margin-bottom:0;padding-bottom:0;" >{{$data->no_inv}}</h4></label>
            @endif --}}
                <label> <small>Invoice</small> <h4 style="font-weight: bolder;margin-top:0;padding-top:0;margin-bottom:0;padding-bottom:0;" >{{$data->no_inv}}</h4></label>

                <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>
                <a class="btn  btn-arrow-right pull-right disabled {{$data->status == 'P' ? 'bg-blue' : 'bg-gray'}}" >Paid</a>

                <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>

                <a class="btn btn-arrow-right pull-right disabled {{$data->status == 'O' ? 'bg-blue' : 'bg-gray'}}" >Open</a>

                {{-- <label class="pull-right" >&nbsp;&nbsp;&nbsp;</label>

                <a class="btn btn-arrow-right pull-right disabled bg-gray" >Draft PO</a> --}}
            </div>
            <div class="box-body">
                <table class="table" >
                    <tbody>
                        <tr>
                            <td class="col-lg-2">
                                <label>Supplier</label>
                            </td>
                            <td class="col-lg-4" >
                                {{-- <input type="text" name="supplier" class="form-control" data-supplierid="{{$so_master->supplier_id}}" value="{{$so_master->supplier}}" required> --}}
                                {{$data->customer}}
                            </td>
                            <td class="col-lg-2" ></td>
                            <td class="col-lg-2" >
                                <label>Bill Date</label>
                            </td>
                            <td class="col-lg-2" >
                                {{-- <input type="text" name="tanggal" class="input-tanggal form-control" value="{{$so_master->tgl_formatted}}" required> --}}
                                {{$data->invoice_date_formatted}}
                            </td>
                        </tr>
                        <tr>
                            <td class="col-lg-2">
                                <label>Source Document</label>
                            </td>
                            <td class="col-lg-4" >
                                {{-- <input type="text" name="no_inv" class="form-control" value="{{$so_master->no_inv}}" > --}}
                                <a href="#" >{{$data->so_no}}</a>
                            </td>
                            <td class="col-lg-2" ></td>
                            <td class="col-lg-2" >
                                <label>Due Date</label>
                            </td>
                            <td class="col-lg-2" >
                                {{-- <input type="text" name="jatuh_tempo"  class="input-tanggal form-control" value="{{$so_master->jatuh_temso_formatted}}" > --}}
                                {{-- {{$so_master->jatuh_temso_formatted}} --}}
                                {{$data->due_date_formatted}}
                            </td>
                        </tr>
                    </tbody>
                </table>

                <h4 class="page-header" style="font-size:14px;color:#3C8DBC"><strong>PRODUCT DETAILS</strong></h4>

                <table id="table-product" class="table table-bordered table-condensed table-striped" >
                    <thead>
                        <tr>
                            <th style="width:25px;" >NO</th>
                            <th class="col-lg-4" >PRODUCT</th>
                            <th class="col-lg-1" >QUANTITY</th>
                            <th class="col-lg-1" >UNIT</th>
                            <th class="col-lg-1" >WEIGHT</th>
                            <th>UNIT PRICE</th>
                            <th>SUBTOTAL</th>
                            {{-- <th style="width:50px;" ></th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        <?php $rownum=1; ?>
                        @foreach($barang as $dt)
                            <tr>
                                <td class="text-right">{{$rownum++}}</td>
                                <td>
                                    {{$dt->nama_full}}
                                </td>
                                <td class="text-right" >
                                    {{$dt->qty}}
                                </td>
                                <td class="text-right" >
                                    {{$dt->satuan}}
                                </td>
                                <td class="text-right" >
                                    {{$dt->berat}}
                                </td>
                                <td class="text-right" >
                                    {{number_format($dt->harga_salesman,0,'.',',')}}
                                </td>
                                <td class="text-right" >
                                    {{number_format($dt->subtotal,0,'.',',')}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="row" >
                    <div class="col-lg-8" >
                        {{-- <textarea name="note" class="form-control" rows="4" style="margin-top:5px;" placeholder="Note" >{{$so_master->note}}</textarea> --}}
                        {{-- <br/>
                        <label>Note :</label> <i>{{$so_master->note}}</i> --}}
                    </div>
                    <div class="col-lg-4" >
                        <table class="table table-condensed" >
                            <tbody>
                                <tr>
                                    <td class="text-right">
                                        <label>Subtotal :</label>
                                    </td>
                                    <td id="label-total-subtotal" class=" text-right" >
                                        {{number_format($data->subtotal,0,'.',',')}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right" >
                                        <label>Disc :</label>
                                    </td>
                                    <td class="text-right" id="label-disc" >
                                        {{number_format($data->disc,0,'.',',')}}
                                       {{-- <input style="font-size:14px;" type="text" name="disc" class="input-sm form-control text-right input-clear" value="{{$so_master->disc}}" >  --}}

                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right" style="border-top:solid darkgray 1px;" >
                                        Total :
                                    </td>
                                    <td id="label-total" class=" text-right" style="font-size:18px;font-weight:bold;border-top:solid darkgray 1px;" >
                                        {{number_format($data->total,0,'.',',')}}
                                    </td>
                                </tr>
                                @if(count($payments) > 0)
                                @foreach($payments as $dt)
                                    <tr style="background-color:#EEF0F0;" >
                                        <td class="text-right" >
                                            {{-- <a class="btn-delete-payment" data-paymentid="{{$dt->id}}" href="#" ><i class="fa fa-trash-o pull-left" ></i></a> --}}
                                            <i>Paid on {{$dt->payment_date_formatted}}</i>
                                        </td>
                                        <td class="text-right" >
                                            <i>{{number_format($dt->payment_amount,0,'.',',')}}</i>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                                <tr>
                                    <td class="text-right" style="border-top:solid darkgray 1px;" >
                                        Amount Due :
                                    </td>
                                    <td id="label-amount-due" class=" text-right" style="font-size:18px;font-weight:bold;border-top:solid darkgray 1px;" >
                                        {{number_format($data->amount_due,0,'.',',')}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12" >
                        {{-- @if($multi_invoice)
                        <a class="btn btn-danger" href="sales/order/invoice/{{$so_master->id}}" >Close</a>
                        @else --}}
                            <a class="btn btn-danger" href="invoice/customer-invoice" >Close</a>
                        {{-- @endif --}}
                    </div>
                </div>
            </div><!-- /.box-body -->
          </div><!-- /.tab-pane -->
          <div class="tab-pane" id="tab_payment">
            {{-- TAB 2 --}}
            {{-- DATA PAYMENTS --}}
            @if($data->status == 'O')
            <a class="btn btn-primary" id="btn-reg-payment" href="invoice/customer-invoice/reg-payment/{{$data->id}}" >Register Payment</a>
            <br/>
            <div class="clear-fix"></div>
            &nbsp;
            @endif


            <table class="table table-bordered table-condensed table-striped" >
                <thead>
                    <tr>
                        <th style="width:30px;" >NO</th>
                        <th class="col-lg-2" >PAYMENT DATE</th>
                        <th class="col-lg-2" >REF#</th>
                        <th>PAYMENT AMOUNT</th>
                        <th style="width:30px;" ></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $rownum=1; ?>
                    <?php $payment_paid = 0; ?>
                    @foreach($payments as $pay)
                        <tr>
                            <td class="text-right" >{{$rownum++}}</td>
                            <td>{{$pay->payment_date_formatted}}</td>
                            <td>{{$pay->payment_number}}</td>
                            <td class="text-right" >{{number_format($pay->payment_amount,0,'.',',')}}</td>
                            <td  >
                                <a class="btn btn-danger btn-xs btn-delete-payment" href="#" data-paymentid="{{$dt->id}}" ><i class="fa fa-trash-o" ></i></a>
                            </td>
                        </tr>
                        <?php $payment_paid += $pay->payment_amount; ?>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="border-top:solid #CACACA 2px;background-color:whitesmoke;" >
                        <td colspan="3" style="margin:0;padding:0;" ></td>
                        <td class="text-right" style="margin:0;padding:0;" >
                            <label class="pull-left" >TOTAL:</label>
                            <label>{{number_format($payment_paid,0,'.',',')}}</label>
                        </td>
                        <td style="margin:0;padding:0;" ></td>
                    </tr>
                </tfoot>
            </table>

            <a class="btn btn-danger" href="invoice/customer-invoice" >Close</a>

          </div><!-- /.tab-pane -->
        </div><!-- /.tab-content -->
      </div>

    <!-- Default box -->
    <div class="box box-solid"
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
    $('#btn-print-invoice').click(function(){
        alert('Print Invoice');
        return false;
    });

    // delete payment
    $('.btn-delete-payment').click(function(){
        if(confirm('Anda akan menghapus data ini?')){
            var payment_id = $(this).data('paymentid');
            // var deleteForm = $('<form>').attr('method','POST').attr('action','api/delete-customer-payment');
            // deleteForm.append($('<input>').attr('type','hidden').attr('name','payment_id').val(payment_id));
            // deleteForm.submit();

            $.post('api/delete-customer-payment',{
                "payment_id" : payment_id
            },function(){
                location.reload();
            });
        }

        return false;
    });

})(jQuery);
</script>
@append

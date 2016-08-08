@extends('layouts.full')

@section('styles')
    <!--Bootsrap Data Table-->
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>
    <style>
        .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
        .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
        .autocomplete-selected { background: #FFE291; }
        .autocomplete-suggestions strong { font-weight: normal; color: red; }
        .autocomplete-group { padding: 2px 5px; }
        .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }

        #modal-show-barang .modal-dialog {
            width: 75%;
        }

        #table-barang > tfoot > tr:first-child > td{
            border-top-width: 3px; 
            border-top-color: grey;
        }

        #table-barang > tbody > tr > td {
            vertical-align:middle;
        }
    </style>
@append

@section('content')
    <div class="container">

    </div>
    <div class="row" >
        <div class="col-sm-12 col-md-12 col-lg-12" >
            <div class="box box-solid" >
                <div class="box-header bg-green" >
                    <h3 class="box-title" >EDIT DATA PENJUALAN</h3>
                    <div class="pull-right" >
                        <!-- Tanggal indonesia -->
                        {{$tgl_indo}}
                    </div>  
                </div>
                <div class="box-body" >
                    <div class="row" >
                        <div class="col-sm-6 col-md-6 col-lg-6" >
                            <table class="table table-bordered table-condensed" >
                                <tbody>
                                    <tr>
                                        <td>NO. INV</td>
                                        <td>:</td>
                                        <td>
                                            {{$jual->no_inv}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>CUSTOMER</td>
                                        <td>:</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" name="customer" class="form-control text-uppercase" value="{{$jual->customer}}"  autofocus >
                                                <div class="input-group-btn">
                                                  <a id="btn-clear-customer" type="button" class="btn btn-danger"><i class="fa fa-close" ></i></a>
                                                  <a id="btn-refresh-customer" type="button" class="btn btn-success"><i class="fa fa-refresh" ></i></a>
                                                </div><!-- /btn-group -->
                                            </div>
                                            
                                            <input type="hidden" name="customer_id" value="{{$jual->customer_id}}" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>SALESMAN</td>
                                        <td>:</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" name="salesman" class="form-control text-uppercase" value="{{$jual->salesman}}" >
                                                <div class="input-group-btn">
                                                  <a id="btn-clear-salesman" type="button" class="btn btn-danger"><i class="fa fa-close" ></i></a>
                                                  <a id="btn-refresh-salesman" type="button" class="btn btn-success"><i class="fa fa-refresh" ></i></a>
                                                </div><!-- /btn-group -->
                                            </div>
                                            
                                            <input type="hidden" name="salesman_id" value="{{$jual->sales_id}}" >
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6" >
                            <table class="table table-bordered table-condensed" >
                                <tbody>
                                    <tr>
                                        <td>TANGGAL</td>
                                        <td>:</td>
                                        <td>
                                            <div class="input-group">
                                                <input id="input-tanggal" type="text" name="tanggal" class="form-control" value="{{$jual->tgl_formatted}}" >
                                                <div class="input-group-btn">
                                                  <a id="btn-clear-tanggal" type="button" class="btn btn-danger"><i class="fa fa-close" ></i></a>
                                                  <a id="btn-refresh-tanggal" type="button" class="btn btn-success"><i class="fa fa-refresh" ></i></a>
                                                </div><!-- /btn-group -->
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>PEMBAYARAN</td>
                                        <td>:</td>
                                        <td>
                                            <div class="input-group">
                                                {{-- <select class="form-control" name="pembayaran" >\
                                                    <option value="T">TUNAI/LUNAS</option>
                                                    <option value="K">KREDIT/TEMPO</option>
                                                </select> --}}
                                                <?php $opsi_pembayaran = ['T'=>'TUNAI/LUNAS','K'=>'KREDIT/TEMPO']; ?>
                                                {!! Form::select('pembayaran',$opsi_pembayaran,$jual->tipe,['class'=>'form-control']) !!}
                                                <div class="input-group-btn">
                                                  <a id="btn-clear-pembayaran" type="button" class="btn btn-danger"><i class="fa fa-close" ></i></a>
                                                  <a id="btn-refresh-pembayaran" type="button" class="btn btn-success"><i class="fa fa-refresh" ></i></a>
                                                </div><!-- /btn-group -->
                                            </div>
                                            
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="col-sm-12 col-md-12 col-lg-12" >
                            <input type="hidden" name="input-add-id-barang">
                            <input type="hidden" name="input-add-kode-barang">
                            <input type="hidden" name="input-add-stok-barang">
                            <div class="table-responsive" >
                                <table class="table table-bordered table-condensed" id="table-barang" >
                                    <thead>
                                        <tr class="bg-blue" >
                                            <th class="col-sm-1 col-md-1 col-lg-1" style="width: 25px;padding:none;" >NO</th>
                                            <th>BARANG/KATEGORI <i class="pull-right" >STOK</i></th>
                                            <th class="col-sm-2 col-md-2 col-lg-2 " >HRG/SAT</th>
                                            <th class="col-sm-2 col-md-2 col-lg-2 " >HRG/SLS</th>
                                            <th class="col-sm-1 col-md-1 col-lg-1 " >QTY</th>
                                            <th style="width: 25px;padding:none;" >SAT</th>
                                            <th class="col-sm-2 col-md-2 col-lg-2 " >JUMLAH</th>
                                            <th style="width: 100px;padding:none;" ></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="border-bottom:2px solid grey;"  >
                                            <td></td>
                                            <td >
                                                <div class="input-group">
                                                    <input type="text" name="input-add-barang" class="form-control text-uppercase">
                                                    <span class="input-group-addon bg-green" id="label-stok-barang"></span>
                                                </div>
                                            </td>
                                            <td  id="label-harga-satuan" class="text-right" >
                                                <!-- harga satuan -->
                                            </td>
                                            <td>
                                                <input type="text" name="input-add-harga-salesman" class="form-control text-right">
                                            </td> 
                                            <td>
                                                <input type="number" name="input-add-qty" min="1" class="form-control text-right">
                                            </td>
                                            <td id="label-satuan"  ></td>
                                            <td id="label-total-harga-barang" class="text-right" style="vertical-align:middle;" ></td>
                                            <td class="text-center" >
                                                <button id="btn-add-barang" class="btn btn-primary btn-sm" >&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus" ></i>&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                                <button id="btn-cancel-add-barang" class="btn btn-danger btn-sm" ><i class="fa fa-close" ></i></button>
                                            </td>
                                        </tr>
                                        <!-- TAMPILKAN DATA BARANG -->
                                        <?php $rowid = 1; ?>
                                        @foreach($jual_barang as $dt)
                                            <tr data-idbarang="{{$dt->barang_id}}" data-kodebarang="{{$dt->kode}}" data-rowid="{{$rowid}}" class="row-barang">
                                                <td>{{$rowid++}}.</td>
                                                <td>
                                                    {{$dt->kode . ' ' . $dt->nama_full}}<label class="bg-green pull-right label-stok-barang-on-row">&nbsp;&nbsp;{{$dt->stok_on_db}}&nbsp;&nbsp;</label>
                                                </td>
                                                <td class="text-right">
                                                    {{number_format($dt->harga_satuan,0,'.',',')}}
                                                </td>
                                                <td class="text-right">
                                                    <input type="text" class="form-control text-right input-add-harga-salesman-on-row" value="{{$dt->harga_salesman}}">
                                                </td>
                                                <td class="text-right">
                                                    <input type="number" min="1" max="{{$dt->stok_on_db + $dt->qty}}" class="form-control text-right input-add-qty-on-row" value="{{$dt->qty}}"></td><td>{{$dt->satuan}}
                                                </td>
                                                <td class="text-right">
                                                    {{number_format($dt->total,0,'.',',')}}
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-danger btn-sm btn-delete-barang-on-row"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="6" class="text-right"  >
                                                <label>TOTAL</label>
                                            </td>
                                            <td id="label-sub-total" style="font-weight:bold;" class="text-right" >
                                                {{number_format($jual->total,0,'.',',')}}
                                            </td>
                                            <td>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="text-right" >
                                                <label>DISC</label>
                                            </td>
                                            <td>
                                                <input type="text" name="disc" class="form-control text-right" value="{{$jual->disc}}" >
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="text-right" >
                                                <label>TOTAL BAYAR</label>
                                            </td>
                                            <td id="label-grand-total" style="font-weight:bold;" class="grand-total text-right" >
                                                {{number_format($jual->grand_total,0,'.',',')}}
                                            </td>
                                            <td></td>
                                        </tr>

                                    </tfoot>
                                </table>
                            </div>
                            
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 text-right" >
                            <a class="btn btn-primary" id="btn-save" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SAVE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                            <!-- <a class="btn btn-success" id="btn-save-cetak" >&nbsp;&nbsp;&nbsp;&nbsp;SAVE & CETAK NOTA&nbsp;&nbsp;&nbsp;&nbsp;</a> -->
                            <a class="btn text-red" id="btn-exit"  >&nbsp;&nbsp;&nbsp;&nbsp;EXIT&nbsp;&nbsp;&nbsp;&nbsp;</a>
                        </div>
                        <!-- End of input data barang -->
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->

    <!-- DATA JSON JUAL & DATA BARANG -->
    <div class="hide" id="json-data-jual" >{{json_encode($jual)}}</div>
    <div class="hide" id="json-data-jual-barang" >{{json_encode($jual_barang)}}</div>
@stop

@section('scripts')
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>
    <script src="plugins/autocomplete/jquery.autocomplete.min.js" type="text/javascript"></script>
    <script src="plugins/phpjs/numberformat.js" type="text/javascript"></script>
    <script src="plugins/autonumeric/autoNumeric-min.js" type="text/javascript"></script>
    <script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="plugins/numeraljs/numeral.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        (function ($) {

            // -----------------------------------------------------
            // DECLARATION MEMBER VARIABLES
            // =====================================================
            var STR_BARANG = '{"barang" : [] }';
            var OBJ_BARANG = JSON.parse(STR_BARANG);
            //get data barang dari data json
            OBJ_BARANG.barang = JSON.parse($('#json-data-jual-barang').text());

            var OBJ_JUAL = {"customer_id":"", "salesman_id":"","tanggal":"","pembayaran":""};
            //get data jual dari data json
            OBJ_JUAL = JSON.parse($('#json-data-jual').text());

            var TBL_BARANG = $('#table-barang');
            // =====================================================
            // END DECLARATION MEMBER VARIABLES
            // -----------------------------------------------------


            // -----------------------------------------------------
            // SET DEFAULT INPUT
            // =====================================================
            // $('input[name=customer]').val('');
            // $('input[name=salesman]').val('');
            // $('select[name=pembayaran]').val([]);
            // $('input[name=input-add-barang]').val('');
            // $('input[name=input-add-qty]').val('');

            $('input[name=customer]').attr('disabled','disabled');
            $('input[name=salesman]').attr('disabled','disabled');
            $('input[name=tanggal]').attr('disabled','disabled');
            $('select[name=pembayaran]').attr('disabled','disabled');
            $('input[name=input-add-harga-salesman]').val('');
            $('input[name=input-add-qty]').attr('disabled','disabled');
            $('input[name=input-add-harga-salesman]').attr('disabled','disabled');
            // =====================================================
            // END OF SET DEFAULT INPUT
            // -----------------------------------------------------


            // -----------------------------------------------------
            // SET AUTO NUMERIC
            // =====================================================
            $('input[name=input-add-harga-salesman]').autoNumeric('init',{
                vMin:'0',
                vMax:'9999999999'
            });
            $('input[name=disc]').autoNumeric('init',{
                vMin:'0',
                vMax:'9999999999'
            });
            $('.input-add-harga-salesman-on-row').autoNumeric('init',{
                vMin:'0',
                vMax:'9999999999'
            });
            // ===================================================== 
            // END OF SET AUTO NUMERIC
            // ----------------------------------------------------- 


            // -----------------------------------------------------
            // SET AUTO COMPLETE
            // =====================================================
            // set autocomplete customer
            $('input[name=customer]').autocomplete({
                serviceUrl: 'penjualan/jual/get-customer',
                params: {  'nama': function() {
                                return $('input[name=customer]').val();
                            }
                        },
                onSelect:function(suggestions){
                    //set customer id
                    $('input[name=customer_id]').val(suggestions.data);
                    //disablekan input customer
                    $('input[name=customer]').attr('disabled','disabled');
                    //set focus ke salesman
                    $('input[name=salesman]').focus();
                }

            });
            // end of set autocomplete customer
            // +++++++++++++++++++++++++++++++++++++++++++++++++++++
            // set autocomplete salesman
            $('input[name=salesman]').autocomplete({
                serviceUrl: 'penjualan/jual/get-salesman',
                params: {  'nama': function() {
                                return $('input[name=salesman]').val();
                            }
                        },
                onSelect:function(suggestions){
                    //set salesman id
                    $('input[name=salesman_id]').val(suggestions.data);
                    //disablekan input customer
                    $('input[name=salesman]').attr('disabled','disabled');
                    //set focus ke tanggal
                    $('input[name=tanggal]').focus();
                }

            });
            // end of set autocomplete salesman
            // +++++++++++++++++++++++++++++++++++++++++++++++++++++
            // set autocomplete barang/kategori/kode
            $('input[name=input-add-barang]').autocomplete({
                serviceUrl: 'penjualan/jual/get-barang',
                params: {  'nama': function() {
                                return $('input[name=input-add-barang]').val();
                            }
                        },
                onSelect:function(suggestions){
                    //disablekan input barang
                    $('input[name=input-add-barang]').attr('disabled','disabled');
                    //set barang yang di pilih
                    $('input[name=input-add-kode-barang]').val(suggestions.kode);
                    //set satuan barang
                    $('#label-satuan').text(suggestions.sat);
                    $('input[name=input-add-id-barang]').val(suggestions.id);
                    $('input[name=input-add-stok_barang]').val(suggestions.stok);                    
                    //tampilkan stok barang ke table
                    $('#label-stok-barang').text(suggestions.stok);
                    //tampilkan harga satuan
                    $('#label-harga-satuan').text(numeral(suggestions.harga_jual_current).format('0,0'));
                    $('input[name=input-add-harga-salesman],input[name=input-add-qty]').val(numeral(suggestions.harga_jual_current).format('0,0'));
                    //enable kan input qty dan input harga salesman
                    $('input[name=input-add-qty],input[name=input-add-harga-salesman]').removeAttr('disabled');
                    $('input[name=input-add-harga-salesman]').focus();
                    //set qty value to 1
                    $('input[name=input-add-qty]').val(1);

                }

            });
            // end of set autocomplete barang/kategori/kode
            // =====================================================
            // END OF SET AUTO COMPLETE
            // -----------------------------------------------------


            // =====================================================
            // CLEAR CUSTOMER & SALESMAN & TANGGAL & PEMBAYARAN
            // -----------------------------------------------------            
            // clear customer
            $('#btn-clear-customer').click(function(){
                //clear data customer
                $('input[name=customer]').val('');
                $('input[name=customer_id]').val('');
                //enable kan input customer
                $('input[name=customer]').removeAttr('disabled');
                //focuskan input customer
                $('input[name=customer]').focus();
            });
            // end of clear customer
            // +++++++++++++++++++++++++++++++++++++++++++++++++++++
            // clear salesman
            $('#btn-clear-salesman').click(function(){
                //clear data salesman
                $('input[name=salesman]').val('');
                $('input[name=salesman_id]').val('');
                //enablekan input salesman
                $('input[name=salesman]').removeAttr('disabled');
                //focuskan input salesman
                $('input[name=salesman]').focus();
            });
            // end of clear salesman
            // +++++++++++++++++++++++++++++++++++++++++++++++++++++
            // clear tanggal
            $('#btn-clear-tanggal').click(function(){
                //clear data tanggal
                $('input[name=tanggal]').val('');
                //enable kan input tanggal
                $('input[name=tanggal]').removeAttr('disabled');
                //focuskan input tanggal
                $('input[name=tanggal]').focus();
            });
            // end of clear tanggal
            // +++++++++++++++++++++++++++++++++++++++++++++++++++++
            // clear pembayaran
            $('#btn-clear-pembayaran').click(function(){
                //clear data pembayaran
                $('select[name=pembayaran]').val([]);
                //enable kan input pembayaran
                $('select[name=pembayaran]').removeAttr('disabled');
                //focuskan input pembayaran
                $('select[name=pembayaran]').focus();
            });
            // end of clear tanggal
            // -----------------------------------------------------
            // END OF CLEAR CUSTOMER & SALESMAN & TANGGAL & PEMBAYARAN
            // =====================================================


            // =====================================================
            // REFRESH CUSTOMER & SALESMAN & TANGGAL & PEMBAYARAN
            // -----------------------------------------------------            
            // refresh customer
            $('#btn-refresh-customer').click(function(){
                //refresh data customer
                $('input[name=customer]').val(OBJ_JUAL.customer);
                $('input[name=customer_id]').val(OBJ_JUAL.customer_id);
                //disablekan input customer
                $('input[name=customer]').attr('disabled','disabled');
            });
            // end of refresh customer
            // +++++++++++++++++++++++++++++++++++++++++++++++++++++
            // refresh salesman
            $('#btn-refresh-salesman').click(function(){
                //refresh data salesman
                $('input[name=salesman]').val(OBJ_JUAL.salesman);
                $('input[name=salesman_id]').val(OBJ_JUAL.salesman_id);
                //disablekan input salesman
                $('input[name=salesman]').attr('disabled','disabled');
            });
            // end of refresh salesman
            // +++++++++++++++++++++++++++++++++++++++++++++++++++++
            // refresh tanggal
            $('#btn-refresh-tanggal').click(function(){
                //refresh data tanggal
                $('input[name=tanggal]').val(OBJ_JUAL.tgl_formatted);
                //disablekan input tanggal
                $('input[name=tanggal]').attr('disabled','disabled');
            });
            // end of refresh tanggal
            // +++++++++++++++++++++++++++++++++++++++++++++++++++++
            // refresh pembayaran
            $('#btn-refresh-pembayaran').click(function(){
                //refresh data pembayaran
                $('select[name=pembayaran]').val(OBJ_JUAL.tipe);
                //disablekan input pembayaran
                $('select[name=pembayaran]').attr('disabled','disabled');
            });
            // end of refresh tanggal
            // -----------------------------------------------------
            // END OF REFRESH CUSTOMER & SALESMAN & TANGGAL & PEMBAYARAN
            // =====================================================


            // -----------------------------------------------------
            // SET DATE TIME PICKER
            // =====================================================            
            $('#input-tanggal').datepicker({
                format: 'dd-mm-yyyy',
                todayHighlight: true,
                autoclose: true
            }).on('changeDate',function(env){
                $('select[name=pembayaran]').focus();
            });
            // =====================================================
            // END OF SET DATE TIME PICKER
            // -----------------------------------------------------
            

            // -----------------------------------------------------
            // HITUNG JUMLAH HARGA BARANG
            // =====================================================
            // hitung jumlah harga barang saat edit harga salesman dan quantity
            $('input[name=input-add-harga-salesman],input[name=input-add-qty]').keyup(function(e){
                // hitungJumlahHargaBarangOnRow();
                // hitungTotalBayar();
                var qty = $('input[name=input-add-qty]').val();
                var harga_salesman = $('input[name=input-add-harga-salesman]').autoNumeric('get');
                var total_harga = Number(qty) * Number(harga_salesman);
                //tampilkan total harga ke table
                $('#label-total-harga-barang').text(numeral(total_harga).format('0,0'));
            });
            // end of hitung jumlah harga barang
            // +++++++++++++++++++++++++++++++++++++++++++++++++++++
            // press enter perubahan qty dan harga salesman
            $('input[name=input-add-harga-salesman],input[name=input-add-qty]').keydown(function(e){
                //jika yg di tekan tombol enter
                var elm = $(this);
                if(e.keyCode == 13){
                    if(elm.is($('input[name=input-add-harga-salesman]'))){
                        //pindahkan kursor ke input qty
                        $('input[name=input-add-qty]').select();
                    }else{
                        addBarang();
                    }
                };
            });
            // end press enter perubahan qty dan harga salesman
            // // +++++++++++++++++++++++++++++++++++++++++++++++++++++
            // // fungsi perhitungan jumlah harga barang
            // function hitungJumlahHargaBarangOnRow(){
            //     //get harga dan qty
            //     var qty = $('input[name=input-add-qty]').val();
            //     var harga_salesman = $('input[name=input-add-harga-salesman]').autoNumeric('get');
            //     var total_harga = Number(qty) * Number(harga_salesman);
            //     //tampilkan total harga ke table
            //     $('#label-total-harga-barang').text(numeral(total_harga).format('0,0'));
            //     alert('hitung jumlah harga barang on row');
            // }
            // end of fungsi perhitungan total harga barang
            // =====================================================
            // END OF HITUNG JUMLAH HARGA BARANG
            // -----------------------------------------------------


            // -----------------------------------------------------
            // FUNGSI TAMBAHKAN BARANG BARU KE DALAM TABEL DAN  -
            // DAFTAR BARANG
            // =====================================================
            var row_id=1;
            function addBarang(){
                if($('input[name=input-add-id-barang]').val() != "" && $('input[name=input-add-harga-salesman]').val() != "" && $('input[name=input-add-qty]').val() != "" ){

                    //get data barang
                    var id_barang = $('input[name=input-add-id-barang]').val();
                    var kode_barang = $('input[name=input-add-kode-barang]').val();
                    var nama_barang = $('input[name=input-add-barang]').val();
                    var satuan = $('#label-satuan').text();
                    var qty = $('input[name=input-add-qty]').val();
                    var harga_satuan = $('#label-harga-satuan').text();
                    harga_satuan = harga_satuan.replace(/\./g, "");
                    harga_satuan = harga_satuan.replace(/,/g, "");
                    var harga_salesman = $('input[name=input-add-harga-salesman]').autoNumeric('get');
                    var current_stok = $('#label-stok-barang').text();
                    var total_harga = Number(qty) * Number(harga_salesman);                
                    // cek ketersediaan stok
                    if(Number(qty) <= Number(current_stok)){
                        // // add barang ke JSON
                        // OBJ_BARANG.barang.push({
                        //     id:id_barang,
                        //     nama_barang : nama_barang,
                        //     kode:kode_barang,
                        //     qty:qty,
                        //     harga_satuan:harga_satuan,
                        //     harga_salesman:harga_salesman,
                        //     current_stok:current_stok,
                        //     total_harga:total_harga
                        // });
                        // add barang ke table
                        var new_row = $('<tr>').attr('data-idbarang',id_barang).attr('data-kodebarang',kode_barang).attr('data-rowid',row_id++).addClass('row-barang');
                        new_row.append('<td>');
                        new_row.append($('<td>').html(nama_barang + '<label class="bg-green pull-right label-stok-barang-on-row">&nbsp;&nbsp;' + current_stok + '&nbsp;&nbsp;</label>' ));
                        new_row.append($('<td>').addClass('text-right').text(numeral(harga_satuan).format('0,0')));
                        new_row.append($('<td>').addClass('text-right').html($('<input>').attr('type','text').addClass('form-control text-right input-add-harga-salesman-on-row').attr('value',harga_salesman) ));
                        new_row.append($('<td>').addClass('text-right').html($('<input>').attr('type','number').attr('min',1).attr('max',current_stok).addClass('form-control text-right input-add-qty-on-row').attr('value',qty)));
                        new_row.append($('<td>').text(satuan));
                        new_row.append($('<td>').addClass('text-right').text(numeral(total_harga).format('0,0')));
                        new_row.append($('<td>').addClass('text-center').html('<a class="btn btn-danger btn-sm btn-delete-barang-on-row"><i class="fa fa-trash" ></i></a>'));
                        // add new row ke table
                        TBL_BARANG.children('tbody').append(new_row);
                        //reorder row number
                        rownumReorder();
                        // format auto numeric input-add-harga-salesman-on-row
                        $('.input-add-harga-salesman-on-row').autoNumeric('init',{
                            vMin:'0',
                            vMax:'9999999999'
                        });
                        //clear input barang
                        clearInputBarang();
                        //hitung total bayar
                        hitungTotalBayar();

                    }else{
                        //tampilkan pesan stok tidak memenudi
                        alert('Quantity melebihi stok yang tersedia.');
                        $('input[name=input-add-qty]').val(0);
                        $('input[name=input-add-qty]').select();
                    }

                }else{
                    alert('Lengkapi data yang kosong.');
                }
                
            }
            // =====================================================
            // END OF FUNGSI TAMBAHKAN BARANG BARU KE DALAM TABEL 
            // DAN DAFTAR BARANG
            // -----------------------------------------------------


            // -----------------------------------------------------
            // FUNGSI RE-ORDER ROW NUMBER
            // =====================================================
            function rownumReorder(){
                $('#table-barang > tbody > tr.row-barang').each(function(i){
                    $(this).children('td:first').text((Number(i)+1) + ".");
                });
            }
            // =====================================================
            // END OF FUNGSI RE-ORDER ROW NUMBER 
            // -----------------------------------------------------

            // -----------------------------------------------------
            // FUNGSI HITUNG TOTAL BAYAR
            // =====================================================
            function hitungTotalBayar(){
                // $('#table-barang > tbody > tr.row-barang').each(function(i,data){
                //     alert(data.cells.item(0).);
                // });
                var sub_total = 0;
                var disc = $('input[name=disc]').val();
                disc = disc.replace(/\./g, "");
                disc = disc.replace(/,/g, "");
                var total_bayar = 0;

                $('.row-barang').each(function(i){
                    var total_harga_on_row = $(this).children('td:last').prev().text();
                    total_harga_on_row = total_harga_on_row.replace(/\./g, "");
                    total_harga_on_row = total_harga_on_row.replace(/,/g, "");

                    sub_total += Number(total_harga_on_row);
                });
                //tampilkan total kotor ke label
                $('#label-sub-total').text(numeral(sub_total).format('0,0'));
                //hitung & tampilkan total bayar
                total_bayar = Number(sub_total) - Number(disc);
                $('#label-grand-total').text(numeral(total_bayar).format('0,0'));
            }
            // =====================================================
            // END OF FUNGSI HITUNG TOTAL BAYAR
            // -----------------------------------------------------


            // -----------------------------------------------------
            // CLICK BUTTON TAMBAH BARANG
            // =====================================================
            $('#btn-add-barang').click(function(){
                addBarang();
            });
            // =====================================================
            // END OF CLICK BUTTON TAMBAH BARANG
            // -----------------------------------------------------


            // -----------------------------------------------------
            // CANCEL TAMBAH BARANG
            // =====================================================
            $('#btn-cancel-add-barang').click(function(){
                clearInputBarang();
            });
            // =====================================================
            // END OF CANCEL TAMBAH BARANG
            // -----------------------------------------------------


            // -----------------------------------------------------
            // FUNGSI CLEAR INPUT BARANG
            // =====================================================
            function clearInputBarang(){
                // clear input
                $('input[name=input-add-barang]').val('');
                $('input[name=input-add-qty]').val('');
                $('input[name=input-add-harga-salesman]').val('');
                $('input[name=input-add-id-barang]').val('');
                $('input[name=input-add-kode-barang]').val('');
                $('input[name=input-add-stok_barang]').val('');
                $('#label-stok-barang').text('');
                $('#label-harga-satuan').text('');
                $('#label-satuan').text('');
                $('#label-total-harga-barang').text('');
                // enable & disable input
                $('input[name=input-add-barang]').removeAttr('disabled');
                $('input[name=input-add-harga-salesman]').attr('disabled','disabled');
                $('input[name=input-add-qty]').attr('disabled','disabled');
                // focuskan ke input barang
                $('input[name=input-add-barang]').focus();
            }
            // =====================================================
            // END OF FUNGSI CLEAR INPUT BARANG
            // -----------------------------------------------------


            // -----------------------------------------------------
            // PERUBAHAN DATA QUANTITY ON ROW
            // =====================================================
            // quantity change on keyup
            $(document).on('keyup','.input-add-qty-on-row',function(e){
                hitungJumlahHargaBarangOnRowOnChange($(this).parent('td').parent('tr'));
                hitungTotalBayar();
            });
            // end of quantity change on keyup
            // +++++++++++++++++++++++++++++++++++++++++++++++++++++
            // fungsi hitung jumlah harga barang on change
            function hitungJumlahHargaBarangOnRowOnChange(row){
                var qty = row.children('td:first').next().next().next().next().children('input').val();
                var qty_col = row.children('td:first').next().next().next().next();
                var current_stok = qty_col.prev().prev().prev().children('label').text();
                var input_harga_salesman_on_row = qty_col.prev().children('input');
                var harga_salesman = input_harga_salesman_on_row.autoNumeric('get');
                var total_harga_barang = Number(qty) * Number(harga_salesman);
                var kode_barang = qty_col.parent().data('kodebarang');
                //rubah label total harga barang on row
                qty_col.next().next().text(numeral(total_harga_barang).format('0,0'));
                //cek ketersediaan stok
                if(Number(qty) > Number(current_stok)){
                    alert('Quantity melebihi stok yang tersedia');
                    //set qty to 0
                    row.children('td:first').next().next().next().next().children('input').val(1);
                    //rubah label total harga barang on row ke 0
                    row.children('td:first').next().next().next().next().next().next().text(numeral(harga_salesman).format('0,0'));
                    //focuskan
                    // col_qty.children('input').select();
                }else{
                    //rubah data di OBJ_BARANG
                    // $.each(OBJ_BARANG.barang,function(i,data){
                    //     if(data.kode_barang === kode_barang){
                    //         data.qty = qty;
                    //         data.total_harga = total_harga_barang;
                    //     }
                    // });

                }
            }
            // end of fungsi hitung jumlah harga barang on change
            // +++++++++++++++++++++++++++++++++++++++++++++++++++++
            // quantity change on change event
            $(document).on('input','.input-add-qty-on-row',function(e){
                hitungJumlahHargaBarangOnRowOnChange($(this).parent('td').parent('tr'));
                hitungTotalBayar();
            });
            // end of quantity change on change event
            // =====================================================
            // END OF PERUBAHAN DATA QUANTITY ON ROW
            // -----------------------------------------------------


            // -----------------------------------------------------
            // PERUBAHAN DATA HARGA SALESMAN ON ROW
            // =====================================================
            $(document).on('keyup','.input-add-harga-salesman-on-row',function(){
                hitungJumlahHargaBarangOnRowOnChange($(this).parent('td').parent('tr'));
                hitungTotalBayar();
            });
            // cek perubahan harga salesman on row dari minimal harga
            $(document).on('change','.input-add-harga-salesman-on-row',function(e){
                if (cekHargaSalesmanOnRow($(this))){
                    alert('Harga Salesman di bawah harga minimum.');
                    //focuskan ke input harga barang on row
                    $(this).focus();
                    $(this).select();
                };

            });
            //cek on leave
            $(document).on('blur','.input-add-harga-salesman-on-row',function(){
                if (cekHargaSalesmanOnRow($(this))){
                    $(this).focus();
                    $(this).select();
                };          
            });
            // fungsi cek harga salesman on row apakah kurang dari minimum
            function cekHargaSalesmanOnRow(input_hrg_sls){
                var col_harga_salesman_on_row = input_hrg_sls.parent();
                // get harga minimum
                var harga_minimum_on_row = col_harga_salesman_on_row.prev().text();
                harga_minimum_on_row = harga_minimum_on_row.replace(/\./g, "");
                harga_minimum_on_row = harga_minimum_on_row.replace(/,/g, "");
                // get harga salesman
                var harga_salesman_on_row = input_hrg_sls.val();
                harga_salesman_on_row = harga_salesman_on_row.replace(/\./g, "");
                harga_salesman_on_row = harga_salesman_on_row.replace(/,/g, "");
                // cek harga salesman apakah kurang dari harga minimum
                return (Number(harga_salesman_on_row) < Number(harga_minimum_on_row));
            } 
            // =====================================================
            // END OF PERUBAHAN DATA HARGA SALESMAN ON ROW
            // -----------------------------------------------------


            // -----------------------------------------------------
            // INPUT DISC ON CHANGE
            // =====================================================
            $('input[name=disc]').keyup(function(){
                hitungTotalBayar();
            });
            // =====================================================
            // END OF INPUT DISC ON CHANGE
            // -----------------------------------------------------


            // -----------------------------------------------------
            // HAPUS BARANG ON ROW
            // =====================================================
            $(document).on('click','.btn-delete-barang-on-row', function(){
                if(confirm('Anda akan menghapus data ini?')){
                    var row = $(this).parent().parent();
                    row.fadeOut(250,null,function(){
                        row.remove();
                        //hitung total bayar
                        hitungTotalBayar();
                        //reorder rownumber
                        rownumReorder();
                    });
                }
            });
            // =====================================================
            // END OF HAPUS BARANG ON ROW
            // -----------------------------------------------------


            // -----------------------------------------------------
            // EXIT TRANSACTION
            // =====================================================
            $('#btn-exit').click(function(e){
                if(confirm('Anda akan membatalkan transaksi ini?')){
                    location.href = 'penjualan/jual';
                }else{
                    e.preventDefault();
                }
            });
            // =====================================================
            // END OF EXIT TRANSACTION
            // -----------------------------------------------------

            // -----------------------------------------------------
            // SAVE TRANSACTION
            // =====================================================
            $('#btn-save').click(function(){
                //cek apakah data sudah lengkap
                if( $('input[name=customer]').val() != "" && $('input[name=salesman]').val() != "" && $('input[name=tanggal]').val() != "" && $('select[name=pembayaran]').val() != "" &&  $('#table-barang > tbody > tr.row-barang').length > 0 ){

                    //Collect Data Penjualan
                    //clear OBJ_BARANG
                    OBJ_BARANG = JSON.parse(STR_BARANG);
                    var total_jumlah_harga = 0;
                    var total_bayar = 0;
                    var disc = $('input[name=disc]').val();
                    disc = disc.replace(/\./g, "");
                    disc = disc.replace(/,/g, "");

                    //masukkan data penjualan ke OBJ_JUAL
                    OBJ_JUAL.customer_id = $('input[name=customer_id]').val();
                    OBJ_JUAL.salesman_id = $('input[name=salesman_id]').val();
                    OBJ_JUAL.tanggal = $('input[name=tanggal]').val();
                    OBJ_JUAL.pembayaran = $('select[name=pembayaran]').val();
                    //masukkan data barang ke OBJ_BARANG
                    $('.row-barang').each(function(i){
                        var br_row = $(this);
                        var barang_id = br_row.data('idbarang');
                        var nama_barang = $.trim(br_row.children('td:first').next().text());
                        var kode = br_row.data('kodebarang');
                        var qty = br_row.children('td:first').next().next().next().next().children('input').val();
                        var harga_satuan = $.trim(br_row.children('td:first').next().next().text());
                        harga_satuan = harga_satuan.replace(/\./g, "");
                        harga_satuan = harga_satuan.replace(/,/g, "");

                        var harga_salesman = br_row.children('td:first').next().next().next().children('input').val();
                        harga_salesman = harga_salesman.replace(/\./g, "");
                        harga_salesman = harga_salesman.replace(/,/g, "");

                        var current_stok = $.trim(br_row.children('td:first').next().children('label').text());
                        var jumlah_harga = Number(qty) * Number(harga_salesman);

                        //masukkan data ke OBJ_BARANG
                        OBJ_BARANG.barang.push({
                            id:barang_id,
                            nama_barang : nama_barang,
                            kode:kode,
                            qty:qty,
                            harga_satuan:harga_satuan,
                            harga_salesman:harga_salesman,
                            current_stok:current_stok,
                            total_harga:jumlah_harga
                        });
                        
                        //hitung total_jumlah_harga
                        total_jumlah_harga += Number(jumlah_harga);
                    });

                    
                    // hitung total bayar
                    total_bayar = Number(total_jumlah_harga) - Number(disc);

                    //set total & total_bayar
                    OBJ_JUAL.total = total_jumlah_harga;
                    OBJ_JUAL.disc = disc;
                    OBJ_JUAL.grand_total = total_bayar;

                    //simpan data ke database
                    var newForm = jQuery('<form>', {
                            'action': 'penjualan/jual/update',
                            'method': 'POST'
                        }).append(jQuery('<input>', {
                            'name': 'jual_obj',
                            'value': JSON.stringify(OBJ_JUAL),
                            'type': 'hidden'
                        })).append(jQuery('<input>', {
                            'name': 'barang',
                            'value': JSON.stringify(OBJ_BARANG),
                            'type': 'hidden'
                        }));
                        //disable tombol save
                        $('#btn-save').addClass('disabled');
                        //submit form simpan penjualan
                        newForm.appendTo('body').submit();
                        // alert('Simpan Penjualan');
                        $('#btn-save').removeClass('disabled');

                        // alert('Simpan Update');

                }else{
                    alert('Lengkapi data yang kosong.');
                }

            });
            // =====================================================
            // END OF SAVE TRANSACTION
            // -----------------------------------------------------




        // END OF JQUERY
        })(jQuery);
    </script>
@append
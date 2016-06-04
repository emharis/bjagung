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
    </style>
@append

@section('content')
    <div class="container">

    </div>
    <div class="row" >
        <div class="col-sm-12 col-md-12 col-lg-12" >
            <div class="box box-solid" >
                <div class="box-header" >
                    <h3 class="box-title" >
                        <i class="fa fa-shopping-cart" ></i> PENJUALAN
                        
                    </h3>
                    <div class="pull-right" >
                        <!-- Tanggal indonesia -->
                        {{$tgl_indo}}
                    </div>  
                </div>
                <div class="box-body" >
                    <div class="row" >
                        <div class="col-sm-4 col-md-4 col-lg-4" >
                            <table class="table table-bordered table-condensed" >
                                <tbody>
                                    <tr>
                                        <td>Customer</td>
                                        <td>:</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" name="customer" class="form-control text-uppercase"  autofocus >
                                                <div class="input-group-btn">
                                                  <a id="btn-clear-customer" type="button" class="btn btn-danger"><i class="fa fa-close" ></i></a>
                                                </div><!-- /btn-group -->
                                            </div>
                                            
                                            <input type="hidden" name="customer_id" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Salesman</td>
                                        <td>:</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" name="salesman" class="form-control text-uppercase" >
                                                <div class="input-group-btn">
                                                  <a id="btn-clear-salesman" type="button" class="btn btn-danger"><i class="fa fa-close" ></i></a>
                                                </div><!-- /btn-group -->
                                            </div>
                                            
                                            <input type="hidden" name="salesman_id" >
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4" >
                            <table class="table table-bordered table-condensed" >
                                <tbody>
                                    <tr>
                                        <td>Tanggal</td>
                                        <td>:</td>
                                        <td>
                                            <input id="input-tanggal" type="text" name="tanggal" class="form-control" value="{{date('d-m-Y')}}" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Pembayaran</td>
                                        <td>:</td>
                                        <td>
                                            <select class="form-control" name="pembayaran" >\
                                                <option value="T">TUNAI/LUNAS</option>
                                                <option value="K">KREDIT/TEMPO</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3 bg-green" >
                            <label>TOTAL BAYAR</label>
                            <h1 class="text-right grand-total" id="grand-total-atas" >0</h1>
                        </div>
                        <div class="col-sm-1 col-md-1 col-lg-1 bg-white" >
                            <label></label>
                           
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12" >
                            <input type="hidden" name="id_barang">
                            <table class="table table-bordered table-condensed" id="table-barang" >
                                <thead>
                                    <tr class="bg-blue" >
                                        <th class="col-sm-1 col-md-1 col-lg-1 " >KODE</th>
                                        <th>BARANG/KATEGORI</th>
                                        <th class="col-sm-2 col-md-2 col-lg-2 " >HARGA/SATUAN</th>
                                        <th class="col-sm-2 col-md-2 col-lg-2 " >HARGA SALESMAN</th>
                                        <th class="col-sm-1 col-md-1 col-lg-1 " >QTY</th>
                                        <th style="width: 25px;padding:none;" >SAT</th>
                                        <th class="col-sm-2 col-md-2 col-lg-2 " >TOTAL</th>
                                        <th style="width: 10px;padding:none;" ></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr  >
                                        <td >
                                            <input type="text" name="kode" class="form-control text-uppercase">
                                        </td>
                                        <td>
                                            <input type="text" name="barang" class="form-control text-uppercase">
                                        </td>
                                        <td id="harga-satuan" class="text-right" >
                                            <!-- harga satuan -->
                                        </td>
                                        <td>
                                            <input type="text" name="harga_salesman" class="form-control text-right">
                                        </td> 
                                        <td>
                                            <input type="number" name="qty" class="form-control text-right">
                                        </td>
                                        <td id="label-satuan" >Lembar</td>
                                        <td id="harga-total" class="text-right" ></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-right"  >
                                            <label>TOTAL</label>
                                        </td>
                                        <td id="sub-total" class="text-right" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="text-right" >
                                            <label>DISC</label>
                                        </td>
                                        <td>
                                            <input type="text" name="disc" class="form-control text-right">
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="text-right" >
                                            <label>TOTAL BAYAR</label>
                                        </td>
                                        <td id="grand-total-bawah" class="grand-total text-right" ></td>
                                        <td></td>
                                    </tr>

                                </tfoot>
                            </table>
                        </div>
                        <!-- End of input data barang -->
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->
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

            var strBarang = '{"barang" : [] }';
            var brObj = JSON.parse(strBarang);

            //setting auto numeric
            $('input[name=disc], input[name=harga_salesman]').autoNumeric('init',{
                vMin:'0',
                vMax:'999999999'
            });

            //set datetimepicker
            $('#input-tanggal').datepicker({
                format: 'dd-mm-yyyy',
                todayHighlight: true,
                autoclose: true
            }).on('changeDate',function(env){
                $('select[name=pembayaran]').focus();
            });

            //sembunyikan input qty & harga salesman
            $('input[name=qty]').hide();
            $('input[name=harga_salesman]').hide();

            //set autocomplete
            $('input[name=barang]').autocomplete({
                serviceUrl: 'penjualan/jual/get-barang',
                params: {  'nama': function() {
                                return $('input[name=barang]').val();
                            }
                        },
                onSelect:function(suggestions){
                    //set kode dan satuan
                    $('input[name=kode]').val(suggestions.kode);
                    $('input[name=qty]').parent().next().html(suggestions.sat);
                    $('input[name=id_barang]').val(suggestions.data);
                    //fokuskan ke qty
                    //enablekan input qty
                    $('input[name=qty],input[name=harga_salesman]').show();
                    $('input[name=harga_salesman],input[name=qty]').val('');
                    $('input[name=harga_salesman]').focus();
                }

            });
            //autocomplete dengan kode
            $('input[name=kode]').autocomplete({
                serviceUrl: 'penjualan/jual/get-barang-by-kode',
                params: {  'nama': function() {
                                return $('input[name=kode]').val();
                            }
                        },
                onSelect:function(suggestions){
                    //set kode dan satuan
                    $('input[name=barang]').val(suggestions.nama);
                    $('input[name=qty]').parent().next().html(suggestions.sat);
                    $('input[name=id_barang]').val(suggestions.data);
                     $('#harga-satuan').text(numeral(suggestions.harga_jual_current).format('0,0'));
                    // $('#harga-satuan').numeral(suggestions.harga_jual_current,'0.0');
                    //fokuskan ke qty
                    //enablekan input qty
                    $('input[name=qty],input[name=harga_salesman]').show();
                    $('input[name=harga_salesman],input[name=qty]').val('');
                    $('input[name=harga_salesman]').focus();
                }

            });
            //autocomplete salesman
            $('input[name=salesman]').autocomplete({
                serviceUrl: 'penjualan/jual/get-salesman',
                params: {  'nama': function() {
                                return $('input[name=salesman]').val();
                            }
                        },
                onSelect:function(suggestions){
                    //set salesman id
                    $('input[name=salesman_id]').val(suggestions.data);
                    //set focus ke tanggal
                    $('input[name=tanggal]').focus();
                }

            });
            //autocomplete customer
            $('input[name=customer]').autocomplete({
                serviceUrl: 'penjualan/jual/get-customer',
                params: {  'nama': function() {
                                return $('input[name=customer]').val();
                            }
                        },
                onSelect:function(suggestions){
                    //set customer id
                    $('input[name=customer_id]').val(suggestions.data);
                    //set focus ke salesman
                    $('input[name=salesman]').focus();
                }

            });

            //qty press
            //tambah barang ke tabel
            $('input[name=qty]').keypress(function(e){
                if(e.keyCode == 13){

                    var qty = $('input[name=qty]').val();
                    //cek apakah qty lebih dari 0
                    if(qty > 0){
                        //tombol enter press
                        //tambahkan barang ke tabel

                        var id_barang = $('input[name=id_barang]').val();
                        
                        var harga = $('#harga-satuan').text();
                        harga = harga.replace(/\./g, "");
                        harga = harga.replace(/,/g, "");

                        var kode = $('input[name=kode]').val();
                        // alert('kode : ' + kode);
                        var nama_barang = $('input[name=barang]').val();
                        // alert('nama : ' + nama_barang);
                        var satuan = $('input[name=qty]').parent().next().text();
                        // alert('satuan : ' + satuan);
                        var total = qty * harga;
                        // alert('total : ' + total);
                        
                        //add barang ke JSON
                        brObj.barang.push({
                            id:id_barang,
                            qty:qty,
                            harga:harga
                        });
                        
                        // tampilkan new row tabel barang
                        var newrow = '<tr>\n\
                                        <td>' + kode + '</td>\n\
                                        <td>' + nama_barang + '</td>\n\
                                        <td class="text-right" >' + numeral(harga).format('0,0') + '</td>\n\
                                        <td class="text-right" >' + qty + '</td>\n\
                                        <td>' + satuan + '</td>\n\
                                        <td class="text-right" >' + numeral(total).format('0,0') + '</td>\n\
                                        <td></td>\n\
                                    </tr>';
                        //mamsukkan new row ke table
                        $('#table-barang tbody').append(newrow);

                        //clear input
                        $('input[name=kode],input[name=barang],input[name=qty]').val('')
                        $('#harga-total,#harga-satuan,#label-satuan').text('');
                        $('input[name=kode]').focus();
                        //sembunyikan input qty
                        $('input[name=qty]').hide();

                        //hitung grand total
                        hitungGrandTotal();

                    }else{
                        alert('Kuantity belum ditentukan');
                    }
                }
            });

            //hitung total harga
            $('input[name=qty]').keyup(function(e){
                var qty = $(this).val();
                var harga = $('#harga-satuan').text();
                    harga = harga.replace(/\./g, "");
                    harga = harga.replace(/,/g, "");
                var total = harga * qty;

                $('#harga-total').text(numeral(total).format('0,0'));

            });

            
            function hitungGrandTotal(){
                var sub_total = 0;
                var grand_total = 0;
                var disc = $('input[name=disc]').val();
                if(disc == "") disc = 0;

                $.each(brObj.barang,function(i,data){
                    sub_total = sub_total + (data.harga * data.qty);
                });

                grand_total = sub_total - disc;

                //tampilkan sub_total & grand_total
                $('#sub-total').text(numeral(sub_total).format('0,0'));
                $('.grand-total').text(numeral(grand_total).format('0,0'));
            }

            //cancel add barang
            $('input[name=kode],input[name=barang],input[name=qty]').keyup(function(e){
                //cancel button
                if(e.keyCode == 27){
                    //clear input
                    $('input[name=kode],input[name=barang],input[name=qty]').val('')
                    $('#harga-total,#harga-satuan,#label-satuan').text('');
                    $('input[name=kode]').focus();
                    //sembunyikan input qty
                    $('input[name=qty]').hide();
                }
            });

            //clear customer
            $('#btn-clear-customer').click(function(){
                $('input[name=customer]').val('');
                $('input[name=id_customer]').val('');
            });

            //clear sales man
            $('#btn-clear-salesman').click(function(){
                $('input[name=salesman]').val('');
                $('input[name=id_salesman]').val('');
            });

            // //exit
            // $('#btn-exit').click(function(){
            //     alert('ok');
            // });


        // END OF JQUERY
        })(jQuery);
    </script>
@append
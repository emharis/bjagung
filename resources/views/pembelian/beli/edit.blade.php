@extends('layouts.master')

@section('styles')
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>

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
        Edit Data Pembelian
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
                                <input type="text" name="no_inv" class="form-control" value="{{$beli->no_inv}}" autofocus>
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td>
                                <input id="tanggal" type="text" name="tanggal" class="form-control" value="{{$beli->tgl_formatted}}" >
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4" ></div>
            <div class="col-sm-4 col-md-4 col-lg-4" >
                <input type="hidden" name="id_pembelian" value="{{$beli->id}}">
                <table class="table table-bordered table-condensed" >
                    <tbody>
                        <tr>
                            <td>Supplier</td>
                            <td>:</td>
                            <td>
                                <select name="supplier" class="form-control" >
                                    @foreach($suppliers as $dt)
                                        <option value="{{$dt->id}}" {{$dt->id == $beli->supplier_id ? 'selected':''}} data-tempo="{{$dt->jatuh_tempo}}" >{{strtoupper($dt->nama)}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Pembayaran</td>
                            <td>:</td>
                            <td>
                                <select class="form-control" name="pembayaran" >
                                    <option value="T" {{$beli->tipe == 'T' ? 'selected':''}} >TUNAI/LUNAS</option>
                                    <option value="K" {{$beli->tipe == 'K' ? 'selected':''}} >KREDIT/TEMPO</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- <div class="col-sm-12 col-md-12 col-lg-12 " > -->

            <table class="table table-bordered table-striped table-hover" id="table-barang" >
                <thead>
                    <tr>
                        <th class="col-sm-2 col-md-2 col-lg-2" >KODE</th>
                        <th>KATEGORI/NAMA</th>
                        <th class="col-sm-1 col-md-1 col-lg-1" >QTY</th>
                        <th>SAT</th>
                        <th class="col-sm-2 col-md-2 col-lg-2" >HARGA/SATUAN</th>
                        <th class="col-sm-2 col-md-2 col-lg-2" >TOTAL</th>
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
                    @foreach($beli_barang as $dt)
                        <tr data-id="{{$dt->barang_id}}" >
                            <td>{{$dt->kode}}</td>
                            <td>{{$dt->nama_barang_full}}</td>
                            <td class='text-right td-qty' >{{$dt->qty}}</td>
                            <td>{{$dt->satuan}}</td>
                            <td class='text-right td-harga' >{{number_format($dt->harga,0,'.',',')}}</td>
                            <td class='text-right td-total' >{{number_format($dt->total,0,'.',',')}}</td>
                            <td class='text-center' >
                                    <a class='btn-delete ' href='#' ><i class='fa fa-trash text-red' ></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td  style="border-top-width: 3px; border-top-color: grey;"  colspan="5 " class="text-right" >
                            <label>TOTAL</label>
                        </td>
                        <td  style="border-top-width: 3px; border-top-color: grey;"  class="text-right"  >
                            <label id="label-total">{{$beli->total}}</label>
                        </td>
                        <td  style="border-top-width: 3px; border-top-color: grey;"  ></td>
                    </tr>
                    <tr>
                        <td   colspan="5 " class="text-right" >
                            <label>DISC</label>
                        </td>
                        <td  class="text-right"  >
                            <input type="text" name="disc" class="form-control text-right" value="{{$beli->disc}}" >
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="5 " class="text-right" >
                            <label>JUMLAH TOTAL</label>
                        </td>
                        <td    class="text-right"  >
                            <label id="label-grand-total" >{{$beli->grand_total}}</label>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="4" ></td>
                        <td>
                            <a class="btn btn-primary col-xs-12" id="btn-save" >SAVE</a>
                        </td>
                        <td>
                            <a class="btn btn-danger col-xs-12" id="btn-cancel" href="pembelian/beli" >CANCEL</a>
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <!-- hidden id barang -->
            <input type="hidden" name="id_barang">
        <!-- </div> -->

        </div><!-- /.box-body -->
    </div><!-- /.box -->

    <input type="hidden" name="data_barang_json" value="{{$data_barang_json}}" >

</section><!-- /.content -->
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
    // alert($('input[name=data_barang_json]').val());

    var strBarang = '{"barang" : [] }';
    var brObj = JSON.parse($('input[name=data_barang_json]').val());

    //set datetimepicker
    $('#tanggal').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true
    });

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
        vMin:'0',
        vMax:'999999999'
    });
    $('#col-total,#label-total, #label-grand-total, input[name=disc]').autoNumeric('init',{
        vMin:'0',
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

    function hitungGrandTotal(){
        var grandTotal = 0;
        var total = 0;
        var disc = $('input[name=disc]').val();
        disc = disc.replace(/\./g, "");
        disc = disc.replace(/,/g, "");


         $.each(brObj.barang,function(i,data){
            total += data.harga * data.qty;
         });

         grandTotal = total - disc;

         $('#label-total').autoNumeric('set',total);
         $('#label-grand-total').autoNumeric('set',grandTotal);
         // $('#label-total').html(grandTotal);
    }

    //tambahkan barang
    $('input[name=harga]').keyup(function(e){
        if(e.keyCode == 13){
            var newrow = "<tr data-id=" + $('input[name=id_barang]') .val() + " >\n\
            <td>" + $('input[name=kode]').val() + "</td>\n\
            <td>" + $('input[name=nama]').val() + "</td>\n\
            <td class='text-right td-qty' >" + $('input[name=qty]').val() + "</td>\n\
            <td>" + $('input[name=qty]').parent().next().text() + "</td>\n\
            <td class='text-right td-harga' >" + $('input[name=harga]').val() + "</td>\n\
            <td class='text-right td-total' >" + $('input[name=harga]').parent().next().text() + "</td>\n\
            <td class='text-center' >\n\
                    <a class='btn-delete ' href='#' ><i class='fa fa-trash text-red' ></i></a>\n\
            </td>\n\
            </tr>";
            //tambahkan row ke table
            $('#table-barang tbody').append(newrow);
            //tambahkan barang ke JSON
            brObj.barang.push({
                id:$('input[name=id_barang]').val(),
                qty:$('input[name=qty]').val(),
                harga:$('input[name=harga]').autoNumeric('get')
            });

            //clear input
            $('input[name=kode]').val('');
            $('input[name=nama]').val('');
            $('input[name=harga]').val('');
            $('input[name=harga]').parent().next().html('');
            $('input[name=qty]').val('');
            $('input[name=qty]').parent().next().html('');
            //fokuskan ke input kode
            $('input[name=kode]').focus();

            //hitung grand total
            hitungGrandTotal();
        }
    });


    //save with button save
    $('#btn-save').click(function(event) {
        //cek submit
        var beli_id = $('input[name=id_pembelian]').val() ;
        var inv = $('input[name=no_inv]').val() ;
        var tgl = $('input[name=tanggal]').val() ;
        var sup = $('select[name=supplier]').val() ;
        var pemb = $('select[name=pembayaran]').val() ;
        var disc = $('input[name=disc]').autoNumeric('get') ;
        if(inv != "" && tgl != "" && sup != "" && pemb != "" && brObj.barang.length > 0 ){
            var newForm = jQuery('<form>', {
                'action': 'pembelian/beli/update',
                'method': 'POST'
            }).append(jQuery('<input>', {
                'name': 'tanggal',
                'value': tgl,
                'type': 'hidden'
            })).append(jQuery('<input>', {
                'name': 'id_pembelian',
                'value': beli_id,
                'type': 'hidden'
            })).append(jQuery('<input>', {
                'name': 'no_inv',
                'value': inv,
                'type': 'hidden'
            })).append(jQuery('<input>', {
                'name': 'supplier',
                'value': sup,
                'type': 'hidden'
            })).append(jQuery('<input>', {
                'name': 'tipe',
                'value': pemb,
                'type': 'hidden'
            })).append(jQuery('<input>', {
                'name': 'barang',
                'value': JSON.stringify(brObj),
                'type': 'hidden'
            })).append(jQuery('<input>', {
                'name': 'disc',
                'value': disc,
                'type': 'hidden'
            }));

            newForm.submit();
        }else{
            alert('Lengkapi data yang kosong');
            // fokuskan ke input no inv
            $('input[name=no_inv]').focus();
        }

        return false;
    });

    //edit quantity
    var edit_state = false;
    var default_value_edit_qty=0;
    $(document).on('dblclick','.td-qty',function(event) {
        if(edit_state != true){
            if($(this).children('input').length == 0){
                var text = $(this).text();
                default_value_edit_qty = text;
                //ganti dengan textbox
                $(this).html('<input type="text" name="edit_qty" value="' + text + '" class="text-right form-control" >');
                //focuskan
                $('input[name=edit_qty]').focus().select();                

                //set edit state
                setEditState(true);
            }
        }
    });

    //binding dan prevent untuk lost focus
    $(document).on('blur','input[name=edit_qty],input[name=edit_harga]',function(e){
        $(this).focus();
    });

    //fungsi set edit state
    function setEditState(val){
        edit_state  =val;
        if(val){
            //jika dalam mode edit
            ////disable tombol save
            $('#btn-save').addClass('disabled');
        }else{
            //jika dalam mode normal
            ////enable tombol save
            $('#btn-save').removeClass('disabled');
        }
    }

    //save edit quantity
    $(document).on('keyup','input[name=edit_qty]',function(e){
        if(e.keyCode == 13){
            //ganti text qty
            var rowObj = $(this).parent().parent();
            var qty_text = $(this).val();
            var barangId = rowObj.data('id');

            //ganti input dengan text quantity
            $(this).parent().html(qty_text);

            //hitung ulang total
            hitungUlangTotalHarga(rowObj);

            //rubah data yang ada di array json
            $.each(brObj.barang,function(i,data){
                if(data.id == barangId){
                    data.qty = qty_text;
                }
            });

            //hitung ulang grandtotal
            hitungGrandTotal();

            //edit state to false
            setEditState(false);

        }else if(e.keyCode == 27){
            //cancel edit
            $(this).parent().html(default_value_edit_qty);

            //edit state to false
            setEditState(false);
        }
    });

    //test button
    $('#btn-test').click(function(){
        $.each(brObj.barang,function(i,data){
               alert(data.harga); 
            });
        return false;
    });

    //hitung ulang total harga
    function hitungUlangTotalHarga(rowObj){
        var qty = rowObj.children('td:first').next().next().text();
        
        var harga = rowObj.children('td:first').next().next().next().next().text();
        //normalize harga dari titik dan koma
        harga = harga.replace(/\./g, "");
        harga = harga.replace(/,/g, "");
        //hitung total
        var total = qty*harga;
        //ganti total ke row table
        var tdtotal = rowObj.children('td:first').next().next().next().next().next();
        tdtotal.text(numeral(total).format('0,0'));

    }

    //edit harga satuan
    var default_value_edit_harga=0;
    $(document).on('dblclick','.td-harga',function(event) {
        if(edit_state != true){
            if($(this).children('input').length == 0){
                var text_harga = $(this).text();
                //normalize text_harga
                text_harga = text_harga.replace(/\./g, "");
                text_harga = text_harga.replace(/,/g, "");
                //set default harga
                default_value_edit_harga = text_harga;
                //ganti dengan textbox
                $(this).html('<input type="text" name="edit_harga" value="' + text_harga + '" class="text-right form-control" >');
                //focuskan
                $('input[name=edit_harga]').focus().select();                

                //set edit state
                setEditState(true);
            }
        }
    });
    //simpan perubahan harga
    $(document).on('keyup','input[name=edit_harga]',function(e){
        if(e.keyCode == 13){
            //ganti text qty
            var rowObj = $(this).parent().parent();
            var harga_text = $(this).val();
            var barangId = rowObj.data('id');

            //ganti input dengan text quantity
            $(this).parent().html(numeral(harga_text).format('0,0'));

            //hitung ulang total
            hitungUlangTotalHarga(rowObj);

            //rubah data yang ada di array json
            $.each(brObj.barang,function(i,data){
                if(data.id == barangId){
                    data.harga = harga_text;
                }
            });

            //hitung ulang grandtotal
            hitungGrandTotal();

            //edit state to false
            setEditState(false);

        }else if(e.keyCode == 27){
            //cancel edit harga
            $(this).parent().html(numeral(default_value_edit_harga).format('0,0'));

            //edit state to false
            setEditState(false);
        }
    });

    //perhitungan discount key up
    $('input[name=disc]').keyup(function(){
        hitungGrandTotal();
    });

    //delete barang
    $(document).on('click','.btn-delete',function(e){
        var trObj = $(this).parent().parent();
        //hapus dari array object
        var ind;
        $.each(brObj.barang,function(i,data){
            if(data.id == trObj.data('id')){
                ind = i;
            }
        });
        //delete from brObj
        brObj.barang.splice(ind,1);

        //remove row object
        trObj.fadeOut(250,null,function(){
            trObj.remove();
            //hitung ulang grand total
            hitungGrandTotal();
        });

        return false;
    });




})(jQuery);
</script>
@append

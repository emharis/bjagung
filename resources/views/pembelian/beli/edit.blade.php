@extends('layouts.master')

@section('styles')
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
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
                <table class="table table-bordered table-condensed table-row-mid" >
                    <tbody>
                        <tr>
                            <td>No. Invoice</td>
                            <td>:</td>
                            <td>
                                <input value="{{$beli->no_inv}}" type="text" name="no_inv" class="form-control text-uppercase" autofocus>
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td>
                                <input value="{{$beli->tgl_formatted}}" id="tanggal" type="text" name="tanggal" class="form-control" value="{{date('d-m-Y')}}" >
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4" ></div>
            <div class="col-sm-4 col-md-4 col-lg-4" >
                <table class="table table-bordered table-condensed table-row-mid" >
                    <tbody>
                        <tr>
                            <td>Supplier</td>
                            <td>:</td>
                            <td>
                                <select name="supplier" class="form-control" >
                                    @foreach($suppliers as $dt)
                                        <option {{$dt->id == $beli->supplier_id ? 'selected':''}} value="{{$dt->id}}" data-tempo="{{$dt->jatuh_tempo}}" >{{strtoupper($dt->nama)}}</option>
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

        <!--data pembelian & barang json-->
        <div  id="beli_json" class="hide" >{{json_encode($beli)}}</div>
        <div id="barang_json" class="hide" >{{json_encode($beli_barang)}}</div>

        <!-- <div class="col-sm-12 col-md-12 col-lg-12 " > -->

        <table class="table table-bordered table-striped table-hover table-row-mid" id="table-barang" >
            <thead>
                <tr>
                    <th>KATEGORI/NAMA</th>
                    <th class="col-sm-1 col-md-1 col-lg-1" >QTY</th>
                    <th>SAT</th>
                    <th class="col-sm-2 col-md-2 col-lg-2" >HARGA/SATUAN</th>
                    <th class="col-sm-2 col-md-2 col-lg-2" >JUMLAH</th>
                    <th style="width:100px;"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" name="nama" id="nama_autocomplete" class="form-control text-uppercase">
                    </td>
                    <td>
                        <input type="number" min="1" name="qty" class="form-control text-right">
                    </td>
                    <td id="label-satuan"></td>
                    <td>
                        <input type="text" name="harga" class="form-control text-right">
                    </td>
                    <td class="text-right" id="col-total" ></td>
                    <td class="text-center" >
                        <a class="btn btn-primary btn-sm" id="btn-add-barang" ><i class="fa fa-plus" ></i></a>
                        <a class="btn btn-danger btn-sm" id="btn-cancel-add-barang" ><i class="fa fa-close" ></i></a>
                    </td>
                </tr>
                <?php $rowid=1; ?>
                @foreach($beli_barang as $dt)
                <tr data-rowid="{{$rowid++}}" data-kode="{{$dt->kode}}" class="row-barang" data-idbarang="{{$dt->barang_id}}">
                    <td>{{$dt->kode . '  ' . $dt->nama_barang_full}}</td>
                    <td>
                        <input min="1" type="number" class="form-control input-qty-on-row text-right" value="{{$dt->qty}}" >
                    </td>
                    <td>{{$dt->satuan}}</td>
                    <td>
                        <input class="form-control input-harga-on-row text-right" value="{{$dt->harga}}" >
                    </td>
                    <td class="text-right">{{number_format($dt->total,0,'.',',')}}</td>
                    <td class="text-center">
                        <a class="btn-delete-barang-on-row btn btn-danger btn-xs">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td  style="border-top-width: 3px; border-top-color: grey;"  colspan="4" class="text-right" >
                        <label>TOTAL</label>
                    </td>
                    <td  style="border-top-width: 3px; border-top-color: grey;"  class="text-right"  >
                        <label id="label-total">{{$beli->total}}</label>
                    </td>
                    <td  style="border-top-width: 3px; border-top-color: grey;"  ></td>
                </tr>
                <tr>
                    <td   colspan="4" class="text-right" >
                        <label>DISC</label>
                    </td>
                    <td  class="text-right"  >
                        <input type="text" name="disc" class="form-control text-right" value="{{$beli->disc}}" >
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td    colspan="4" class="text-right" >
                        <label>TOTAL BAYAR</label>
                    </td>
                    <td    class="text-right"  >
                        <label id="label-total-bayar" >{{$beli->grand_total}}</label>
                    </td>
                    <td    ></td>
                </tr>
                <tr>
                    <td colspan="4" ></td>
                    <td>
                        <a class="btn btn-primary col-xs-12" id="btn-save" >SAVE</a>
                    </td>
                    <td>
                        <a class="btn btn-danger col-xs-12" id="btn-cancel" href="pembelian/beli" >EXIT</a>
                    </td>
                </tr>
            </tfoot>
        </table>
        <!-- hidden id barang -->
        <input type="hidden" name="id_barang">
        <!-- hidden kode barang -->
        <input type="hidden" name="kode">
        <!-- </div> -->

        </div><!-- /.box-body -->
    </div><!-- /.box -->

    <a id="btn-test" ><!-- TEST --></a>

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

    // ==================================================================
    // ------------------------------------------------------------------
    // START OF JQUERY
    // ------------------------------------------------------------------
    // ==================================================================

    // XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

    // ==================================================================
    // JUDUL SUB CODE
    // ------------------------------------------------------------------
    // contoh komen
    // ------------------------------------------------------------------
    // END OF JUDUL SUB CODE
    // ==================================================================

    // XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

    // ==================================================================
    // MEMBERS VARIABLE DECLARATION
    // ------------------------------------------------------------------
    var strBarang = '{"barang" : [] }';
    var OBJ_BELI = {"no_inv":"", "supplier_id":"","tanggal":"","pembayaran":"","total":"","disc":"","total_bayar":""};;
    var OBJ_BARANG = JSON.parse(strBarang);
    var TBL_BARANG = $('#table-barang');
    var ROW_BARANG_ID = 1;
    // ------------------------------------------------------------------
    // END OF MEMBERS VARIABLE DECLARATION
    // ==================================================================


    // ==================================================================
    // INISIALISASI ELEMENT
    // ------------------------------------------------------------------
    // set kosong input pembelian
    // disable input qty dan harga barang
    $('input[name=qty]').attr('disabled','disabled');
    $('input[name=harga]').attr('disabled','disabled');
    // end of disable input qty dan harga barang
    // xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
    // set datetimepicker
    $('#tanggal').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true
    });
    // end of set datetimepicker
    // xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
    // set auto complete
    $('#nama_autocomplete').autocomplete({
        serviceUrl: 'pembelian/beli/get-barang',
        params: {  'nama': function() {
                        return $('input[name=nama]').val();
                    }
                },
        onSelect:function(suggestions){
            // set kode dan satuan
            $('input[name=kode]').val(suggestions.kode);
            $('input[name=qty]').parent().next().html(suggestions.sat);
            $('input[name=id_barang]').val(suggestions.data);
            // enablekan input qty
            $('input[name=qty]').removeAttr('disabled');
            // fokuskan ke qty
            $('input[name=qty]').focus();
            //enable kan input harga
            $('input[name=harga]').removeAttr('disabled');
            //disablekan input nama barang
            $('input[name=nama]').attr('disabled','disabled');
        }

    });
    // end of set autocomplete
    // xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
    // set auto numeric
    var colTotal = $('input[name=harga]').parent().next();
    $('.input-harga-on-row').autoNumeric('init',{
        vMin:'0',
        vMax:'999999999'
    });
    $('input[name=harga]').autoNumeric('init',{
        vMin:'0',
        vMax:'999999999'
    });
    $('#col-total,#label-total, #label-total-bayar, input[name=disc]').autoNumeric('init',{
        vMin:'0',
        vMax:'999999999'
    });
    // end of set auto numeric
    // ------------------------------------------------------------------
    // END OF INISIALISASI ELEMENT
    // ==================================================================    

    
    // ==================================================================
    // FUNGSI HITUNG JUMLAH HARGA BARANG ON ADD BARANG
    // ------------------------------------------------------------------
    function hitungJumlahHargaBarang(){
        var qty = $('input[name=qty]').val();
        var harga = $('input[name=harga]').autoNumeric('get');
        var total = qty * harga;
        $('#col-total').autoNumeric('set',total);
    } 
    // ------------------------------------------------------------------
    // END OF FUNGSI HITUNG JUMLAH HARGA BARANG ON ADD BARANG
    // ==================================================================


    // ==================================================================
    // FUNGSI TAMBAHKAN BARANG KE DALAM TABLE
    // ------------------------------------------------------------------
    function addBarangToTable(){
        var nama = $('input[name=nama]').val();
        var qty = $('input[name=qty]').val();
        var harga_satuan = $('input[name=harga]').autoNumeric('get');
        var satuan = $('#label-satuan').text();
        var total_harga = Number(harga_satuan) * Number(qty);

        // cek qty dan harga barang apakah memenuhi syarat
        if(qty > 0 && harga_satuan > 0){
            var newrow = $('<tr>').attr('data-rowid',ROW_BARANG_ID).attr('data-kode',$('input[name=kode]').val()).addClass('row-barang').attr('data-idbarang',$('input[name=id_barang]').val());
            newrow.append($('<td>').text(nama));
            newrow.append($('<td>').html($('<input>').attr('min',1).attr('type','number').addClass('form-control').addClass('input-qty-on-row').addClass('text-right').val(qty)));
            newrow.append($('<td>').text(satuan));
            newrow.append($('<td>').html($('<input>').addClass('form-control').addClass('input-harga-on-row').addClass('text-right').val(numeral(harga_satuan).format('0,0') )));
            newrow.append($('<td>').addClass('text-right').text(numeral(total_harga).format('0,0')));
            newrow.append($('<td>').addClass('text-center').html($('<a>').addClass('btn-delete-barang-on-row btn btn-danger btn-xs ').append($('<i>').addClass('fa fa-trash'))));

            TBL_BARANG.children('tbody').append(newrow);

            //format auto numemric input harga on row
            $('.input-harga-on-row').autoNumeric('init',{
                vMin:'0',
                vMax:'999999999'
            });

            // increment row id
            ROW_BARANG_ID++;

            // // tambahkan barang ke JSON
            // OBJ_BARANG.barang.push({
            //     id:$('input[name=id_barang]').val(),
            //     qty:$('input[name=qty]').val(),
            //     harga:$('input[name=harga]').autoNumeric('get')
            // });

            // clear input
            $('input[name=kode]').val('');
            $('input[name=nama]').val('');
            $('input[name=harga]').val('');
            // clear total
            $('input[name=harga]').parent().next().html('');
            $('input[name=qty]').val('');
            // clear satuan
            $('input[name=qty]').parent().next().html('');
            // disablekan input qty dan harga
            $('input[name=qty], input[name=harga]').attr('disabled','disabled'); 
            // enablekan input nama
            $('input[name=nama]').removeAttr('disabled');
            // fokuskan ke input nama
            $('input[name=nama]').focus();
            // normalkan is_first_focus
            is_first_focus = true;

            // hitung total & total bayar
            hitungTotalAndTotalBayar();
        }else{
            alert('Lengkapi data yang kosong.');
        }
    } 
    // ------------------------------------------------------------------
    // END OF FUNGSI TAMBAHKAN BARANG KE DALAM TABLE
    // ==================================================================


    // ==================================================================
    // INPUT HARGA KEY UP EVENT
    // ------------------------------------------------------------------
    $('input[name=harga]').keyup(function(e){
        if(e.keyCode == 13){
            // tambahkan barang ke table
            addBarangToTable();
        }else{
            hitungJumlahHargaBarang();
        }
    });
    // ------------------------------------------------------------------
    // END OF INPUT HARGA KEY UP EVENT
    // ==================================================================


    // ==================================================================
    // INPUT QTY KEY UP EVENT
    // ------------------------------------------------------------------
    var is_first_focus = true;
    $('input[name=qty]').keyup(function(e){
        if(e.keyCode == 13){
            // fokuskan ke input harga
            if(!is_first_focus){
                $('input[name=harga]').focus();   
            }else{
                is_first_focus = false;
            }
        }else{
            // hitung jumlah harga barang
            hitungJumlahHargaBarang();
        }
    });
    // ------------------------------------------------------------------
    // END OF INPUT QTY KEY UP EVENT
    // ==================================================================


    // ==================================================================
    // INPUT QTY ON CHANGED
    // ------------------------------------------------------------------
    $(document).on('input','input[name=qty]',function(e){
            // hitung jumlah harga barang
            hitungJumlahHargaBarang();
    });
    // ------------------------------------------------------------------
    // END OF INPUT QTY ON CHANGE
    // ==================================================================


    // ==================================================================
    // BUTTON ADD BARANG CLICK
    // ------------------------------------------------------------------
    $('#btn-add-barang').click(function(){
        addBarangToTable();
    });
    // ------------------------------------------------------------------
    // END OF BUTTON ADD BARANG CLICK
    // ==================================================================


    // ==================================================================
    // BUTTON CANCEL ADD BARANG CLICK
    // ------------------------------------------------------------------
    $('#btn-cancel-add-barang').click(function(){
        // clear input
        $('input[name=kode]').val('');
        $('input[name=nama]').val('');
        $('input[name=harga]').val('');
        // clear total
        $('input[name=harga]').parent().next().html('');
        $('input[name=qty]').val('');
        // clear satuan
        $('input[name=qty]').parent().next().html('');
        // disablekan input qty dan harga
        $('input[name=qty], input[name=harga]').attr('disabled','disabled'); 
        // enablekan input nama
        $('input[name=nama]').removeAttr('disabled');
        // fokuskan ke input nama
        $('input[name=nama]').focus();
        // normalkan is_first_focus
        is_first_focus = true;
    });
    // ------------------------------------------------------------------
    // END OF BUTTON CANCEL ADD BARANG CLICK
    // ==================================================================


    // ==================================================================
    // FUNGSI HITUNG TOTAL & TOTAL BAYAR
    // ------------------------------------------------------------------
    function hitungTotalAndTotalBayar(){
        var total = 0;
        var total_bayar = 0;
        var disc = $('input[name=disc]').val();
        disc = disc.replace(/\./g, "");
        disc = disc.replace(/,/g, "");

        $('#table-barang > tbody > tr.row-barang').each(function(i){
            var first_col = $(this).children('td:first');
            var qty = first_col.next().children('input').val();
            var harga_satuan = first_col.next().next().next().children('input').val();
            harga_satuan = harga_satuan.replace(/\./g, "");
            harga_satuan = harga_satuan.replace(/,/g, "");
            total += Number(qty) * Number(harga_satuan);
        });

        total_bayar = Number(total) - Number(disc);

        //tampilkan total & total bayar
        $('#label-total').text(numeral(total).format('0,0'));
        $('#label-total-bayar').text(numeral(total_bayar).format('0,0'));

    }
    // ------------------------------------------------------------------
    // END OF FUNGSI TOTAL & TOTAL BAYAR
    // ==================================================================


    // ==================================================================
    // FUNGSI HITUNG JUMLAH HARGA BARANG ON ROW
    // ------------------------------------------------------------------
    function hitungJumlahHargaOnRow(row){
        var first_col = row.children('td:first');
        var qty  = first_col.next().children('input').val();
        var harga_satuan = first_col.next().next().next().children('input').autoNumeric('get');
        var jumlah_harga = Number(qty) * Number(harga_satuan);
        //tampilkan harga di table row
        first_col.next().next().next().next().text(numeral(jumlah_harga).format('0,0'));    
    }
    // ------------------------------------------------------------------
    // END OF FUNGSI HITUNG JUMLAH HARGA BARANG ON ROW
    // ==================================================================


    // ==================================================================
    // DELETE BUTTON ON ROW CLICK
    // ------------------------------------------------------------------
    $(document).on('click','.btn-delete-barang-on-row',function(){
        var row = $(this).parent().parent();
        if(confirm('Anda akan menghapus data ini?')){
            row.fadeOut(250,null,function(){
                row.remove();
                hitungTotalAndTotalBayar();
            });
        }
    });
    // ------------------------------------------------------------------
    // END OF DELETE BUTTON ON ROW CLICK
    // ==================================================================    


    // ==================================================================
    // INPUT QTY ON ROW KEY UP
    // ------------------------------------------------------------------
    $(document).on('keyup','.input-qty-on-row',function(){
        hitungJumlahHargaOnRow($(this).parent().parent());
    });
    // ------------------------------------------------------------------
    // END OF INPUT QTY ON ROW KEY UP
    // ==================================================================


    // ==================================================================
    // INPUT QTY ON ROW CHANGED
    // ------------------------------------------------------------------
    $(document).on('input','.input-qty-on-row',function(){
        hitungJumlahHargaOnRow($(this).parent().parent());
    });
    // ------------------------------------------------------------------
    // END OF INPUT QTY ON ROW CHANGED
    // ==================================================================


    // ==================================================================
    // INPUT HARGA ON ROW CHANGED
    // ------------------------------------------------------------------
    $(document).on('keyup','.input-harga-on-row',function(){
        hitungJumlahHargaOnRow($(this).parent().parent());
    });
    // ------------------------------------------------------------------
    // END OF INPUT HARGA ON ROW CHANGED
    // ==================================================================


    // ==================================================================
    // INPUT DISC ON KEYUP
    // ------------------------------------------------------------------
    $('input[name=disc]').keyup(function(){
        //cek apakah diskon melebihi total bayar
        var total = $('#label-total').autoNumeric('get');
        var disc = $(this).val();
        disc = disc.replace(/\./g, "");
        disc = disc.replace(/,/g, "");

        if(Number(disc) > Number(total)){
            alert('Discount melebihi total harga');
            $(this).val(0);
            $(this).select();
        }else{
            hitungTotalAndTotalBayar();
        }
    });
    // ------------------------------------------------------------------
    // END OF INPUT DISC ON KEYUP
    // ==================================================================


    // ==================================================================
    // BUTTON SAVE CLICK
    // ------------------------------------------------------------------
    $('#btn-save').click(function(){
        //cek apakah sudah layak untuk disimpan
        if($('input[name=no_inv]').val() != "" && $('input[name=tanggal]').val() != "" && $('select[name=supplier]').val() != "" && $('select[name=pembayaran]').val() != ""  && $('#table-barang > tbody > tr.row-barang').length > 0 ){

            var no_inv = $('input[name=no_inv]').val();
            var tanggal = $('input[name=tanggal]').val();
            var supplier = $('select[name=supplier]').val();
            var pembayaran = $('select[name=pembayaran]').val();
            var total = 0;
            var disc = $('input[name=disc]').val();
            disc = disc.replace(/\./g, "");
            disc = disc.replace(/,/g, "");
            var total_bayar = 0;

            // set OBJ_BELI
            OBJ_BELI.no_inv = no_inv;
            OBJ_BELI.tanggal = tanggal;
            OBJ_BELI.supplier_id = supplier;
            OBJ_BELI.pembayaran = pembayaran;

            // set OBJ_BARANG
            $('#table-barang > tbody > tr.row-barang').each(function(i){
                row = $(this);
                var first_col = row.children('td:first');
                var row_id = row.data('rowid');
                var id_barang = row.data('idbarang');
                var kode = row.data('kode');      
                var nama = first_col.text();
                var qty = first_col.next().children('input').val();
                var satuan = first_col.next().next().text().trim();
                var harga_satuan = first_col.next().next().next().children('input').autoNumeric('get');
                var jumlah = Number(harga_satuan) * Number(qty);

                // set barang ke OBJ_BARANG
                OBJ_BARANG.barang.push({
                    id : id_barang,
                    nama_barang : nama,
                    kode : kode,
                    qty : qty,
                    harga_satuan : harga_satuan,
                    jumlah : jumlah
                });
                
                // hitung total
                total += Number(jumlah);
            });

            // hitung total bayar
            total_bayar = Number(total) - Number(disc);

            // set total, disc & total bayar ke OBJ_BELI
            OBJ_BELI.total = total;
            OBJ_BELI.disc = disc;
            OBJ_BELI.total_bayar = total_bayar;

            // $.each(OBJ_BARANG.barang,function(i,data){
            //     alert(i);
            //     alert(data.nama_barang);
            // });

            // alert("TOTAL " + OBJ_BELI.total);
            // alert("DISC " + OBJ_BELI.disc);
            // alert("TOTAL BAYAR " + OBJ_BELI.total_bayar);

            // Simpan Data Pembelian ke Database
            var newForm = jQuery('<form>', {
                'action': 'pembelian/beli/insert',
                'method': 'POST'
            }).append(jQuery('<input>', {
                'name': 'obj_beli',
                'value': JSON.stringify(OBJ_BELI),
                'type': 'hidden'
            })).append(jQuery('<input>', {
                'name': 'obj_barang',
                'value': JSON.stringify(OBJ_BARANG),
                'type': 'hidden'
            }));
            newForm.appendTo('body').submit();

        }else{
            alert('Lengkapi data yang kosong.');
        }
    });
    // ------------------------------------------------------------------
    // END OF BUTTON SAVE CLICK
    // ==================================================================


})(jQuery);
</script>
@append

@extends('layouts.master')

@section('styles')
    <!--Bootsrap Data Table-->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    	Master Barang
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-body">
            <a class="btn btn-primary btn-sm" id="btn-add-barang" ><i class="fa fa-plus" ></i> Add Barang</a>
            <div class="clearfix" ></div>
            <br/>
            <!-- Form add barang -->
            <form class="hide" name="form-add-barang" method="POST" action="master/barang/insert" >
            	<table class="table table-bordered table-condensed" >
            		<tbody>
            			<tr>
            				<td class="col-sm-2 col-md-2 col-lg-2" >Nama</td>
            				<td>
            					<input autocomplete="off" required type="text" class="form-control" name="nama" />
            				</td>
            			</tr>
            			<tr>
            				<td></td>
            				<td>
            					<button type="submit" class="btn btn-primary btn-sm" >Save</button>
            					<a href="#" class="btn btn-danger btn-sm" id="btn-cancel-add-barang" >Cancel</a>
            				</td>
            			</tr>
            		</tbody>
            	</table>
            </form>
            
            <!--table data barang-->
            <table class="table table-bordered table-condensed" id="table-datatable" >
            	<thead>
            		<tr>
            			<th class="col-sm-1 col-md-1 col-lg-1" >No</th>
            			<th>Nama</th>
            			<th class="col-sm-1 col-md-1 col-lg-1" ></th>
            		</tr>
            	</thead>
            	<tbody>
            		<?php $rownum=1; ?>
            		@foreach($data as $dt)
            		<tr>
            			<td class="text-right" >{{$rownum++}}</td>
            			<td>{{$dt->nama}}</td>
            			<td class="text-center" >
            				<a data-id="{{$dt->id}}" class="btn btn-success btn-xs btn-edit-barang" href="master/barang/edit/{{$dt->id}}" ><i class="fa fa-edit" ></i></a>
            				<a data-id="{{$dt->id}}" class="btn btn-danger btn-xs btn-delete-barang" href="master/barang/delete-barang/{{$dt->id}}" ><i class="fa fa-trash" ></i></a>
            			</td>
            		</tr>
            		@endforeach
            	</tbody>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

    <div class="modal" id="modal-edit-barang" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Barang</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="master/barang/update-barang" name="form-edit-barang" >
                        <input type="hidden" name="id" />
                        <table class="table table-bordered table-condensed" >
                            <tbody>
                                <tr>
                                    <td>Nama</td>
                                    <td>
                                        <input type="text" name="nama" class="form-control" autocomplete="OFF" />
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <button type="submit" class="btn btn-primary btm-sm">Save</button>
                                        <a data-dismiss="modal" class="btn btn-danger btn-sm" >Cancel</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div> 
        </div> 
    </div>

</section><!-- /.content -->
@stop

@section('scripts')
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
	(function ($) {
        //format datatable
        $('#table-datatable').dataTable();
        //tampilkan form new barang
        $('#btn-add-barang').click(function(){
            //tampilkan form new barang
            $('form[name=form-add-barang]').removeClass('hide');
            $('form[name=form-add-barang]').hide();
            $('form[name=form-add-barang]').slideDown(250,null,function(){
                //fokuskan
                $('form[name=form-add-barang] input[name=nama]').focus();
            });
        });

        //cancel add new
        $('#btn-cancel-add-barang').click(function(){
            $('form[name=form-add-barang]').slideUp(250,null,function(){
                //clear input
                $('form[name=form-add-barang] input[name=nama]').val(null);
            }); 
            return false;
        });

        //edit barang
        $('.btn-edit-barang').click(function(){
            var url = $(this).attr('href');
            var id = $(this).data('id');
            
            //get data barang
            $.get('master/barang/get-barang/'+id,null,function(data){
                var dataBarang = JSON.parse(data);
                
                //tampilkan data ke modal edit
                $('#modal-edit-barang input[name=id]').val(dataBarang.id);
                $('#modal-edit-barang input[name=nama]').val(dataBarang.nama);
                //fokuskan
                
                $('#modal-edit-barang').modal('show');
                $('#modal-edit-barang input[name=nama]').focus();
            });

            return false;
        });
        
        //delete barang
        $('.btn-delete-barang').click(function(){
            var id = $(this).data('id');
            var url = $(this).attr('href');
            if(confirm('Anda akan menghapus data ini..?')){
                location.href = url;
            }
            
            return false;
        });

	})(jQuery);
</script>
@append
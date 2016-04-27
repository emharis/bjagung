@extends('layouts.master')

@section('styles')
    <!--Bootsrap Data Table-->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    	Master Satuan Barang
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-body">
            <a class="btn btn-primary btn-sm" id="btn-add-satuan" ><i class="fa fa-plus" ></i> Add Satuan</a>
            <div class="clearfix" ></div>
            <br/>
            <!-- Form add satuan -->
            <form class="hide" name="form-add-satuan" method="POST" action="master/satuan/insert" >
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
            					<a href="#" class="btn btn-danger btn-sm" id="btn-cancel-add-satuan" >Cancel</a>
            				</td>
            			</tr>
            		</tbody>
            	</table>
            </form>
            
            <!--table data satuan-->
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
            				<a data-id="{{$dt->id}}" class="btn btn-success btn-xs btn-edit-satuan" href="master/satuan/edit/{{$dt->id}}" ><i class="fa fa-edit" ></i></a>
            				<a data-id="{{$dt->id}}" class="btn btn-danger btn-xs btn-delete-satuan" href="master/satuan/delete-satuan/{{$dt->id}}" ><i class="fa fa-trash" ></i></a>
            			</td>
            		</tr>
            		@endforeach
            	</tbody>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

    <div class="modal" id="modal-edit-satuan" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Satuan</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="master/satuan/update-satuan" name="form-edit-satuan" >
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
        //tampilkan form new satuan
        $('#btn-add-satuan').click(function(){
            //tampilkan form new satuan
            $('form[name=form-add-satuan]').removeClass('hide');
            $('form[name=form-add-satuan]').hide();
            $('form[name=form-add-satuan]').slideDown(250,null,function(){
                //fokuskan
                $('form[name=form-add-satuan] input[name=nama]').focus();
            });
        });

        //cancel add new
        $('#btn-cancel-add-satuan').click(function(){
            $('form[name=form-add-satuan]').slideUp(250,null,function(){
                //clear input
                $('form[name=form-add-satuan] input[name=nama]').val(null);
            }); 
            return false;
        });

        //edit satuan
        $('.btn-edit-satuan').click(function(){
            var url = $(this).attr('href');
            var id = $(this).data('id');
            
            //get data satuan
            $.get('master/satuan/get-satuan/'+id,null,function(data){
                var dataSatuan = JSON.parse(data);
                
                //tampilkan data ke modal edit
                $('#modal-edit-satuan input[name=id]').val(dataSatuan.id);
                $('#modal-edit-satuan input[name=nama]').val(dataSatuan.nama);
                //fokuskan
                
                $('#modal-edit-satuan').modal('show');
                $('#modal-edit-satuan input[name=nama]').focus();
            });

            return false;
        });
        
        //delete satuan
        $('.btn-delete-satuan').click(function(){
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
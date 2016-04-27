@extends('layouts.master')

@section('styles')
    <!--Bootsrap Data Table-->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    	Master Salesman
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-body">
            <a class="btn btn-primary btn-sm" id="btn-add-sales" ><i class="fa fa-plus" ></i> Add Sales</a>
            <div class="clearfix" ></div>
            <br/>
            <!-- Form add sales -->
            <form class="hide" name="form-add-sales" method="POST" action="master/sales/insert" >
            	<table class="table table-bordered table-condensed" >
            		<tbody>
            			<tr>
            				<td class="col-sm-2 col-md-2 col-lg-2" >Nama</td>
            				<td>
            					<input autocomplete="off" required type="text" class="form-control" name="nama" />
            				</td>
            			</tr>
            			<tr>
            				<td>Telp</td>
            				<td>
            					<input autocomplete="off" type="text" class="form-control" name="telp" />
            				</td>
            			</tr>
            			<tr>
            				<td></td>
            				<td>
            					<input autocomplete="off" type="text" class="form-control" name="telp_2" />
            				</td>
            			</tr>
            			<tr>
            				<td>Alamat</td>
            				<td>
            					<input autocomplete="off" type="text" class="form-control" name="alamat" />
            				</td>
            			</tr>
            			<tr>
            				<td></td>
            				<td>
            					<button type="submit" class="btn btn-primary btn-sm" >Save</button>
            					<a href="#" class="btn btn-danger btn-sm" id="btn-cancel-add-sales" >Cancel</a>
            				</td>
            			</tr>
            		</tbody>
            	</table>
            </form>
            
            <!--table data sales-->
            <table class="table table-bordered table-condensed" id="table-datatable" >
            	<thead>
            		<tr>
            			<th class="col-sm-1 col-md-1 col-lg-1" >No</th>
            			<th>Nama</th>
            			<th>Telp</th>
            			<th>Alamat</th>
            			<th class="col-sm-1 col-md-1 col-lg-1" ></th>
            		</tr>
            	</thead>
            	<tbody>
            		<?php $rownum=1; ?>
            		@foreach($data as $dt)
            		<tr>
            			<td class="text-right" >{{$rownum++}}</td>
            			<td>{{$dt->nama}}</td>
            			<td>{!! $dt->telp . '<br/>' .$dt->telp_2 !!}</td>
            			<td>{{$dt->alamat}}</td>
            			<td class="text-center" >
            				<a data-id="{{$dt->id}}" class="btn btn-success btn-xs btn-edit-sales" href="master/sales/edit/{{$dt->id}}" ><i class="fa fa-edit" ></i></a>
            				<a data-id="{{$dt->id}}" class="btn btn-danger btn-xs btn-delete-sales" href="master/sales/delete-sales/{{$dt->id}}" ><i class="fa fa-trash" ></i></a>
            			</td>
            		</tr>
            		@endforeach
            	</tbody>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

    <div class="modal" id="modal-edit-sales" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Sales</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="master/sales/update-sales" name="form-edit-sales" >
                        <input type="hidden" name="id" />
                        <table class="table table-bordered table-condensed" >
                            <tbody>
                                <tr>
                                    <td>Nama</td>
                                    <td>
                                        <input required type="text" name="nama" class="form-control" autocomplete="OFF" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Telp</td>
                                    <td>
                                        <input autocomplete="off" type="text" class="form-control" name="telp" />
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input autocomplete="off" type="text" class="form-control" name="telp_2" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>
                                        <input autocomplete="off" type="text" class="form-control" name="alamat" />
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
<!--Datatable-->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
	(function ($) {
        //format datatable
        $('#table-datatable').dataTable();
        //tampilkan form new sales
        $('#btn-add-sales').click(function(){
            //tampilkan form new sales
            $('form[name=form-add-sales]').removeClass('hide');
            $('form[name=form-add-sales]').hide();
            $('form[name=form-add-sales]').slideDown(250,null,function(){
                //fokuskan
                $('form[name=form-add-sales] input[name=nama]').focus();
            });
        });

        //cancel add new
        $('#btn-cancel-add-sales').click(function(){
            $('form[name=form-add-sales]').slideUp(250,null,function(){
                //clear input
                $('form[name=form-add-sales] input[name=nama]').val(null);
            }); 
            return false;
        });

        //edit sales
        $('.btn-edit-sales').click(function(){
            var url = $(this).attr('href');
            var id = $(this).data('id');
            
            //get data sales
            $.get('master/sales/get-sales/'+id,null,function(data){
                var dataSales = JSON.parse(data);
                
                //tampilkan data ke modal edit
                $('#modal-edit-sales input[name=id]').val(dataSales.id);
                $('#modal-edit-sales input[name=nama]').val(dataSales.nama);
                $('#modal-edit-sales input[name=telp]').val(dataSales.telp);
                $('#modal-edit-sales input[name=telp_2]').val(dataSales.telp_2);
                $('#modal-edit-sales input[name=alamat]').val(dataSales.alamat);
                //fokuskan & tampilkan modal                
                $('#modal-edit-sales').modal('show');
                $('#modal-edit-sales input[name=nama]').focus();
            });

            return false;
        });
        
        //delete sales
        $('.btn-delete-sales').click(function(){
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
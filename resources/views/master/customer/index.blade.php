@extends('layouts.master')

@section('styles')
    <!--Bootsrap Data Table-->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    	Master Customer
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-body">
            <a class="btn btn-primary btn-sm" id="btn-add-customer" ><i class="fa fa-plus" ></i> Add Customer</a>
            <div class="clearfix" ></div>
            <br/>
            <!-- Form add customer -->
            <form class="hide" name="form-add-customer" method="POST" action="master/customer/insert" >
            	<table class="table table-bordered table-condensed" >
            		<tbody>
            			<tr>
            				<td class="col-sm-2 col-md-2 col-lg-2" >Nama Toko</td>
            				<td>
            					<input autocomplete="off" required type="text" class="form-control" name="nama" />
            				</td>
            			</tr>
            			<tr>
            				<td class="col-sm-2 col-md-2 col-lg-2" >Nama Kontak</td>
            				<td>
            					<input autocomplete="off" required type="text" class="form-control" name="nama_kontak" />
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
            					<a href="#" class="btn btn-danger btn-sm" id="btn-cancel-add-customer" >Cancel</a>
            				</td>
            			</tr>
            		</tbody>
            	</table>
            </form>
            
            <!--table data customer-->
            <table class="table table-bordered table-condensed" id="table-datatable" >
            	<thead>
            		<tr>
            			<th class="col-sm-1 col-md-1 col-lg-1" >No</th>
            			<th>Nama Toko</th>
            			<th>Kontak</th>
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
            			<td>{{$dt->nama_kontak}}</td>
            			<td>{!! $dt->telp . '<br/>' .$dt->telp_2 !!}</td>
            			<td>{{$dt->alamat}}</td>
            			<td class="text-center" >
            				<a data-id="{{$dt->id}}" class="btn btn-success btn-xs btn-edit-customer" href="master/customer/edit/{{$dt->id}}" ><i class="fa fa-edit" ></i></a>
            				<a data-id="{{$dt->id}}" class="btn btn-danger btn-xs btn-delete-customer" href="master/customer/delete-customer/{{$dt->id}}" ><i class="fa fa-trash" ></i></a>
            			</td>
            		</tr>
            		@endforeach
            	</tbody>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

    <div class="modal" id="modal-edit-customer" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Customer</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="master/customer/update-customer" name="form-edit-customer" >
                        <input type="hidden" name="id" />
                        <table class="table table-bordered table-condensed" >
                            <tbody>
                                <tr>
                                    <td>Nama Toko</td>
                                    <td>
                                        <input required type="text" name="nama" class="form-control" autocomplete="OFF" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nama Kontak</td>
                                    <td>
                                        <input required type="text" name="nama_kontak" class="form-control" autocomplete="OFF" />
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
        
        //tampilkan form new customer
        $('#btn-add-customer').click(function(){
            //tampilkan form new customer
            $('form[name=form-add-customer]').removeClass('hide');
            $('form[name=form-add-customer]').hide();
            $('form[name=form-add-customer]').slideDown(250,null,function(){
                //fokuskan
                $('form[name=form-add-customer] input[name=nama]').focus();
            });
        });

        //cancel add new
        $('#btn-cancel-add-customer').click(function(){
            $('form[name=form-add-customer]').slideUp(250,null,function(){
                //clear input
                $('form[name=form-add-customer] input[name=nama]').val(null);
            }); 
            return false;
        });

        //edit customer
        $('.btn-edit-customer').click(function(){
            var url = $(this).attr('href');
            var id = $(this).data('id');
            
            //get data customer
            $.get('master/customer/get-customer/'+id,null,function(data){
                var dataCustomer = JSON.parse(data);
                
                //tampilkan data ke modal edit
                $('#modal-edit-customer input[name=id]').val(dataCustomer.id);
                $('#modal-edit-customer input[name=nama]').val(dataCustomer.nama);
                $('#modal-edit-customer input[name=nama_kontak]').val(dataCustomer.nama_kontak);
                $('#modal-edit-customer input[name=telp]').val(dataCustomer.telp);
                $('#modal-edit-customer input[name=telp_2]').val(dataCustomer.telp_2);
                $('#modal-edit-customer input[name=alamat]').val(dataCustomer.alamat);
                //fokuskan & tampilkan modal                
                $('#modal-edit-customer').modal('show');
                $('#modal-edit-customer input[name=nama]').focus();
            });

            return false;
        });
        
        //delete customer
        $('.btn-delete-customer').click(function(){
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
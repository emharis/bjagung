@extends('layouts.master')

@section('styles')
<!--Bootsrap Data Table-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>
<style>
    .btn-filter{
        cursor: pointer;
    }
</style>

@append

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Cash Expense
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-header with-border" >
            
            <div class="row" >
                <div class="col-sm-2 col-md-2 col-lg-2 " >
                    <a class="btn btn-primary btn-sm" id="btn-add" href="cashbook/expense/add" ><i class="fa fa-plus" ></i> Add Expense</a>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 pull-right" >
                    {{-- Filter section --}}
                    <div class="input-group">
                        <span class="input-group-addon bg-gray" >
                            Filter
                        </span>
                        <div class="input-group-btn" style="width: 30%;" >
                          {!! Form::select('select_filter_by',[
                                    'desc' => 'Description',
                                    'date' => 'Date',
                                    'total' => 'Total',
                                ],Input::get('filter_by'),['class'=>'form-control']) !!}
                        </div><!-- /btn-group -->

                        {{-- Filter by desc --}}
                        <input type="text" name="filter_string" class="form-control input-filter input-filter-by-desc {{Input::get('filter_by') != 'desc' ? 'hide':'' }}" value="{{Input::get('filter_string')}}" >

                        {{-- Filter by date --}}
                        <div class="input-group-btn input-filter-by-date {{Input::get('filter_by') != 'date' ? 'hide':'' }} input-filter " style="width: 30%;" >
                            <input type="text" name="input_filter_date_start" class="form-control input-tanggal" value="{{Input::get('date_start')}}" >
                        </div>
                        <input type="text" name="input_filter_date_end" class="form-control input-filter  input-tanggal input-filter-by-date {{Input::get('filter_by') != 'date' ? 'hide':'' }}" value="{{Input::get('date_end')}}" >

                        {{-- Filter by total --}}
                        <div class="input-group-btn input-filter-by-total {{Input::get('filter_by') != 'total' ? 'hide':'' }} input-filter " style="width: 15%;" >

                        {!! Form::select('input_filter_select_operator',[
                            'equal' => '=',
                            'lower_than' => '<',
                            'higher_than' => '>',
                            'lower_than_equal' => '<=',
                            'higher_than_equal' => '>=',
                        ],Input::get('filter_operator'),['class'=>'form-control']) !!}
                            {{-- <select name="input_filter_select_operator" class="form-control">
                                <option value="equal" ><label>=</label></option>
                                <option value="lower_than" ><label><</label></option>
                                <option value="higher_than" ><label>></label></option>
                                <option value="lower_than_equal" ><label><=</label></option>
                                <option value="higher_than_equal" ><label>>=</label></option>
                            </select> --}}
                        </div>
                        <input type="text" name="input_filter_total" class="form-control input-filter uang input-filter-by-total text-right {{Input::get('filter_by') != 'total' ? 'hide':'' }}" value="{{Input::get('total')}}" >

                        {{-- Filter submit button --}}
                        <div class="input-group-btn" >
                            <button class="btn btn-success btn-flat" id="btn-submit-filter" ><i class="fa fa-search" ></i></button>
                        </div>

                        {{-- Clear Filter --}}
                        <div class="input-group-btn" >
                            <a class="btn btn-danger" href="cashbook/expense" ><i class="fa fa-refresh" ></i></a>
                        </div>

                    </div>
                    {{-- End of filter section --}}
                </div>
            </div>
            
        </div>
        <div class="box-body">
            <?php $rownum=1; ?>
            <table class="table table-bordered table-condensed table-striped table-hover" id="table-order" >
                <thead>
                    <tr>
                        <th style="width:50px;" >No</th>
                        <th class="col-sm-2 col-md-2 col-lg-2" >DATE</th>
                        <th  >DESCRIPTION</th>
                        <th  >TOTAL</th>
                        <th class="col-sm-1 col-md-1 col-lg-1" ></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $rownum = ($data->currentPage() - 1 ) * $paging_item_number + 1 ; ?>
                    @foreach($data as $dt)
                    <tr>
                        <td class="text-right">{{$rownum++}}</td>
                        <td>
                            {{$dt->date_formatted}}
                        </td>
                        <td>
                            {{$dt->desc}}
                        </td>
                        <td class="uang text-right" >
                            {{$dt->total}}
                        </td>
                        <td class="text-center">
                            <a class="btn btn-success btn-xs" href="cashbook/expense/edit/{{$dt->id}}" ><i class="fa fa-edit" ></i></a>
                            <a class="btn btn-danger btn-xs btn-delete-expense" href="cashbook/expense/delete/{{$dt->id}}" ><i class="fa fa-trash-o" ></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-right" >
                {{-- {!! $data->render() !!} --}}
                {!! $data->appends(['filter_string' => \Input::get('filter_string')])
                        ->appends(['filter_by' => \Input::get('filter_by')])
                                    ->render() !!}
            </div>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

</section><!-- /.content -->

@stop

@section('scripts')
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>
<script src="plugins/autonumeric/autoNumeric-min.js" type="text/javascript"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>

<script type="text/javascript">
(function ($) {

    // ==========================================================================
    // FILTER SECTION
    $('select[name=select_filter_by]').change(function(){
        var filter_by = $(this).val();

        // hide filter input
        $('.input-filter').removeClass('hide');
        $('.input-filter').hide();

        if(filter_by == 'desc'){
            $('.input-filter-by-desc').show();
        }else if(filter_by == 'date'){
            $('.input-filter-by-date').show();
        }else{
            $('.input-filter-by-total').show();
        }

    });

    $('#btn-submit-filter').click(function(){
        var filter_by = $('select[name=select_filter_by]').val();
        var formFilter = $('<form>').attr('method','GET').attr('action','cashbook/expense/filter');

        if(filter_by == 'desc'){
            var filter_string = $('input[name=filter_string]').val();
            
            formFilter.append($('<input>').attr('type','hidden').attr('name','filter_string').val(filter_string));
            
        }else if(filter_by == 'date'){
            formFilter.append($('<input>').attr('type','hidden').attr('name','date_start').val($('input[name=input_filter_date_start]').val()));
            formFilter.append($('<input>').attr('type','hidden').attr('name','date_end').val($('input[name=input_filter_date_end]').val()));
        }else{
            // FILTER BY TOTAL
            formFilter.append($('<input>').attr('type','hidden').attr('name','filter_operator').val($('select[name=input_filter_select_operator]').val()));
            formFilter.append($('<input>').attr('type','hidden').attr('name','total').val($('input[name=input_filter_total]').autoNumeric('get')));
        }

        formFilter.append($('<input>').attr('type','hidden').attr('name','filter_by').val(filter_by));
        formFilter.submit();
    });
    // END OF FILTER SECTION
    // ==========================================================================

    // SET DATEPICKER
    $('.input-tanggal').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true
    });
    // END OF SET DATEPICKER

    // SET AUTO NUMERIC UANG
    $('.uang').autoNumeric('init',{
        vMin:'0',
        vMax:'9999999999'
    });
    // normalize
    $('.uang').each(function(i,data){
        $(this).autoNumeric('set',$(this).autoNumeric('get'));
    });
    // $('.uang').autoNumeric('set',$('.uang').autoNumeric('get'));

    // DELETE EXPENSE
    $(document).on('click', '.btn-delete-expense', function(){
        if(confirm('Anda akan menghapus data ini?')){

        }else{
            return false;
        }
    });

    

})(jQuery);
</script>
@append
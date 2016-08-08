@extends('layouts.full')

@section('styles')
@append

@section('content')
    <div>Clear Data Penjualan</div>
    <form name="form-clear-jual" method="POST" action="penjualan/post-clear-jual" >
        <button type="submit">CLEAR</button>
    </form>
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

            

        // END OF JQUERY
        })(jQuery);
    </script>
@append
<!-- diagnostic_report_menu -->
@extends('layouts.master')
@section ('includes')

<script>
    $(document).ready(function(){
        $('#top-entrypanel-validation input').keydown(function(e){
         if(e.keyCode==13){
            var inputType = $(':input:eq(' + ($(':input').index(this) + 1) + ')').attr('type');
            if (inputType=="text"){
                $(':input:eq(' + ($(':input').index(this) + 1) + ')').focus();
                return false;
            }
          }
        });
    })
</script>

@stop
@section('content')

<legend>Diagnostic Report Module </legend>
<!-- 'onkeypress'=> "return event.keyCode != 13;" -->
<form action="{{ route('diagnosticreports.store') }} " id="top-entrypanel-validation" onkeypress="return event.keyCode != 13;">
@csrf
<div clase="row">

    <div class="col-lg-3 col-md-3 col-xs-12">
        <div class="col-lg-12 entry_panel_body">
            <input type="submit" id="submit" name="submit" value="Daily Sales" class="col-lg-12 col-md-12 col-xs-12 btn btn-success pull-right" style="background-color: #795548; border-radius: 0px;">
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-xs-12">
        <div class="col-lg-12 entry_panel_body">
            <input type="submit" id="submit" name="submit" value="Invoice Register" class="col-lg-12 col-md-12 col-xs-12 btn btn-success pull-right" style="background-color: #795548; border-radius: 0px;">
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-xs-12">
        <div class="col-lg-12 entry_panel_body">
            <input type="submit" id="submit" name="submit" value="User Wise Sales" class="col-lg-12 col-md-12 col-xs-12 btn btn-success pull-right" style="background-color: #795548; border-radius: 0px;">
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-xs-12">
        <div class="col-lg-12 entry_panel_body">
            <input type="submit" id="submit" name="submit" value="Doctor Commission" class="col-lg-12 col-md-12 col-xs-12 btn btn-success pull-right" style="background-color: #795548; border-radius: 0px;">
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-xs-12">
        <div class="col-lg-12 entry_panel_body">
            <input type="submit" id="submit" name="submit" value="Group Wise Sales" class="col-lg-12 col-md-12 col-xs-12 btn btn-success pull-right" style="background-color: #795548; border-radius: 0px;">
        </div>
    </div>              

    <div class="col-lg-3 col-md-3 col-xs-12">
        <div class="col-lg-12 entry_panel_body">
            <input type="submit" id="submit" name="submit" value="Doctor Performance" class="col-lg-12 col-md-12 col-xs-12 btn btn-success pull-right" style="background-color: #795548; border-radius: 0px;">
        </div>
    </div>

            


</div>
</form>

@stop
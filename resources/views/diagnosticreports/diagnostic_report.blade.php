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


    <script>
    $( document ).ready(function() {
            $('#doctor').select2({
            placeholder: 'Enter a doctor name',
                ajax: {
                    headers: {
                            'X-CSRF-TOKEN':'{{csrf_token()}}'
                    },
                    type: 'POST',
                    dataType: 'json',
                    url: "{{URL::to('/')}}/doctord",
                    delay: 250,
                    data: function(params) {
                        return {
                            term: params.term
                        }
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data
                        };
                    },
                }
            });
    });

    $( document ).ready(function() {
            $('#patient_name').select2({
            placeholder: 'Enter a patient name',
                ajax: {
                    headers: {
                            'X-CSRF-TOKEN':'{{csrf_token()}}'
                    },
                    type : 'POST',
                    dataType: 'json',
                    url: "{{URL::to('/')}}/patient",
                    delay: 250,
                    data: function(params) {
                        return {
                            term: params.term
                        }
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data
                        };
                    },
                }
            });
    });

    $(function() {
        $( "#datefrom" ).datepicker({
            changeMonth: true,
            changeYear: true
        });
        $( "#dateto" ).datepicker({
            changeMonth: true,
            changeYear: true
        });  
    });

    </script>

@stop
@section('content')

    <legend>{{$reportname}}</legend>

    <form action="{{ route('diagnosticreportviews.store') }}" id="top-entrypanel-validation" onkeypress= "return event.keyCode != 13" method="post">
    @csrf    
        <div clase="row">

                <div class="col-lg-6 col-md-6 col-xs-6">

                    @if ($reporttype == 1)
                    <div class="col-lg-12 col-md-12 col-xs-12 entry_panel_body">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <label for="Report Type" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Report Type</label>
                            <select id="reporttype" name="reporttype" placeholder="" class="col-lg-8 col-md-8 col-xs-8 entry_panel_dropdown" >
                                <option "1">Summarized</option>
                                <option "2">Details</option>
                            </select>
                        </div>
                    </div>
                    @endif

                    @if ($datefrom == 1)
                    <div class="col-lg-12 col-md-12 col-xs-12 entry_panel_body">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <label for="Date From" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Date From</label>
                            <input name="datefrom" type="text" id="datefrom" readonly placeholder="Date From.." class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" data-date-format="DD/MM/YY" value="{{ date('d/m/Y') }}">                
                        </div>
                    </div>
                    @endif

                    @if ($dateto == 1)
                    <div class="col-lg-12 col-md-12 col-xs-12 entry_panel_body">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <label for="Dateto" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label">Date To</label>
                            <input name="dateto" type="text" id="dateto" readonly placeholder="Date To.." class="col-lg-8 col-md-8 col-xs-8 entry_panel_input" data-date-format="DD/MM/YY" value="{{ date('d/m/Y') }}">                
                        </div>
                    </div>
                    @endif

                    @if ($doctor == 1)
                    <div class="col-lg-12 col-md-12 col-xs-12 entry_panel_body">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <label for="Doctor Name" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label" style="padding: 3px;">Doctors</label>
                            <select id="doctor" name="doctor" placeholder="" class="col-lg-8 col-md-8 col-xs-8 entry_panel_dropdown" >
                            </select>                        
                        </div>
                    </div>
                    @endif

                    @if ($patient_name == 1)
                    <div class="col-lg-12 col-md-12 col-xs-12 entry_panel_body">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <label for="Patient Name" class="col-lg-4 col-md-4 col-xs-4 entry_panel_label" style="padding: 3px;">Patient</label>
                            <select id="patient_name" name="patient_name" placeholder="" class="col-lg-8 col-md-8 col-xs-8 entry_panel_dropdown" >
                            </select>
                        </div>
                    </div>
                    @endif

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="col-lg-12 entry_panel_body">
                            <input type="submit" id="submit" name="submit" value="Show Report" class="col-lg-3 col-md-3 col-xs-3 btn btn-success pull-right" style="border-radius: 0px;">
                            <input type="hidden" id="reportname" name="reportname" value="{{$reportname}}">
                        </div>
                    </div>

                </div>
        
        </div>
    </form>

@stop
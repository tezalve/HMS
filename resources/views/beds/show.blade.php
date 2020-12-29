@extends('layouts.master')
@section('content')

    <div class="row" style="padding:0 30px">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Bed No: {{ $bed->bed_no }}</strong>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description: {{ $bed->description }}</strong>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Bed Group ID: {{ $bed->bed_group_id }}</strong>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Floor Information ID: {{ $bed->floor_information_id }}</strong>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Charge: {{ $bed->charge }}</strong>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Bed Status: {{ $bed->bed_active_status }}</strong>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Valid?: {{ $bed->valid }}</strong>
            </div>
        </div>
    </div>
@stop
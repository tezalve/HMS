@extends('layouts.master')

@section('content')

    <div class="row" style="padding:0 30px">
        <div class="padd">
            <div class="form-group">
                <strong>Reg No: {{ $patient->registration_no }}</strong>

            </div>
        </div>
        <div class="padd">
            <div class="form-group">
                <strong>Name: {{ $patient->name }}</strong>

            </div>
        </div>
        <div class="padd">
            <div class="form-group">
                <strong>Address: {{ $patient->address }}</strong>

            </div>
        </div>
        <div class="padd">
            <div class="form-group">
                <strong>Date of Birth: {{ $patient->dob }}</strong>

            </div>
        </div>
        <div class="padd">
            <div class="form-group">
                <strong>Phone No: {{ $patient->phone }}</strong>

            </div>
        </div>
        <div class="padd">
            <div class="form-group">
                <strong>Gender: {{ $patient->gender }}</strong>

            </div>
        </div>
        <div class="padd">
            <div class="form-group">
                <strong>Father: {{ $patient->fathersname }}</strong>

            </div>
        </div>
        <div class="padd">
            <div class="form-group">
                <strong>Mother: {{ $patient->mothersname }}</strong>

            </div>
        </div>
        <div class="padd">
            <div class="form-group">
                <strong>Spouse: {{ $patient->spousename }}</strong>

            </div>
        </div>
        <div class="padd">
            <div class="form-group">
                <strong>Religion: {{ $patient->religion }}</strong>

            </div>
        </div>
        <div class="padd">
            <div class="form-group">
                <strong>Nationality: {{ $patient->nationality }}</strong>

            </div>
        </div>
        <div class="padd">
            <div class="form-group">
                <strong>National ID: {{ $patient->nationalid }}</strong>

            </div>
        </div>
        <div class="padd">
            <div class="form-group">
                <strong>Passport ID: {{ $patient->passportid }}</strong>

            </div>
        </div>
        <div class="padd">
            <div class="form-group">
                <strong>Related: {{ $patient->related }}</strong>

            </div>
        </div>
        <div class="padd">
            <div class="form-group">
                <strong>Relation: {{ $patient->relation }}</strong>

            </div>
        </div>
        <div class="padd">
            <div class="form-group">
                <strong>Blood Group: {{ $patient->blood_group }}</strong>

            </div>
        </div>
        <div class="padd">
            <div class="form-group">
                <strong>Date Deceased: {{ $patient->date_deceased }}</strong>

            </div>
        </div>
        <div class="padd">
            <div class="form-group">
                <strong>Employee Info ID: {{ $patient->employee_info_id }}</strong>

            </div>
        </div>
        <div class="padd">
            <div class="form-group">
                <strong>Occupation's ID: {{ $patient->occupations_id }}</strong>

            </div>
        </div>
    </div>
@stop
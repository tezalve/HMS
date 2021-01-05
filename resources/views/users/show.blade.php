@extends('layouts.master')
@section('content')

    <div class="row" style="padding:15px 30px">
        <div class="">
            <div class="form-group">
                <img src="{{ $user->profile_photo_path }}" alt="Profile Photo">
            </div>
        </div>

        <div class="">
            <div class="form-group">
                <strong>User: {{ $user->id }}</strong>
            </div>
        </div>

        <div class="">
            <div class="form-group">
                <strong>User: {{ $user->name }}</strong>
            </div>
        </div>

        <div class="">
            <div class="form-group">
                <strong>Email: {{ $user->email }}</strong>
            </div>
        </div>
    </div>
@stop
@extends('layouts.master')

@section('content')

    <h2>User Edit</h2>

    <br><br>

    <form action="{{ route('users.update', $user->id) }}" method="post">
        @method('PUT')
        @php $form_type ='edit' @endphp
		@include('users/_form')
    </form>
@stop
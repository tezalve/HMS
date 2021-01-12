@extends('layouts.master')

@section('content')

    <h2>New Unit</h2>

    <br><br>

    <form action="{{ route('permissions.update', $permission->id) }}" method="post">
        @method('PUT')
        @php $form_type ='edit' @endphp
		@include('permissions/_form')
    </form>
    <!-- emo -->
@stop
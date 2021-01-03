@extends('layouts.master')

@section('content')

    <h2>New Medicine</h2>

    <br><br>

    <form action="{{ route('medicinecompanyinfos.update', $medicinecompanyinfo->id) }}" method="post">
        @method('PUT')
        @php $form_type ='edit' @endphp
		@include('medicinecompanyinfos/_form')
    </form>
@stop
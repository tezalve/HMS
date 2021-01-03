@extends('layouts.master')

@section('content')
    <form action="{{ route('medicinecompanyinfos.store') }}" method="post">
        @php $form_type ='create' @endphp
		@include('medicinecompanyinfos/_form')
    </form>
@stop
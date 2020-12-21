@extends('layouts.mister')
@section('content')

<h1>HMS</h1>
<h3><a href="{{ route('doctors.index') }}">Doctors Panel</a></h3>
<h3><a href="{{ route('patients.index') }}">Patients Panel</a></h3>
<h3><a href="{{ route('beds.index') }}">Beds Panel</a></h3>
<h3><a href="{{ route('clinicalcharts.index') }}">Clinical Chart</a></h3>

<br><br><br>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                            this.closest('form').submit();">
        {{ __('Logout') }}
    </a>
</form>

<a href="{{ route('register') }}">{{ __('Register') }}</a>
@stop
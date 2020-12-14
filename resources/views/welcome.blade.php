@extends('layouts.mister')
@section('content')

<h1>HMS</h1>
<a href="{{ route('doctors.index') }}">Doctors Panel</a>
<a href="{{ route('patients.index') }}">Patients Panel</a>

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
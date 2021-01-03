@extends('layouts.master')
@section ('includes')

<script>

    $(document).ready(function(){
        $("#button").click(function(){
            $("#button").fadeOut(800);
            $("#test").removeClass('hidden');
        })
    }); 

</script>
<style>
    .cent{
        text-align: center;
        color: blue;
    }
</style>

@stop
@section('content')

    <h1 class="hidden cent" id="test">Hospital Management System</h1>
    <div class="cent">
        <button id="button">Click me for more information about this site</button>
    </div>

@stop


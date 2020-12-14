@extends('layouts.mister')
@section('content')

<h1>Patient Information</h1>
	
	
	<div class="col-lg-4 col-md-4 col-xs-12">
		<div class="col-lg-12 entry_panel_body ">
			<a href="{{ route('patients.create') }}"><input type="button" id="submit" name="submit" value="New Patient Registration" class="col-lg-7 col-md-7 col-xs-7 btn btn-save btn-sm button button-save pull-left" style="background: rgb(5, 142, 27); color: aliceblue;">	</a>
		</div>
	</div>

    <legend></legend>
    <div class="col-lg-12 datatablescope">
        <table id="example" class="stripe row-border order-column" cellspacing="0" width="100%">	
        <!-- <table id="example" class="display" cellspacing="0" width="100%"> -->
            <thead>
                <tr>
                    <th>Registration No.</th>
                    <th>Patient Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Blood Group</th>
                    <th>Age</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($patient as $patient)
                    <?php 
                        $d1 = new DateTime($patient->dob);
                        $d2 = new DateTime(date("Y/m/d"));
                        $diff = $d2->diff($d1);
                    ?>
                    <tr>
                        <td>{{$patient->registration_no}}</td>
                        <td>{{$patient->name}}</td>
                        <td>{{$patient->phone}}</td>
                        <td>{{$patient->address}}</td>
                        <td>{{$patient->blood_group}}</td>
                        <td>{{$diff->y." Y"}}</td>
                        <td>
                            <form action="{{ route('patients.destroy', $patient->id) }}" method="POST">

                                <a href="{{ route('patients.show', $patient->id ) }}">Show</a>

                                <a href="{{ route('patients.edit', $patient->id ) }}">Edit</a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-primary" title="delete"></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
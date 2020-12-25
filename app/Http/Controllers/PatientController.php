<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Occupation;
use Illuminate\Http\Request;
use Validator;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patient = Patient::all();
		return View('patients.index', compact('patient'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $occupation = Occupation::all();
        return view('patients.create', compact('occupation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fast_name'  		=> 'required|min:2',
            'middle_name'  		=> 'required',
            'phone'  			=> 'required',
            'dob' 				=> 'required',
            'occupations' 		=> 'required'
        ]);

        $gistration                 = new DataController();
        $gistration_no  			= $gistration->geneart_gistration("patientregistration", "registration_no");
        $olddate 					= $request->dob;
        $olddate 					= str_replace('/', '-', $olddate);
        $newdate 					= date('Y-m-d', strtotime($olddate));
        
        $fastname 					= $request->fast_name;
        $middlename 				= $request->middle_name;
        $lastname 					= $request->last_name;
        $patientname  				= $fastname." ".$middlename." ".$lastname;

        $patient 					= new Patient;
        $patient->name 				= $patientname;
        $patient->phone 			= $request->phone;
        $patient->dob 				= $newdate;
        $patient->gender			= $request->gender;
        $patient->fathersname 		= $request->fathersname;
        $patient->mothersname 		= $request->mothersname;
        $patient->spousename 		= $request->spousesname;
        $patient->address 			= $request->address;
        $patient->relegion 			= $request->religion;
        $patient->nationality 		= $request->nationality;
        $patient->passportid 		= $request->passno;
        $patient->nationalid 		= $request->nid;
        $patient->blood_group 		= $request->bloodgroup;
        $patient->registration_no 	= $gistration_no;
        $patient->occupations_id 	= $request->occupations;

        $patient->save();

        return redirect()->route('patients.index')
        ->with('success', 'patient created successfully');    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        $occupation = Occupation::all();
        return view('patients.edit', compact('patient','occupation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'dob' 				=> 'required'
        ]);

        // dd("$request");
        $gistration = new DataController();
        $gistration_no  			= $gistration->geneart_gistration("patientregistration", "registration_no");
        $olddate 					= $request->dob;
        $olddate 					= str_replace('/', '-', $olddate);
        $newdate 					= date('Y-m-d', strtotime($olddate));
        
        $fastname 					= $request->fast_name;
        $middlename 				= $request->middle_name;
        $lastname 					= $request->last_name;
        $patientname  				= $fastname." ".$middlename." ".$lastname;

        $patient                    = Patient::find($patient->id);
        $patient->name 				= $patientname;
        $patient->phone 			= $request->phone;
        $patient->dob 				= $newdate;
        $patient->gender			= $request->gender;
        $patient->fathersname 		= $request->fathersname;
        $patient->mothersname 		= $request->mothersname;
        $patient->spousename 		= $request->spousesname;
        $patient->address 			= $request->address;
        $patient->relegion 			= $request->religion;
        $patient->nationality 		= $request->nationality;
        $patient->passportid 		= $request->passno;
        $patient->nationalid 		= $request->nid;
        $patient->blood_group 		= $request->bloodgroup;
        $patient->registration_no 	= $gistration_no;
        $patient->occupations_id 	= $request->occupations;

        $patient->save();
        
        return redirect()->route('patients.index')
            ->with('success', 'patient updated successfully');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()->route('patients.index')
            ->with('success', 'patient deleted successfully');
    }
}

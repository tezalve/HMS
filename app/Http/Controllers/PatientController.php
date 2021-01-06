<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Occupation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DataTables;
use DB;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Patient::select('*');

            return Datatables::of($data)
                    ->addColumn('edit', function($row){
     
                        $btn1 = '<a href="'.route('patients.edit', Crypt::EncryptString($row->id)).'" class="edit btn btn-primary btn-sm">Edit</a>';
                        return $btn1;
                    })
                    ->addColumn('delete', function($row){
     
                        $btn2 = '<form action="'.route('patients.destroy', Crypt::EncryptString($row->id)).'" method="POST">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        <button type="submit" class="edit btn btn-primary btn-sm">Delete
                        </form>';
                        return $btn2;
                    })
                    ->rawColumns(['edit', 'delete'])
                    ->make(true);
        }

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
    public function edit($patient)
    {
        try {
            $decrypted = Crypt::decryptString($patient);
        } catch (DecryptException $e) {
            dd("decryption failed");
        }
        // dd("$decrypted");
        $patient = patient::where('id',$decrypted)->first();

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
            'fast_name'  		=> 'required|min:2',
            'middle_name'  		=> 'required',
            'phone'  			=> 'required',
            'dob' 				=> 'required',
            'occupations' 		=> 'required'
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
    public function destroy($patient)
    {
        try {
            $decrypted = Crypt::decryptString($patient);
        } catch (DecryptException $e) {
            dd("decryption failed");
        }
        // dd("$decrypted");
        $patient = patient::where('id',$decrypted)->first();

        $patient->delete();

        return redirect()->route('patients.index')
            ->with('success', 'patient deleted successfully');
    }
}

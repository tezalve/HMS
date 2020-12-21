<?php

namespace App\Http\Controllers;
use App\Models\Doctor;
use App\Models\Department;
use Illuminate\Http\Request;

class DoctorController extends Controller {

	public function __construct()
	{
		$this->middleware(['auth']);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$doctor = Doctor::all();
		
		return View('doctors.index', compact('doctor'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$department = Department::all();
		return view('doctors.create', compact('department'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$request->validate([
            'name' => ['required','min:5', 'string'],
            'address' => ['required', 'string'],
			'email' => ['required'],
			'phone' => 'required',
			'doctor_status' => 'required',
			'reference_status' => 'required',
			'gender' => 'required',
			'married' => 'required',
			'consultation_fee' => 'required',
			'dob' => 'required',
			'department_id' => 'required',
			'doctor_degree' => 'required',
			'bloodgroup' => 'required'
        ]);

        Doctor::create($request->all());

        return redirect()->route('doctors.index')
		    ->with('success', 'Doctor created successfully.');
	}


	/**	
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Doctor $doctor)
	{
		return view('doctors.show', compact('doctor'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Doctor $doctor)
	{
		$department = Department::all();
		return view('doctors.edit', compact('doctor', 'department'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(Request $request, Doctor $doctor)
    {
        $doctor->update($request->all());

        return redirect()->route('doctors.index')
            ->with('success', 'Doctor updated successfully');
    }


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Doctor $doctor)
    {
        $doctor->delete();

        return redirect()->route('doctors.index')
            ->with('success', 'Doctor deleted successfully');
    }
}
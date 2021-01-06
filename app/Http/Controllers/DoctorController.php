<?php

namespace App\Http\Controllers;
use App\Models\{ Doctor, Department };
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DataTables;

class DoctorController extends Controller {
	

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (request()->ajax()) {
			$data = Doctor::select('*');
			
            return Datatables::of($data)
                    ->addColumn('edit', function($row){
     
                        $btn1 = '<a href="'.route('doctors.edit', Crypt::EncryptString($row->id)).'" class="edit btn btn-primary btn-sm">Edit</a>';
                        return $btn1;
                    })
                    ->addColumn('delete', function($row){
     
                        $btn2 = '<form action="'.route('doctors.destroy', Crypt::EncryptString($row->id)).'" method="POST">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        <button type="submit" class="edit btn btn-primary btn-sm">Delete
                        </form>';
                        return $btn2;
                    })
                    ->rawColumns(['edit', 'delete'])
                    ->make(true);
        }

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
	public function edit($doctor)
	{
		try {
            $decrypted = Crypt::decryptString($doctor);
        } catch (DecryptException $e) {
            dd("decryption failed");
        }
        // dd("$decrypted");
		$doctor = doctor::where('id',$decrypted)->first();
		
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
	public function destroy($doctor)
    {
		try {
            $decrypted = Crypt::decryptString($doctor);
        } catch (DecryptException $e) {
            dd("decryption failed");
        }
        // dd("$decrypted");
		$doctor = doctor::where('id',$decrypted)->first();
		
        $doctor->delete();

        return redirect()->route('doctors.index')
            ->with('success', 'Doctor deleted successfully');
    }
}
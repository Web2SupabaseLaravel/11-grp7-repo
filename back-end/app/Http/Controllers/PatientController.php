<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
                    $data['patient'] = \App\Models\patient::all(); 
    return $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
           $data['patient'] = new \App\Models\patient(); 
    $data['route'] = 'dataevent.store'; 
    $data['method'] = 'post';
    // $data['titleForm'] = 'Form Input Event'; 
    // $data['submitButton'] = 'Submit';
    // return view('event/form_event', $data); 

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
           $request->validate([
        'full_name' => 'required',
        'patient_id' => 'required', 
        'date_of_birth' => 'required', 
        'gender' => 'required', 
        'phone' => 'required', 
    ]);

    $inputpatient = new \App\Models\patient(); 
    $inputpatient->full_name = $request->full_name;
    $inputpatient->patient_id = $request->patient_id;  
    $inputpatient->date_of_birth = $request->date_of_birth; 
    $inputpatient->gender = $request->gender;  
    $inputpatient->password = $request->password;  
    $inputpatient->address = $request->address;  
    $inputpatient->phone = $request->phone;  
    $inputpatient->email = $request->email;  
    $inputpatient->last_visit_date = $request->last_visit_date;  
    $inputpatient->save();
    return redirect('datapatient'); 

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       

    $appointments = \App\Models\Appointment::all();
    return response()->json($appointments);


    //         $data['appointment'] = \App\Models\Appointment::all(); 
    // return $data;
 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    $data['appointment'] = new \App\Models\appointment(); 
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
        'appointment_id' => 'required',
        'patient_id' => 'required',
        'practitioner_id' => 'required',
        'appointment_date' => 'required',
        'appointment_time' => 'required',
        'status' => 'required',
        'service_id' => 'required',
    ]);

    $inputappointment = new \App\Models\appointment(); 
    $inputappointment->appointment_id = $request->appointment_id;
    $inputappointment->patient_id = $request->patient_id;  
    $inputappointment->appointment_date = $request->appointment_date; 
    $inputappointment->practitioner_id = $request->practitioner_id; 
    $inputappointment->appointment_time = $request->appointment_time; 
    $inputappointment->status = $request->status; 
    $inputappointment->service_id = $request->service_id;  
    $inputappointment->save();
    return redirect('dataappointment'); 

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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['report'] = \App\Models\report::all(); 
    return $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            $data['report'] = new \App\Models\report(); 
    $data['route'] = 'datareport.store'; 
    $data['method'] = 'post';
    // $data['titleForm'] = 'Form Input report'; 
    // $data['submitButton'] = 'Submit';
    // return view('report/form_report', $data); 

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([
        'report_id' => 'required',
        'report_date' => 'required', 
        'report_type' => 'required', 
        'patient_name' => 'required', 

    ]);

    $inputreport = new \App\Models\report(); 
    $inputreport->report_id = $request->report_id;
    $inputreport->report_date = $request->report_date;  
    $inputreport->report_type = $request->report_typee;
    $inputreport->patient_name = $request->patient_name;    
    $inputEvent->save();
    return redirect('datareport'); 

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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $data['System'] = \App\Models\Admin::all();

         return $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $data['Admin'] = new \App\Models\Admin(); 
    $data['route'] = 'dataAdmin.store'; 
    $data['method'] = 'post';
    #$data['titleForm'] = 'Form Input Admin'; 
    #$data['submitButton'] = 'Submit';
    #return view('Admin/form_Admin', $data); 

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'admin_id' => 'required',
        'staff_id' => 'required', 
        'email' => 'required', 
        'password' => 'required', 
        'role' => 'required', 
    ]);

    $inputAdmin = new \App\Models\Admin(); 
    $inputAdmin->admin_id = $request->admin_id;
    $inputAdmin->staff_id = $request->staff_id;  
    $inputAdmin->email = $request->email; 
    $inputAdmin->password = $request->password; 
    $inputAdmin->role= $request->role; 
    $inputAdmin->save();
    return redirect('dataAdmin'); 

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $admin = \App\Models\Admin::find($id);

    if (!$admin) {
        return response()->json(['message' => 'Admin not found'], 404);
    }

    return response()->json($admin);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $data['Admin'] = \App\Models\Admin::findOrFail($id); 
    $data['route'] = ['dataAdmin.update', $id]; 
    $data['method'] = 'put';

    // return view('Admin/form_Admin', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
        'staff_id' => 'required',
        'email' => 'required', 
        'password' => 'required', 
        'role' => 'required', 
    ]);

    $admin = \App\Models\Admin::findOrFail($id);
    $admin->staff_id = $request->staff_id;  
    $admin->email = $request->email; 
    $admin->password = $request->password; 
    $admin->role = $request->role; 
    $admin->save();

    return redirect('dataAdmin');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          $admin = \App\Models\Admin::find($id);

    if (!$admin) {
        return response()->json(['message' => 'Admin not found'], 404);
    }

    $admin->delete();

    return response()->json(['message' => 'Admin deleted successfully']);
    }
}

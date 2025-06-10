<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserSofyanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
                $data['UserSofyan'] = \App\Models\UserSofyan::all();
                return $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['UserSofyan'] = new \App\Models\UserSofyan(); 
        $data['route'] = 'dataevent.store'; 
        $data['method'] = 'post';
        #$data['titleForm'] = 'Form Input UserSofyanController'; 
        #$data['submitButton'] = 'Submit';
        #return view('UserSofyanController/form_UserSofyanController', $data); 

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
        'user_id' => 'required',
        'name' => 'required', 
        'email' => 'required', 
        'role' => 'required', 
        'status' => 'required', 

    ]);

    $inputUserSofyanController = new \App\Models\UserSofyan(); 
    $inputUserSofyanController->user_id = $request->user_id;
    $inputUserSofyanController->name = $request->name;
    $inputUserSofyanController->email = $request->email;  
    $inputUserSofyanController->role= $request->role; 
    $inputUserSofyanController->status= $request->status; 

    $inputUserSofyanController->save();
    return redirect('datauser'); 

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $user = \App\Models\UserSofyan::findOrFail($id);
    return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['UserSofyan'] = \App\Models\UserSofyan::findOrFail($id); 
        $data['route'] = ['dataevent.update', $id]; 
        $data['method'] = 'put';
        return view('UserSofyanController.form_UserSofyanController', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
        'user_id' => 'required',
        'name' => 'required',
        'email' => 'required',
        'role' => 'required',
        'status' => 'required',
    ]);

    $user = \App\Models\UserSofyan::findOrFail($id);
    $user->update($request->only(['user_id', 'name', 'email', 'role', 'status']));

    return response()->json(['message' => 'User updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = \App\Models\UserSofyan::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}

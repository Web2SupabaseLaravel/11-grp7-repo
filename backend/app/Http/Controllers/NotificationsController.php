<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['notifications'] = \App\Models\Notifications::all();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['notification'] = new \App\Models\Notifications(); 
        $data['route'] = 'dataNotifications.store'; 
        $data['method'] = 'post';
        // return view('Notifications/form_Notifications', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'notification_id' => 'required',
            'message' => 'required',
            'date' => 'required',
            'created_at' => 'required',
            'updated_at' => 'required',
        ]);

        $notification = new \App\Models\Notifications();
        $notification->notification_id = $request->notification_id;
        $notification->message = $request->message;
        $notification->date = $request->date;
        $notification->created_at = $request->created_at;
        $notification->updated_at = $request->updated_at;

        $notification->save();

        return redirect('dataNotifications');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $notification = \App\Models\Notifications::where('notification_id', $id)->first();

        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        return response()->json($notification);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['notification'] = \App\Models\Notifications::findOrFail($id);
        $data['route'] = ['dataNotifications.update', $id];
        $data['method'] = 'put';

        // return view('Notifications/form_Notifications', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'message' => 'required',
            'date' => 'required',
            'created_at' => 'required',
            'updated_at' => 'required',
        ]);

        $notification = \App\Models\Notifications::where('notification_id', $id)->first();

        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        $notification->message = $request->message;
        $notification->date = $request->date;
        $notification->created_at = $request->created_at;
        $notification->updated_at = $request->updated_at;

        $notification->save();

        return response()->json(['message' => 'Notification updated successfully', 'data' => $notification]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $notification = \App\Models\Notifications::where('notification_id', $id)->first();

        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        $notification->delete();

        return response()->json(['message' => 'Notification deleted successfully']);
    }
}

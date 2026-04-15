<?php

namespace App\Http\Controllers;

use App\Models\AirSocial;
use Illuminate\Http\Request;

class AirSocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $air_post = AirSocial::with('user')
        ->latest()
        ->take(50)
        ->get();


        return view("home", ['air_post' => $air_post]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validated the request
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        
        //Create Air_Post (No user for now , we'll add auth later)
        AirSocial:create([
            'message' => $validated['message'],
        ]);

        return redirect('/')->with('sucess', 'Air Post Created');
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

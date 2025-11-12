<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDurationRequest;
use App\Http\Requests\UpdateDurationRequest;
use App\Models\Duration;

class DurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreDurationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Duration $duration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Duration $duration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDurationRequest $request, Duration $duration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Duration $duration)
    {
        //
    }
}

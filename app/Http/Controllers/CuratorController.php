<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCuratorRequest;
use App\Http\Requests\UpdateCuratorRequest;
use App\Models\Curator;

class CuratorController extends Controller
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
    public function store(StoreCuratorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Curator $curator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curator $curator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCuratorRequest $request, Curator $curator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curator $curator)
    {
        //
    }
}

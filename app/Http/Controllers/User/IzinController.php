<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use App\Http\Requests\StoreIzinRequest;
use App\Http\Requests\UpdateIzinRequest;

class IzinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIzinRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIzinRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Izin  $izin
     * @return \Illuminate\Http\Response
     */
    public function show(Izin $izin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Izin  $izin
     * @return \Illuminate\Http\Response
     */
    public function edit(Izin $izin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIzinRequest  $request
     * @param  \App\Models\Izin  $izin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIzinRequest $request, Izin $izin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Izin  $izin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Izin $izin)
    {
        //
    }
}

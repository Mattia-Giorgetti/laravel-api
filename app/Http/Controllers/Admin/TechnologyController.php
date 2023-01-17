<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Models\Technology;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTechnologyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTechnologyRequest $request)
    {
        $data = $request->validated();
        $slug = Technology::generateSlug($request->name);
        $data['slug'] = $slug;

        $newTechnology = Technology::create($data);

        return redirect()->route('admin.technologies.index', $newTechnology->slug)->with('message', "New Technology: $newTechnology->name created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTechnologyRequest  $request
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        $data = $request->validated();
        $slug = Technology::generateSlug($request->name);
        $data['slug'] = $slug;
        $technology->update($data);
        return redirect()->route('admin.technologies.index')->with('message', "$technology->name Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('admin.technologies.index')->with('message', "$technology->name deleted");
    }
}

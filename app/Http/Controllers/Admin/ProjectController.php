<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use App\Models\Technology;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        if (Auth::user()->isadmin()) {
            $projects = Project::paginate(3);
        } else {
            $userID = Auth::id();
            $projects = Project::where('user_id', $userID)->paginate(3);
        }

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {

        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));


    }

    /**
     * Store a newly created resource in storage.
     *
     *
     */
    public function store(StoreProjectRequest $request)
    {
        $userID = Auth::id();
        $data = $request->validated();
        $slug = Project::generateSlug($request->title);
        $data['slug'] = $slug;
        $data['user_id'] = $userID;
        //IMMAGINI
        if ($request->hasFile('cover_image')) {
            $path = Storage::put('project_images', $request->cover_image);
            $data['cover_image'] = $path;
        }
        $newProject = Project::create($data);


        if ($request->has('technologies')) {
            $newProject->technologies()->attach($request->technologies);
        }
        return redirect()->route('admin.projects.show', $newProject->slug)->with('message', "New project created!");
    }

    /**
     * Display the specified resource.
     *
     *
     */
    public function show(Project $project)
    {
        if (!Auth::user()->isadmin() && $project->user_id !== Auth::id()) {
            abort(403);
        }
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     */
    public function edit(Project $project)
    {
        if (!Auth::user()->isadmin() && $project->user_id !== Auth::id()) {
            abort(403);
        }
        $technologies = Technology::all();
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));

    }

    /**
     * Update the specified resource in storage.
     *
     *
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        if (!Auth::user()->isadmin() && $project->user_id !== Auth::id()) {
            abort(403);
        }
        $data = $request->validated();
        $slug = Project::generateSlug($request->title);
        $data['slug'] = $slug;
        if ($request->hasFile('cover_image')) {
            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }
            $path = Storage::put('project_images', $request->cover_image);
            $data['cover_image'] = $path;
        }

        $project->update($data);

        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        } else {
            $project->technologies()->sync([]);
        }

        return redirect()->route('admin.projects.index')->with('message', "$project->title Updated!");

    }

    /**
     * Remove the specified resource from storage.
     *
     *
     */
    public function destroy(Project $project)
    {
        if (!Auth::user()->isadmin() && $project->user_id !== Auth::id()) {
            abort(403);
        }
        if ($project->cover_image) {
            Storage::delete($project->cover_image);
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', "$project->title has been deleted");
    }
}

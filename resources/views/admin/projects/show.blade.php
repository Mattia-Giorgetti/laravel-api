@extends('layouts.app')

@section('content')
    <section id="proj_page" class="py-5">
        <div class="container border-start ps-5">
            @if (session()->has('message'))
                <div class="alert alert-info mb-4">
                    {{ session()->get('message') }}
                </div>
            @endif
            <h2>{{ $project->title }}</h2>
            <p>{{ $project->proj_description }}</p>
            @if ($project->type)
                <p>Type: <span>{{ $project->type->name }}</span></p>
            @endif
            @if ($project->technologies && count($project->technologies) > 0)
                <span class="text-white fs-2">Technologies:</span>
                <ul class="list-unstyled mb-5">
                    @foreach ($project->technologies as $technology)
                        <li class="text-white fs-4">{{ $technology->name }}</li>
                    @endforeach
                </ul>
            @endif

            <a class="gh_link" href="{{ $project->github_link }}" target="_blank">{{ $project->github_link }}</a>
            <img class="d-block mt-5" width="600px" src="{{ asset('storage/' . $project->cover_image) }}" alt="">
            <div class="btn_section d-flex gap-4 pt-5">
                <button>
                    <a href="{{ route('admin.projects.index') }}">Back to my projects</a>
                </button>
                <button>
                    <a href="{{ route('admin.projects.edit', $project->slug) }}">Edit this project</a>
                </button>
                <form action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')

                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Delete project
                    </button>
                    <div class="modal fade centered" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content p-2 bg-white">
                                <div class="modal-body">
                                    <h4 class="text-black">Delete this project?</h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" data-bs-dismiss="modal">No</button>
                                    <button type="submit">Yes, delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@extends('layouts.guest')
@section('guest-content')
    <section id="guest_index">
        <div class="container py-4">
            <h1 class="text-center py-5">These Are My Current Projects</h1>
            <div class="row justify-content-between mt-4">
                @foreach ($projects as $project)
                    <div class="col-4 mb-5">
                        <div class="card hidden " style="width: 18rem;">
                            <div class="img-wrap">
                                <img src="{{ asset('storage/' . $project->cover_image) }}" class="card-img-top"
                                    alt="{{ $project->title }}">
                            </div>
                            <div class="card-body">
                                <div class="card-text">
                                    <h5 class="card-title">{{ $project->title }}</h5>
                                    <p class="card-text">{{ $project->proj_description }}</p>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">{{ $project->type->name }}</li>
                                @foreach ($project->technologies as $technology)
                                    <li class="list-group-item">{{ $technology->name }}</li>
                                @endforeach
                            </ul>
                            <div class="card-body">
                                <a href="{{ $project->github_link }}" target="_blank" class="card-link">View on Git Hub</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>
    </section>
@endsection

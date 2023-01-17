@extends('layouts.app')
@section('content')
    <section id="create_form">
        <div class="container py-5">
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <form action="{{ route('admin.projects.update', $project->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $project->title) }}">
                <label for="proj_description">Description</label>
                <input type="text" name="proj_description" id="proj_description"
                    value="{{ old('proj_description', $project->proj_description) }}" required>
                <label for="github_link">GitHub Link</label>
                <input type="text" name="github_link" id="github_link"
                    value="{{ old('github_link', $project->github_link) }}" required>
                <div class="mt-2">
                    <p>Previous Image</p>
                    <img width="300px" src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}">
                </div>
                <label for="cover_image">New Image</label>
                <input type="file" name="cover_image" id="cover_image">
                <select name="type_id" id="type_id" class="my-5 w-25">
                    <option value="">Select Type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $type->id == old('type_id') ? 'selected' : '' }}>
                            {{ $type->name }}</option>
                    @endforeach
                </select>

                {{-- <label for="technologies">Technologies</label>
                <select multiple class="form-select" name="technologies[]" id="technologies">
                    @forelse ($technologies as $technology)
                        @if ($errors->any())
                            <option value="{{ $technology->id }}"
                                {{ in_array($technology->id, old('technologies[]')) ? 'selected' : '' }}>
                                {{ $technology->name }}
                            </option>
                        @else
                            <option value="{{ $technology->id }}"
                                {{ $project->technologies->contains($technology->id) ? 'selected' : '' }}>
                                {{ $technology->name }}
                            </option>
                        @endif
                    @empty
                        <option value="">No technologies</option>
                    @endforelse
                </select> --}}
                <p class="mb-0 fs-5">Select Technology:</p>
                @foreach ($technologies as $technology)
                    <div class="form-check ps-0">
                        <label for="{{ $technology->slug }}">{{ $technology->name }}</label>
                        @if (old('technologies'))
                            <input type="checkbox" id="{{ $technology->slug }}" name="technologies[]"
                                value="{{ $technology->id }}"
                                {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>
                        @else
                            <input type="checkbox" id="{{ $technology->slug }}" name="technologies[]"
                                value="{{ $technology->id }}"
                                {{ $project->technologies->contains($technology) ? 'checked' : '' }}>
                        @endif

                    </div>
                @endforeach



                <input class="form_btn" type="submit" value="Send">
            </form>
        </div>
    </section>
@endsection

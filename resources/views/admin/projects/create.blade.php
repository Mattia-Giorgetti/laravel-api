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
            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title">
                <label for="proj_description">Description</label>
                <input type="text" name="proj_description" id="proj_description" required>
                <label for="github_link">GitHub Link</label>
                <input type="text" name="github_link" id="github_link" required>
                <label for="cover_image">Image</label>
                <input type="file" name="cover_image" id="cover_image">
                <label for="type_id">Project Type:</label>
                <select name="type_id" id="type_id" class="w-25">
                    <option value="">Select Type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $type->id == old('type_id') ? 'selected' : '' }}>
                            {{ $type->name }}</option>
                    @endforeach
                </select>

                {{-- <label for="technologies">Technologies</label>
                <select multiple class="form-select" name="technologies[]" id="technologies">
                    @forelse ($technologies as $technology)
                        <option value="{{ $technology->id }}">
                            {{ $technology->name }}
                        </option>

                    @empty
                        <option value="">No Technologies</option>
                    @endforelse
                </select> --}}
                <div class="mt-3">
                    <p>Project Technology:</p>
                    @foreach ($technologies as $technology)
                        <div class="form-check ps-0">
                            <label for="{{ $technology->slug }}">{{ $technology->name }}</label>
                            <input type="checkbox" id="{{ $technology->slug }}" name="technologies[]"
                                value="{{ $technology->id }}">
                        </div>
                    @endforeach
                </div>





                <input class="form_btn" type="submit" value="Send">
            </form>
        </div>
    </section>
@endsection

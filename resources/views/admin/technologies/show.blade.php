@extends('layouts.app')

@section('content')
    <section id="proj_page" class="py-5">
        <div class="container border-start ps-5">
            @if (session()->has('message'))
                <div class="alert alert-info mb-4">
                    {{ session()->get('message') }}
                </div>
            @endif
            <h2>{{ $technology->name }}</h2>
            <h3 class="text-white mb-5">Projects with this technology:</h3>
            <ul class="list-unstyled">
                @foreach ($technology->projects as $project)
                    <li class="text-white py-2">
                        <span>{{ $project->title }}</span>
                    </li>
                @endforeach
            </ul>
            <div class="btn_section d-flex gap-4 pt-5">
                <button>
                    <a href="{{ route('admin.technologies.index') }}">Back to Technologies</a>
                </button>
                <button>
                    <a href="{{ route('admin.technologies.edit', $technology->slug) }}">Edit this technology</a>
                </button>
                <form action="{{ route('admin.technologies.destroy', $technology->slug) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')


                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Delete technology
                    </button>
            </div>
            <div class="modal fade centered" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content p-2 bg-white">
                        <div class="modal-body">
                            <h4 class="text-black">Delete this Technology?</h4>
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

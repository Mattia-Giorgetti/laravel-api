@extends('layouts.app')

@section('content')
    <section id="proj_page" class="py-5">
        <div class="container border-start ps-5">
            @if (session()->has('message'))
                <div class="alert alert-info mb-4">
                    {{ session()->get('message') }}
                </div>
            @endif
            <h2>{{ $type->name }}</h2>
            @if (count($type->projects) > 0)
                <h3 class="text-white mb-4">Projects involved:</h3>
            @else
                <h3 class="text-white">Oops... no {{ $type->name }} projects here</h3>
            @endif

            <ul class="list-unstyled">
                @foreach ($type->projects as $project)
                    <li class="text-white py-2">
                        <span>{{ $project->title }}</span>
                    </li>
                @endforeach
            </ul>
            <div class="btn_section d-flex gap-4 pt-5">
                <button>
                    <a href="{{ route('admin.types.index') }}">Back to my types</a>
                </button>
                <button>
                    <a href="{{ route('admin.types.edit', $type->slug) }}">Edit this type</a>
                </button>
                <form action="{{ route('admin.types.destroy', $type->slug) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')


                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Delete type
                    </button>
            </div>
            <div class="modal fade centered" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content p-2 bg-white">
                        <div class="modal-body">
                            <h4 class="text-black">Delete this type?</h4>
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

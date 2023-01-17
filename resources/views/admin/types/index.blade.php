@extends('layouts.app')

@section('content')
    <section id="proj_list" class="py-5">
        <div class="container">
            <button class="mb-5">
                <a href="{{ route('admin.types.create') }}">Add Type</a>
            </button>
            @if (session()->has('message'))
                <div class="alert alert-info mb-4">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="row justify-content-between">
                @foreach ($types as $type)
                    <div class="col-12 d-flex align-items-center gap-5 mb-5">
                        <h4>{{ $type['name'] }}</h4>
                        <span>{{ count($type->projects) }}</span>
                        <button class="ms-auto">
                            <a href="{{ route('admin.types.show', $type->slug) }}">view {{ $type->name }}</a>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

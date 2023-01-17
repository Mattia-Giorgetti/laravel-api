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
            <form action="{{ route('admin.technologies.update', $technology->slug) }}" method="POST">
                @csrf
                @method('PUT')

                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $technology->name) }}">

                <input class="form_btn" type="submit" value="Send">
            </form>
        </div>
    </section>
@endsection

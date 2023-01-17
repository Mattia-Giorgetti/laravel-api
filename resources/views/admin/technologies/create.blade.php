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
            <form action="{{ route('admin.technologies.store') }}" method="POST">
                @csrf

                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name">

                <input class="form_btn" type="submit" value="Send">
            </form>
        </div>
    </section>
@endsection

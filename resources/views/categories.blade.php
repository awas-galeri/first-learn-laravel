@extends('layouts.main')

@section('container')
    <h1>Post Categories</h1>

    <div class="container">
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-4 mb-4">
                    <div class="card text-bg-dark">
                        <img src="https://source.unsplash.com/500x500?{{ $category->name }}" class="card-img"
                            alt="{{ $category->name }}">
                        <div class="card-img-overlay d-flex align-items-center">
                            <h5 class="card-title text-center flex-fill fs-3"><a href="/posts?category={{ $category->slug }}">{{ $category->name }}</a></h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

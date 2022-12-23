@extends('dashboard.layouts.master')

@section('container')
    <div class="container">
        <div class="row my-3">
            <div class="col-lg-8">
                <h1>{{ $post->title }}</h1>
                <article class="mt-3 mb-3">

                    <a href="/dashboard/posts" class="btn btn-success"><span data-feather="arrow-left"></span> Back to all my posts</a>
                    <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"><span data-feather="edit"></span> Edit</a>
                    <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger border-0" onclick="return confirm('Sure?')"><span data-feather="trash-2"></span> Delete</button>
                    </form>

                    @if ($post->image)
                    <div class="card-img-top mt-3" style="max-height: 350px; overflow: hidden;">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                    </div>
                    @else    
                    <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" class="card-img-top mt-3"
                        alt="{{ $post->category->name }}" class="img-fluid">
                    @endif
                    <article class="my-3 fs-5">
                        {!! $post->body !!}
                    </article>
                </article>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-10">
                <h1>{{ $post->title }}</h1>
                <article class="mt-3 mb-3">
                    <p>By. <a href="/posts?author={{ $post->author->username }}">{{ $post->author->name }}</a> in <a
                            href="/posts?categories={{ $post->category->slug }}">{{ $post->category->name }}</a></p>
                    @if ($post->image)
                        <div class="card-img-top mt-3" style="max-height: 350px; overflow: hidden;">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                        </div>
                    @else
                        <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}"
                            class="card-img-top mt-3" alt="{{ $post->category->name }}" class="img-fluid">
                    @endif
                    <article class="my-3 fs-5">
                        {!! $post->body !!}
                    </article>
                </article>

                <a href="/posts">Back to Blog</a>
            </div>
        </div>
    </div>
@endsection
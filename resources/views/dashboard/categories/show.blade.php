@extends('dashboard.layouts.master')

@section('container')
    <div class="mx-3">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Categories of {{ $category->name }}</h1>
        </div>

        <div class="mt-3 mb-3">
            <a href="/dashboard/categories" class="btn btn-success"><span data-feather="arrow-left"></span> Back to all
                categories</a>
            <a href="/dashboard/categories/{{ $category->slug }}/edit" class="btn btn-warning"><span
                    data-feather="edit"></span>
                Edit</a>
            <form action="/dashboard/categories/{{ $category->slug }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger border-0" onclick="return confirm('Sure?')"><span
                        data-feather="trash-2"></span>
                    Delete</button>
            </form>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card text-bg-dark">
                    <a href="/posts?category={{ $category->slug }}">
                        <img src="https://source.unsplash.com/500x500?{{ $category->name }}" class="card-img"
                            alt="{{ $category->name }}"></a>
                </div>
                <p class="mt-3 mb-5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquid aut error itaque illo
                    praesentium
                    asperiores mollitia, nulla laboriosam ipsum illum iure cumque aspernatur similique fuga iste debitis
                    blanditiis provident ipsam veniam quis error facere velit sequi deserunt minus.
                </p>
            </div>
        </div>
    </div>
@endsection

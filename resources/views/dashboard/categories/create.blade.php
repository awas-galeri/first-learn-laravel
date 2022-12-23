@extends('dashboard.layouts.master')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create New Category</h1>
    </div>
    <div class="col-lg-8 mb-5">
        <form action="/dashboard/categories" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    required autofocus value="{{ old('name') }}" autocomplete="off">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Category Slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                    required value="{{ old('slug') }}" autocomplete="off">
                @error('slug')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="id" class="form-label">Category ID</label>
                <input type="text" class="form-control @error('id') is-invalid @enderror" id="id" name="id"
                    required value="{{ old('id') }}" autocomplete="off">
                @error('id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- <div class="mb-3">
                <label for="image" class="form-label">Post Image</label>
                <img class="img-preview img-fluid mb-3 col-sm-5">
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                    name="image" onchange="previewImage()">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div> --}}

            <button type="submit" class="btn btn-primary mt-3">Create Category</button>
        </form>
    </div>

    <script>
        const name = document.querySelector('#name');
        const slug = document.querySelector('#slug');

        name.addEventListener('change', function() {
            fetch('/dashboard/categories/checkSlug?name=' + name.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });

        // function previewImage() {
        //     const image = document.querySelector('#image');
        //     const imgPreview = document.querySelector('.img-preview');

        //     imgPreview.style.display = 'block';

        //     const oFReader = new FileReader();
        //     oFReader.readAsDataURL(image.files[0]);

        //     oFReader.onload = function(oFREvent) {
        //         imgPreview.src = oFREvent.target.result;
        //     }
        // }
    </script>
@endsection

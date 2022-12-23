@extends('layouts.main')

@section('container')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1>Sanz Movies</h1>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Movie Title.." id="search-input">
                <div class="input-group-append">
                    <button class="btn btn-info" type="button" id="search-button">Search</button>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row" id="movie-list">

    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Sanz Movies</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
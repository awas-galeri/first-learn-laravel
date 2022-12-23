@extends('dashboard.layouts.master')

@section('container')
    <div class="mx-3">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Users of {{ $user->name }}</h1>
        </div>

        <div class="mt-3 mb-3">
            <a href="/dashboard/users" class="btn btn-success"><span data-feather="arrow-left"></span> Back to all
                users</a>
            <a href="/dashboard/users/{{ $user->slug }}/edit" class="btn btn-warning"><span data-feather="edit"></span>
                Edit</a>
            <form action="/dashboard/users/{{ $user->slug }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger border-0" onclick="return confirm('Sure?')"><span
                        data-feather="trash-2"></span>
                    Delete</button>
            </form>
        </div>


        <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
            <div class="card-header">
                <h5 class="card-title">Profil</h5>
            </div>
            <div class="card-body">
                <p class="card-text">Name : {{ $user->name }} <br>
                    Username : {{ $user->username }} <br>
                    Email : {{ $user->email }}</p>
                Status : @if ($user->is_admin)
                    <p>{{ $is_admin }}</p>
                @else
                    <p>USER</p>
                @endif
                <p class="card-text"><small>Created at {{ $user->created_at->diffForHumans() }}</small></p>
            </div>
        </div>
    @endsection

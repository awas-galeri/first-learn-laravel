<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class OperatorUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //-> bisa digabung, kalo pakai check depan harus dikasih not, karena kalo check (apabila udah login) menghasilkan nilai true
        // if(!auth()->check() || auth()->user()->username !== 'sanomanjiro') { 
        //     abort(403);
        // }
        // PINDAH KE MIDDLEWARE
        return view('dashboard.users.index', [
            'users' => User::all(),
            'is_admin' => 'admin'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255|unique:users',
            'slug' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:255',
            'is_admin' => 'required'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
        return redirect('/dashboard/users')->with('success', 'New users has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('dashboard.users.show', [
            'user' => $user,
            'is_admin' => 'ADMIN'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255',
            'email' => 'required|email',
            'is_admin' => 'required'
        ];

        // problem slug
        if ($request->slug != $user->slug) {
            $rules['slug'] = 'required|unique:users';
        }

        $validatedData = $request->validate($rules);

        User::where('id', $user->id)
            ->update($validatedData);
        return redirect('/dashboard/users')->with('success', 'Users has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/dashboard/users')->with('success', 'Users has been deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(User::class, 'slug', $request->username);
        return response()->json(['slug' => $slug]);
    }
}

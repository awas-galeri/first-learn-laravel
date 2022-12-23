<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home() {
        return view('home', [
            "title" => "Home",
            "active" => 'home'
        ]);
    }

    public function about() {
        return view('about', [
            "title" => "About",
            "active" => 'about'
        ]);
    }

    public function categories() {
        return view('categories', [
            'title' => 'Post Categories',
            "active" => 'categories',
            'categories' => Category::all()
        ]);
    }

    public function dashboard() {
        return view('dashboard.index');
    }

    public function movies() {
        return view('movies', [
            "title" => "Movies",
            "active" => "movies"
        ]);
    }

}
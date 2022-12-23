<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Cviebrock\EloquentSluggable\Services\SlugService;


class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // FUNGSI UNTUK MENAMPILKAN HALAMAN MY POSTS
    public function index()
    {
        return view('dashboard.posts.index', [
            // ambil data dari post, namun hanya ditampilkan user yg login (pakai where)
            'posts' => Post::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // FUNGSI UNTUK TAMBAH DATA
    public function create()
    {
        return view('dashboard.posts.create', [
            // kirim method category
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // FUNGSI UNTUK TANGKAP DATA POST YG DIKIRIM DARI DASHBOARD CREATE
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ]);

        // cek user isi image baru atau tidak
        if($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        // Panggil post
        Post::create($validatedData);
        return redirect('/dashboard/posts')->with('success','New post has been added!');        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    // FUNGSI UNTUK MENAMPILKAN HALAMAN READ / DETAIL POSTS / TOMBOL BADGE KECIL WARNA BIRU
    public function show(Post $post)
    {
        // mengakali route model binding, membuat slug menjadi nilai default untuk pencarian (customizing the key) ke Documentation lalu ke Models Post
        return view('dashboard.posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    // FUNGSI EDIT DATA
    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            // isi post yg lama
            'post' => $post,
            // kirim method category
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    // FUNGSI UPDATE DATA
    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ];

        // problem slug
        if($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        $validatedData = $request->validate($rules);

        // cek user isi image baru atau tidak
        if($request->file('image')) {
            // hapus gambar untuk mengganti atau menimpa gambar lama
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        // Apabila lolos
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        // Panggil post
        Post::where('id', $post->id)
                ->update($validatedData);

        return redirect('/dashboard/posts')->with('success','Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    // FUNGSI HAPUS
    public function destroy(Post $post)
    {
        // hapus gambar
        if($post->image) {
            Storage::delete($post->image);
        }

        Post::destroy($post->id);
        return redirect('/dashboard/posts')->with('success','Post has been deleted!');  
    }

    // FUNGSI SLUG OTOMATIS UNTUK TITLE
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

}
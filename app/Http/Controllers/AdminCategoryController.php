<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // cara simple pengkondisian untuk Admin yg masuk
        // namun akan menjadi repot, karena nanti harus copast ke controller CRUDnya
        // dan menambah username apabila ada yg ingin menjadi admin lagi
        // if(auth()->guest()) { 
        //     abort(403);
        // }

        // jika user yg masuk bukan admin
        // if(auth()->user()->username !== 'sanomanjiro') {
        //     abort(403);
        // }

        //-> bisa digabung, kalo pakai check depan harus dikasih not, karena kalo check (apabila udah login) menghasilkan nilai true
        // if(!auth()->check() || auth()->user()->username !== 'sanomanjiro') { 
        //     abort(403);
        // }

        return view('dashboard.categories.index', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // FITUR CREATE
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // TANGKAP DATA YG DIKIRIM OLEH CREATE
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'name' => 'required|max:255',
            'slug' => 'required|unique:categories'
        ]);

        Category::create($validatedData);
        return redirect('/dashboard/categories')->with('success', 'New category has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    // FITUR READ
    public function show(Category $category)
    {
        return view('dashboard.categories.show', [
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    // FITUR UPDATE
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    // TANGKAP DATA DARI EDIT LALU UPDATE
    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required|max:255'
        ];

        // problem slug
        if ($request->slug != $category->slug) {
            $rules['slug'] = 'required|unique:categories';
        }

        if ($request->id != $category->id) {
            $rules['id'] = 'required|unique:categories';
        }

        $validatedData = $request->validate($rules);

        Category::where('id', $category->id)
            ->update($validatedData);

        return redirect('/dashboard/categories')->with('success', 'Category has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    // FITUR DELETE
    public function destroy(Category $category)
    {
        Category::destroy($category->id);
        return redirect('/dashboard/categories')->with('success', 'Category has been added!');
    }

    // FUNGSI SLUG OTOMATIS UNTUK TITLE
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('subcategory.create')->with('categories', $categories);
    }
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subcategoryname' => 'required|max:255'
        ]);

        $subcategory = new Subcategory();
        $subcategory->category_id = $request['category_id'];
        $subcategory->subcategory_name = $request['subcategoryname'];
        $subcategory->slug = str_slug($request['subcategoryname']);
        $lastestSlug = Subcategory::whereRaw("slug RLIKE '^{$subcategory->slug}(-[0-9]*)?$'")
        ->latest('id')
        ->value('slug');
            if ($lastestSlug){
                $pieces = explode('-', $lastestSlug);
                $number = intval(end($pieces));
                $subcategory->slug .= '-' . ($number + 1);
                // Youtube Videos -> youtube-videos
                // Youtube Videos -> youtube-videos-1
                // Youtube Videos -> youtube-videos-2
            }
        $subcategory->save();
        $subcategories = subcategory::get();
        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Domain;
use Storage;
use File;
use Illuminate\Http\Request;



class DomainController extends Controller
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
        $subcategories = Subcategory::get();
        return view('domain.create')->with('categories', $categories)->with('subcategories', $subcategories);
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
            'email' => 'required|email',
            'title' => 'required|max:60',
            'url' => 'required|max:255',
            'shortdesc' => 'required|max:150'
        ]);

        $domain = new Domain();
        $domain->title = $request['title'];
        $domain->email = $request['email'];
        $domain->url = $request['url'];
        $domain->shortdescription = $request['shortdesc'];
        $domain->description = $request['desc'];
        $domain->category_id = $request['category_id'];
        $domain->subcategory_id = $request['subcategory_id'];
        $domain->paid = $request['paid'];

        //Pregunta si hay una imagen agregada, le coloca la extencion original
        //El nombre mediante la fecha de publicacion y guarda en la carpeta publica
        //Si no hay imagen, se coloca como imagen predeterminada "default.jpg" 
        //Localizada en la carpeta publica.
        if ($request['img']) {
            $image = $request['img'];
            $extension = $image->getClientOriginalExtension();
            $name = time() .'_'. $image->getClientOriginalName();
            Storage::disk('public')->put($name, File::get($image));
            $domain->img = $name; 
        }else{
            $domain->img = 'default.jpg';
        }
        $domain->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function show(Domain $domain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function edit(Domain $domain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Domain $domain)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function destroy(Domain $domain)
    {
        //
    }
}

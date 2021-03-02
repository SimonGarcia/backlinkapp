<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
        $domains = Domain::get();
        $categories = Category::get();
        $subcategories = Subcategory::get();

        return view('welcome')->with('domains', $domains)->with('categories', $categories)->with('subcategories', $subcategories);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function adminViewCategories()
    {
    	return view('admin.category.index');
    }

    public function adminAddCategories()
    {

    }

    public function adminEditCategories()
    {

    }
}

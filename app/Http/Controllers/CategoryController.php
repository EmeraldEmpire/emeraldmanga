<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function adminViewCategories()
    {
    	return view('admin.category.index');
    }

    public function adminAddCategories()
    {
        return view('admin.category.create');
    }

    public function adminEditCategories()
    {

    }

    public function adminStoreCategories()
    {
        $this->validate(request(), [
            'name' => 'required'
        ]);

        $category = Category::create(request(['name']));

        return redirect()->route('admin.home');
    }
}

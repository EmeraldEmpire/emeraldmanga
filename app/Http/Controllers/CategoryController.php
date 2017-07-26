<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Exception;

class CategoryController extends Controller
{
    public function adminIndexCategory()
    {
        $categories = Category::all();

    	return view('admin.category.index', compact('categories'));
    }

    public function adminStoreCategory()
    {
        $this->validate(request(), [
            'name' => 'required|unique:categories'
        ]);

        $category = Category::create(request(['name']));

        return response()->json($category, 201);
    }

    public function adminUpdateCategory($id)
    {
        $this->validate(request(), [
            'name' => 'required|unique:categories'
        ]);

        try {
            $category = Category::findOrFail($id);
            $category->update(request(['name']));
            return response()->json($category, 200);
        } catch (\ModelNotFoundException $e) {
            return abort(404);
        }

    }

    public function adminDeleteCategory($id)
    {
        try {
            if (!Category::destroy($id)) {
                throw new Exception();
            }

            return response()->json('Success', 200);
        } catch (Exception $e) {
            return abort(404);
        }
    }


}

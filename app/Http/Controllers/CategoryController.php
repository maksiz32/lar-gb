<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categories()
    {
        return view('categories.index', ['categories' => Category::paginate(5)]);
    }

    public function create()
    {
        return view('categories.input');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', ['category' => $category]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'integer|exists:categories,id',
            'category' => 'required|string|max:255',
                                        ]);
        if(isset($validated['id'])) {
            $category = Category::find($validated['id']);
        } else {
            $category = new Category();
        }
        $category->category = $validated['category'];
        $category->save();

        return redirect((action([__CLASS__, 'categories'])))
                            ->with(['message' => "Категория <strong>$category->category</strong> изменена"]);
    }

    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:categories,id',
                                        ]);
        $category = Category::findOrFail($validated['id']);
        $name = $category->category;
        $category->delete();

        return redirect((action([__CLASS__, 'categories'])))
            ->with(['message' => "Категория <strong>$name</strong> удалена"]);
    }
}

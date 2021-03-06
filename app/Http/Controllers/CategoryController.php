<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_admin')->except('categories');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function categories()
    {
        return view('categories.index', ['categories' => Category::paginate(5)]);
    }

    public function list()
    {
        return view('admin.categories', ['categories' => Category::paginate(5)]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('categories.input');
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Category $category)
    {
        return view('categories.edit', ['category' => $category]);
    }

    /**
     * @param CategoryRequest $request
     * @param Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CategoryRequest $request, Category $category)
    {
        $category = $category->fill($request->validated());
        if ($category->save()) {

            return redirect((action([__CLASS__, 'list'])))
                ->with(['message' => __('messages.admin.category.store.success')]);
        }

        return back()->with(['errors' => __('messages.admin.category.store.fail')]);
    }

    public function input(CategoryRequest $request)
    {
        $category = Category::create($request->validated());
        if ($category->save()) {

            return redirect((action([__CLASS__, 'list'])))
                ->with(['message' => __('messages.admin.category.input.success')]);
        }

        return back()->with(['errors' => __('messages.admin.category.input.fail')]);
    }

    /**
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();

            return response()->json(['message' => __('messages.admin.category.destroy.success')]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage() . PHP_EOL, $e->getTrace());

            return response()->json(['message' => __('messages.admin.category.destroy.fail')]);
        }
    }
}

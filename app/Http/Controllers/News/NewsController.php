<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\Source;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categories()
    {
        return view('news.index', ['categories' => Category::getAllCategories()]);
    }

    public function oneCategory(int $id)
    {
        $result = News::getNewsByCategory($id);
        $news = $result['news'];
        $catName = $result['catName'];

        return view('news.cat', ['news' => $news, 'catName' => $catName]);
//        return view('news.cat', [...$result]);
    }

    public function showOne(int $id)
    {
        $news = News::oneNews($id);
        return view('news.one', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.input', ['categories' => Category::getAllCategories()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'id' => 'integer|exists:news,id|nullable',
                'title' => 'required|string',
                'textNews' => 'required|string',
                'author' => 'required|string',
                'categories' => 'integer|exists:categories,id',
                'sourceId' => 'integer|exists:sources,id|nullable',
                'sourceName' => 'required|string',
                'sourcePath' => 'required|string',
            ]
        );
        $text = '';

        $category = Category::find($validated['categories']);
        $source_id = $validated['sourceId'] ?? null;
        if (!$source_id) {
            $source_id = Source::query()->create([
                'name' => $validated['sourceName'],
                'path' => $validated['sourcePath'],
                                    ])->id;
        }

        if (isset($validated['id']) && !is_null($validated['id'])) {
            $id = $validated['id'];
            $text = ' добавлена';
        } else {
            $id = null;
            $text = ' изменена';
        }
        $news = News::query()->updateOrCreate([
            'id' => $id
        ],
        [
            'title' => $validated['title'],
            'text' => $validated['textNews'],
            'author' => $validated['author'],
            'category_id' => $category->id,
            'source_id' => $source_id,
        ]);
        $news->save();
        $newsRes = News::query()->where('category_id', $category->id)->get();

        return view('news.cat', ['news' => $newsRes, 'catName' => $category->category])
        ->with(['message' => 'Новость <strong>' . $validated['title'] . '</strong>' . $text]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\News $news
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function edit(Request $request)
    {
        $news = News::find((int) $request['id']);
        $categories = Category::all();
        return view('news.input', ['news' => $news, 'categories' => $categories]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $news = News::query()->findOrFail($id);
        $title = $news->title;
        $catId = $news->category_id;
        $news->delete();
        $result = News::getNewsByCategory($catId);

        $newsRes = $result['news'];
        $catName = $result['catName'];

        return view('news.cat', ['news' => $newsRes, 'catName' => $catName])
            ->with(['message' => "Новость <strong>$title</strong> удалена"]);
    }
}

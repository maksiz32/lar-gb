<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\Source;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function oneCategory(int $id)
    {
        /** @var Category $cat */
        $category = Category::findOrFail($id);
        $result = $category->news()->paginate(3);

        return view('news.cat', ['news' => $result, 'catName' => $category->category]);
    }

    public function showOne(News $news)
    {
        $oneNews = News::query()->with(['category', 'source'])->find($news->id);
        return view('news.one', ['news' => $oneNews]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.input', ['categories' => Category::all()]);
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
                'id' => 'integer|exists:news,id',
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
            $source_id = Source::create([
                'name' => $validated['sourceName'],
                'path' => $validated['sourcePath'],
                                    ])->id;
        }

        if (!isset($validated['id'])) {
            $news = new News();
            $text = ' добавлена';
        } else {
            $news = News::find($validated['id']);
            $text = ' изменена';
        }
        $news->title = $validated['title'];
        $news->text = $validated['textNews'];
        $news->author = $validated['author'];
        $news->category_id = $category->id;
        $news->source_id = $source_id;

        if ($news->save()) {
            return redirect(action([__CLASS__, 'oneCategory'], ['id' => $category->id]))
                ->with(['message' => 'Новость <strong>' . $validated['title'] . '</strong>' . $text]);
        } else {
            return back()->with(['errors' => 'Ошибка при сохранении']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\News $news
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function edit(News $news)
    {
        $oneNews = News::with('source')->find($news->id);
        $categories = Category::all();
        return view('news.edit', ['news' => $oneNews, 'categories' => $categories]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $title = $news->title;
        $categoryId = $news->category_id;
        $news->delete();

        return redirect(action([__CLASS__, 'oneCategory'], ['id' => $categoryId]))
            ->with(['message' => "Новость <strong>$title</strong> удалена"]);
    }
}

<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\Source;
use App\Http\Requests\NewsRequest;
use Illuminate\Contracts\View\View;

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
     * @return View
     */
    public function create()
    {
        return view('news.input', ['categories' => Category::all()]);
    }

    /**
     * @param NewsRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(NewsRequest $request)
    {
        $text = '';

        $category = Category::find($request->categories);
        $source_id = $request->sourceId ?? null;
        if (!$source_id) {
            $source_id = Source::create([
                'name' => $request->sourceName,
                'path' => $request->sourcePath,
                                    ])->id;
        }

        if (!isset($request->id)) {
            $news = new News();
            $text = ' добавлена';
        } else {
            $news = News::find($request->id);
            $text = ' изменена';
        }
        $news->title = $request->title;
        $news->text = $request->textNews;
        $news->author = $request->author;
        $news->category_id = $category->id;
        $news->source_id = $source_id;

        if ($news->save()) {
            return redirect(action([__CLASS__, 'oneCategory'], ['id' => $category->id]))
                ->with(['message' => 'Новость <strong>' . $request->title . '</strong>' . $text]);
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

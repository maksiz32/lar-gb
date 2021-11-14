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
    public function __construct()
    {
        $this->middleware('is_admin')->except(['oneCategory', 'showOne', 'create', 'store']);
    }

    public function list()
    {
        return view('admin.news', ['news' => News::with(['category', 'source'])->paginate(4)]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function oneCategory(int $id)
    {
        /** @var Category $category */
        $category = Category::findOrFail($id);
        $result = $category->news()->paginate(3);

        return view('news.cat', ['news' => $result, 'catName' => $category->category]);
    }

    /**
     * @param News $news
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function showOne(News $news)
    {
        $oneNews = News::query()->with(['category', 'source'])->find($news->id);

        return view('news.one', ['news' => $oneNews]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function create()
    {
        return view('news.input', ['categories' => Category::all()]);
    }

    /**
     * @param NewsRequest $request
     * @param News $news
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(NewsRequest $request, News $news)
    {
        $source_id = $request->sourceId ?? null;
        if (!$source_id) {
            $source_id = Source::create([
                'name' => $request->sourceName,
                'path' => $request->sourcePath,
                                    ])->id;
        }

        $news = $news->fill($request->validated());
        $news->source_id = $source_id;

        if ($news->save()) {

            return redirect(action([__CLASS__, 'oneCategory'], ['id' => $news->category_id]))
                ->with(['message' => __('messages.admin.news.store.success')]);
        }

        return back()->with(['errors' => __('messages.admin.news.store.fail')]);
    }

    /**
     * @param NewsRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function input(NewsRequest $request)
    {
        $source_id = $request->sourceId ?? null;
        if (!$source_id) {
            $source_id = Source::create([
                                            'name' => $request->sourceName,
                                            'path' => $request->sourcePath,
                                        ])->id;
        }

        $news = News::create($request->validated());
        $news->source_id = $source_id;
        if ($news->save()) {

            return redirect(action([__CLASS__, 'oneCategory'], ['id' => $news->category_id]))
                ->with(['message' => __('messages.admin.news.input.success')]);
        }

        return back()->with(['errors' => __('messages.admin.news.input.fail')]);
    }

    /**
     * @param News $news
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function edit(News $news)
    {
        $oneNews = News::with('source')->find($news->id);
        $categories = Category::all();

        return view('news.edit', ['news' => $oneNews, 'categories' => $categories]);
    }

    /**
     * @param News $news
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(News $news)
    {
        try {
            $news->delete();

            return response()->json(['message' => __('messages.admin.news.destroy.success')]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage() . PHP_EOL, $e->getTrace());

            return response()->json(['message' => __('messages.admin.news.destroy.fail')]);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResourceRequest;
use App\Jobs\NewsJob;
use App\Models\Resource;
use App\Services\ValutasParser;

class ParserController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_admin')->except('valutas');
    }

    /**
     * @param ValutasParser $parser
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function valutas(ValutasParser $parser)
    {
        $parser->setUrl('https://www.cbr-xml-daily.ru/daily_utf8.xml');

        return view('news.valutas', ['valutas' => $parser->getCourses()]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function list()
    {
        return view('admin.parser.list', ['resources' => Resource::paginate(10)]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.parser.input');
    }

    /**
     * @param ResourceRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function input(ResourceRequest $request)
    {
        $resource = Resource::create($request->validated());
        if ($resource->save()) {

            return redirect(action([__CLASS__, 'list']))
                ->with(['message' => __('messages.admin.resource.input.success')]);
        }

        return back()->with(['errors' => __('messages.admin.resource.input.fail')]);
    }

    public function edit(Resource $resource)
    {
        return view('admin.parser.edit', ['resource' => $resource]);
    }

    /**
     * @param ResourceRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ResourceRequest $request)
    {
        $resource = Resource::find($request->id);
        $resource->path = $request->validated()['path'];
        $resource->title = $request->validated()['title'];
        if ($resource->save()) {

            return redirect(action([__CLASS__, 'list']))
                ->with(['message' => __('messages.admin.resource.update.success')]);
        }

        return back()->with(['errors' => __('messages.admin.resource.update.fail')]);
    }

    public function destroy(Resource $resource)
    {
        try {
            $resource->delete();

            return response()->json(['message' => __('messages.admin.resource.destroy.success')]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage() . PHP_EOL, $e->getTrace());

            return response()->json(['message' => __('messages.admin.resource.destroy.fail')]);
        }
    }

    public function yandexParse()
    {
        // Перебираем ресурсы для парсинга из БД
        $newsResources = Resource::get();
        foreach ($newsResources as $resource) {
            dispatch(new NewsJob($resource));
        }
        echo "Запросы запущены, дождитесь сообщения по электронной почте.";
    }
}

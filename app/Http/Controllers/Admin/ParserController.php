<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ValutasParser;

class ParserController extends Controller
{
    /**
     * @param ValutasParser $parser
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function __invoke(ValutasParser $parser)
    {
        $parser->setUrl('https://www.cbr-xml-daily.ru/daily_utf8.xml');

        return view('news.valutas', ['valutas' => $parser->getCourses()]);
    }
}

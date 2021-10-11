<?php

namespace App\Http\Controllers;

use Faker\Provider\Lorem;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $news = [
            0 => [
                'title' => 'Title1',
                'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto atque delectus dicta
                            hic, incidunt nam non obcaecati provident quis reiciendis.',
            ],
            1 => [
                'title' => 'Title2',
                'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto atque delectus dicta
                            hic, incidunt nam non obcaecati provident quis reiciendis.',
            ],
            2 => [
                'title' => 'Title3',
                'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto atque delectus dicta
                            hic, incidunt nam non obcaecati provident quis reiciendis.',
            ],
        ];
        $page_title = 'First Page';
        $description = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa dignissimos doloremque esse
                        ipsa iure libero minima odio omnis provident unde? Aperiam dignissimos ex ipsam modi quae,
                        quod reiciendis sed voluptatum? Asperiores cupiditate id magni numquam odio, officia
                        reprehenderit sit tempora!';

        return view('index', [
            'news' => $news,
            'page_title' => $page_title,
            'description' => $description
        ]);
    }
}

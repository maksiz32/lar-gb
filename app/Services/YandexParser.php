<?php

namespace App\Services;

use App\Models\Category;
use App\Models\News;
use App\Models\Resource;
use Carbon\Carbon;
use Orchestra\Parser\Xml\Facade as XmlParser;

class YandexParser
{
    public function parseNews($link)
    {
        $xml = XmlParser::load($link);
        $data = $xml->parse([
                                'title' => [
                                    'uses' => 'channel.title'
                                ],
                                'link' => [
                                    'uses' => 'channel.link'
                                ],
                                'description' => [
                                    'uses' => 'channel.description'
                                ],
                                'image' => [
                                    'uses' => 'channel.image.url'
                                ],
                                'news' => [
                                    'uses' => 'channel.item[title,link,guid,description,pubDate]'
                                ]
                            ]);
        return $data;
    }

    public function parseYandexNews(): self
    {
        // Перебираем ресурсы для парсинга из БД
        $newsResources = Resource::get();
        foreach ($newsResources as $resource) {
            // На тот случай, если ресурс уже не работает, тогда залогируем ошибку и будем дальше парсить
            try {
                $parsedNews = $this->parseNews($resource->path);
            } catch (\Exception $e) {
                \Log::error($e->getMessage() . PHP_EOL, $e->getTrace());
            }

            if ($parsedNews['news']) {
                $categoryId = null;
                $newsAuthor = '';
                if ($resource->title) {
                    $newsAuthor = 'Яндекс Новости';
                    $newsCategory = $resource->title;
                } else {
                    $arrayTitleStringExplode = explode(" ", $parsedNews['title']);
                    $countTitleNews = count($arrayTitleStringExplode);
                    $newsAuthor = $arrayTitleStringExplode[0];
                    $newsCategory = $arrayTitleStringExplode[$countTitleNews - 1];
                }

                // Проверка существования Категории Новостей
                $categoryInDb = Category::where('category', $newsCategory)->first();
                if (!$categoryInDb) {
                    $category = Category::create([
                                                     'category' => addslashes($newsCategory)
                                                 ]);
                    $categoryId = $category->id;
                } else {
                    $categoryId = $categoryInDb->id;
                }
                $resourceId = $resource->id;
                if(count($parsedNews['news']) > 0) {
                    foreach ($parsedNews['news'] as $item) {
                        // Проверка: есть ли такая новость уже в базе (сделано с введением переменной для читаемости)
                        $isSetNewsInDB = News::where('title', $item['title'])->first();
                        if(!$isSetNewsInDB) {
                            try {
                                $news = new News();
                                $news->title = addslashes($item['title']);
                                $news->text = addslashes($item['description']);
                                $news->author = $newsAuthor;
                                $news->category_id = $categoryId;
                                $news->resource_id = $resourceId;
                                $news->created_at = Carbon::parse($item['pubDate']);
                                $news->save();
                                // Логирование
                                $currientTime = new Carbon();
                                \Log::info("Добавлена новость ID: {$news->id} :: Время ({$currientTime->format('d-m-Y H:i:s')})");
                            } catch (\Exception $e) {
                                \Log::error($e->getMessage() . PHP_EOL, $e->getTrace());
                            }
                        }
                    }
                }

            }
        }

        return $this;
    }
}

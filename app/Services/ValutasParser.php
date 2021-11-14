<?php

namespace App\Services;

use Orchestra\Parser\Xml\Facade as XmlParser;

class ValutasParser
{
    private const VALUTAS_CODES = [
        'GBP' => [
            'numCode' => 826,
            'name' => 'Фунт стерлингов Соединенного королевства',
        ],
        'BYN' => [
            'numCode' => 933,
            'name' => 'Белорусский рубль',
        ],
        'USD' => [
            'numCode' => 840,
            'name' => 'Доллар США',
        ],
        'EUR' => [
            'numCode' => 978,
            'name' => 'Евро',
        ],
    ];
    private string $parse_url;

    public function setUrl(string $url): self
    {
        $this->parse_url = $url;

        return $this;
    }

    /**
     * Возвращает массив нужных кодов курсов валют
     * @return array
     */
    private function getArrayCoursesCode(): array
    {
        return array_map(function($value) {
                return $value['numCode'];
            }, self::VALUTAS_CODES);
    }

    /**
     * Возвращает только необходимые курсы валют
     *
     * @return array
     */
    public function getCourses(): array
    {
        $xml = XmlParser::load($this->parse_url);

        $data = $xml->parse([
                    'title' => [
                        'uses' => 'Valute[NumCode,CharCode,Name,Nominal,Value]'
                    ]
                ]);

        $resultCoursesArray = array_filter($data['title'], function($v, $k) {
                return in_array($v['NumCode'], $this->getArrayCoursesCode(), false);
            }, ARRAY_FILTER_USE_BOTH);

        return $resultCoursesArray;
    }
}

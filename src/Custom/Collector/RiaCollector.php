<?php


namespace App\Custom\Collector;


use App\Custom\AbstractCollector;
use Symfony\Component\DomCrawler\Crawler;

class RiaCollector extends AbstractCollector
{
    const URL = 'https://ria.ru/location_Novosibirsk/';

    public function __construct()
    {
        parent::__construct(self::URL);
    }

    /**
     * @param string $html
     * @return array
     */
    protected function parse($rawData)
    {
        $crawler = new Crawler($rawData);
        $data = [];
        $crawler->filter('div .list-item__content')->each(function ($node) use (&$data) {
            $data[] = [
                'title' => $node->getNode(0)->nodeValue,
                'href' => $node->filter('.list-item__title')->attr('href'),
            ];
        });
        return $data;
    }


}
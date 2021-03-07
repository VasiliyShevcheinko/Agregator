<?php


namespace App\Custom\Collector;


use App\Custom\AbstractCollector;
use Symfony\Component\DomCrawler\Crawler;

class AvitoCollector extends AbstractCollector
{
    const URL = 'https://www.avito.ru/novosibirsk';
    protected $pageSize = 9;


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
        $baseUrl = explode('/', self::URL);
        $baseUrl = $baseUrl[0] . '//' . $baseUrl[2];
        $crawler->filter('div[itemtype="http://schema.org/Product"]')->each(function ($node) use (&$data, $baseUrl) {
            $data[] = [
                'title' => $node->filter('h3[itemprop="name"]')->getNode(0)->nodeValue,
                'price' => $node->filter('span[class*="price"]')->getNode(0)->nodeValue,
                'href' => $baseUrl . $node->filter('a[class*="link-link"]')->attr('href'),
                'imgSrc' => $node->filter('img[itemprop="image"]')->attr('src'),
                'imgAlt' => $node->filter('img[itemprop="image"]')->attr('alt'),
            ];
        });
        return $data;
    }


}
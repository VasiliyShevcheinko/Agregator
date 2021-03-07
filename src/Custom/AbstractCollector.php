<?php


namespace App\Custom;

use Symfony\Component\HttpClient\HttpClient;

abstract class AbstractCollector
{
    protected $data;
    protected $itemsNumber;
    protected $pagesNumber;
    protected $currentPageNumber;
    protected $pageSize = 10;

    /**
     * AbstractCollector constructor.
     * @param string $url
     * @param array $headers
     */
    protected function __construct(string $url, array $headers = [])
    {
        $rawData = $this->request($url, $headers);
        $this->data = $this->parse($rawData);
        $this->itemsNumber = count($this->data);
        $this->pagesNumber = $this->itemsNumber / $this->pageSize;
        $this->pagesNumber = intval(ceil($this->pagesNumber));
    }

    /**
     * @param $rawData
     * @return mixed
     */
    abstract protected function parse($rawData);

    /**
     * @param string $url
     * @param $headers
     * @return string
     */
    private function request(string $url, array $headers)
    {
        $httpClient = HttpClient::create();
        $response = $httpClient->request('GET', $url, [
            'headers' => $headers,
        ]);
        return $response->getContent();
    }

    /**
     * @param array $data
     * @param int $page
     * @return array
     */
    public function selectPage(int $page)
    {
        if ($page > 0)
            $page--;

        if ($page > $this->pagesNumber - 1)
            $page = $this->pagesNumber - 1;

        $this->currentPageNumber = $page;

        $firstItemNum = $page * $this->pageSize;

        $lastItemNum = $firstItemNum + $this->pageSize;
        if ($lastItemNum > $this->itemsNumber)
            $lastItemNum = $this->itemsNumber;

        $dataPage = [];
        for ($i = $firstItemNum; $i < $lastItemNum; $i++) {
            $dataPage[] = $this->data[$i];
        }

        return $dataPage;
    }

    /**
     * @return int
     */
    public function getPagesNumber()
    {
        return $this->pagesNumber;
    }

    public function getPaginationPage()
    {
        return $this->currentPageNumber + 1;
    }
}
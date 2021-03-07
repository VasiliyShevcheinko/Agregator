<?php

namespace App\Controller;

use App\Custom\Collector\RiaCollector;
use App\Custom\Collector\AvitoCollector;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SourcesController extends AbstractController
{
    /**
     * @Route("/ria/{page}", name="ria", requirements={"page"="\d+"})
     */
    public function ria($page = 1): Response
    {
        $collector = new RiaCollector();
        $pageData = $collector->selectPage($page);
        $pageNumbers = $collector->getPagesNumber();
        $paginationPage = $collector->getPaginationPage();

        return $this->render('sources/ria.html.twig', [
            'src' => 'ria',
            'title' => 'Ria.ru',
            'pageData' => $pageData,
            'pageNumber' => $page,
            'pageNumbers' => $pageNumbers,
            'paginationPage' => $paginationPage,
        ]);
    }

    /**
     * @Route("/avito/{page}", name="avito", requirements={"page"="\d+"})
     */
    public function avito($page = 1): Response
    {
        $collector = new AvitoCollector();
        $pageData = $collector->selectPage($page);
        $pageNumbers = $collector->getPagesNumber();
        $paginationPage = $collector->getPaginationPage();

        return $this->render('sources/avito.html.twig', [
            'src' => 'avito',
            'title' => 'Avito.ru',
            'pageData' => $pageData,
            'pageNumber' => $page,
            'pageNumbers' => $pageNumbers,
            'paginationPage' => $paginationPage,
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AgregatorController extends AbstractController
{
    /**
     * @Route("/", name="sources")
     */
    public function sources(UrlGeneratorInterface $router): Response
    {
        $sources = [
            'Ria.ru' => $router->generate('ria'),
            'Avito.ru' => $router->generate('avito'),
        ];

        return $this->render('agregator/sources.html.twig', [
            'sources' => $sources,
        ]);
    }
}

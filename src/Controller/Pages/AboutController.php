<?php

namespace App\Controller\Pages;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    #[Route([
        'fr' => '/about',
        'en' => '/en/about',
        'es' => '/es/sobre'
    ], name: 'app_about')]
    public function index(): Response
    {
        return $this->render('about/index.html.twig');
    }
}
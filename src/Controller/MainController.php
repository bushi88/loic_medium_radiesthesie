<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\HomeSliderRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{

    public function __construct(
        private HomeSliderRepository $slideRepo, 
        private ArticleRepository $articleRepo
    ){}

    
    /**
     * Je met une route par defaut pour le francais
     * Je met mes local pour les autres langues
     */
    #[Route([
        'fr' => '/',
        'en' => '/en',
        'es' => '/es'
    ], name: 'app_home')]
    public function index(Request $request): Response
    {

        /**
         * Je vais mettre dans une variable $locale la langue de l'utilisateur
         */
        $locale = $request->getLocale();

        return $this->render('main/index.html.twig', [
            'homeSliders' => $this->slideRepo->findBy(['isDisplayed' => true, 'lang' => $locale], ['createdAt' => 'DESC'], 4),
            'lastArticles' => $this->articleRepo->findBy(['lang' => $locale], ['id' => 'DESC'], 11)
        ]);
    }
}
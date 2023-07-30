<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\HomeSliderRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    private $slideRepo;
    private $articleRepo;

    public function __construct(HomeSliderRepository $slideRepo, ArticleRepository $articleRepo)
    {
        $this->slideRepo = $slideRepo;
        $this->articleRepo = $articleRepo;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {

        $homeSliders = $this->slideRepo->findBy(['isDisplayed' => true], ['createdAt' => 'DESC'], 4);
        $lastArticles = $this->articleRepo->findBy([], ['id' => 'DESC'], 11);
        // $lastArticles = $this->articleRepo->findBy([], ['createdAt' => 'DESC'], 11);
        // dump($lastArticles);

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'homeSliders' => $homeSliders,
            'lastArticles' => $lastArticles,
        ]);
    }
}
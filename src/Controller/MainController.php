<?php

namespace App\Controller;

use App\Repository\HomeSliderRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    private $slideRepo;

    public function __construct(HomeSliderRepository $slideRepo)
    {
        $this->slideRepo = $slideRepo;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $articles = [
            [
                "titre" => "La radiesthésie et les énergies cachées",
                "texte" => "La radiesthésie est un voyage vers l'invisible, une exploration des mystères cachés de l'univers.",
                "image" => "1.jpg",
                "icone" => "bx bxs-yin-yang"
            ],
            [
                "titre" => "La connexion spirituelle du medium",
                "texte" => "Le medium est un canal entre le monde matériel et spirituel, une connexion entre le visible et l'invisible.",
                "image" => "2.jpg",
                "icone" => "bx bxs-moon"
            ],
            [
                "titre" => "L'harmonie du corps par la médecine parallèle",
                "texte" => "La médecine parallèle est un équilibre entre la sagesse ancienne et la science moderne, une approche holistique de la guérison.",
                "image" => "3.jpg",
                "icone" => "bx bxs-flask"
            ],
            [
                "titre" => "La radiesthésie et les vibrations du cosmos",
                "texte" => "La radiesthésie nous enseigne l'art de ressentir les énergies, de capter les vibrations du cosmos.",
                "image" => "4.jpg",
                "icone" => "bx bxs-compass"
            ],
            [
                "titre" => "Le medium, guide des âmes vers l'au-delà",
                "texte" => "Le medium est un passeur d'âmes, un guide vers l'autre côté du voile.",
                "image" => "5.jpg",
                "icone" => "bx bxs-door-open"
            ],
            [
                "titre" => "L'harmonie corps-âme par la médecine parallèle",
                "texte" => "La médecine parallèle nous rappelle que la guérison commence par l'esprit, que le corps et l'âme sont intimement liés.",
                "image" => "6.jpg",
                "icone" => "bx bxs-heart"
            ],
            [
                "titre" => "La radiesthésie, art de la danse énergétique",
                "texte" => "La radiesthésie est un art divinatoire, une danse entre l'homme et les énergies de la terre.",
                "image" => "7.jpg",
                "icone" => "bx bxs-sun"
            ],
            [
                "titre" => "L'énergie curative de la radiesthésie",
                "texte" => "La radiesthésie est un moyen d'accéder à l'énergie curative universelle, une source de guérison pour le corps et l'esprit.",
                "image" => "8.jpg",
                "icone" => "bx bxs-group"
            ],
            [
                "titre" => "La médecine parallèle et la sagesse de la nature",
                "texte" => "La médecine parallèle nous rappelle que la nature est notre plus grand guérisseur, que les plantes ont des pouvoirs curatifs.",
                "image" => "9.jpg",
                "icone" => "bx bxs-tree"
            ],
        ];

        $homeSlider = $this->slideRepo->findBy(['isDisplayed' => true]);

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'homeSlider' => $homeSlider,
            'articles' => $articles,
        ]);
    }
}
<?php

namespace App\Controller;

use App\Service\HoroscopeService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/zodiaq', name: 'app_zodiaq_')]
class ZodiaqController extends AbstractController
{
    private $horoscopeService;

    public function __construct(HoroscopeService $horoscopeService)
    {
        $this->horoscopeService = $horoscopeService;
    }

    #[Route('/', name: 'all')]
    public function index(): Response
    {
        $zodiaqSigns = [
            [
                "sign" => "belier",
                "image" => "Aries.png",
                "date" => "du 21 mars au 19 avril",
                "traits" => "Enthousiaste, dynamique, rapide et compétitif"
            ],
            [
                "sign" => "taureau",
                "image" => "Taurus.png",
                "date" => "du 20 avril au 20 mai",
                "traits" => "Fort, fiable, sensuel et créatif"
            ],
            [
                "sign" => "gemeaux",
                "image" => "Gemini.png",
                "date" => "du 21 mai au 20 juin",
                "traits" => "Polyvalent, expressif, curieux et gentil"
            ],
            [
                "sign" => "cancer",
                "image" => "Cancer.png",
                "date" => "du 21 juin au 22 juillet",
                "traits" => "Intuitif, sentimental, compatissant et protecteur"
            ],
            [
                "sign" => "lion",
                "image" => "Leo.png",
                "date" => "du 23 juillet au 22 août",
                "traits" => "Dramatique, extraverti, fougueux et sûr de lui"
            ],
            [
                "sign" => "vierge",
                "image" => "Virgo.png",
                "date" => "du 23 août au 22 septembre",
                "traits" => "Pratique, loyal, doux et analytique"
            ],
            [
                "sign" => "balance",
                "image" => "Libra.png",
                "date" => "du 23 septembre au 22 octobre",
                "traits" => "Social, équitable, diplomate et gracieux"
            ],
            [
                "sign" => "scorpion",
                "image" => "Scorpio.png",
                "date" => "du 23 octobre au 21 novembre",
                "traits" => "Passionné, têtu, ingénieux et courageux"
            ],
            [
                "sign" => "sagittaire",
                "image" => "Sagittarius.png",
                "date" => "du 22 novembre au 21 décembre",
                "traits" => "Extraverti, optimiste, drôle et généreux"
            ],
            [
                "sign" => "capricorne",
                "image" => "Capricornus.png",
                "date" => "du 22 décembre au 19 janvier",
                "traits" => "Sérieux, indépendant, discipliné et tenace"
            ],
            [
                "sign" => "verseau",
                "image" => "Aquarius.png",
                "date" => "du 20 janvier au 18 février",
                "traits" => "Profond, imaginatif, original et intransigeant"
            ],
            [
                "sign" => "poissons",
                "image" => "Pisces.png",
                "date" => "du 19 février au 20 mars",
                "traits" => "Affectueux, empathique, sage et artistique"
            ],
        ];
        return $this->render('zodiaq/index.html.twig', [
            'zodiaqSigns' => $zodiaqSigns,
        ]);
    }

    #[Route('/{slug}', name: 'sign')]
    public function sign(Request $request, string $slug): Response
    {
        // Récupérer l'horoscope détaillé pour le signe spécifié
        $horoscopeData = $this->horoscopeService->getHoroscope($slug);

        return $this->render('zodiaq/sign.html.twig', [
            'slug' => $slug,
            'horoscopeData' => $horoscopeData,
        ]);
    }
}
<?php

namespace App\Controller;

use App\Service\HoroscopeService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ZodiaqController extends AbstractController
{
    private $horoscopeService;

    public function __construct(HoroscopeService $horoscopeService)
    {
        $this->horoscopeService = $horoscopeService;
    }

    #[Route('/zodiaq/{slug}', name: 'app_zodiaq')]
    public function index(Request $request, string $slug): Response
    {
        // Récupérer l'horoscope quotidien détaillé pour le signe spécifié
        $horoscopeData = $this->horoscopeService->getHoroscope($slug);

        return $this->render('zodiaq/index.html.twig', [
            'controller_name' => 'ZodiaqController',
            'slug' => $slug,
            'horoscopeData' => $horoscopeData,
        ]);
    }
}
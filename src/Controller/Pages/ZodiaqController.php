<?php

namespace App\Controller\Pages;

use App\Repository\ZodiaqRepository;
use App\Service\HoroscopeService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/zodiaq', name: 'app_zodiaq_')]
class ZodiaqController extends AbstractController
{
    public function __construct(
        private HoroscopeService $horoscopeService,
        private ZodiaqRepository $zodiaqRepo
    ) {
    }

    #[Route('/', name: 'all')]
    public function index(): Response
    {
        $zodiaqSigns = $this->zodiaqRepo->findAll();

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
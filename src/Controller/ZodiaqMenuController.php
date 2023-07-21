<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ZodiaqMenuController extends AbstractController
{
    #[Route('/zodiaq/menu', name: 'app_zodiaq_menu')]
    public function index(): Response
    {
        $zodiacSigns = ['belier', 'taureau', 'gemeaux', 'cancer', 'lion', 'vierge', 'balance', 'scorpion', 'sagittaire', 'capricorne', 'verseau', 'poissons'];

        return $this->render('zodiaq_menu/index.html.twig', [
            'zodiacSigns' => $zodiacSigns,
        ]);
    }
}
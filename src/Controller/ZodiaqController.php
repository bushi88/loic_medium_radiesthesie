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
                "image" => "https://lh3.googleusercontent.com/pw/ACtC-3fnt48-z_r0o2kcuLZ2qx0CyTyyKa4uO05y4gbMZMOcTB66oLpwq511Hvjq6guZS2qr12fAQHUH0kSoi1afSJ2gX-LTzhjpMvsHGGfpjK5vK4kbWe-ScfgE06D1uqLn_fUmkALzS0r8-p8yEgFxJoX8=s500-no",
                "date" => "du 21 mars au 19 avril",
                "traits" => "Enthousiaste, dynamique, rapide et compétitif"
            ],
            [
                "sign" => "taureau",
                "image" => "https://lh3.googleusercontent.com/pw/ACtC-3dEXKQS6YgyieJt17NCoSc4mOUEIPVAID4XarDo_YxnqfMo9OaTQwF82YabAtterjDKxTddjQGC9o4gfpXgyBRriPEfAqA3URNb1i6sv9DEGDJyZDTVrPkfFxQx_DCvZ6lwO83rZ_wG7bFDV4mrGvO2=s500-no",
                "date" => "du 20 avril au 20 mai",
                "traits" => "Fort, fiable, sensuel et créatif"
            ],
            [
                "sign" => "gemeaux",
                "image" => "https://lh3.googleusercontent.com/pw/ACtC-3cI28uadYQZgEAv3qB8MNyEIivppH6b4T86ROV-fEBFvpDeHQQB7UDVq1BhXZARqAz8jP34RjS_M9nuynGID9cFbiTpokEoll94ObGFXkWqbPTO7zG7G2dtEHKD1Fd1qso7VMUMWuAA8LcqgSxacw1c=s500-no",
                "date" => "du 21 mai au 20 juin",
                "traits" => "Polyvalent, expressif, curieux et gentil"
            ],
            [
                "sign" => "cancer",
                "image" => "https://lh3.googleusercontent.com/pw/ACtC-3ceW__atYB7ql_fVRRuuHNbaNTtzmOqGwEtefUt0zigGFwVT7SCdZI2nce0r_cV0JZ1OmMiyBtCNr6uPHwpceVgrcZqDksX_PRNirIxwIY7s8W3QFwF36mr9E4eoT1NblCtlx_uNlV02sBN4awGUmkD=s500-no",
                "date" => "du 21 juin au 22 juillet",
                "traits" => "Intuitif, sentimental, compatissant et protecteur"
            ],
            [
                "sign" => "lion",
                "image" => "https://lh3.googleusercontent.com/pw/ACtC-3eM7m0ZcY0iD5Rmg_5XTOyleq8rGpuYVeITp14ph2scj5w1WSn2GtpWSCJlw7Gan0ZyCZpsT9DjMGkSc6y9pBQn8drJr_ZhMXucc61bDUk5VzS0Ktq1oxqyWikuqZQ4SaIGl9pD7IxD8p7F9DBIwKH4=s500-no",
                "date" => "du 23 juillet au 22 août",
                "traits" => "Dramatique, extraverti, fougueux et sûr de lui"
            ],
            [
                "sign" => "vierge",
                "image" => "https://lh3.googleusercontent.com/pw/ACtC-3ctekmi1UV3ZEi46BE-syzP3TkJyA_FIcoeXf5ZhB5oUt5cNzOeIEDCgd3YB7hYrRLSGfoN0aP9vDXRIR5-SHVOoR-HcRAi5ZZbovAbBEg-mb1YI8XXhbIGcHmy0zNGA6dI9gw6etdsusvJ1BjTOjRg=s500-no",
                "date" => "du 23 août au 22 septembre",
                "traits" => "Pratique, loyal, doux et analytique"
            ],
            [
                "sign" => "balance",
                "image" => "https://lh3.googleusercontent.com/pw/ACtC-3esLeOaikdOlQM0HypcGTvOUiOyio-q8J4LD5VxlGxsLGUVvHUXVgYA-xVM_p5iqrKXZCV8iBkYAi0ph952FqXZVoTIqIjJFO76yhqDRgXAkkHKOG4YzfOTVnP4SQ2_C1MOUbQgQAyVi4ruxhSCaxwu=s500-no",
                "date" => "du 23 septembre au 22 octobre",
                "traits" => "Social, équitable, diplomate et gracieux"
            ],
            [
                "sign" => "scorpion",
                "image" => "https://lh3.googleusercontent.com/pw/ACtC-3fEJcdDU7yZ3Oi1imZr2_GUb4mlfsW0oKJTbgNRidn59W7YUhmWKtCFVl_O_C4h8M6ZnkNrJuTBRFr_Nr-rS7xWbAvvH1xYe3wMajO-W_RxWBTso5Sl4Zpb4AbqP0vGRMlzWtezP9nbhL96UUbo8xlh=s500-no",
                "date" => "du 23 octobre au 21 novembre",
                "traits" => "Passionné, têtu, ingénieux et courageux"
            ],
            [
                "sign" => "sagittaire",
                "image" => "https://lh3.googleusercontent.com/pw/ACtC-3cyOzCj0J08OZwTs-8L1BuKm8IsuEZF-qngTp7xx8jvFPl_wgmwZ42tq551zMddt0cfjOkWNaqTiGPiXYRYks_jZGn7syqOKqm0sD3d1FlVf76zF9VMe6blfY_-Uc7zbpb3l44c5eVd69jXeuvyQNlT=s500-no",
                "date" => "du 22 novembre au 21 décembre",
                "traits" => "Extraverti, optimiste, drôle et généreux"
            ],
            [
                "sign" => "capricorne",
                "image" => "https://lh3.googleusercontent.com/pw/ACtC-3cuOa96lqaso4mHk_LIZpRVuxgybl0I89dIfdAeodOAMreGdYmrBOFjJ-8Fq57jpoJGps7NGKHW-PSq7JSsYNelbaoery1t6U-miCvtmXNF_umyJClBGwFSOU8zI3wC5mdK2SCZx1WJKTIhFYjOwzzo=s500-no",
                "date" => "du 22 décembre au 19 janvier",
                "traits" => "Sérieux, indépendant, discipliné et tenace"
            ],
            [
                "sign" => "verseau",
                "image" => "https://lh3.googleusercontent.com/pw/ACtC-3fFJlHX0jY1_V74ojAGSRw2Z_nCwFdkziXqwcBLuhv52SyHUoO29gbDG_QaEo1e9JrGaCSip2IuWe0uGPoS8HtSjmv5D-Uj1Ui03Zpgnsj7-YYte7KaimnbBIcAApp9fc88L6C42ftRFoUwAgH0xq3-=s500-no",
                "date" => "du 20 janvier au 18 février",
                "traits" => "Profond, imaginatif, original et intransigeant"
            ],
            [
                "sign" => "poissons",
                "image" => "https://lh3.googleusercontent.com/pw/ACtC-3fxfiwxTlwG-wr6vPfMbjRoxlPz4pqVBay9-x90yHSazmbSBoKFRGsPDdjyjRuGShhB9csVYyLPyNWRetcGmyAWvQm3EFGzCFKWdW303m1trJ4bABPVpsILsVeryXy9kHR6gRFsNf8W8B93X5PtHEyD=s500-no",
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
<?php

namespace App\DataFixtures;

use App\Entity\HomeSlider;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class HomeSliderFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $sliders = [
            1 => [
                "title" => "Équilibrez votre énergie vitale",
                "description" => "Retrouvez votre équilibre énergétique grâce à la puissance apaisante de la radiesthésie",
                "image" => "1.jpg",
                "lang" => "fr"
            ],
            2 => [
                "title" => "Balance Your Vital Energy",
                "description" => "Regain your energy balance with the soothing power of dowsing",
                "image" => "1.jpg",
                "lang" => "en"
            ],
            3 => [
                "title" => "Equilibra tu Energía Vital",
                "description" => "Recupera tu equilibrio energético con el poder tranquilizador de la radiestesia",
                "image" => "1.jpg",
                "lang" => "es"
            ],
            4 => [
                "title" => "Soin purificateur et libérateur",
                "description" => "stress, mal-être, fardeaux, énergie et liens toxiques, mauvais œil, blocages, poids du passé, karma familial...",
                "image" => "2.jpg",
                "lang" => "fr"
            ],
            5 => [
                "title" => "Purifying and Liberating Care",
                "description" => "stress, discomfort, burdens, energy and toxic ties, evil eye, blockages, weight of the past, family karma...",
                "image" => "2.jpg",
                "lang" => "en"
            ],
            6 => [
                "title" => "Cuidado Purificador y Liberador",
                "description" => "estrés, malestar, cargas, energía y lazos tóxicos, mal de ojo, bloqueos, peso del pasado, karma familiar...",
                "image" => "2.jpg",
                "lang" => "es"
            ],
            7 => [
                "title" => "Trouvez les réponses cachées",
                "description" => "Plongez dans l'univers secret de la radiesthésie et révélez les réponses qui illumineront votre chemin",
                "image" => "3.jpg",
                "lang" => "fr"
            ],
            8 => [
                "title" => "Discover Hidden Answers",
                "description" => "Dive into the secret world of dowsing and reveal the answers that will illuminate your path",
                "image" => "3.jpg",
                "lang" => "en"
            ],
            9 => [
                "title" => "Descubre Respuestas Ocultas",
                "description" => "Sumérgete en el mundo secreto de la radiestesia y descubre las respuestas que iluminarán tu camino",
                "image" => "3.jpg",
                "lang" => "es"
            ],
            10 => [
                "title" => "Harmonisez votre vie avec la radiesthésie",
                "description" => "Expérimentez une vie harmonieuse et équilibrée en laissant la radiesthésie vous guider vers la sérénité",
                "image" => "5.jpg",
                "lang" => "fr"
            ],
            11 => [
                "title" => "Harmonize Your Life with Dowsing",
                "description" => "Experience a harmonious and balanced life by letting dowsing guide you to serenity",
                "image" => "5.jpg",
                "lang" => "en"
            ],
            12 => [
                "title" => "Armoniza Tu Vida con la Radiestesia",
                "description" => "Experimenta una vida armoniosa y equilibrada dejando que la radiestesia te guíe hacia la serenidad",
                "image" => "5.jpg",
                "lang" => "es"
            ]
        ];

        foreach ($sliders as $key => $value) {
            $slide = new HomeSlider();
            $slide->setTitle($value['title']);
            $slide->setDescription($value['description']);
            $slide->setImage($value['image']);
            $slide->setLang($value['lang']);
            $slide->setIsDisplayed(1);
            $manager->persist($slide);
        }

        $manager->flush();
    }
}
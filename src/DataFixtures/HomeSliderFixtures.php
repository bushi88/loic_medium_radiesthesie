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
            ],
            2 => [
                "title" => "Soin purificateur et libérateur",
                "description" => "stress, mal-être, fardeaux, énergie et liens toxiques, mauvais œil, blocages, poids du passé, karma familial...",
                "image" => "2.jpg",
            ],
            3 => [
                "title" => "Trouvez les réponses cachées",
                "description" => "Plongez dans l'univers secret de la radiesthésie et révélez les réponses qui illumineront votre chemin",
                "image" => "3.jpg",
            ],
            4 => [
                "title" => "Harmonisez votre vie avec la radiesthésie",
                "description" => "Expérimentez une vie harmonieuse et équilibrée en laissant la radiesthésie vous guider vers la sérénité",
                "image" => "5.jpg",
            ],

        ];
        foreach ($sliders as $key => $value) {
            $slide = new HomeSlider();
            $slide->setTitle($value['title']);
            $slide->setDescription($value['description']);
            $slide->setImage($value['image']);
            $slide->setIsDisplayed(1);
            $manager->persist($slide);
        }

        $manager->flush();
    }
}
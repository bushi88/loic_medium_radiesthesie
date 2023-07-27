<?php

namespace App\DataFixtures;

use App\Entity\Zodiaq;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ZodiaqFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $zodiaqSigns = [
            1 => [
                "sign" => "belier",
                "image" => "Aries.png",
                "date" => "du 21 mars au 19 avril",
                "traits" => "Enthousiaste, dynamique, rapide, compétitif"
            ],
            2 => [
                "sign" => "taureau",
                "image" => "Taurus.png",
                "date" => "du 20 avril au 20 mai",
                "traits" => "Fort, fiable, sensuel, créatif"
            ],
            3 => [
                "sign" => "gemeaux",
                "image" => "Gemini.png",
                "date" => "du 21 mai au 20 juin",
                "traits" => "Polyvalent, expressif, curieux, gentil"
            ],
            4 => [
                "sign" => "cancer",
                "image" => "Cancer.png",
                "date" => "du 21 juin au 22 juillet",
                "traits" => "Intuitif, sentimental, compatissant, protecteur"
            ],
            5 => [
                "sign" => "lion",
                "image" => "Leo.png",
                "date" => "du 23 juillet au 22 août",
                "traits" => "Dramatique, extraverti, fougueux, sûr de lui"
            ],
            6 => [
                "sign" => "vierge",
                "image" => "Virgo.png",
                "date" => "du 23 août au 22 septembre",
                "traits" => "Pratique, loyal, doux, analytique"
            ],
            7 => [
                "sign" => "balance",
                "image" => "Libra.png",
                "date" => "du 23 septembre au 22 octobre",
                "traits" => "Social, équitable, diplomate, gracieux"
            ],
            8 => [
                "sign" => "scorpion",
                "image" => "Scorpio.png",
                "date" => "du 23 octobre au 21 novembre",
                "traits" => "Passionné, têtu, ingénieux, courageux"
            ],
            9 => [
                "sign" => "sagittaire",
                "image" => "Sagittarius.png",
                "date" => "du 22 novembre au 21 décembre",
                "traits" => "Extraverti, optimiste, drôle, généreux"
            ],
            10 => [
                "sign" => "capricorne",
                "image" => "Capricornus.png",
                "date" => "du 22 décembre au 19 janvier",
                "traits" => "Sérieux, indépendant, discipliné, tenace"
            ],
            11 => [
                "sign" => "verseau",
                "image" => "Aquarius.png",
                "date" => "du 20 janvier au 18 février",
                "traits" => "Profond, imaginatif, original, intransigeant"
            ],
            12 => [
                "sign" => "poissons",
                "image" => "Pisces.png",
                "date" => "du 19 février au 20 mars",
                "traits" => "Affectueux, empathique, sage, artistique"
            ],
        ];
        foreach ($zodiaqSigns as $key => $value) {
            $zodiaq = new Zodiaq();
            $zodiaq->setSign($value['sign']);
            $zodiaq->setImage($value['image']);
            $zodiaq->setDate($value['date']);
            $zodiaq->setTraits($value['traits']);
            $manager->persist($zodiaq);
        }

        $manager->flush();
    }
}
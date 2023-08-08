<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoryFixtures extends Fixture
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {

        $categories = [
            1 => [
                "title" => "Introduction à la radiesthésie",
                "description" => "Articles expliquant les bases de la radiesthésie, son histoire, ses concepts fondamentaux, etc.",
                "icone" => "bx bxs-yin-yang",
                "lang" => "fr"
            ],
            7 => [
                "title" => "Introduction to Dowsing",
                "description" => "Articles explaining the basics of dowsing, its history, fundamental concepts, etc.",
                "icone" => "bx bxs-yin-yang",
                "lang" => "en"
            ],
            13 => [
                "title" => "Introducción a la Radiestesia",
                "description" => "Artículos que explican los conceptos básicos de la radiestesia, su historia, conceptos fundamentales, etc.",
                "icone" => "bx bxs-yin-yang",
                "lang" => "es"
            ],
            2 => [
                "title" => "Pratiques et techniques de radiesthésie",
                "description" => "Articles détaillant les différentes méthodes de pratique de la radiesthésie, telles que l'utilisation du pendule, des baguettes, des cadrans, etc.",
                "icone" => "bx bxs-heart",
                "lang" => "fr"
            ],
            8 => [
                "title" => "Practices and Techniques of Dowsing",
                "description" => "Articles detailing various methods of dowsing practice, such as pendulum use, dowsing rods, dowsing charts, etc.",
                "icone" => "bx bxs-heart",
                "lang" => "en"
            ],
            14 => [
                "title" => "Prácticas y Técnicas de Radiestesia",
                "description" => "Artículos que detallan varios métodos de práctica de la radiestesia, como el uso del péndulo, varillas radiestésicas, gráficos radiestésicos, etc.",
                "icone" => "bx bxs-heart",
                "lang" => "es"
            ],
            3 => [
                "title" => "Interprétation des signes",
                "description" => "Comment interpréter les mouvements du pendule, les réponses des baguettes, les cadrans, etc., et comment les utiliser pour obtenir des informations.",
                "icone" => "bx bxs-tree",
                "lang" => "fr"
            ],
            9 => [
                "title" => "Interpretation of Signs",
                "description" => "How to interpret pendulum movements, dowsing rod responses, dowsing charts, etc., and how to use them to obtain information.",
                "icone" => "bx bxs-tree",
                "lang" => "en"
            ],
            15 => [
                "title" => "Interpretación de los Signos",
                "description" => "Cómo interpretar los movimientos del péndulo, las respuestas de las varillas radiestésicas, los gráficos radiestésicos, etc., y cómo usarlos para obtener información.",
                "icone" => "bx bxs-tree",
                "lang" => "es"
            ],
            4 => [
                "title" => "Applications de la radiesthésie",
                "description" => "Articles montrant comment la radiesthésie peut être utilisée dans divers domaines tels que la santé, la recherche d'objets perdus, la géobiologie, la recherche d'eau, etc.",
                "icone" => "bx bxs-paper-plane",
                "lang" => "fr"
            ],
            10 => [
                "title" => "Applications of Dowsing",
                "description" => "Articles showing how dowsing can be used in various fields such as health, finding lost objects, geobiology, water divining, etc.",
                "icone" => "bx bxs-paper-plane",
                "lang" => "en"
            ],
            16 => [
                "title" => "Aplicaciones de la Radiestesia",
                "description" => "Artículos que muestran cómo la radiestesia se puede utilizar en diversos campos como la salud, la búsqueda de objetos perdidos, la geobiología, la búsqueda de agua, etc.",
                "icone" => "bx bxs-paper-plane",
                "lang" => "es"
            ],
            5 => [
                "title" => "Nettoyage et protection énergétique",
                "description" => "Méthodes de nettoyage et de protection énergétique utilisées en radiesthésie.",
                "icone" => "bx bxs-shield",
                "lang" => "fr"
            ],
            11 => [
                "title" => "Energy Cleansing and Protection",
                "description" => "Methods of energy cleansing and protection used in dowsing.",
                "icone" => "bx bxs-shield",
                "lang" => "en"
            ],
            17 => [
                "title" => "Limpieza y Protección Energética",
                "description" => "Métodos de limpieza y protección energética utilizados en radiestesia.",
                "icone" => "bx bxs-shield",
                "lang" => "es"
            ],
            6 => [
                "title" => "Témoignages et expériences",
                "description" => "Partager les expériences de personnes ayant utilisé la radiesthésie et les résultats obtenus.",
                "icone" => "bx bxs-comment-detail",
                "lang" => "fr"
            ],
            12 => [
                "title" => "Testimonials and Experiences",
                "description" => "Share the experiences of individuals who have used dowsing and the results achieved.",
                "icone" => "bx bxs-comment-detail",
                "lang" => "en"
            ],
            18 => [
                "title" => "Testimonios y Experiencias",
                "description" => "Compartir las experiencias de personas que han utilizado la radiestesia y los resultados obtenidos.",
                "icone" => "bx bxs-comment-detail",
                "lang" => "es"
            ],
        ];

        foreach ($categories as $key => $value) {
            $category = new Category();
            $category->setTitle($value['title']);
            $category->setSlug($this->slugger->slug($category->getTitle()));
            $category->setDescription($value['description']);
            $category->setIcone($value['icone']);
            $category->setLang($value['lang']);
            $this->addReference('category_' . $key, $category);
            $manager->persist($category);
        }

        $manager->flush();
    }
}
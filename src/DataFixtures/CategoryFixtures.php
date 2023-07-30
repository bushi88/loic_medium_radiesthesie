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
                'title' => 'Introduction à la radiesthésie',
                'description' => 'Articles expliquant les bases de la radiesthésie, son histoire, ses concepts fondamentaux, etc.',
                'icone' => 'bx bxs-yin-yang',
            ],
            2 => [
                'title' => 'Pratiques et techniques de radiesthésie',
                'description' => 'Articles détaillant les différentes méthodes de pratique de la radiesthésie, telles que l\'utilisation du pendule, des baguettes, des cadrans, etc.',
                'icone' => 'bx bxs-heart',
            ],
            3 => [
                'title' => 'Interprétation des signes',
                'description' => 'Comment interpréter les mouvements du pendule, les réponses des baguettes, les cadrans, etc., et comment les utiliser pour obtenir des informations.',
                'icone' => 'bx bxs-tree',
            ],
            4 => [
                'title' => 'Applications de la radiesthésie',
                'description' => 'Articles montrant comment la radiesthésie peut être utilisée dans divers domaines tels que la santé, la recherche d\'objets perdus, la géobiologie, la recherche d\'eau, etc.',
                'icone' => 'bx bxs-paper-plane',
            ],
            5 => [
                'title' => 'Nettoyage et protection énergétique',
                'description' => 'Méthodes de nettoyage et de protection énergétique utilisées en radiesthésie.',
                'icone' => 'bx bxs-shield',
            ],
            6 => [
                'title' => 'Témoignages et expériences',
                'description' => 'Partager les expériences de personnes ayant utilisé la radiesthésie et les résultats obtenus.',
                'icone' => 'bx bxs-comment-detail',
            ],
            7 => [
                'title' => 'Événements et formations',
                'description' => 'Annoncer des événements liés à la radiesthésie, des ateliers, des conférences, des formations, etc.',
                'icone' => 'bx bxs-calendar',
            ],
            8 => [
                'title' => 'Actualités et découvertes',
                'description' => 'Articles sur les dernières nouvelles, recherches ou découvertes dans le domaine de la radiesthésie.',
                'icone' => 'bx bxs-news',
            ],
        ];

        foreach ($categories as $key => $value) {
            $category = new Category();
            $category->setTitle($value['title']);
            $category->setSlug($this->slugger->slug($category->getTitle()));
            $category->setDescription($value['description']);
            $category->setIcone($value['icone']);
            $this->addReference('category_' . $key, $category);
            $manager->persist($category);
        }

        $manager->flush();
    }
}
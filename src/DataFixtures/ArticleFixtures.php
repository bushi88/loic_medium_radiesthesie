<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= 50; $i++) {
            $article = new Article();

            $category = $this->getReference('category_' . rand(1, 8));
            $article->setCategory($category);

            $article->setTitle($faker->sentence($nbWords = 4, $variableNbWords = true));
            $article->setSlug($this->slugger->slug($article->getTitle()));
            $article->setShortDescription($faker->sentence(6));
            $article->setDescription($faker->paragraph());
            $article->setImage(rand(1, 11) . '.jpg');

            $manager->persist($article);
        }

        $lastArticles = [
            1 => [
                "title" => "La radiesthésie et les énergies cachées",
                "shortDescription" => "La radiesthésie est un voyage vers l'invisible, une exploration des mystères cachés de l'univers.",
                "image" => "1.jpg",
            ],
            2 => [
                "title" => "La connexion spirituelle du medium",
                "shortDescription" => "Le medium est un canal entre le monde matériel et spirituel, une connexion entre le visible et l'invisible.",
                "image" => "2.jpg",
            ],
            3 => [
                "title" => "L'harmonie du corps par la médecine parallèle",
                "shortDescription" => "La médecine parallèle est un équilibre entre la sagesse ancienne et la science moderne, une approche holistique de la guérison.",
                "image" => "3.jpg",
            ],
            4 => [
                "title" => "La radiesthésie et les vibrations du cosmos",
                "shortDescription" => "La radiesthésie nous enseigne l'art de ressentir les énergies, de capter les vibrations du cosmos.",
                "image" => "4.jpg",
            ],
            5 => [
                "title" => "Le medium, guide des âmes vers l'au-delà",
                "shortDescription" => "Le medium est un passeur d'âmes, un guide vers l'autre côté du voile.",
                "image" => "5.jpg",
            ],
            6 => [
                "title" => "L'harmonie corps-âme par la médecine parallèle",
                "shortDescription" => "La médecine parallèle nous rappelle que la guérison commence par l'esprit, que le corps et l'âme sont intimement liés.",
                "image" => "6.jpg",
            ],
            7 => [
                "title" => "La radiesthésie, art de la danse énergétique",
                "shortDescription" => "La radiesthésie est un art divinatoire, une danse entre l'homme et les énergies de la terre.",
                "image" => "7.jpg",
            ],
            8 => [
                "title" => "L'énergie curative de la radiesthésie",
                "shortDescription" => "La radiesthésie est un moyen d'accéder à l'énergie curative universelle, une source de guérison pour le corps et l'esprit.",
                "image" => "8.jpg",
            ],
            9 => [
                "title" => "La médecine parallèle et la sagesse de la nature",
                "shortDescription" => "La médecine parallèle nous rappelle que la nature est notre plus grand guérisseur, que les plantes ont des pouvoirs curatifs.",
                "image" => "9.jpg",
            ],
        ];

        foreach ($lastArticles as $key => $value) {

            $article = new Article();

            $category = $this->getReference('category_' . rand(1, 8));
            $article->setCategory($category);

            $article->setTitle($value['title']);
            $article->setShortDescription($value['shortDescription']);
            $article->setImage($value['image']);

            $article->setSlug($this->slugger->slug($article->getTitle()));
            $article->setDescription($faker->paragraph());

            $manager->persist($article);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class
        ];
    }
}
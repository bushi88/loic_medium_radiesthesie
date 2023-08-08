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
        // articles langue fr

        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= 200; $i++) {
            $article = new Article();

            $category = $this->getReference('category_' . rand(1, 6));
            $article->setCategory($category);

            $article->setTitle($faker->sentence($nbWords = 5, $variableNbWords = false));
            $article->setSlug($this->slugger->slug($article->getTitle()));
            $article->setShortDescription($faker->text(300));
            $article->setImage(rand(1, 11) . '.jpg');

            // description avec 4 paragraphes d'environ 1000 caractères chacun
            $description = '';
            for ($j = 0; $j < 4; $j++) {
                $paragraph = $faker->text(1000);
                // Ajouter le paragraphe au texte complet avec une balise <p>
                $description .= '<p>' . $paragraph . '</p>';
            }
            $article->setDescription($description);
            $article->setLang('fr');

            $manager->persist($article);
        }

        // articles langue en

        $faker = Factory::create('en_EN');

        for ($i = 1; $i <= 200; $i++) {
            $article = new Article();

            $category = $this->getReference('category_' . rand(7, 12));
            $article->setCategory($category);

            $article->setTitle($faker->sentence($nbWords = 5, $variableNbWords = false));
            $article->setSlug($this->slugger->slug($article->getTitle()));
            $article->setShortDescription($faker->text(300));
            $article->setImage(rand(1, 11) . '.jpg');

            $description = '';
            for ($j = 0; $j < 4; $j++) {
                $paragraph = $faker->text(1000);
                $description .= '<p>' . $paragraph . '</p>';
            }
            $article->setDescription($description);
            $article->setLang('en');

            $manager->persist($article);
        }

        // articles langue es

        $faker = Factory::create('es_ES');

        for ($i = 1; $i <= 200; $i++) {
            $article = new Article();

            $category = $this->getReference('category_' . rand(8, 18));
            $article->setCategory($category);

            $article->setTitle($faker->sentence($nbWords = 5, $variableNbWords = false));
            $article->setSlug($this->slugger->slug($article->getTitle()));
            $article->setShortDescription($faker->text(300));
            $article->setImage(rand(1, 11) . '.jpg');

            $description = '';
            for ($j = 0; $j < 4; $j++) {
                $paragraph = $faker->text(1000);
                $description .= '<p>' . $paragraph . '</p>';
            }
            $article->setDescription($description);
            $article->setLang('es');

            $manager->persist($article);
        }


        // derniers articles (langue fr)

        $lastArticles = [
            1 => [
                "title" => "La radiesthésie et les énergies cachées",
                "shortDescription" => "La radiesthésie est un voyage vers l'invisible, une exploration des mystères cachés de l'univers.",
                "image" => "1.jpg",
                "lang" => "fr"
            ],
            2 => [
                "title" => "La connexion spirituelle du medium",
                "shortDescription" => "Le medium est un canal entre le monde matériel et spirituel, une connexion entre le visible et l'invisible.",
                "image" => "2.jpg",
                "lang" => "fr",
            ],
            3 => [
                "title" => "L'harmonie du corps par la médecine parallèle",
                "shortDescription" => "La médecine parallèle est un équilibre entre la sagesse ancienne et la science moderne, une approche holistique de la guérison.",
                "image" => "3.jpg",
                "lang" => "fr",
            ],
            4 => [
                "title" => "La radiesthésie et les vibrations du cosmos",
                "shortDescription" => "La radiesthésie nous enseigne l'art de ressentir les énergies, de capter les vibrations du cosmos.",
                "image" => "4.jpg",
                "lang" => "fr",
            ],
            5 => [
                "title" => "Le medium, guide des âmes vers l'au-delà",
                "shortDescription" => "Le medium est un passeur d'âmes, un guide vers l'autre côté du voile.",
                "image" => "5.jpg",
                "lang" => "fr",
            ],
            6 => [
                "title" => "L'harmonie corps-âme par la médecine parallèle",
                "shortDescription" => "La médecine parallèle nous rappelle que la guérison commence par l'esprit, que le corps et l'âme sont intimement liés.",
                "image" => "6.jpg",
                "lang" => "fr",
            ],
            7 => [
                "title" => "La radiesthésie, art de la danse énergétique",
                "shortDescription" => "La radiesthésie est un art divinatoire, une danse entre l'homme et les énergies de la terre.",
                "image" => "7.jpg",
                "lang" => "fr",
            ],
            8 => [
                "title" => "L'énergie curative de la radiesthésie",
                "shortDescription" => "La radiesthésie est un moyen d'accéder à l'énergie curative universelle, une source de guérison pour le corps et l'esprit.",
                "image" => "8.jpg",
                "lang" => "fr",
            ],
            9 => [
                "title" => "La médecine parallèle et la sagesse de la nature",
                "shortDescription" => "La médecine parallèle nous rappelle que la nature est notre plus grand guérisseur, que les plantes ont des pouvoirs curatifs.",
                "image" => "9.jpg",
                "lang" => "fr",
            ],
        ];

        foreach ($lastArticles as $key => $value) {

            $article = new Article();

            $category = $this->getReference('category_' . rand(1, 6));
            $article->setCategory($category);

            $article->setTitle($value['title']);
            $article->setShortDescription($value['shortDescription']);
            $article->setImage($value['image']);

            $article->setSlug($this->slugger->slug($article->getTitle()));

            $description = '';
            for ($j = 0; $j < 4; $j++) {
                $paragraph = $faker->text(600);
                $description .= '<p>' . $paragraph . '</p>';
            }
            $article->setDescription($description);
            $article->setLang('fr');

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
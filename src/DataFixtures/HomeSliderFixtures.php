<?php

namespace App\DataFixtures;

use App\Entity\HomeSlider;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class HomeSliderFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $homeSlider = new HomeSlider();
            $homeSlider->setTitle($faker->sentence(1))
                ->setDescription($faker->paragraph(1))
                ->setButtonMessage($faker->sentence(1))
                ->setButtonURL($faker->url)
                ->setImage($faker->imageUrl(1700, 400, 'ads', true))
                ->setIsDisplayed($faker->boolean(30)); // 30% chance to be `true`

            $manager->persist($homeSlider);
        }

        $manager->flush();
    }
}
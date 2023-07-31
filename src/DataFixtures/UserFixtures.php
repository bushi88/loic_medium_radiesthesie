<?php

namespace App\DataFixtures;

use DateTime;
use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordEncoder, private SluggerInterface $slugger)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('admin@admin.fr');
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'admin')
        );
        $admin->setUsername('Bushi88');
        $admin->setLastname('CH');
        $admin->setFirstname('Djam');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setGender('homme');
        $admin->setBirthdate(new DateTime('08-10-1979'));
        $manager->persist($admin);

        $faker = Factory::create('fr_FR');

        for ($usr = 1; $usr <= 3; $usr++) {
            $user = new User();
            $user->setEmail($faker->email);
            $user->setPassword(
                $this->passwordEncoder->hashPassword($user, 'secret')
            );
            $user->setUsername($faker->unique()->userName);
            $user->setLastname($faker->lastName);
            $user->setRoles(['ROLE_USER']);
            $gender = $faker->randomElement(['homme', 'femme']); // Génère aléatoirement 'homme' ou 'femme'
            $firstName = ($gender == 'homme') ? $faker->firstNameMale : $faker->firstNameFemale;
            $user->setGender($gender);
            $user->setFirstName($firstName);
            $min = '-110 years';
            $max = '-18 years';
            $date = $faker->dateTimeBetween($min, $max);
            $user->setBirthdate($date);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
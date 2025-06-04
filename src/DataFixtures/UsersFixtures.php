<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;

class UsersFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {}

    public function load(ObjectManager $manager): void
    {
        // Admin manuel
        $admin = new Users();
        $admin->setEmail('admin@admin.admin');
        $admin->setName('Admin');
        $admin->setPicture('1.png');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'admin'));
        $admin->setIsVerified(true);
        $manager->persist($admin);

        // Faker
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 50; $i++) {
    $user = new Users();
    
    // Pour les images 1.png à 9.png, on boucle dessus en mod 9 + 1
    $imageNumber = ($i % 9) + 1;
    $user->setPicture($imageNumber . '.png');
    
    $user->setName($faker->name());
    $user->setEmail($faker->unique()->safeEmail());
    $user->setRoles(['ROLE_USER']);
    $user->setIsVerified($faker->boolean(80));
    $password = $this->passwordHasher->hashPassword($user, 'password');
    $user->setPassword($password);
    $this->addReference('user_' . $i, $user);

    $manager->persist($user);
    }
    $manager->flush();
}

}
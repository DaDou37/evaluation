<?php

namespace App\DataFixtures;

use App\Entity\Faq;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class FaqFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 20; $i++) {
            $faq = new Faq();
            $faq->setRequest($faker->sentence(rand(5, 8), true) . ' ?');
            $faq->setResponse($faker->paragraphs(rand(1, 3), true));
            $faq->setCreatedAt(new \DateTimeImmutable());
            $faq->setUpdatedAt(new \DateTimeImmutable());

            $manager->persist($faq);
        }

        $manager->flush();
    }
}
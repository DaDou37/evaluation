<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Post;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class PostFixture extends Fixture
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $possibleTags = ['Trading', 'Buisness', 'Stock', 'Foxtrader', 'Investor', 'Trading', 'Daytrading', 'Management', 'Investment', 'Forex Trading', 'Trading Market'];

        for ($i = 0; $i < 50; $i++) {
            $post = new Post();
            
            $title = $faker->sentence(4);
            $slug = strtolower($this->slugger->slug($title));

            $post
                ->setName($title)
                ->setSlug($slug)
                ->setContent($faker->paragraphs(3, true))
                ->setTags($faker->randomElements($possibleTags, rand(1, 3)))
                ->setCreatedAt(new \DateTimeImmutable('-' . rand(1, 365) . ' days'))
                ->setUpdatedAt(new \DateTimeImmutable());

            $manager->persist($post);
        }

        $manager->flush();
    }
}

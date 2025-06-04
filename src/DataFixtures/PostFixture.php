<?php

namespace App\DataFixtures;

use App\Entity\Users;
use App\Entity\Post;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class PostFixture extends Fixture implements DependentFixtureInterface
{
    public function __construct(private SluggerInterface $slugger) {}

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $possibleTags = ['Trading', 'Buisness', 'Stock', 'Foxtrader', 'Investor', 'Daytrading', 'Management', 'Investment', 'Forex Trading', 'Trading Market'];

        // 🔍 Récupère tous les utilisateurs existants depuis la base
        $users = $manager->getRepository(Users::class)->findAll();

        if (count($users) === 0) {
            throw new \Exception("Aucun utilisateur trouvé pour associer aux posts");
        }

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

            // 👤 Associe un utilisateur aléatoire existant
            $randomUser = $users[array_rand($users)];
            $post->setAuthor($randomUser);

            $manager->persist($post);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UsersFixtures::class,
        ];
    }
}

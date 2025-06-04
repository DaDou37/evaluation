<?php

namespace App\DataFixtures;

use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class TeamFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $roles = ['Trade Captain', 'Financial Consultant', 'Operation Consultant', 'Trade Consultant', 'HR Consultant', 'Technologie Consultant', 'Customer Consultant', 'Project Manager'];
        $socials = ['twitter', 'linkedin', 'facebook', 'instagram', 'youtube', 'indid'];

        // 🔹 3 profils manuels
        $manualProfiles = [
            [
                'name' => 'Nicolas Launay',
                'picture' => 'https://images-ext-1.discordapp.net/external/l1V9G3_EaF5DbNvN8pOedvaF64A4XpB-DnVl1rcbu_o/https/cdn.discordapp.com/avatars/413060479993249793/cb6469ada31ae0e475a395eb9083dc19.png',
                'title' => ['Database Manager'],
                'social' => [
                    'linkedin' => 'https://linkedin.com',
                    'twitter' => 'https://twitter.com',
                    'onlyfan' => 'https://onlyfans.com'
                ],
                'description' => 'Sais compté jusqu\'à 10 et sais mettre ses chaussures.',
            ],
            [
                'name' => 'David ',
                'picture' => 'https://images-ext-1.discordapp.net/external/0AFJgRX4vdcCxh9u0XjXd_w-tG7KdZgDS98GbsclHkk/https/cdn.discordapp.com/avatars/773268101893980181/b75cbbb9e8597116a51dc269b50bdb1f.png',
                'title' => ['HTML Consultant', 'Project Manager'],
                'social' => [
                    'facebook' => 'https://facebook.com',
                    'bar' => 'https://alcooliques-anonymes.fr'
                ],
                'description' => 'Travailleur de l\'extrême qui deviendra prochainement HTML Manager.',
            ],
            [
                'name' => 'Alexis ',
                'picture' => 'https://images-ext-1.discordapp.net/external/-URmt7adIxaVx0jyFxS9juwKICNh6DSV4QWyD6oXCkk/https/cdn.discordapp.com/avatars/478841095569145856/465b768636c3a9bfb88729da3d0c9ed1.png',
                'title' => ['Controller Manager'],
                'social' => [
                    'linkedin' => 'https://linkedin.com',
                    'instagram' => 'https://instagram.com',
                    'bar' => 'https://alcooliques-anonymes.fr'
                ],
                'description' => 'Gros geek a temps plein et il est panini addict.',
            ],
        ];

        foreach ($manualProfiles as $data) {
            $team = new Team();
            $team
                ->setName($data['name'])
                ->setPicture($data['picture'])
                ->setTitle($data['title'])
                ->setSocial($data['social'])
                ->setDescription($data['description']);
            $manager->persist($team);
        }

        // 🔹 50 profils générés avec Faker
        for ($i = 0; $i < 50; $i++) {
            $team = new Team();

            $team->setName($faker->name());
            $team->setPicture('https://via.placeholder.com/150?text=' . urlencode($faker->firstName()));
            $team->setTitle($faker->randomElements($roles, rand(1, 2)));

            $socialArray = [];
            foreach ($faker->randomElements($socials, rand(1, 3)) as $network) {
                $socialArray[$network] = 'https://' . $network . '.com/' . $faker->userName();
            }

            $team->setSocial($socialArray);
            $team->setDescription($faker->paragraph(2));

            $manager->persist($team);
        }

        $manager->flush();
    }
}
<?php

namespace App\DataFixtures;

use App\Entity\Sport;
use App\Entity\TeamPlayer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private \Faker\Generator $faker;

    public function __construct()
    {

        $this->faker = Factory::create();
    }
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();

        $sportNames = [
            'football',
            'basketball',
            'hockey',
            'baseball',
            'volleyball',
            'cricket',
            'horse racing',
            'rowing',
        ];

        $sports = [];
        foreach ($sportNames as $sportName) {
            $sport = new Sport();
            $sport->name = $sportName;
            $sports[] = $sport;
        }

        for ($i = 0; $i < pow(10, 6); $i++) {
            $player = new TeamPlayer();
            $player->name = $this->faker->name;
            $player->sport = $sports[array_rand($sports, 1)];

            $manager->persist($player);
        }

        $manager->flush();
    }
}

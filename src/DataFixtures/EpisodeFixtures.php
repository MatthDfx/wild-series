<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    const EPISODE = [
        [
            'title' => 'Changes',
            'number' => 1,
            'synopsis' => 'Début de la série',
            'season' => 1,
        ],
        [
            'title' => 'The Big Sister',
            'number' => 2,
            'synopsis' => 'Pas de synopsis',
            'season' => 1,
        ],
        [
            'title' => 'Old Man Dexter',
            'number' => 3,
            'synopsis' => 'Pas de synopsis',
            'season' => 1,
        ],
        [
            'title' => 'Deedeemensional',
            'number' => 4,
            'synopsis' => 'Pas de synopsis',
            'season' => 1,
        ],
        [
            'title' => 'Dial M for Monkey: Magmanamus',
            'number' => 5,
            'synopsis' => 'Pas de synopsis',
            'season' => 1,
        ],

    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::EPISODE as $key => $value) {

            $episode = new Episode();
            $episode->setTitle($value['title']);
            $episode->setNumber($value['number']);
            $episode->setSynopsis($value['synopsis']);
            $episode->setSeason($this->getReference('season_' . $value['season']));
            $manager->persist($episode);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            SeasonFixtures::class,
        ];
    }
}

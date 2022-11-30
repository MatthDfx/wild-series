<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    const SEASON = [
        [
            'number' => 1,
            'year' => 1996,
            'description' => 'Début de la série',
            'program' => 'Le laboratoire de Dexter',
        ],
        [
            'number' => 2,
            'year' => 1997,
            'description' => 'Pas de description',
            'program' => 'Le laboratoire de Dexter',
        ],
        [
            'number' => 3,
            'year' => 2001,
            'description' => 'Pas de description',
            'program' => 'Le laboratoire de Dexter',
        ],
        [
            'number' => 4,
            'year' => 2002,
            'description' => 'Pas de description',
            'program' => 'Le laboratoire de Dexter',
        ],
        [
            'number' => 5,
            'year' => 2010,
            'description' => 'Pas de description',
            'program' => 'Le laboratoire de Dexter',
        ],

    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::SEASON as $key => $value) {

            $season = new Season();
            $season->setNumber($value['number']);
            $season->setYear($value['year']);
            $season->setDescription($value['description']);
            $season->setProgram($this->getReference('program_' . $value['program']));
            $manager->persist($season);
            $this->addReference('season_' . $value['number'], $season);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            ProgramFixtures::class,
        ];
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAM = [
        [
            'title' => 'Phénomène Raven',
            'synopsis' => 'une meuf avec des visions',
            'category' => 'category_Action'
        ],
        [
            'title' => 'Le laboratoire de Dexter',
            'synopsis' => 'un petit scientifique',
            'category' => 'category_Aventure'
        ],
        [
            'title' => 'Les supers nana',
            'synopsis' => 'Trois enfants qui veulent vaincre un méchant singe',
            'category' => 'category_Animé'
        ],
        [
            'title' => 'Mi-chat mi-chien',
            'synopsis' => 'Comment font-ils pour être copain ?',
            'category' => 'category_Fantastique'
        ],
        [
            'title' => 'Johnny Bravo',
            'synopsis' => 'Hi-Ha-Hou purée chui beau',
            'category' => 'category_Romantique'
        ],

    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAM as $key => $value) {

            $program = new Program();
            $program->setTitle($value['title']);
            $program->setSynopsis($value['synopsis']);
            $program->setCategory($this->getReference($value['category']));
            $this->addReference('program_' . $value['title'], $program);
            $manager->persist($program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
        ];
    }
}

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
            'category' => 'category_Action',
            'poster' => 'https://fr.web.img4.acsta.net/pictures/20/03/17/13/29/4568012.jpg'
        ],
        [
            'title' => 'Le laboratoire de Dexter',
            'synopsis' => 'un petit scientifique',
            'category' => 'category_Aventure',
            'poster' => 'https://fr.web.img6.acsta.net/pictures/15/09/01/14/51/314868.jpg'
        ],
        [
            'title' => 'Les supers nana',
            'synopsis' => 'Trois enfants qui veulent vaincre un méchant singe',
            'category' => 'category_Animé',
            'poster' => 'https://fr.web.img4.acsta.net/r_654_368/newsv7/20/08/25/10/06/2795311.jpg'
        ],
        [
            'title' => 'Mi-chat mi-chien',
            'synopsis' => 'Comment font-ils pour être copain ?',
            'category' => 'category_Fantastique',
            'poster' => 'https://images.mubicdn.net/images/film/265885/cache-547214-1590030085/image-w1280.jpg?size=800x'
        ],
        [
            'title' => 'Johnny Bravo',
            'synopsis' => 'Hi-Ha-Hou purée chui beau',
            'category' => 'category_Romantique',
            'poster' => 'https://images.justwatch.com/poster/273336247/s592/johnny-bravo'
        ],

    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAM as $key => $value) {

            $program = new Program();
            $program->setTitle($value['title']);
            $program->setSynopsis($value['synopsis']);
            $program->setCategory($this->getReference($value['category']));
            $this->addReference('program_' . $key, $program);
            $program->setPoster($value['poster']);
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

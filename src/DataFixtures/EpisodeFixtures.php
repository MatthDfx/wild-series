<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\String\Slugger\SluggerInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    private SluggerInterface $slugger;
    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }
    public function load(ObjectManager $manager): void
    {
        //Puis ici nous demandons à la Factory de nous fournir un Faker
        $faker = Factory::create();

        /**
         * L'objet $faker que tu récupère est l'outil qui va te permettre 
         * de te générer toutes les données que tu souhaites
         */

        for ($i = 0; $i < 5; $i++) {
            for ($j = 1; $j < 6; $j++) {
                for ($k = 1; $k < 11; $k++) {


                    $episode = new Episode();
                    //Ce Faker va nous permettre d'alimenter l'instance de episode que l'on souhaite ajouter en base
                    $episode->setNumber($k);
                    $episode->setTitle($faker->words(3, true));
                    $episode->setSlug($this->slugger->slug($episode->getTitle())->title());
                    $episode->setSynopsis($faker->paragraph());
                    $episode->setDuration($faker->time($format = 'i'));
                    $episode->setSeason($this->getReference('program_' . $i . '_season_' . $j));
                    $manager->persist($episode);
                }
            }
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

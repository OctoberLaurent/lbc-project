<?php

namespace App\DataFixtures;
use Faker\Factory;
use App\Entity\Media;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class MediaFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $slugify = new Slugify();
        $faker = Factory::create('fr_FR');
        
        for ($i=0; $i<10; $i++)
        {
            $media = new Media();
            //$media->type;


            // $ad->setDescription("Description de ma premiere annonce...");
            // $ad->setPrice("99.99");
            // $ad->setState("broken");
            // $ad->setCategory( $this->getReference("categ-1"));
            // $ad->setCreatedBy( $this->getReference("john@doe.com") );
            // $ad->setLangage( $this->getReference("john@doe.com")->getLangage() );
            // $ad->setLocation( $this->getReference("address-1") );
            // $ad->setSlug($slugify->slugify('Ma premiere annonce'));
            // $ad->setDatePublish($faker->dateTimeInInterval($startDate = '-30 days', $interval = ' -10 days', $timezone = null));
            // $ad->setDateExpire($faker->dateTimeInInterval($startDate = '-30 days', $interval = ' -10 days', $timezone = null));

            $manager->persist($media);
        }

        $manager->persist($media);
        $manager->flush();
    }
    
    /**
     * Get the order of this fixture
     * @return integer
     */
    public function getOrder()
    {
        return 4;
    }
}
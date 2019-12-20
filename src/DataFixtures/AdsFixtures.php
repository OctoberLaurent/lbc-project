<?php

namespace App\DataFixtures;
use Faker\Factory;
use App\Entity\Ads;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class AdsFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $slugify = new Slugify();
        $faker = Factory::create('fr_FR');
        
        for ($i=0; $i<10; $i++)
        {
            $ad = new Ads();
            $ad->setTitle("Ma premiere annonce");
            $ad->setDescription("Description de ma premiere annonce...");
            $ad->setPrice("99.99");
            $ad->setState("broken");
            $ad->setCategory( $this->getReference("categ-1"));
            $ad->setCreatedBy( $this->getReference("john@doe.com") );
            $ad->setLangage( $this->getReference("john@doe.com")->getLangage() );
            $ad->setLocation( $this->getReference("address-1") );
            $ad->setSlug($slugify->slugify('Ma premiere annonce'));
            $ad->setDatePublish($faker->dateTimeInInterval($startDate = '-30 days', $interval = ' -10 days', $timezone = null));
            $ad->setDateExpire($faker->dateTimeInInterval($startDate = '-30 days', $interval = ' -10 days', $timezone = null));

            $manager->persist($ad);
        }
        $ad = new Ads();
        $ad->setTitle("Ma seconde annonce");
        $ad->setDescription("Description de ma premiere annonce...");
        $ad->setPrice("99.99");
        $ad->setState("new");
        $ad->setCategory( $this->getReference("categ-2"));
        $ad->setCreatedBy( $this->getReference("bob@doe.com") );
        $ad->setLangage( $this->getReference("bob@doe.com")->getLangage() );
        $ad->setLocation( $this->getReference("address-1") );
        $ad->setSlug($slugify->slugify('Ma seconde annonce'));
        $ad->setDatePublish($faker->dateTimeInInterval($startDate = '-30 days', $interval = ' -10 days', $timezone = null));
        $ad->setDateExpire($faker->dateTimeInInterval($startDate = '-30 days', $interval = ' -10 days', $timezone = null));

        $manager->persist($ad);
        $manager->flush();
    }
    
    /**
     * Get the order of this fixture
     * @return integer
     */
    public function getOrder()
    {
        return 3;
    }
}
<?php

namespace App\DataFixtures;

use App\Entity\AddressBooks;
use App\Entity\City;
use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AddressBookFixtures extends Fixture
{

    private $provider;

    /**
     * AddressBookFixtures constructor.
     */
    public function __construct()
    {
        $this->provider = new DataProvider();
    }


    public function load(ObjectManager $manager)
    {
        $connection = $manager->getConnection();
        $connection->exec(" UPDATE SQLITE_SEQUENCE SET SEQ=0 WHERE NAME='city' ");
        $connection->exec(" UPDATE SQLITE_SEQUENCE SET SEQ=0 WHERE NAME='country' ");
        $connection->exec(" UPDATE SQLITE_SEQUENCE SET SEQ=0 WHERE NAME='address_books' ");
        $this->addPlases($manager);
        for ($i = 1; $i < 10; $i++) {
            $AddressBookEntity = new AddressBooks();
            $AddressBookEntity->setStreetNumber($this->provider->streetNumberProvider());
            $AddressBookEntity->setFirstname($this->provider->firstNameProvider());
            $AddressBookEntity->setLastname($this->provider->lastNameProvider());
            $AddressBookEntity->setEmail($this->provider->lastNameProvider() . '@gmail.com');
            $AddressBookEntity->setZip($this->provider->ziCodeProvider());
            $AddressBookEntity->setPhonenumber($this->provider->phoneNumberProvider());
            $AddressBookEntity->setBirthday($this->provider->dateProvider());
            $place = $this->provider->placeProvider($this->provider->places());
            $AddressBookEntity->setCity($this->cityObj($manager, $place['city']));
            $AddressBookEntity->setCountry($this->countrysObj($manager, $place['country']));
            $manager->persist($AddressBookEntity);
        }
        $manager->flush();
    }

    private function addPlases(ObjectManager $manager)
    {
        $id = 1;
        foreach ($this->provider->places() as $country => $city) {
            $cityEntity = new City();
            $countryEntity = new Country();
            $cityEntity->setCityName($city);
            $manager->persist($cityEntity);
            $countryEntity->setCountryName($country);
            $manager->persist($countryEntity);
            $id++;
        }
        $manager->flush();
    }

    private function countrysObj($manager, $country)
    {
        $model = $manager->getRepository(Country::class);
        return $model->findOneBy(['country_name' => $country]);
    }

    private function cityObj($manager, $city)
    {
        $model = $manager->getRepository(City::class);
        return $model->findOneBy(['city_name' => $city]);
    }


}

<?php

namespace App\Services;
use App\Entity\AddressBooks;
use Symfony\Component\Validator\Constraints\Date;

class AddressBookSerializService
{
    /**
     * @param AddressBooks $objEntity
     * @return mixed
     */
    public function serializeToArray(AddressBooks $objEntity){
        $result['firstname']=$objEntity->getFirstname();
        $result['lastname']=$objEntity->getLastname();
        $result['email']=$objEntity->getEmail();
        $result['zip']=$objEntity->getZip();
        $result['street_number']=$objEntity->getStreetNumber();
        $result['phonenumber']=$objEntity->getPhonenumber();
        $result['birthday']=$this->changeDateFormat($objEntity->getBirthday());
        $result['country']=$objEntity->getCountry()->getCountryName();
        $result['city']=$objEntity->getCity()->getCityName();
        return $result;
    }

    public function serializeArrayToJson(array $AddressBook ){
        return json_encode($AddressBook,true);
    }
    /**
     * @param Date $date
     * @return mixed
     */
    private function changeDateFormat( $date )
    {
        return $date->format('Y-m-d');
    }
}

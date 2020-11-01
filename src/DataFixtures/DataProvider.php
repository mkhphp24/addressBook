<?php

namespace App\DataFixtures;
class DataProvider
{
    /**
     * @return mixed
     */
    public function firstNameProvider(){
        $firstname = array(
            'Johnathon',
            'Anthony',
            'Erasmo',
            'Raleigh',
            'Nancie',
            'Tama',
            'Camellia',
            'Augustine',
            'Christeen',
            'Luz',
            'Diego',
            'Lyndia',
            'Thomas',
            'Georgianna',
            'Leigha',
            'Alejandro',
            'Marquis',
            'Joan',
            'Stephania',
            'Elroy',
            'Zonia',
            'Buffy',
            'Sharie',
            'Blythe',
            'Gaylene',
            'Elida',
            'Randy',
            'Margarete',
            'Margarett',
            'Dion',
            'Tomi',
            'Arden',
            'Clora',
            'Laine',
            'Becki',
            'Margherita',
            'Bong',
            'Jeanice',
            'Qiana',
            'Lawanda',
            'Rebecka',
            'Maribel',
            'Tami',
            'Yuri',
            'Michele',
            'Rubi',
            'Larisa',
            'Lloyd',
            'Tyisha',
            'Samatha',
        );
        return $firstname[rand(0,10)];
    }

    /**
     * @return mixed
     */
    public function lastNameProvider(){
        $lastname = array(
            'Mischke',
            'Serna',
            'Pingree',
            'Mcnaught',
            'Pepper',
            'Schildgen',
            'Mongold',
            'Wrona',
            'Geddes',
            'Lanz',
            'Fetzer',
            'Schroeder',
            'Block',
            'Mayoral',
            'Fleishman',
            'Roberie',
            'Latson',
            'Lupo',
            'Motsinger',
            'Drews',
            'Coby',
            'Redner',
            'Culton',
            'Howe',
            'Stoval',
            'Michaud',
            'Mote',
            'Menjivar',
            'Wiers',
            'Paris',
            'Grisby',
            'Noren',
            'Damron',
            'Kazmierczak',
            'Haslett',
            'Guillemette',
            'Buresh',
            'Center',
            'Kucera',
            'Catt',
            'Badon',
            'Grumbles',
            'Antes',
            'Byron',
            'Volkman',
            'Klemp',
            'Pekar',
            'Pecora',
            'Schewe',
            'Ramage',
        );
        return $lastname[rand(0,10)];

    }

    public function phoneNumberProvider(){
        $phoneNumber = array(
            '08161776623',
            '08157676208',
            '08188430651',
            '08187765326',
            '08176077144',
            '09087477073',
            '08127415352',
            '08191681262',
            '08168828747',
            '08195023836',
            '08198008111',
            '09096738254',
            '08162004285',
            '08166810731',
            '08130133373',
            '09093214002',
            '08154125422',
            '08160702315',
            '08143817877',
            '08194806336',
            '08133183466');
        return $phoneNumber[rand(0,20)];
            }

    public function dateProvider()
    {

        $start = strtotime("01 July 1950");
        $end = strtotime("01 July 2016");
        $date = new \DateTime();
        $date->format('Y-m-d');
        $date->setTimestamp(mt_rand($start, $end));
        return $date;
    }

    public function ziCodeProvider()
    {
        return rand(11111, 99999);
    }

    public function streetNumberProvider()
    {
        return rand(1, 100);
    }

    public function places()
    {
        return array('Germany' => 'Berlin', 'Japan' => 'Tokyo', 'Mexico' => 'Mexico City', 'USA' => 'New York City', 'India' => 'Mumbai', 'South Korea' => 'Seoul', 'China' => 'Shanghai', 'Nigeria' => 'Lagos', 'Argentina' => 'Buenos Aires', 'Egypt' => 'Cairo', 'England' => 'London', 'Iran' => 'Tehran');
    }

    public function placeProvider($placesArray)
    {
        $keys = array_keys($placesArray);
        $country = $keys[rand(0, count($keys) - 1)];
        return ['country' => $country, 'city' => $placesArray[$country]];
    }

}



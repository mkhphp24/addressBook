<?php

    namespace App\Tests;
    use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
    use Symfony\Component\DomCrawler\Crawler;

    class AddressBookFormTypeTest extends WebTestCase
    {
        private $client;

        protected function setUp()
        {
            $this->client = static::createClient();
        }

        public function testFormCheckfirstname(){

            $request= [
                'form_type_adress_book[firstname]' => '',
                'form_type_adress_book[lastname]' => 'lastname',
                'form_type_adress_book[street_number]' => '123',
                'form_type_adress_book[zip]' => '111',
                'form_type_adress_book[phonenumber]'=> '09123502456',
                'form_type_adress_book[birthday]'=> '2020-10-30',
                'form_type_adress_book[email]'=> 'test@exampel.com',
                'form_type_adress_book[city]'=> '1',
                'form_type_adress_book[country]'=> '2',

            ];

            $resultError=$this->checkForm($request);
            $asertError=["count" => 1 , "message" =>["firstname" => "Firstname cannot be empty"]];
            $this->assertEquals($asertError, $resultError);

            $request= [
                'form_type_adress_book[firstname]' => 'ma',
                'form_type_adress_book[lastname]' => 'lastname',
                'form_type_adress_book[street_number]' => '123',
                'form_type_adress_book[zip]' => '111',
                'form_type_adress_book[phonenumber]'=> '09123502456',
                'form_type_adress_book[birthday]'=> '2020-10-30',
                'form_type_adress_book[email]'=> 'test@exampel.com',
                'form_type_adress_book[city]'=> '1',
                'form_type_adress_book[country]'=> '2',

            ];

            $resultError=$this->checkForm($request);
            $asertError=["count" => 1 , "message" =>["firstname" => "Firstname must be more than  3 char"]];
            $this->assertEquals($asertError, $resultError);


            $request= [
                'form_type_adress_book[firstname]' => 'masssssssssssssssssssssssssssssssssssssss',
                'form_type_adress_book[lastname]' => 'lastname',
                'form_type_adress_book[street_number]' => '123',
                'form_type_adress_book[zip]' => '111',
                'form_type_adress_book[phonenumber]'=> '09123502456',
                'form_type_adress_book[birthday]'=> '2020-10-30',
                'form_type_adress_book[email]'=> 'test@exampel.com',
                'form_type_adress_book[city]'=> '1',
                'form_type_adress_book[country]'=> '2',

            ];

            $resultError=$this->checkForm($request);
            $asertError=["count" => 1 , "message" =>["firstname" => "Firstname must be less than  30 char"]];
            $this->assertEquals($asertError, $resultError);

        }


        /**
         * @param $HtmlValueError
         */
        private function returnErrorfield( $HtmlValueError ){
            $result=['count'=>0,'message'=>[]];
            foreach ($HtmlValueError as $domElement) {
                if($domElement->nodeValue === '')  continue;
                $result['count']++;
                $result['message'][$domElement->getAttribute('for')]=$domElement->nodeValue;
            }
            return $result;

        }

        private function checkForm(array $request) {
            $MakeRequest =  $this->client->request('GET', '/Insert');
            $buttonCrawlerNode = $MakeRequest->selectButton('Save');

            $form = $buttonCrawlerNode->form($request);
            $this->client->submit($form);
            $response = $this->client->getResponse();
            //dd($response->getContent());

            $html = $response->getContent();


            $crawler = new Crawler($html);
            $HtmlValueError = $crawler->filter('.text-danger');
            return $this->returnErrorfield($HtmlValueError);
        }
    }


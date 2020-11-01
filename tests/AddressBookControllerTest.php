<?php

    namespace App\Tests;

    use App\Entity\AddressBooks;
    use App\Entity\City;
    use App\Entity\Country;
    use App\Services\AddressBookSerializService;
    use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
    use Symfony\Component\HttpFoundation\Response;

    class AddressBookControllerTest extends WebTestCase
    {
        private $client;
        private $em;

        protected function setUp()
        {
            $this->client = static::createClient();
            $this->em = self::$kernel->getContainer()->get('doctrine.orm.entity_manager');
        }

        /**
         * @throws \Exception
         */
        public function testdoDetail()
        {

            $this->client->request('GET', '/detail/9999999999');
            $response = $this->client->getResponse();
            $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
            $addressBookIdFake = $this->inserteFakeAddressBook($this->makeFakeAddressBook());
            $ObjAddressBook = $this->em->getRepository(AddressBooks::class)->findOneBy(['id' => $addressBookIdFake]);
            $serializer = new AddressBookSerializService();
            $resultArray = $serializer->serializeToArray($ObjAddressBook);
            $resultJson = $serializer->serializeArrayToJson($resultArray);
            $this->client->request('GET', '/detail/' . $addressBookIdFake);
            $response = $this->client->getResponse();
            $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
            $this->assertEquals($response->getContent(), $resultJson);
            $this->deleteFakeAddressBook($addressBookIdFake);
        }

        /**
         *
         */
        public function testdoInsert()
        {


            $request = ['form_type_adress_book[firstname]' => 'test-Firstname', 'form_type_adress_book[lastname]' => 'test-Lastname', 'form_type_adress_book[street_number]' => '123', 'form_type_adress_book[zip]' => '111', 'form_type_adress_book[phonenumber]' => '09123502456', 'form_type_adress_book[birthday]' => '2020-10-30', 'form_type_adress_book[email]' => 'test@exampel.com', 'form_type_adress_book[city]' => '1', 'form_type_adress_book[country]' => '2',];
            $MakeRequest = $this->client->request('GET', '/Insert');
            $response = $this->client->getResponse();
            $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
            $buttonCrawlerNode = $MakeRequest->selectButton('Save');
            $form = $buttonCrawlerNode->form($request);
            $this->client->submit($form);
            $ObjAddressBook = $this->em->getRepository(AddressBooks::class)->findOneBy(['firstname' => 'test-Firstname']);
            $this->assertNotNull($ObjAddressBook);
            $this->deleteFakeAddressBook($ObjAddressBook->getId());

        }

        public function testdoEdit()
        {

            $MakeRequest = $this->client->request('GET', '/edit/9999999999');
            $response = $this->client->getResponse();
            $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
            $addressBookIdFake = $this->inserteFakeAddressBook($this->makeFakeAddressBook());
            $request = ['form_type_adress_book[firstname]' => 'test-Edit-Firstname', 'form_type_adress_book[lastname]' => 'test-Edit--Lastname', 'form_type_adress_book[street_number]' => '123', 'form_type_adress_book[zip]' => '111', 'form_type_adress_book[phonenumber]' => '09123502456', 'form_type_adress_book[birthday]' => '2020-10-30', 'form_type_adress_book[email]' => 'test@exampel.com', 'form_type_adress_book[city]' => '1', 'form_type_adress_book[country]' => '2',];
            $MakeRequest = $this->client->request('GET', '/edit/' . $addressBookIdFake);
            $response = $this->client->getResponse();
            $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
            $buttonCrawlerNode = $MakeRequest->selectButton('Save');
            $form = $buttonCrawlerNode->form($request);
            $this->client->submit($form);
            $ObjAddressBook = $this->em->getRepository(AddressBooks::class)->findOneBy(['id' => $addressBookIdFake]);
            $this->assertNotNull($ObjAddressBook);
            $this->assertEquals('test-Edit-Firstname', $ObjAddressBook->getFirstname());
            $this->deleteFakeAddressBook($ObjAddressBook->getId());

        }


        /**
         * @return AddressBooks
         * @throws \Exception
         */
        private function makeFakeAddressBook(): AddressBooks
        {
            $addressBooks = new AddressBooks();
            $addressBooks->setFirstname('test-Firstname')->setLastname('test-Lastname')->setPhonenumber('08187765326')->setZip('1234')->setEmail('Pepper@gmail.com')->setStreetNumber('12')->setBirthday(new \DateTime())->setCity($this->em->getRepository(City::class)->findOneBy(['id' => '1']))->setCountry($this->em->getRepository(Country::class)->findOneBy(['id' => '1']));
            return $addressBooks;
        }

        /**
         * @param AddressBooks $addressBooks
         * @return int|null
         *
         */
        private function inserteFakeAddressBook(AddressBooks $addressBooks)
        {
            $this->em->persist($addressBooks);
            $this->em->flush();
            return $addressBooks->getId();
        }

        /**
         * @param $id
         */
        private function deleteFakeAddressBook($id)
        {
            $addressBooks = $this->em->getRepository(AddressBooks::class)->findOneBy(['id' => $id]);
            $this->em->remove($addressBooks);
            $this->em->flush();
        }

    }

<?php

	namespace App\Services;

	use App\Entity\AddressBooks;
    use Doctrine\ORM\EntityManager;

    /**
     * @author Majid Kazerooni
     */
    class AdressBookService extends AbstractDbService
    {

        public function __construct(EntityManager $em, $entityName)
        {
            $this->em = $em;
            $this->model = $em->getRepository($entityName);
        }

        /**
         * @return \Doctrine\ORM\EntityRepository|\Doctrine\Persistence\ObjectRepository
         */
        public function getModelBook()
        {
            return $this->model;
        }

        /**
         * @param int $id
         * @return AddressBooks $objEntity
         */
        public function getAdressBookById(int $id)
        {
            return $this->findById($id);
        }

        /**
         * @return AddressBooks $objEntity
         */
        public function getAllAdressBook()
        {
            return $this->findAll();
        }

        /**
         * @return Query String
         */
        public function getDataPaginationAdressBook()
        {
            return $this->getDataPagination();
        }


        /**
         * @param int $id
         * @throws \Doctrine\ORM\ORMException
         * @throws \Doctrine\ORM\OptimisticLockException
         */
        public function deleteAdressBook(AddressBooks $addressBooks)
        {
            return $this->delete($this->findId($addressBooks));
        }


        /**
         * @param AddressBooks $objEntity
         * @throws \Doctrine\ORM\ORMException
         * @throws \Doctrine\ORM\OptimisticLockException
         */
        public function editAdressBook(AddressBooks $objEntity)
        {
            return $this->update($objEntity);
        }

        /**
         * @param AddressBook $objEntity
         * @throws \Doctrine\ORM\ORMException
         * @throws \Doctrine\ORM\OptimisticLockException
         */
        public function insertAdressBook(AddressBooks $objEntity)
        {
            return $this->insert($objEntity);
        }


    }


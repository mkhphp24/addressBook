<?php


	namespace App\Services;

	use Doctrine\DBAL\LockMode;
    use Doctrine\ORM\EntityManager;

    abstract class AbstractDbService
    {
        /**
         * @var
         */
        protected $model;
        protected $em;

        /**
         * @return EntityManager
         */
        protected function entityManager()
        {
            return $this->em;
        }

        /**
         * @return mixed
         */
        protected function getDataPagination()
        {
            $query = $this->model->createQueryBuilder('tabel')->getQuery();
            return $query;
        }


        /**
         * @param $id
         * @param int $lockMode
         * @param null $lockVersion
         * @return null|object
         */
        protected function findAll()
        {
            return $this->model->findAll();
        }

        /**
         * @param $id
         * @param int $lockMode
         * @param null $lockVersion
         * @return null|object
         */
        protected function findId($id, $lockMode = LockMode::NONE, $lockVersion = null)
        {
            return $this->model->find($id, $lockMode, $lockVersion);
        }


        /**
         * @param $id
         *
         * @return mixed|string
         */
        protected function findById($id)
        {
            return $this->model->findOneBy(array('id' => $id));
        }


        /**
         * @param array $criteria
         * @param array $orderBy
         *
         * @return null|object
         */
        protected function findOneBy(array $criteria, array $orderBy = null)
        {
            return $this->model->findOneBy($criteria, $orderBy);
        }

        /**
         * @param $objEntity
         * @throws \Doctrine\ORM\ORMException
         * @throws \Doctrine\ORM\OptimisticLockException
         */
        protected function delete($objEntity)
        {
            $this->em->remove($objEntity);
            $this->em->flush();
        }


        /**
         * @param $objEntity
         * @throws \Doctrine\ORM\ORMException
         * @throws \Doctrine\ORM\OptimisticLockException
         */
        protected function insert($objEntity)
        {
            $this->em->persist($objEntity);
            $this->em->flush();
        }

        /**
         * @param $objEntity
         * @throws \Doctrine\ORM\ORMException
         * @throws \Doctrine\ORM\OptimisticLockException
         */
        protected function update($objEntity)
        {
            $this->em->persist($objEntity);
            $this->em->flush();
        }


    }

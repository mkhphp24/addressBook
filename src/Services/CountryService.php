<?php

	namespace App\Services;
	use Doctrine\ORM\EntityManager;

    /**
     * @author Majid Kazerooni
     */
    class CountryService extends AbstractDbService
    {
        public function __construct(EntityManager $em, $entityName)
        {
            $this->em = $em;
            $this->model = $em->getRepository($entityName);
        }

        public function getObjectCity($id)
        {
            return $this->findId($id);
        }

    }


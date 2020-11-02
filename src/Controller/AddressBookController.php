<?php

namespace App\Controller;

    use App\Entity\AddressBooks;
    use App\Form\FormTypeAdressBook;
    use App\Services\AddressBookSerializService;
    use App\Services\AdressBookService;
    use Knp\Component\Pager\PaginatorInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class AddressBookController extends AbstractController
    {
        const LIMIT = 5;

        /**
         * @Route("/", name="address_book" , methods={"GET","HEAD"} )
         */
        public function index(Request $request, PaginatorInterface $paginator)
        {

            $addressBookService = new AdressBookService($this->getDoctrine()->getManager(), AddressBooks::class);
            $addressBooks = $addressBookService->getDataPaginationAdressBook();
            $pagination = $paginator->paginate($addressBooks, /* query NOT result */ $request->query->getInt('page', 1), /*page number*/ self::LIMIT /*limit per page*/);
            return $this->render('address_book/index.html.twig', ['pagination' => $pagination]);
        }

        //========================================== INSERT

        /**
         * @Route("/Insert", name="insert_address_book" )
         */
        public function doInsert(Request $request)
        {
            $addressBookService = new AdressBookService($this->getDoctrine()->getManager(), AddressBooks::class);
            $form = $this->createForm(FormTypeAdressBook::class);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                try {

                    $addressBooks = $form->getData();
                    $addressBookService->insertAdressBook($addressBooks);
                    return $this->redirect($this->generateUrl('address_book'));
                } catch (\Doctrine\DBAL\DBALException $exception) {

                    return new jsonResponse($exception->getMessage(), Response::HTTP_BAD_REQUEST);

                }

            }
            return $this->render('address_book/Insert.html.twig', ["form" => $form->createView()]);
        }

        //========================================== Edit

        /**
         * @Route("/edit/{id}", name="edit_address_book"   )
         */
        public function doEdit(Request $request, $id)
        {
            $addressBookService = new AdressBookService($this->getDoctrine()->getManager(), AddressBooks::class);
            $obj = $addressBookService->getAdressBookById($id);
            $form = $this->createForm(FormTypeAdressBook::class, $obj);
            $form->handleRequest($request);
            if ($obj === null) return new jsonResponse('not Found', Response::HTTP_NOT_FOUND);
            if ($form->isSubmitted() && $form->isValid()) {

                try {
                    $addressBookService->editAdressBook($obj);
                    return $this->redirect($this->generateUrl('address_book'));
                } catch (\Doctrine\DBAL\DBALException $exception) {

                    return new jsonResponse($exception->getMessage(), Response::HTTP_BAD_REQUEST);

                }

            }
            return $this->render('address_book/edit.html.twig', ["form" => $form->createView()]);

        }

        //========================================== DELETE

        /**
         * @Route("/delete/{id}", name="delete_address_book" ,  methods={"GET","HEAD"} )
         */
        public function doDelete($id)
        {
            $addressBookService = new AdressBookService($this->getDoctrine()->getManager(), AddressBooks::class);
            $obj = $addressBookService->getAdressBookById($id);
            if ($obj === null) return new jsonResponse('not Found', Response::HTTP_NOT_FOUND);
            $addressBookService->deleteAdressBook($obj);
            return $this->redirect($this->generateUrl('address_book'));
        }

        //========================================== DETAIL

        /**
         * @Route("/detail/{id}", name="detail_address_book" ,  methods={"GET","HEAD"} )
         */
        public function doDetail($id, AddressBookSerializService $serializer)
        {
            $addressBookService = new AdressBookService($this->getDoctrine()->getManager(), AddressBooks::class);
            $obj = $addressBookService->getAdressBookById($id);
            if ($obj === null) return new jsonResponse('not Found', Response::HTTP_NOT_FOUND);
            $jsonObject = $serializer->serializeToArray($obj);
            return new jsonResponse($jsonObject);

        }


    }

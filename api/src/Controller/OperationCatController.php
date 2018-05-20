<?php

namespace App\Controller;

use App\Entity\OperationCategory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class OperationCatController extends Controller
{
    /**
     * @Route("/categories/operation/", name="get_basic_categories_operation")
     * @Method("GET")
     */
    public function getBasicCategoriesOperation()
    {
        // PROVIDE MEMORY LEAK
        unset($datas);

        // GET ENTITIES
        $categories = $this->getDoctrine()->getManager()->getRepository(OperationCategory::class)->findAll();

        // PROVIDE ID ERROR
        if ($categories === null ) {
            return new JsonResponse(
                array(
                    'request' => 'GET_BASIC_CATEGORIES_OPERATION',
                    'state' => 'ERROR',
                    'message' => 'It seems no operation categories is in database !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // FORMAT DATAS
        $datas = [];
        foreach ($categories as $category) {
            $datas[] = $category->toArrayBasic();
        }

        // PROVIDE MEMORY LEAK
        unset($categories);
        unset($category);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'GET_BASIC_CATEGORIES_OPERATION',
                'state' => 'SUCCESS',
                'datas' => $datas
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/categories/operation/extended/", name="get_extended_categories_operation")
     * @Method("GET")
     */
    public function getExtendedCategoriesOperation()
    {
        // PROVIDE MEMORY LEAK
        unset($datas);

        // GET ENTITIES
        $categories = $this->getDoctrine()->getManager()->getRepository(OperationCategory::class)->findAll();

        // PROVIDE ID ERROR
        if ($categories === null ) {
            return new JsonResponse(
                array(
                    'request' => 'GET_EXTENDED_CATEGORIES_OPERATION',
                    'state' => 'ERROR',
                    'message' => 'It seems no operation categories is in database !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // FORMAT DATAS
        $datas = [];
        foreach ($categories as $category) {
            $datas[] = $category->toArrayExtended();
        }

        // PROVIDE MEMORY LEAK
        unset($categories);
        unset($category);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'GET_EXTENDED_CATEGORIES_OPERATION',
                'state' => 'SUCCESS',
                'datas' => $datas
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/categories/operation/{id}/", requirements={"id"="\d+"}, name="get_basic_category_operation")
     * @Method("GET")
     */
    public function getBasicCategoryOperation($id)
    {
        // PROVIDE MEMORY LEAK
        unset($datas);

        // GET ENTITY
        $category = $this->getDoctrine()->getManager()->getRepository(OperationCategory::class)->find(intval($id));

        // PROVIDE ID ERROR
        if ($category === null ) {
            return new JsonResponse(
                array(
                    'request' => 'GET_BASIC_CATEGORY_OPERATION',
                    'state' => 'ERROR',
                    'message' => 'This ID dosn\'nt seems exist !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // FORMAT DATAS
        $datas = $category->toArrayBasic();

        // PROVIDE MEMORY LEAK
        unset($id);
        unset($category);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'GET_BASIC_CATEGORY_OPERATION',
                'state' => 'SUCCESS',
                'datas' => $datas
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/categories/operation/{id}/extended/", requirements={"id"="\d+"}, name="get_extended_category_operation")
     * @Method("GET")
     */
    public function getExtendedCategoryOperation($id)
    {
        // PROVIDE MEMORY LEAK
        unset($datas);

        // GET ENTITY
        $category = $this->getDoctrine()->getManager()->getRepository(OperationCategory::class)->find(intval($id));

        // PROVIDE ID ERROR
        if ($category === null ) {
            return new JsonResponse(
                array(
                    'request' => 'GET_EXTENDED_CATEGORY_OPERATION',
                    'state' => 'ERROR',
                    'message' => 'This ID dosn\'nt seems exist !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // FORMAT DATAS
        $datas = $category->toArrayExtended();

        // PROVIDE MEMORY LEAK
        unset($id);
        unset($category);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'GET_EXTENDED_CATEGORY_OPERATION',
                'state' => 'SUCCESS',
                'datas' => $datas
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/categories/operation/", name="post_category_operation")
     * @Method("POST")
     */
    public function postCategoryOperation(Request $request)
    {
        // GET UNFORMATTED DATAS
        $unformattedLibelle = $request->get('libelle');

        // FORMAT DATAS
        if ($unformattedLibelle !== "") { $libelle = (string)$unformattedLibelle; } else { $libelle = null; }

        // CREATE ENTITY
        $category = new OperationCategory();
        if ($libelle !== null) {
            $category->setLibelle($libelle);
        } else {
            /* validate empty field */
            return new JsonResponse(
                array(
                    'request' => 'ADD_CATEGORY_OPERATION',
                    'state' => 'ERROR',
                    'message' => 'Libelle can\'t be null !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // PERSIST ENTITY
        $this->getDoctrine()->getManager()->persist($category);
        $this->getDoctrine()->getManager()->flush();

        // PROVIDE MEMORY LEAK
        unset($request);
        unset($unformattedLibelle);
        unset($libelle);
        unset($category);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'ADD_CATEGORY_OPERATION',
                'state' => 'SUCCESS'
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/categories/operation/{id}/", name="put_category_operation")
     * @Method("PUT")
     */
    // METHOD WITH ALREADY ENCRYPTED PASSWORD
    public function putCategoryOperation($id, Request $request)
    {
        // GET ENTITY
        $category = $this->getDoctrine()->getManager()->getRepository(OperationCategory::class)->find(intval($id));

        // PROVIDE ID ERROR
        if ($category === null) {
            return new JsonResponse(
                array(
                    'request' => 'UPDATE_CATEGORY_OPERATION',
                    'state' => 'ERROR',
                    'message' => 'This ID dosn\'nt seems exist !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // GET UNFORMATTED DATAS
        $unformattedLibelle = $request->get('libelle');

        // FORMAT DATAS
        if ($unformattedLibelle !== "") { $libelle = (string)$unformattedLibelle; } else { $libelle = null; }

        //UPDATE ENTITY
        if($category->getLibelle() !== $libelle && $libelle !== null) { $category->setLibelle($libelle); }

        // PERSIST ENTITY
        $this->getDoctrine()->getManager()->persist($category);
        $this->getDoctrine()->getManager()->flush();

        // PROVIDE MEMORY LEAK
        unset($request);
        unset($id);
        unset($unformattedLibelle);
        unset($libelle);
        unset($category);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'UPDATE_CATEGORY_OPERATION',
                'state' => 'SUCCESS'
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/categories/operation/{id}/", requirements={"id"="\d+"}, name="delete_category_operation")
     * @Method("DELETE")
     */
    public function deleteCategoryOperation($id)
    {
        // GET ENTITY
        $category = $this->getDoctrine()->getManager()->getRepository(OperationCategory::class)->find(intval($id));

        // PROVIDE ID ERROR
        if ($category === null ) {
            return new JsonResponse(
                array(
                    'request' => 'DELETE_CATEGORY_OPERATION',
                    'state' => 'ERROR',
                    'message' => 'This ID dosn\'nt seems exist !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // DELETE ENTITY
        $this->getDoctrine()->getManager()->remove($category);
        $this->getDoctrine()->getManager()->flush();

        // PROVIDE MEMORY LEAK
        unset($id);
        unset($category);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'DELETE_CATEGORY_OPERATION',
                'state' => 'SUCCESS'
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }
}

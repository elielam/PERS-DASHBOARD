<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Entity\TodoCategory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TodoCatController extends Controller
{
    /**
     * @Route("/categories/todo/", name="get_basic_categories_todo")
     * @Method("GET")
     */
    public function getBasicCategoriesTodo()
    {
        // PROVIDE MEMORY LEAK
        unset($datas);

        // GET ENTITIES
        $categories = $this->getDoctrine()->getManager()->getRepository(TodoCategory::class)->findAll();

        // PROVIDE ID ERROR
        if ($categories === null ) {
            return new JsonResponse(
                array(
                    'request' => 'GET_BASIC_CATEGORIES_TODO',
                    'state' => 'ERROR',
                    'message' => 'It seems no todo categories is in database !'
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
                'request' => 'GET_BASIC_CATEGORIES_TODO',
                'state' => 'SUCCESS',
                'datas' => $datas
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/categories/todo/extended/", name="get_extended_categories_todo")
     * @Method("GET")
     */
    public function getExtendedCategoriesTodo()
    {
        // PROVIDE MEMORY LEAK
        unset($datas);

        // GET ENTITIES
        $categories = $this->getDoctrine()->getManager()->getRepository(TodoCategory::class)->findAll();

        // PROVIDE ID ERROR
        if ($categories === null ) {
            return new JsonResponse(
                array(
                    'request' => 'GET_EXTENDED_CATEGORIES_TODO',
                    'state' => 'ERROR',
                    'message' => 'It seems no todo categories is in database !'
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
                'request' => 'GET_EXTENDED_CATEGORIES_TODO',
                'state' => 'SUCCESS',
                'datas' => $datas
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/categories/todo/{id}/", requirements={"id"="\d+"}, name="get_basic_category_todo")
     * @Method("GET")
     */
    public function getBasicCategoryTodo($id)
    {
        // PROVIDE MEMORY LEAK
        unset($datas);

        // GET ENTITY
        $category = $this->getDoctrine()->getManager()->getRepository(TodoCategory::class)->find(intval($id));

        // PROVIDE ID ERROR
        if ($category === null ) {
            return new JsonResponse(
                array(
                    'request' => 'GET_BASIC_CATEGORY_TODO',
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
                'request' => 'GET_BASIC_CATEGORY_TODO',
                'state' => 'SUCCESS',
                'datas' => $datas
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/categories/todo/{id}/extended/", requirements={"id"="\d+"}, name="get_extended_category_todo")
     * @Method("GET")
     */
    public function getExtendedCategoryTodo($id)
    {
        // PROVIDE MEMORY LEAK
        unset($datas);

        // GET ENTITY
        $category = $this->getDoctrine()->getManager()->getRepository(TodoCategory::class)->find(intval($id));

        // PROVIDE ID ERROR
        if ($category === null ) {
            return new JsonResponse(
                array(
                    'request' => 'GET_EXTENDED_CATEGORY_TODO',
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
                'request' => 'GET_EXTENDED_CATEGORY_TODO',
                'state' => 'SUCCESS',
                'datas' => $datas
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/categories/todo/", name="post_category_todo")
     * @Method("POST")
     */
    public function postCategoryOperation(Request $request)
    {
        // GET UNFORMATTED DATAS
        $unformattedLibelle = $request->get('libelle');

        // FORMAT DATAS
        if ($unformattedLibelle !== "") { $libelle = (string)$unformattedLibelle; } else { $libelle = null; }

        // CREATE ENTITY
        $category = new TodoCategory();
        if ($libelle !== null) {
            $category->setLibelle($libelle);
        } else {
            /* validate empty field */
            return new JsonResponse(
                array(
                    'request' => 'ADD_CATEGORY_TODO',
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
                'request' => 'ADD_CATEGORY_TODO',
                'state' => 'SUCCESS'
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/categories/todo/{id}/", name="put_category_todo")
     * @Method("PUT")
     */
    public function putCategoryOperation($id, Request $request)
    {
        // GET ENTITY
        $category = $this->getDoctrine()->getManager()->getRepository(TodoCategory::class)->find(intval($id));

        // PROVIDE ID ERROR
        if ($category === null) {
            return new JsonResponse(
                array(
                    'request' => 'UPDATE_CATEGORY_TODO',
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
                'request' => 'UPDATE_CATEGORY_TODO',
                'state' => 'SUCCESS'
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/categories/todo/{id}/", requirements={"id"="\d+"}, name="delete_category_todo")
     * @Method("DELETE")
     */
    public function deleteCategoryTodo($id)
    {
        // GET ENTITY
        $category = $this->getDoctrine()->getManager()->getRepository(TodoCategory::class)->find(intval($id));

        // PROVIDE ID ERROR
        if ($category === null ) {
            return new JsonResponse(
                array(
                    'request' => 'DELETE_CATEGORY_TODO',
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
                'request' => 'DELETE_CATEGORY_TODO',
                'state' => 'SUCCESS'
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }
}

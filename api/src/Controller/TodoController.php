<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Entity\TodoCategory;
use App\Entity\User;
use DateTime;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TodoController extends Controller
{
    /**
     * @Route("/todos/", name="get_basic_todos")
     * @Method("GET")
     */
    public function getBasicTodos()
    {
        // PROVIDE MEMORY LEAK
        unset($datas);

        // GET ENTITIES
        $todos = $this->getDoctrine()->getManager()->getRepository(Todo::class)->findAll();

        // PROVIDE ID ERROR
        if ($todos === null ) {
            return new JsonResponse(
                array(
                    'request' => 'GET_BASIC_TODOS',
                    'state' => 'ERROR',
                    'message' => 'It seems no todos is in database !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // FORMAT DATAS
        $datas = [];
        foreach ($todos as $todo) {
            $datas[] = $todo->toArrayBasic();
        }

        // PROVIDE MEMORY LEAK
        unset($todos);
        unset($todo);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'GET_BASIC_TODOS',
                'state' => 'SUCCESS',
                'datas' => $datas
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/todos/extended/", name="get_extended_todos")
     * @Method("GET")
     */
    public function getExtendedTodos()
    {
        // PROVIDE MEMORY LEAK
        unset($datas);

        // GET ENTITIES
        $todos = $this->getDoctrine()->getManager()->getRepository(Todo::class)->findAll();

        // PROVIDE ID ERROR
        if ($todos === null ) {
            return new JsonResponse(
                array(
                    'request' => 'GET_EXTENDED_TODOS',
                    'state' => 'ERROR',
                    'message' => 'It seems no todos is in database !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // FORMAT DATAS
        $datas = [];
        foreach ($todos as $todo) {
            $datas[] = $todo->toArrayExtended();
        }

        // PROVIDE MEMORY LEAK
        unset($todos);
        unset($todo);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'GET_EXTENDED_TODOS',
                'state' => 'SUCCESS',
                'datas' => $datas
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/todos/{id}/", requirements={"id"="\d+"}, name="get_basic_todo")
     * @Method("GET")
     */
    public function getBasicTodo($id)
    {
        // PROVIDE MEMORY LEAK
        unset($datas);

        // GET ENTITY
        $todo = $this->getDoctrine()->getManager()->getRepository(Todo::class)->find(intval($id));

        // PROVIDE ID ERROR
        if ($todo === null ) {
            return new JsonResponse(
                array(
                    'request' => 'GET_BASIC_TODO',
                    'state' => 'ERROR',
                    'message' => 'This ID dosn\'nt seems exist !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // FORMAT DATAS
        $datas = $todo->toArrayBasic();

        // PROVIDE MEMORY LEAK
        unset($id);
        unset($todo);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'GET_BASIC_TODO',
                'state' => 'SUCCESS',
                'datas' => $datas
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/todos/{id}/extended/", requirements={"id"="\d+"}, name="get_extended_todo")
     * @Method("GET")
     */
    public function getExtendedTodo($id)
    {
        // PROVIDE MEMORY LEAK
        unset($datas);

        // GET ENTITY
        $todo = $this->getDoctrine()->getManager()->getRepository(Todo::class)->find(intval($id));

        // PROVIDE ID ERROR
        if ($todo === null ) {
            return new JsonResponse(
                array(
                    'request' => 'GET_EXTENDED_TODO',
                    'state' => 'ERROR',
                    'message' => 'This ID dosn\'nt seems exist !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // FORMAT DATAS
        $datas = $todo->toArrayExtended();

        // PROVIDE MEMORY LEAK
        unset($id);
        unset($todo);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'GET_EXTENDED_TODO',
                'state' => 'SUCCESS',
                'datas' => $datas
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/todos/", name="post_todo")
     * @Method("POST")
     */
    public function postTodo(Request $request)
    {
        // GET UNFORMATTED DATAS
        $unformattedLibelle = $request->get('libelle');
        $unformattedDescription = $request->get('description');
        $unformattedDatetime = $request->get('datetime');
        $unformattedState = $request->get('state');
        $unformattedUid = $request->get('uid');
        $unformattedCid = $request->get('cid');

        // FORMAT DATAS
        if ($unformattedLibelle !== "") { $libelle = (string)$unformattedLibelle; } else { $libelle = null; }
        if ($unformattedDescription !== "") { $description = (string)$unformattedDescription; } else { $description = null; }
        if ($unformattedDatetime !== "") { $datetime = DateTime::createFromFormat('d-m-Y H:i:s', $unformattedDatetime); } else { $datetime = null; }
        if ($unformattedState !== "") { $state = (integer)$unformattedState; } else { $state = null; }
        if ($unformattedUid !== "") { $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find(intval($unformattedUid)); } else { $user = null; }
        if ($unformattedCid !== "") { $category = $this->getDoctrine()->getManager()->getRepository(TodoCategory::class)->find(intval($unformattedCid)); } else { $category = null; }

        // CREATE ENTITY
        $todo = new Todo();
        if ($libelle !== null) {
            $todo->setLibelle($libelle);
        } else {
            /* validate empty field */
            return new JsonResponse(
                array(
                    'request' => 'ADD_TODO',
                    'state' => 'ERROR',
                    'message' => 'Libelle can\'t be null !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }
        if ($description !== null) {
            $todo->setDescription($description);
        } else {
            /* validate empty field */
            return new JsonResponse(
                array(
                    'request' => 'ADD_TODO',
                    'state' => 'ERROR',
                    'message' => 'Description can\'t be null !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }
        if ($datetime !== null) {
            $todo->setDatetime($datetime);
        } else {
            /* validate empty field */
            return new JsonResponse(
                array(
                    'request' => 'ADD_TODO',
                    'state' => 'ERROR',
                    'message' => 'Datetime can\'t be null !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }
        if ($state !== null) {
            $todo->setState($state);
        } else {
            /* validate empty field */
            return new JsonResponse(
                array(
                    'request' => 'ADD_TODO',
                    'state' => 'ERROR',
                    'message' => 'State can\'t be null !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }
        if ($user !== null) {
            $todo->setUser($user);
        } else {
            /* validate empty field */
            return new JsonResponse(
                array(
                    'request' => 'ADD_TODO',
                    'state' => 'ERROR',
                    'message' => 'User can\'t be null !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }
        if ($category !== null) {
            $todo->setTodoCat($category);
        } else {
            /* validate empty field */
            return new JsonResponse(
                array(
                    'request' => 'ADD_TODO',
                    'state' => 'ERROR',
                    'message' => 'Category can\'t be null !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // PERSIST ENTITY
        $this->getDoctrine()->getManager()->persist($todo);
        $this->getDoctrine()->getManager()->flush();

        // PROVIDE MEMORY LEAK
        unset($request);
        unset($unformattedLibelle);
        unset($unformattedDescription);
        unset($unformattedDatetime);
        unset($unformattedState);
        unset($unformattedUid);
        unset($unformattedCid);
        unset($libelle);
        unset($description);
        unset($datetime);
        unset($state);
        unset($user);
        unset($category);
        unset($todo);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'ADD_TODO',
                'state' => 'SUCCESS'
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/todos/{id}/", name="put_todo")
     * @Method("PUT")
     */
    public function putTodo($id, Request $request)
    {
        $todo = $this->getDoctrine()->getManager()->getRepository(Todo::class)->find(intval($id));

        // PROVIDE ID ERROR
        if ($todo === null) {
            return new JsonResponse(
                array(
                    'request' => 'UPDATE_TODO',
                    'state' => 'ERROR',
                    'message' => 'This ID dosn\'nt seems exist !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // GET UNFORMATTED DATAS
        $unformattedLibelle = $request->get('libelle');
        $unformattedDescription = $request->get('description');
        $unformattedDatetime = $request->get('datetime');
        $unformattedState = $request->get('state');
        $unformattedUid = $request->get('uid');
        $unformattedCid = $request->get('cid');

        // FORMAT DATAS
        if ($unformattedLibelle !== "") { $libelle = (string)$unformattedLibelle; } else { $libelle = null; }
        if ($unformattedDescription !== "") { $description = (string)$unformattedDescription; } else { $description = null; }
        if ($unformattedDatetime !== "") { $datetime = DateTime::createFromFormat('d-m-Y H:i:s', $unformattedDatetime); } else { $datetime = null; }
        if ($unformattedState !== "") { $state = (integer)$unformattedState; } else { $state = null; }
        if ($unformattedUid !== "") { $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find(intval($unformattedUid)); } else { $user = null; }
        if ($unformattedCid !== "") { $category = $this->getDoctrine()->getManager()->getRepository(TodoCategory::class)->find(intval($unformattedCid)); } else { $category = null; }

        //UPDATE ENTITY
        if($todo->getLibelle() !== $libelle && $libelle !== null) { $todo->setLibelle($libelle); }
        if($todo->getDescription() !== $description && $description !== null) { $todo->setDescription($description); }
        if($todo->getDatetime() !== $datetime && $datetime !== null) { $todo->setDatetime($datetime); }
        if($todo->getState() !== $state && $state !== null) { $todo->setState($state); }
        if($todo->getUser() !== $user && $user !== null) { $todo->setUser($user); }
        if($todo->getTodoCat() !== $category && $category !== null) { $todo->setTodoCat($category); }

        // PERSIST ENTITY
        $this->getDoctrine()->getManager()->persist($todo);
        $this->getDoctrine()->getManager()->flush();

        // PROVIDE MEMORY LEAK
        unset($request);
        unset($id);
        unset($unformattedLibelle);
        unset($unformattedDescription);
        unset($unformattedDatetime);
        unset($unformattedState);
        unset($unformattedUid);
        unset($unformattedCid);
        unset($libelle);
        unset($description);
        unset($datetime);
        unset($state);
        unset($user);
        unset($category);
        unset($todo);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'UPDATE_TODO',
                'state' => 'SUCCESS'
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/todos/{id}/", requirements={"id"="\d+"}, name="delete_todo")
     * @Method("DELETE")
     */
    public function deleteTodo($id)
    {
        // GET ENTITY
        $todo = $this->getDoctrine()->getManager()->getRepository(Todo::class)->find(intval($id));

        // PROVIDE ID ERROR
        if ($todo === null ) {
            return new JsonResponse(
                array(
                    'request' => 'DELETE_TODO',
                    'state' => 'ERROR',
                    'message' => 'This ID dosn\'nt seems exist !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // DELETE ENTITY
        $this->getDoctrine()->getManager()->remove($todo);
        $this->getDoctrine()->getManager()->flush();

        // PROVIDE MEMORY LEAK
        unset($id);
        unset($todo);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'DELETE_TODO',
                'state' => 'SUCCESS'
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }
}

<?php

namespace App\Controller;

use App\Entity\User;
use DateTime;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    /**
     * @Route("/users/", name="get_basic_users")
     * @Method("GET")
     */
    public function getBasicUsers()
    {
        // PROVIDE MEMORY LEAK
        unset($datas);

        // GET ENTITIES
        $users = $this->getDoctrine()->getManager()->getRepository(User::class)->findAll();

        // PROVIDE ID ERROR
        if ($users === null ) {
            return new JsonResponse(
                array(
                    'request' => 'GET_BASIC_USERS',
                    'state' => 'ERROR',
                    'message' => 'It seems no users is in database !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // FORMAT DATAS
        $datas = [];
        foreach ($users as $user) {
            $datas[] = $user->toArrayBasic();
        }

        // PROVIDE MEMORY LEAK
        unset($users);
        unset($user);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'GET_BASIC_USERS',
                'state' => 'SUCCESS',
                'datas' => $datas
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/users/extended/", name="get_extended_users")
     * @Method("GET")
     */
    public function getExtendedUsers()
    {
        // PROVIDE MEMORY LEAK
        unset($datas);

        // GET ENTITIES
        $users = $this->getDoctrine()->getManager()->getRepository(User::class)->findAll();

        // PROVIDE ID ERROR
        if ($users === null ) {
            return new JsonResponse(
                array(
                    'request' => 'GET_EXTENDED_USERS',
                    'state' => 'ERROR',
                    'message' => 'It seems no users is in database !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // FORMAT DATAS
        $datas = [];
        foreach ($users as $user) {
            $datas[] = $user->toArrayExtended();
        }

        // PROVIDE MEMORY LEAK
        unset($users);
        unset($user);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'GET_EXTENDED_USERS',
                'state' => 'SUCCESS',
                'datas' => $datas
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/users/{id}/", requirements={"id"="\d+"}, name="get_basic_user")
     * @Method("GET")
     */
    public function getBasicUser($id)
    {
        // PROVIDE MEMORY LEAK
        unset($datas);

        // GET ENTITY
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find(intval($id));

        // PROVIDE ID ERROR
        if ($user === null ) {
            return new JsonResponse(
                array(
                    'request' => 'GET_BASIC_USER',
                    'state' => 'ERROR',
                    'message' => 'This ID dosn\'nt seems exist !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // FORMAT DATAS
        $datas = $user->toArrayBasic();

        // PROVIDE MEMORY LEAK
        unset($id);
        unset($user);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'GET_BASIC_USER',
                'state' => 'SUCCESS',
                'datas' => $datas
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/users/{id}/extended/", requirements={"id"="\d+"}, name="get_extended_user")
     * @Method("GET")
     */
    public function getExtendedUser($id)
    {
        // PROVIDE MEMORY LEAK
        unset($datas);

        // GET ENTITY
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find(intval($id));

        // PROVIDE ID ERROR
        if ($user === null ) {
            return new JsonResponse(
                array(
                    'request' => 'GET_EXTENDED_USER',
                    'state' => 'ERROR',
                    'message' => 'This ID dosn\'nt seems exist !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // FORMAT DATAS
        $datas = $user->toArrayExtended();

        // PROVIDE MEMORY LEAK
        unset($id);
        unset($user);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'GET_EXTENDED_USER',
                'state' => 'SUCCESS',
                'datas' => $datas
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/users/", name="post_user")
     * @Method("POST")
     */
    // METHOD WITH ALREADY ENCRYPTED PASSWORD
    public function postUser(Request $request)
    {
        // GET UNFORMATTED DATAS
        $unformattedName = $request->get('name');
        $unformattedLastname = $request->get('lastname');
        $unformattedBirthdate = $request->get('birthdate');
        $unformattedEmail = $request->get('email');
        $unformattedPassword = $request->get('password');
        $unformattedRoles = $request->get('roles');
        $unformattedUsername = $request->get('username');

        // FORMAT DATAS
        if($unformattedName !== "") { $name = (string)$unformattedName; } else { $name = null; }
        if($unformattedLastname !== "") { $lastname = (string)$unformattedLastname; } else { $lastname = null; }
        if($unformattedBirthdate !== "") { $birthdate = DateTime::createFromFormat('d-m-Y H:i:s', $unformattedBirthdate); } else { $birthdate = null; }
        if($unformattedEmail !== "") { $email = (string)$unformattedEmail; } else { $email = null; }
        if($unformattedPassword !== "") { $password = (string)$unformattedPassword; } else { $password = null; }
        if($unformattedRoles !== "") { $roles = (array)$unformattedRoles; } else { $roles = null; }
        if($unformattedUsername !== "") { $username = (string)$unformattedUsername; } else { $username = null; }

        // CREATE ENTITY
        $user = new User();
        if($name !== null) { $user->setName($name); } else {
            /* validate empty field */
            return new JsonResponse(
                array(
                    'request' => 'ADD_USER',
                    'state' => 'ERROR',
                    'message' => 'Name can\'t be null !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }
        if($lastname !== null) { $user->setLastname($lastname); } else {
            /* validate empty field */
            return new JsonResponse(
                array(
                    'request' => 'ADD_USER',
                    'state' => 'ERROR',
                    'message' => 'Lastname can\'t be null !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }
        if($birthdate !== null) { $user->setBirthdate($birthdate); }
        if($email !== null) { $user->setEmail($email); } else {
            /* validate empty field */
            return new JsonResponse(
                array(
                    'request' => 'ADD_USER',
                    'state' => 'ERROR',
                    'message' => 'Email can\'t be null !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }
        if($password !== null) { $user->setPassword($password); } else {
            /* validate empty field */
            return new JsonResponse(
                array(
                    'request' => 'ADD_USER',
                    'state' => 'ERROR',
                    'message' => 'Password can\'t be null !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }
        if($roles !== null) { $user->setRoles($roles); } else {
            /* validate empty field */
            return new JsonResponse(
                array(
                    'request' => 'ADD_USER',
                    'state' => 'ERROR',
                    'message' => 'Roles can\'t be null !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }
        if($username !== null) { $user->setUsername($username); } else {
            /* validate empty field */
            return new JsonResponse(
                array(
                    'request' => 'ADD_USER',
                    'state' => 'ERROR',
                    'message' => 'Username can\'t be null !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // PERSIST ENTITY
        $this->getDoctrine()->getManager()->persist($user);
        $this->getDoctrine()->getManager()->flush();

        // PROVIDE MEMORY LEAK
        unset($request);
        unset($unformattedName);
        unset($unformattedLastname);
        unset($unformattedBirthdate);
        unset($unformattedEmail);
        unset($unformattedPassword);
        unset($unformattedRoles);
        unset($unformattedUsername);
        unset($name);
        unset($lastname);
        unset($birthdate);
        unset($email);
        unset($password);
        unset($roles);
        unset($username);
        unset($user);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'ADD_USER',
                'state' => 'SUCCESS'
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/users/{id}/", requirements={"id"="\d+"}, name="put_user")
     * @Method("PUT")
     */
    // METHOD WITH ALREADY ENCRYPTED PASSWORD
    public function putUser(Request $request, $id)
    {
        // GET ENTITY
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find(intval($id));

        // PROVIDE ID ERROR
        if ($user === null) {
            return new JsonResponse(
                array(
                    'request' => 'UPDATE_USER',
                    'state' => 'ERROR',
                    'message' => 'This ID dosn\'nt seems exist !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // GET UNFORMATTED DATAS
        $unformattedName = $request->get('name');
        $unformattedLastname = $request->get('lastname');
        $unformattedBirthdate = $request->get('birthdate');
        $unformattedEmail = $request->get('email');
        $unformattedPassword = $request->get('password');
        $unformattedRoles = $request->get('roles');
        $unformattedUsername = $request->get('username');

        // FORMAT DATAS
        if($unformattedName !== "") { $name = (string)$unformattedName; } else { $name = null; }
        if($unformattedLastname !== "") { $lastname = (string)$unformattedLastname; } else { $lastname = null; }
        if($unformattedBirthdate !== "") { $birthdate = DateTime::createFromFormat('d-m-Y H:i:s', $unformattedBirthdate); } else { $birthdate = null; }
        if($unformattedEmail !== "") { $email = (string)$unformattedEmail; } else { $email = null; }
        if($unformattedPassword !== "") { $password = (string)$unformattedPassword; } else { $password = null; }
        if($unformattedRoles !== "") { $roles = (array)$unformattedRoles; } else { $roles = null; }
        if($unformattedUsername !== "") { $username = (string)$unformattedUsername; } else { $username = null; }

        //UPDATE ENTITY
        if($user->getName() !== $name && $name !== null) { $user->setName($name); }
        if($user->getLastname() !== $lastname && $lastname !== null) { $user->setLastname($lastname); }
        if($user->getBirthdate() !== $birthdate && $birthdate !== null) { $user->setBirthdate($birthdate); }
        if($user->getEmail() !== $email && $email !== null) { $user->setEmail($email); }
        if($user->getPassword() !== $password && $password !== null) { $user->setPassword($password); }
        if($user->getRoles() !== $roles && $roles !== null) { $user->setRoles($roles); }
        if($user->getUsername() !== $username && $username !== null) { $user->setUsername($username); }

        // PERSIST ENTITY
        $this->getDoctrine()->getManager()->persist($user);
        $this->getDoctrine()->getManager()->flush();

        // PROVIDE MEMORY LEAK
        unset($request);
        unset($id);
        unset($unformattedName);
        unset($unformattedLastname);
        unset($unformattedBirthdate);
        unset($unformattedEmail);
        unset($unformattedPassword);
        unset($unformattedRoles);
        unset($unformattedUsername);
        unset($name);
        unset($lastname);
        unset($birthdate);
        unset($email);
        unset($password);
        unset($roles);
        unset($username);
        unset($user);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'UPDATE_USER',
                'state' => 'SUCCESS'
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/users/{id}/", requirements={"id"="\d+"}, name="delete_user")
     * @Method("DELETE")
     */
    public function deleteUser($id)
    {
        // GET ENTITY
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find(intval($id));

        // PROVIDE ID ERROR
        if ($user === null ) {
            return new JsonResponse(
                array(
                    'request' => 'DELETE_USER',
                    'state' => 'ERROR',
                    'message' => 'This ID dosn\'nt seems exist !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // DELETE ENTITY
        $this->getDoctrine()->getManager()->remove($user);
        $this->getDoctrine()->getManager()->flush();

        // PROVIDE MEMORY LEAK
        unset($id);
        unset($account);
        unset($user);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'DELETE_ACCOUNT',
                'state' => 'SUCCESS'
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

}

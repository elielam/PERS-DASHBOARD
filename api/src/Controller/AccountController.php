<?php

namespace App\Controller;

use App\Entity\Account;
use App\Entity\User;
use DateTime;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccountController extends Controller
{
    /**
     * @Route("/accounts/", name="get_basic_accounts")
     * @Method("GET")
     */
    public function getBasicAccounts()
    {
        // PROVIDE MEMORY LEAK
        unset($datas);

        // GET ENTITIES
        $accounts = $this->getDoctrine()->getManager()->getRepository(Account::class)->findAll();

        // PROVIDE ID ERROR
        if ($accounts === null ) {
            return new JsonResponse(
                array(
                    'request' => 'GET_BASIC_ACCOUNTS',
                    'state' => 'ERROR',
                    'message' => 'It seems no accounts is in database !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // FORMAT DATAS
        $datas = [];
        foreach ($accounts as $account) {
            $datas[] = $account->toArrayBasic();
        }

        // PROVIDE MEMORY LEAK
        unset($accounts);
        unset($account);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'GET_BASIC_ACCOUNTS',
                'state' => 'SUCCESS',
                'datas' => $datas
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/accounts/extended/", name="get_extended_accounts")
     * @Method("GET")
     */
    public function getExtendedAccounts()
    {
        // PROVIDE MEMORY LEAK
        unset($datas);

        // GET ENTITIES
        $accounts = $this->getDoctrine()->getManager()->getRepository(Account::class)->findAll();

        // PROVIDE ID ERROR
        if ($accounts === null ) {
            return new JsonResponse(
                array(
                    'request' => 'GET_EXTENDED_ACCOUNTS',
                    'state' => 'ERROR',
                    'message' => 'It seems no accounts is in database !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // FORMAT DATAS
        $datas = [];
        foreach ($accounts as $account) {
            $datas[] = $account->toArrayExtended();
        }

        // PROVIDE MEMORY LEAK
        unset($accounts);
        unset($account);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'GET_EXTENDED_ACCOUNTS',
                'state' => 'SUCCESS',
                'datas' => $datas
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/accounts/{id}/", requirements={"id"="\d+"}, name="get_basic_account")
     * @Method("GET")
     */
    public function getBasicAccount($id)
    {
        // PROVIDE MEMORY LEAK
        unset($datas);

        // GET ENTITY
        $account = $this->getDoctrine()->getManager()->getRepository(Account::class)->find(intval($id));

        // PROVIDE ID ERROR
        if ($account === null ) {
            return new JsonResponse(
                array(
                    'request' => 'GET_BASIC_ACCOUNT',
                    'state' => 'ERROR',
                    'message' => 'This ID dosn\'nt seems exist !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // FORMAT DATAS
        $datas = $account->toArrayBasic();

        // PROVIDE MEMORY LEAK
        unset($id);
        unset($account);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'GET_BASIC_ACCOUNT',
                'state' => 'SUCCESS',
                'datas' => $datas
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/accounts/{id}/extended/", requirements={"id"="\d+"}, name="get_extended_account")
     * @Method("GET")
     */
    public function getExtendedAccount($id)
    {
        // PROVIDE MEMORY LEAK
        unset($datas);

        // GET ENTITY
        $account = $this->getDoctrine()->getManager()->getRepository(Account::class)->find(intval($id));

        // PROVIDE ID ERROR
        if ($account === null ) {
            return new JsonResponse(
                array(
                    'request' => 'GET_EXTENDED_ACCOUNT',
                    'state' => 'ERROR',
                    'message' => 'This ID dosn\'nt seems exist !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // FORMAT DATAS
        $datas = $account->toArrayExtended();

        // PROVIDE MEMORY LEAK
        unset($id);
        unset($account);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'GET_EXTENDED_ACCOUNT',
                'state' => 'SUCCESS',
                'datas' => $datas
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/accounts/", name="post_account")
     * @Method("POST")
     */
    public function postAccount(Request $request)
    {
        // GET UNFORMATTED DATAS
        $unformattedUid = $request->get('uid');
        $unformattedLibelle = $request->get('libelle');
        $unformattedSalaryDay = $request->get('salaryDay');
        $unformattedBalance = $request->get('balance');
        $unformattedAtFirstBalance = $request->get('atFirstBalance');
        $unformattedInterestDraft = $request->get('interestDraft');
        $unformattedOverdraft = $request->get('overdraft');

        // FORMAT DATAS
        if($unformattedUid !== "") { $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find(intval($unformattedUid)); } else { $user = null; }
        if($unformattedLibelle !== "") { $libelle = (string)$unformattedLibelle; } else { $libelle = null; }
        if($unformattedSalaryDay !== "") { $salaryDay = DateTime::createFromFormat('d-m-Y H:i:s', $unformattedSalaryDay); } else { $salaryDay = null; }
        if($unformattedBalance !== "") { $balance = (double)$unformattedBalance; } else { $balance = null; }
        if($unformattedAtFirstBalance !== "") { $atFirstBalance = (double)$unformattedAtFirstBalance; } else { $atFirstBalance = null; }
        if($unformattedInterestDraft !== "") { $interestDraft = (double)$unformattedInterestDraft; } else { $interestDraft = null; }
        if($unformattedOverdraft !== "") { $overdraft = (double)$unformattedOverdraft; } else { $overdraft = null; }

        // CREATE ENTITY
        $account = new Account();
        if($user !== null) { $account->setUser($user); } else {
            /* validate empty field */
            return new JsonResponse(
                array(
                    'request' => 'ADD_ACCOUNT',
                    'state' => 'ERROR',
                    'message' => 'User can\'t be null !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }
        if($libelle !== null) { $account->setLibelle($libelle); } else {
            /* validate empty field */
            return new JsonResponse(
                array(
                    'request' => 'ADD_ACCOUNT',
                    'state' => 'ERROR',
                    'message' => 'Libelle can\'t be null !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }
        if($salaryDay !== null) { $account->setSalaryDay($salaryDay); }
        if($balance !== null) { $account->setBalance($balance); } else {
            /* validate empty field */
            return new JsonResponse(
                array(
                    'request' => 'ADD_ACCOUNT',
                    'state' => 'ERROR',
                    'message' => 'Balance can\'t be null !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }
        if($atFirstBalance !== null) { $account->setAtFirstBalance($atFirstBalance); }
        if($interestDraft !== null) { $account->setInterestDraft($interestDraft); }
        if($overdraft !== null) { $account->setOverdraft($overdraft); } else {
            /* validate empty field */
            return new JsonResponse(
                array(
                    'request' => 'ADD_ACCOUNT',
                    'state' => 'ERROR',
                    'message' => 'Overdraft can\'t be null !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // PERSIST ENTITY
        $this->getDoctrine()->getManager()->persist($account);
        $this->getDoctrine()->getManager()->flush();

        // PROVIDE MEMORY LEAK
        unset($request);
        unset($unformattedUid);
        unset($unformattedLibelle);
        unset($unformattedSalaryDay);
        unset($unformattedBalance);
        unset($unformattedAtFirstBalance);
        unset($unformattedInterestDraft);
        unset($unformattedOverdraft);
        unset($user);
        unset($libelle);
        unset($salaryDay);
        unset($balance);
        unset($atFirstBalance);
        unset($interestDraft);
        unset($overdraft);
        unset($account);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'ADD_ACCOUNT',
                'state' => 'SUCCESS'
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/accounts/{id}/", requirements={"id"="\d+"}, name="put_account")
     * @Method("PUT")
     */
    public function putAccount(Request $request, $id)
    {
        // GET ENTITY
        $account = $this->getDoctrine()->getManager()->getRepository(Account::class)->find(intval($id));

        // PROVIDE ID ERROR
        if ($account === null ) {
            return new JsonResponse(
                array(
                    'request' => 'UPDATE_ACCOUNT',
                    'state' => 'ERROR',
                    'message' => 'This ID dosn\'nt seems exist !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // GET UNFORMATTED DATAS
        $unformattedUid = $request->get('uid');
        $unformattedLibelle = $request->get('libelle');
        $unformattedSalaryDay = $request->get('salaryDay');
        $unformattedBalance = $request->get('balance');
        $unformattedAtFirstBalance = $request->get('atFirstBalance');
        $unformattedInterestDraft = $request->get('interestDraft');
        $unformattedOverdraft = $request->get('overdraft');

        // FORMAT DATAS
        if($unformattedUid !== "") { $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find(intval($unformattedUid)); } else { $user = null; }
        if($unformattedLibelle !== "") { $libelle = (string)$unformattedLibelle; } else { $libelle = null; }
        if($unformattedSalaryDay !== "") { $salaryDay = DateTime::createFromFormat('d-m-Y H:i:s', $unformattedSalaryDay); } else { $salaryDay = null; }
        if($unformattedBalance !== "") { $balance = (double)$unformattedBalance; } else { $balance = null; }
        if($unformattedAtFirstBalance !== "") { $atFirstBalance = (double)$unformattedAtFirstBalance; } else { $atFirstBalance = null; }
        if($unformattedInterestDraft !== "") { $interestDraft = (double)$unformattedInterestDraft; } else { $interestDraft = null; }
        if($unformattedOverdraft !== "") { $overdraft = (double)$unformattedOverdraft; } else { $overdraft = null; }

        //UPDATE ENTITY
        if($account->getUser() !== $user && $user !== null) { $account->setUser($user); }
        if($account->getLibelle() !== $libelle && $libelle !== null) { $account->setLibelle($libelle); }
        if($account->getSalaryDay() !== $salaryDay && $salaryDay !== null) { $account->setSalaryDay($salaryDay); }
        if($account->getBalance() !== $balance && $balance !== null) { $account->setBalance($balance); }
        if($account->getAtFirstBalance() !== $atFirstBalance && $atFirstBalance !== null) { $account->setAtFirstBalance($atFirstBalance); }
        if($account->getInterestDraft() !== $interestDraft && $interestDraft !== null) { $account->setInterestDraft($interestDraft); }
        if($account->getOverdraft() !== $overdraft && $overdraft !== null) { $account->setOverdraft($overdraft); }

        // PERSIST ENTITY
        $this->getDoctrine()->getManager()->persist($account);
        $this->getDoctrine()->getManager()->flush();

        // PROVIDE MEMORY LEAK
        unset($request);
        unset($id);
        unset($account);
        unset($unformattedUid);
        unset($unformattedLibelle);
        unset($unformattedSalaryDay);
        unset($unformattedBalance);
        unset($unformattedAtFirstBalance);
        unset($unformattedInterestDraft);
        unset($unformattedOverdraft);
        unset($user);
        unset($libelle);
        unset($salaryDay);
        unset($balance);
        unset($atFirstBalance);
        unset($interestDraft);
        unset($overdraft);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'UPDATE_ACCOUNT',
                'state' => 'SUCCESS'
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/accounts/{id}/", requirements={"id"="\d+"}, name="delete_account")
     * @Method("DELETE")
     */
    public function deleteAccount($id)
    {
        // GET ENTITY
        $account = $this->getDoctrine()->getManager()->getRepository(Account::class)->find(intval($id));

        // PROVIDE ID ERROR
        if ($account === null ) {
            return new JsonResponse(
                array(
                    'request' => 'DELETE_ACCOUNT',
                    'state' => 'ERROR',
                    'message' => 'This ID dosn\'nt seems exist !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // DELETE ENTITY
        $user = $account->getUser();
        $user->removeAccount($account);
        $this->getDoctrine()->getManager()->remove($account);

        // PERSIST ENTITY
        $this->getDoctrine()->getManager()->persist($user);
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

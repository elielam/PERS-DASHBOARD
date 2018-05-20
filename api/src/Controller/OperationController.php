<?php

namespace App\Controller;

use App\Entity\Account;
use App\Entity\OperationCategory;
use App\Entity\OperationMinus;
use App\Entity\OperationPlus;
use DateTime;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OperationController extends Controller
{
    /**
     * @Route("/operations/{type}/", name="get_basic_operations", requirements={
     *     "type"="credit|debit"
     * })
     * @Method("GET")
     */
    public function getBasicOperations($type)
    {
        // PROVIDE MEMORY LEAK
        unset($datas);

        // PROVIDE TYPE WRONG VALUE
        if ($type === "credit") {
            // GET ENTITIES
            $operations = $this->getDoctrine()->getManager()->getRepository(OperationPlus::class)->findAll();
        } elseif ($type === "debit") {
            // GET ENTITIES
            $operations = $this->getDoctrine()->getManager()->getRepository(OperationMinus::class)->findAll();
        } else {
            return new JsonResponse(
                array(
                    'request' => 'GET_BASIC_OPERATIONS',
                    'state' => 'ERROR',
                    'message' => 'Operation type can only be credit or debit !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // PROVIDE ID ERROR
        if ($operations === null) {
            return new JsonResponse(
                array(
                    'request' => 'GET_BASIC_OPERATIONS',
                    'state' => 'ERROR',
                    'message' => 'It seems no operations is in database !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // FORMAT DATAS
        $datas = [];
        foreach ($operations as $operation) {
            $datas[] = $operation->toArrayBasic();
        }

        // PROVIDE MEMORY LEAK
        unset($operations);
        unset($operation);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'GET_BASIC_OPERATIONS',
                'state' => 'SUCCESS',
                'datas' => $datas
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/operations/{type}/extended/", name="get_extended_operations", requirements={
     *     "type"="credit|debit"
     * })
     * @Method("GET")
     */
    public function getExtendedOperations($type)
    {
        // PROVIDE MEMORY LEAK
        unset($datas);

        // PROVIDE TYPE WRONG VALUE
        if ($type === "credit") {
            // GET ENTITIES
            $operations = $this->getDoctrine()->getManager()->getRepository(OperationPlus::class)->findAll();
        } elseif ($type === "debit") {
            // GET ENTITIES
            $operations = $this->getDoctrine()->getManager()->getRepository(OperationMinus::class)->findAll();
        } else {
            return new JsonResponse(
                array(
                    'request' => 'GET_EXTENDED_OPERATIONS',
                    'state' => 'ERROR',
                    'message' => 'Operation type can only be credit or debit !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // PROVIDE ID ERROR
        if ($operations === null) {
            return new JsonResponse(
                array(
                    'request' => 'GET_EXTENDED_OPERATIONS',
                    'state' => 'ERROR',
                    'message' => 'It seems no operations is in database !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // FORMAT DATAS
        $datas = [];
        foreach ($operations as $operation) {
            $datas[] = $operation->toArrayExtended();
        }

        // PROVIDE MEMORY LEAK
        unset($operations);
        unset($operation);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'GET_EXTENDED_OPERATIONS',
                'state' => 'SUCCESS',
                'datas' => $datas
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/operations/{type}/{id}/", name="get_basic_operation"), requirements={
     *     "type"="credit|debit", "id"="\d+"
     * })
     * @Method("GET")
     */
    public function getBasicOperation($type, $id)
    {
        // PROVIDE MEMORY LEAK
        unset($datas);

        // PROVIDE TYPE WRONG VALUE
        if ($type === "credit") {
            // GET ENTITY
            $operation = $this->getDoctrine()->getManager()->getRepository(OperationPlus::class)->find(intval($id));
        } elseif ($type === "debit") {
            // GET ENTITIES
            $operation = $this->getDoctrine()->getManager()->getRepository(OperationMinus::class)->find(intval($id));
        } else {
            return new JsonResponse(
                array(
                    'request' => 'GET_BASIC_OPERATION',
                    'state' => 'ERROR',
                    'message' => 'Operation type can only be credit or debit !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // PROVIDE ID ERROR
        if ($operation === null) {
            return new JsonResponse(
                array(
                    'request' => 'GET_BASIC_OPERATION',
                    'state' => 'ERROR',
                    'message' => 'This ID dosn\'nt seems exist !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // FORMAT DATAS
        $datas = $operation->toArrayBasic();

        // PROVIDE MEMORY LEAK
        unset($id);
        unset($type);
        unset($operation);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'GET_BASIC_OPERATION',
                'state' => 'SUCCESS',
                'datas' => $datas
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/operations/{type}/{id}/extended/", name="get_extended_operation"), requirements={
     *     "type"="credit|debit", "id"="\d+"
     * })
     * @Method("GET")
     */
    public function getExtendedOperation($type, $id)
    {
        // PROVIDE MEMORY LEAK
        unset($datas);

        // PROVIDE TYPE WRONG VALUE
        if ($type === "credit") {
            // GET ENTITY
            $operation = $this->getDoctrine()->getManager()->getRepository(OperationPlus::class)->find(intval($id));
        } elseif ($type === "debit") {
            // GET ENTITIES
            $operation = $this->getDoctrine()->getManager()->getRepository(OperationMinus::class)->find(intval($id));
        } else {
            return new JsonResponse(
                array(
                    'request' => 'GET_EXTENDED_OPERATION',
                    'state' => 'ERROR',
                    'message' => 'Operation type can only be credit or debit !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // PROVIDE ID ERROR
        if ($operation === null) {
            return new JsonResponse(
                array(
                    'request' => 'GET_EXTENDED_OPERATION',
                    'state' => 'ERROR',
                    'message' => 'This ID dosn\'nt seems exist !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // FORMAT DATAS
        $datas = $operation->toArrayExtended();

        // PROVIDE MEMORY LEAK
        unset($id);
        unset($type);
        unset($operation);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'GET_EXTENDED_OPERATION',
                'state' => 'SUCCESS',
                'datas' => $datas
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/operations/{type}/", name="post_operation")
     * @Method("POST")
     */
    public function postOperation($type, Request $request)
    {
        // PROVIDE TYPE WRONG VALUE
        if ($type === "credit") {
            // GET UNFORMATTED DATAS
            $unformattedLibelle = $request->get('libelle');
            $unformattedDatetime = $request->get('datetime');
            $unformattedSum = $request->get('sum');
            $unformattedIsCredit = $request->get('isCredit');
            $unformattedAid = $request->get('aid');
            $unformattedCid = $request->get('cid');
        } elseif ($type === "debit") {
            // GET UNFORMATTED DATAS
            $unformattedLibelle = $request->get('libelle');
            $unformattedDatetime = $request->get('datetime');
            $unformattedSum = $request->get('sum');
            $unformattedIsDebit = $request->get('isDebit');
            $unformattedAid = $request->get('aid');
            $unformattedCid = $request->get('cid');
        } else {
            return new JsonResponse(
                array(
                    'request' => 'ADD_OPERATION',
                    'state' => 'ERROR',
                    'message' => 'Operation type can only be credit or debit !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // FORMAT DATAS
        if ($unformattedLibelle !== "") {
            $libelle = (string)$unformattedLibelle;
        } else {
            $libelle = null;
        }
        if ($unformattedDatetime !== "") {
            $datetime = DateTime::createFromFormat('d-m-Y H:i:s', $unformattedDatetime);
        } else {
            $datetime = null;
        }
        if ($unformattedSum !== "") {
            $sum = (double)$unformattedSum;
        } else {
            $sum = null;
        }
        if ($type === "credit") {
            if ($unformattedIsCredit !== "") {
                $isCredit = $unformattedIsCredit === 'true' ? true : false;
            } else {
                $isCredit = null;
            }
        } else if ($type === "debit") {
            if ($unformattedIsDebit !== "") {
                $isDebit = $unformattedIsDebit === 'true' ? true : false;
            } else {
                $isDebit = null;
            }
        }
        if ($unformattedAid !== "") {
            $account = $this->getDoctrine()->getManager()->getRepository(Account::class)->find(intval($unformattedAid));
        } else {
            $account = null;
        }
        if ($unformattedCid !== "") {
            $category = $this->getDoctrine()->getManager()->getRepository(OperationCategory::class)->find(intval($unformattedCid));
        } else {
            $category = null;
        }

        // CREATE ENTITY
        if ($type === "credit") {
            $operation = new OperationPlus();
        } else if ($type === "debit") {
            $operation = new OperationMinus();
        }

        if ($libelle !== null) {
            $operation->setLibelle($libelle);
        } else {
            /* validate empty field */
            return new JsonResponse(
                array(
                    'request' => 'ADD_OPERATION',
                    'state' => 'ERROR',
                    'message' => 'Libelle can\'t be null !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }
        if ($datetime !== null) {
            $operation->setDatetime($datetime);
        } else {
            /* validate empty field */
            return new JsonResponse(
                array(
                    'request' => 'ADD_OPERATION',
                    'state' => 'ERROR',
                    'message' => 'Datetime can\'t be null !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }
        if ($sum !== null) {
            $operation->setSum($sum);
        } else {
            /* validate empty field */
            return new JsonResponse(
                array(
                    'request' => 'ADD_OPERATION',
                    'state' => 'ERROR',
                    'message' => 'Sum can\'t be null !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        if ($type === "credit") {
            if ($isCredit !== null) {
                $operation->setIsCredit($isCredit);
            } else {
                /* validate empty field */
                return new JsonResponse(
                    array(
                        'request' => 'ADD_OPERATION',
                        'state' => 'ERROR',
                        'message' => 'IsCredit can\'t be null !'
                    ),
                    Response::HTTP_NOT_FOUND,
                    array('content-type' => 'json/html')
                );
            }
        } elseif ($type === "debit") {
            if ($isDebit !== null) {
                $operation->setIsDebit($isDebit);
            } else {
                /* validate empty field */
                return new JsonResponse(
                    array(
                        'request' => 'ADD_OPERATION',
                        'state' => 'ERROR',
                        'message' => 'IsDebit can\'t be null !'
                    ),
                    Response::HTTP_NOT_FOUND,
                    array('content-type' => 'json/html')
                );
            }
        }

        if ($account !== null) {
            $operation->setAccount($account);
        } else {
            /* validate empty field */
            return new JsonResponse(
                array(
                    'request' => 'ADD_OPERATION',
                    'state' => 'ERROR',
                    'message' => 'Account can\'t be null !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }
        if ($category !== null) {
            $operation->setOperationCategory($category);
        } else {
            /* validate empty field */
            return new JsonResponse(
                array(
                    'request' => 'ADD_OPERATION',
                    'state' => 'ERROR',
                    'message' => 'Category can\'t be null !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // PERSIST ENTITY
        $this->getDoctrine()->getManager()->persist($operation);
        $this->getDoctrine()->getManager()->flush();

        // PROVIDE MEMORY LEAK
        unset($request);
        unset($type);
        unset($unformattedLibelle);
        unset($unformattedDatetime);
        unset($unformattedSum);
        unset($unformattedIsCredit);
        unset($unformattedIsDebit);
        unset($unformattedAid);
        unset($unformattedCid);
        unset($libelle);
        unset($datetime);
        unset($sum);
        unset($isCredit);
        unset($isDebit);
        unset($account);
        unset($category);
        unset($operation);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'ADD_OPERATION',
                'state' => 'SUCCESS'
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }

    /**
     * @Route("/operations/{type}/{id}/", requirements={"id"="\d+"}, name="put_operation")
     * @Method("PUT")
     */
    public function putOperation(Request $request, $type, $id)
    {
        // PROVIDE TYPE WRONG VALUE
        if ($type === "credit") {
            $operation = $this->getDoctrine()->getManager()->getRepository(OperationPlus::class)->find(intval($id));
            // GET UNFORMATTED DATAS
            $unformattedLibelle = $request->get('libelle');
            $unformattedDatetime = $request->get('datetime');
            $unformattedSum = $request->get('sum');
            $unformattedIsCredit = $request->get('isCredit');
            $unformattedAid = $request->get('aid');
            $unformattedCid = $request->get('cid');
        } elseif ($type === "debit") {
            $operation = $this->getDoctrine()->getManager()->getRepository(OperationMinus::class)->find(intval($id));
            // GET UNFORMATTED DATAS
            $unformattedLibelle = $request->get('libelle');
            $unformattedDatetime = $request->get('datetime');
            $unformattedSum = $request->get('sum');
            $unformattedIsDebit = $request->get('isDebit');
            $unformattedAid = $request->get('aid');
            $unformattedCid = $request->get('cid');
        } else {
            return new JsonResponse(
                array(
                    'request' => 'UPDATE_OPERATION',
                    'state' => 'ERROR',
                    'message' => 'Operation type can only be credit or debit !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // PROVIDE ID ERROR
        if ($operation === null) {
            return new JsonResponse(
                array(
                    'request' => 'UPDATE_OPERATION',
                    'state' => 'ERROR',
                    'message' => 'This ID dosn\'nt seems exist !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // FORMAT DATAS
        if ($unformattedLibelle !== "") {
            $libelle = (string)$unformattedLibelle;
        } else {
            $libelle = null;
        }
        if ($unformattedDatetime !== "") {
            $datetime = DateTime::createFromFormat('d-m-Y H:i:s', $unformattedDatetime);
        } else {
            $datetime = null;
        }
        if ($unformattedSum !== "") {
            $sum = (double)$unformattedSum;
        } else {
            $sum = null;
        }
        if ($type === "credit") {
            if ($unformattedIsCredit !== "") {
                $isCredit = $unformattedIsCredit === 'true' ? true : false;
            } else {
                $isCredit = null;
            }
        } else if ($type === "debit") {
            if ($unformattedIsDebit !== "") {
                $isDebit = $unformattedIsDebit === 'true' ? true : false;
            } else {
                $isDebit = null;
            }
        }
        if ($unformattedAid !== "") {
            $account = $this->getDoctrine()->getManager()->getRepository(Account::class)->find(intval($unformattedAid));
        } else {
            $account = null;
        }
        if ($unformattedCid !== "") {
            $category = $this->getDoctrine()->getManager()->getRepository(OperationCategory::class)->find(intval($unformattedCid));
        } else {
            $category = null;
        }

        //UPDATE ENTITY
        if($operation->getLibelle() !== $libelle && $libelle !== null) { $operation->setLibelle($libelle); }
        if($operation->getDatetime() !== $datetime && $datetime !== null) { $operation->setDatetime($datetime); }
        if($operation->getSum() !== $sum && $sum !== null) { $operation->setSum($sum); }
        if ($type === "credit") {
            if($operation->getIsCredit() !==  $isCredit && $isCredit !== null) { $operation->setIsCredit($isCredit); }
        } else if ($type === "debit") {
            if($operation->getIsDebit() !== $isDebit && $isDebit !== null) { $operation->setIsDebit($isDebit); }
        }
        if($operation->getAccount() !== $account && $account !== null) { $operation->setAccount($account); }
        if($operation->getOperationCategory() !== $category && $category !== null) { $operation->setOperationCategory($category); }

        // PERSIST ENTITY
        $this->getDoctrine()->getManager()->persist($operation);
        $this->getDoctrine()->getManager()->flush();

        // PROVIDE MEMORY LEAK
        unset($request);
        unset($type);
        unset($id);
        unset($unformattedLibelle);
        unset($unformattedDatetime);
        unset($unformattedSum);
        unset($unformattedIsCredit);
        unset($unformattedIsDebit);
        unset($unformattedAid);
        unset($unformattedCid);
        unset($libelle);
        unset($datetime);
        unset($sum);
        unset($isCredit);
        unset($isDebit);
        unset($account);
        unset($category);
        unset($operation);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'UPDATE_OPERATION',
                'state' => 'SUCCESS'
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );

    }

    /**
     * @Route("/operations/{type}/{id}/", requirements={"id"="\d+"}, name="delete_operation")
     * @Method("DELETE")
     */
    public function deleteOperation($type, $id)
    {
        // PROVIDE TYPE WRONG VALUE
        if ($type === "credit") {
            // GET ENTITY
            $operation = $this->getDoctrine()->getManager()->getRepository(OperationPlus::class)->find(intval($id));
        } elseif ($type === "debit") {
            // GET ENTITY
            $operation = $this->getDoctrine()->getManager()->getRepository(OperationMinus::class)->find(intval($id));
        } else {
            return new JsonResponse(
                array(
                    'request' => 'DELETE_OPERATION',
                    'state' => 'ERROR',
                    'message' => 'Operation type can only be credit or debit !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // PROVIDE ID ERROR
        if ($operation === null ) {
            return new JsonResponse(
                array(
                    'request' => 'DELETE_OPERATION',
                    'state' => 'ERROR',
                    'message' => 'This ID dosn\'nt seems exist !'
                ),
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'json/html')
            );
        }

        // DELETE ENTITY
        $this->getDoctrine()->getManager()->remove($operation);
        $this->getDoctrine()->getManager()->flush();

        // PROVIDE MEMORY LEAK
        unset($id);
        unset($type);
        unset($operation);

        // RETURN
        return new JsonResponse(
            array(
                'request' => 'DELETE_OPERATION',
                'state' => 'SUCCESS'
            ),
            Response::HTTP_OK,
            array('content-type' => 'json/html')
        );
    }
}

<?php

namespace LS\CalculatorBundle\Controller;


use LS\CalculatorBundle\Util\Calculator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 * @package LS\CalculatorBundle\Controller
 */
class DefaultController extends Controller
{

    /**
     * @Method("POST")
     * @Route("/calc")
     * @param Request $request
     * @return JsonResponse
     */
    public function indexAction(Request $request)
    {
        $request = json_decode($request->getContent(), true);

        if (!array_key_exists('date', $request) || !array_key_exists('hours', $request)) {
            return new JsonResponse("Missing parameters", 409);
        }
        $date = strtotime($request['date']);
        $hours = $request['hours'];
        $calc = new Calculator($date, $hours);
        $calc->treatment();
        return new JsonResponse($calc->getDate());
    }


}

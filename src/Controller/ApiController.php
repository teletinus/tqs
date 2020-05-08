<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

//use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/api", name="api.")
 */
class ApiController extends FOSRestController {

    /**
     * @Rest\Post("/increment", name="increment")
     * @param Request $request
     */
    public function postIncrementAction(Request $request) {
        $webPath = $this->get('kernel')->getProjectDir() . '/public/publicassets/json/';
        $file = 'value.json';
        $content = file_get_contents($webPath . $file);
        $value_array = json_decode($content, true);
        $value_array['value'] ++;

        file_put_contents($webPath . $file, json_encode($value_array));
        $response['status'] = 'ok';
        $response['value'] = $value_array;

        die(json_encode($response));
    }

    /**
     * @Route("/decrement", name="decrement")
     */
    public function postDecrementAction() {
        $webPath = $this->get('kernel')->getProjectDir() . '/public/publicassets/json/';
        $file = 'value.json';
        $content = file_get_contents($webPath . $file);
        $value_array = json_decode($content, true);
        if ($value_array['value'] > 0) {
            $value_array['value'] --;
        }

        file_put_contents($webPath . $file, json_encode($value_array));

        $response['status'] = 'ok';
        $response['value'] = $value_array;

        die(json_encode($response));
    }

}

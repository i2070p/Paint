<?php

namespace MainBundle\Controller;

use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user = $this->getUser();

     /* $user = new User();
        $user->setName($name);
        $user->setPassword("mama");
        $user->setRole("admin");
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
*/
        return $this->render('MainBundle:Default:index.html.twig', array("user" => $user));
    }

    public function accountAction()
    {
        $user = $this->getUser();

        return $this->render('MainBundle:Default:account.html.twig', array("user" => $user));
    }

    public function drawAction()
    {
        $user = $this->getUser();

        return $this->render('MainBundle:Default:draw.html.twig', array("user" => $user));
    }

    public function ajaxTestAction(){
        $request = $this->get('request');
        $img= $request->get('img64');

        $path = "";
        try {
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $path = 'generated_images/'.round(microtime(true) * 1000).".png";

            file_put_contents($path, $data);
        } catch (Exception $e) {
            $this->logger($e->getMessage());
        }

        $response = array("path" => $path);

        return new JsonResponse($response);
    }
}

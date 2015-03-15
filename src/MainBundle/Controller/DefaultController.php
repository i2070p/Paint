<?php

namespace MainBundle\Controller;

use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use MainBundle\Entity\Image;
use MainBundle\Entity\Command;

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

    public function saveImageAction(){
        $request = $this->get('request');
        $img= $request->get('img');

        $isOk= true;

        try {
            //$json = json_decode($img, true);
            $image = new Image();
            $image->setName("img".microtime() * 1000);
            $image->setCreatedAt(new DateTime("Y-m-d"));
            $image->setLastModified(new DateTime("Y-m-d"));
            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();

        } catch (Exception $e) {
            $this->logger($e->getMessage());
            $isOk=false;
        }

        $response = array("success" => $isOk);



        return new JsonResponse($response);
    }
}

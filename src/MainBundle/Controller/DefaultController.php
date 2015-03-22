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
        $user = $this->getUser();        
        $request = $this->get('request');
        $img = $request->get('img');

        $isOk= true;

        try {
            $image = new Image();
            $image->setName("img".microtime() * 1000);
            $image->setCreatedAt(new \DateTime("now"));
            $image->setLastModified(new \DateTime("now"));
            $image->setUserId($user->getId());
            $image->setContent($img);
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

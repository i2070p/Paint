<?php

namespace MainBundle\Controller;

use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use MainBundle\Entity\Image;
use MainBundle\Entity\Command;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function indexAction() {

        $user = $this->getUser();

        return $this->render('MainBundle:Default:index.html.twig', array("user" => $user));
    }

    public function imageListAction() {
        $em = $this->getDoctrine()->getManager();


        $user = $this->getUser();

        $query = $em->createQuery(
                        'SELECT i FROM MainBundle:Image i WHERE i.user_id = :user_id'
                )->setParameter('user_id', $user->getId());

        $images = $query->getResult();

        return $this->render('MainBundle:Default:image_list.html.twig', array("user" => $user, "images" => $images));
    }

    public function accountAction() {
        $user = $this->getUser();

        return $this->render('MainBundle:Default:account.html.twig', array("user" => $user));
    }

    public function drawAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                        'SELECT i FROM MainBundle:Image i WHERE i.id = :image_id'
                )->setParameter('image_id', $request->get("image_id"));

        $image = $query->getResult();

        if ($image) {
            $image = $image[0];
        } else {
            $image = null;
        }
        $user = $this->getUser();

        return $this->render('MainBundle:Default:draw.html.twig', array("user" => $user, "image" => $image));
    }

    public function saveImageAction() {
        $user = $this->getUser();
        $request = $this->get('request');
        $img = $request->get('img');
        $name = $request->get('name');

        if ($name == "default") {
            $name = "img" . microtime() * 1000;
        }
        $isOk = true;

        try {
            $image = new Image();
            $image->setName($name);
            $image->setCreatedAt(new \DateTime("now"));
            $image->setLastModified(new \DateTime("now"));
            $image->setUserId($user->getId());
            $image->setContent($img);
            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();
        } catch (Exception $e) {
            $this->logger($e->getMessage());
            $isOk = false;
        }

        $response = array("success" => $isOk);



        return new JsonResponse($response);
    }

}

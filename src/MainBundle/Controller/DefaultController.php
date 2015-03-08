<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\User;

class DefaultController extends Controller
{
    public function indexAction($name)
    {


        $user = new User();
        $user->setName($name);
        $user->setPassword("mama");
        $user->setRole("admin");
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->render('MainBundle:Default:index.html.twig', array('name' => $name));
    }

    public function showAction()
    {

        return $this->render('MainBundle:Default:show.html.twig');
    }
}

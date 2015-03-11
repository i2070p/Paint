<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\User;

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

        $msg = "user";

        if ($this->get('security.context')->isGranted('ROLE_ADMIN')) {
            $msg = "admin";
        }

        return $this->render('MainBundle:Default:account.html.twig', array("user" => $user));
    }

    public function drawAction()
    {
        $user = $this->getUser();

        return $this->render('MainBundle:Default:draw.html.twig', array("user" => $user));
    }
}

<?php
// src/Acme/AccountBundle/Controller/AccountController.php
namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MainBundle\Form\Type\RegistrationType;
use MainBundle\Form\Model\Registration;
use MainBundle\Entity\User;

class AccountController extends Controller
{
    public function registerAction()
    {
        $registration = new Registration();
        $form = $this->createForm(new RegistrationType(), $registration, array(
            'action' => $this->generateUrl('account_create'),
        ));

        return $this->render(
            'MainBundle:Account:register.html.twig',
            array('form' => $form->createView())
        );
    }

    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new RegistrationType(), new Registration());

        $form->handleRequest($request);

        if ($form->isValid()) {
            $registration = $form->getData();
            $user=$registration->getUser();

            $user->setRole(User::ROLE_USER);
            $user->setPassword(sha1($user->getPassword()));

            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('main_homepage'));
        }

        return $this->render(
            'MainBundle:Account:register.html.twig',
            array('form' => $form->createView())
        );
    }
}
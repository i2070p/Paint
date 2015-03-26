<?php

// src/Acme/AccountBundle/Controller/AccountController.php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MainBundle\Form\Type\RegistrationType;
use MainBundle\Form\Model\Registration;
use MainBundle\Entity\User;
use MainBundle\Entity\Confirm;

class AccountController extends Controller {

    public function registerAction() {
        $registration = new Registration();
        $form = $this->createForm(new RegistrationType(), $registration, array(
            'action' => $this->generateUrl('account_create'),
        ));

        return $this->render(
                        'MainBundle:Account:register.html.twig', array('form' => $form->createView())
        );
    }

    public function confirmAction(Request $request) {
        $em = $this->getDoctrine()->getManager();        
        $token = $request->get("token");

        $query = $em->createQuery(
            'SELECT c FROM MainBundle:Confirm c WHERE c.token = :token'
        )->setParameter('token', $token);
        
        $confirm = $query->getResult()[0];
        
        $query = $em->createQuery(
            'SELECT u FROM MainBundle:User u WHERE u.id = :id'
        )->setParameter('id', $confirm->getUserId());

        $user = $query->getResult()[0];
        
        $user->setActive(1);
        
        $em->persist($user);
        $em->flush();

        return $this->render(
                        'MainBundle:Account:confirm.html.twig', array()
        );
    }

     public function createAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new RegistrationType(), new Registration());

        $form->handleRequest($request);

        if ($form->isValid()) {
            $registration = $form->getData();
            $user = $registration->getUser();

            $user->setRole(User::ROLE_USER);
            $user->setPassword(sha1($user->getPassword()));
            $user->setIsActive(0);
            $em->persist($user);
            $em->flush();
            
            $this->sendConfirmEmail($user);
            
            
            
            
            return $this->redirect($this->generateUrl('main_homepage'));
        }

        return $this->render(
                        'MainBundle:Account:register.html.twig', array('form' => $form->createView())
        );
    }
    
    private function sendConfirmEmail(User $user) {
        $em = $this->getDoctrine()->getManager();
        $product = $user->getPassword()."/".$user->getLastname()."/".microtime(true);
        $token = sha1($product);
        
        $params = array(
            'name' => $user->getUsername(),
            'token' => $token
        );
        
        $confirm = new Confirm();
        $confirm->setToken($token);
        $confirm->setUserId($user->getId());
        $em->persist($confirm);
        $em->flush();
            
        $message = \Swift_Message::newInstance()
                ->setSubject('Confirm your registration.')
                ->setFrom($this->container->getParameter('mailer_user'))
                ->setTo($user->getEmail())
                ->setBody($this->renderView('MainBundle:Emails:confirm.html.twig', $params), 'text/html')
        ;
        $this->get('mailer')->send($message);
    }

}

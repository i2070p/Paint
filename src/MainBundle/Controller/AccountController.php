<?php

// src/Acme/AccountBundle/Controller/AccountController.php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MainBundle\Form\Type\RegistrationType;
use MainBundle\Form\Model\Registration;
use MainBundle\Entity\User;
use MainBundle\Entity\Confirmation;
use MainBundle\Form\Type\ResetPasswordType;
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
                        'SELECT c FROM MainBundle:Confirmation c WHERE c.token = :token'
                )->setParameter('token', $token);

        $confirm = $query->getResult();
        if ($confirm) {
            $confirm = $confirm[0];
            if ($confirm->getType() == 'confirm_reg') {
                $query = $em->createQuery(
                                'SELECT u FROM MainBundle:User u WHERE u.id = :id'
                        )->setParameter('id', $confirm->getUserId());

                $user = $query->getResult()[0];

                $user->setEnabled(1);

                $em->persist($user);
                $em->flush();
                $confirm->setUsed(1);
                $em->persist($confirm);
                $em->flush();
                return $this->render(
                                'MainBundle:Account:confirm.html.twig', array()
                );
            }
        }
        return $this->redirect($this->generateUrl('main_homepage'));
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
            $user->setEnabled(0);
            $em->persist($user);
            $em->flush();

            $this->sendConfirmEmail($user);

            return $this->render(
                            'MainBundle:Account:notice.html.twig', array('title' => "Account has been created!", "text" => "Check your email.")
            );
        }

        return $this->render(
                        'MainBundle:Account:register.html.twig', array('form' => $form->createView())
        );
    }

    private function sendConfirmEmail(User $user) {
        $em = $this->getDoctrine()->getManager();
        $product = $user->getPassword() . "/" . $user->getLastname() . "/" . microtime(true);
        $token = sha1($product);

        $params = array(
            'name' => $user->getUsername(),
            'token' => $token
        );

        $confirm = new Confirmation();
        $confirm->setToken($token);
        $confirm->setUserId($user->getId());
        $confirm->setUsed(0);
        $confirm->setType("confirm_reg");
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

    public function resetPasswordAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $token = $request->get("token");

        $query = $em->createQuery(
                        'SELECT c FROM MainBundle:Confirmation c WHERE c.token = :token'
                )->setParameter('token', $token);

        $confirm = $query->getResult();

        if ($confirm) {
            $confirm = $confirm[0];
            if ($confirm->getUsed() == 0 && $confirm->getType() == "confirm_reset_pw") {

                $query = $em->createQuery(
                                'SELECT u FROM MainBundle:User u WHERE u.id = :id'
                        )->setParameter('id', $confirm->getUserId());

                $user = $query->getResult()[0];
                $newPw = substr(hash('sha512', rand()), 0, 12);
                $user->setPassword(sha1($newPw));

                $em->persist($user);
                $em->flush();
                $confirm->setUsed(1);
                $em->persist($confirm);
                $em->flush();

                $params = array(
                    "password" => $newPw,
                    "name" => $user->getUsername()
                );

                $message = \Swift_Message::newInstance()
                        ->setSubject('Password reset')
                        ->setFrom($this->container->getParameter('mailer_user'))
                        ->setTo($user->getEmail())
                        ->setBody($this->renderView('MainBundle:Emails:new_password.html.twig', $params), 'text/html')
                ;

                $this->get('mailer')->send($message);

                return $this->render(
                                'MainBundle:Account:notice.html.twig', array('title' => "Password has been reset!", "text" => "Please log in.")
                );
            }
        }

        return $this->redirect($this->generateUrl('main_homepage'));
    }

    public function resetPasswordRequestFormAction(Request $request) {

        $form = $this->createForm(new ResetPasswordType(), array(
            'action' => $this->generateUrl('account_password_reset_request'),
        ));

        return $this->render(
                        'MainBundle:Account:reset_password.html.twig', array('form' => $form->createView())
        );
    }

    public function resetPasswordRequestAction(Request $request) {
        
        $em = $this->getDoctrine()->getManager();
        $email = $this->getRequest()->request->get('resetpassword')['email'];
        $user = null;
        $query = $em->createQuery(
                        'SELECT u FROM MainBundle:User u WHERE u.email = :email'
                )->setParameter('email', $email);

        $user = $query->getResult();

        if ($user) {
            $user = $user[0];
            $product = $user->getPassword() . "/" . $user->getLastname() . "/" . microtime(true);
            $token = sha1($product);

            $params = array(
                'name' => $user->getUsername(),
                'token' => $token
            );

            $confirm = new Confirmation();
            $confirm->setToken($token);
            $confirm->setUserId($user->getId());
            $confirm->setUsed(0);
            $confirm->setType("confirm_reset_pw");
            $em->persist($confirm);
            $em->flush();

            $message = \Swift_Message::newInstance()
                    ->setSubject('Password reset')
                    ->setFrom($this->container->getParameter('mailer_user'))
                    ->setTo($user->getEmail())
                    ->setBody($this->renderView('MainBundle:Emails:password_reset.html.twig', $params), 'text/html')
            ;
            $this->get('mailer')->send($message);

            return $this->render(
                            'MainBundle:Account:notice.html.twig', array('title' => "Email has been sent to $email!", "text" => "Please confirm your request.")
            );
        } else {
            return $this->render(
                            'MainBundle:Account:notice.html.twig', array('title' => "User with email: $email doesn't exist.", "text" => "")
            );
        }
    }

}

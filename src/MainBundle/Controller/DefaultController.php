<?php

namespace MainBundle\Controller;

use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use MainBundle\Entity\Image;
use MainBundle\Entity\Command;
use Symfony\Component\HttpFoundation\Request;
use MainBundle\Entity\Comment;
use MainBundle\Form\Type\CommentType;
use Symfony\Component\Validator\Constraints\DateTime;

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

    public function publicSpaceAction() {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $query = $em->createQuery(
                        'SELECT i FROM MainBundle:Image i WHERE i.public = :pub'
                )->setParameter('pub', 1);

        $images = $query->getResult();

        return $this->render('MainBundle:Default:public_image.html.twig', array("user" => $user, "images" => $images));
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
        $public = $request->get('public');

        if ($public == "false") {
            $public = 0;
        } else {
            $public = 1;
        }

        $thumbnail = $request->get('thumb');
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
            $image->setPublic($public);
            $image->setThumbnail($thumbnail);
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

    public function commentsAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new CommentType());
        $id = $request->get("id");

        $form->handleRequest($request);

        if ($form->isValid()) {
            $comment = new Comment();
            $date = new \DateTime('now');
            $data = $form->getData();
            $comment->setAuthor($data['Author']);
            $comment->setContent($data['Content']);
            $comment->setImageId($id);
            $comment->setDate($date);

            $em->persist($comment);
            $em->flush();
        }

        $query = $em->createQuery(
                        'SELECT c FROM MainBundle:Comment c WHERE c.image_id = :id'
                )->setParameter('id', $id);

        $comments = $query->getResult();


        $query = $em->createQuery(
                        'SELECT c FROM MainBundle:Image c WHERE c.id = :id'
                )->setParameter('id', $id);
        $image = $query->getResult();
        $image = $image[0];
        return $this->render(
                        'MainBundle:Default:comments.html.twig', array('form' => $form->createView(), 'comments' => $comments, "image" => $image)
        );
    }

}

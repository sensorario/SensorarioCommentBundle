<?php

namespace Sensorario\CommentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Sensorario\CommentBundle\Entity\Comment;
use Sensorario\CommentBundle\Form\CommentType;

class AjaxController extends Controller
{
    /**
     * This method create new comment and return a response. This method has no
     * output.
     * 
     * @Route("/sensorario/comment/create/{unique_id}", name="sensorario_comment_create")
     */
    public function createAction($unique_id)
    {
        $user = $this // Get the username of current user
                ->get('security.context')
                ->getToken()
                ->getUser();

        $doctrine = $this->getDoctrine();

        $entityManager = $doctrine->getEntityManager();

        $commento = new Comment;
        $commento->setAuthor($user->getUsername());
        $commento->setCreationDate(new \DateTime());
        $commento->setUniqueId($unique_id);

        $form = $this->createForm(new CommentType(), $commento);
        $form->bindRequest($this->getRequest());

        if ($form->isValid()) {
            $entityManager->persist($commento);
            $entityManager->flush();
        }

        return new Response();
    }

    /**
     * This method delete a comment and redirect user.
     * 
     * @Route("/sensorario/comment/delete/{unique_id}", name="sensorario_comment_delete")
     */
    public function deleteAction($unique_id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('SensorarioCommentBundle:Comment')
                ->find($unique_id);
        $em->remove($entity);
        $em->flush();

        return new Response();
    }

}

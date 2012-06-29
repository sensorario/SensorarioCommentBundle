<?php

namespace Sensorario\CommentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Sensorario\CommentBundle\Entity\Comment;
use Sensorario\CommentBundle\Form\CommentType;

class DefaultController extends Controller
{
    /**
     * @Route("/sensorario/comments/comments/{unique_id}", name="sensorario_comments_comments")
     * @Template()
     */
    public function commentsAction($unique_id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('SensorarioCommentBundle:Comment')
                ->findOrderedFromlastToFirst($unique_id);

        return array(
            'unique_id' => $unique_id,
            'comments' => $entity
        );
    }

    /**
     * @Route("/sensorario/comment/delete/{unique_id}", name="sensorario_comment_delete")
     * @Template()
     */
    public function deleteAction($unique_id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('SensorarioCommentBundle:Comment')
                ->find($unique_id);
        $em->remove($entity);
        $em->flush();

        $url = $this->generateUrl('sensorario_comments_index', array(
            'unique_id' => $unique_id)
        );

        return $this->redirect($url);
    }

    /**
     * @Route("/sensorario/comments/{unique_id}", name="sensorario_comments_index")
     * @Template()
     */
    public function indexAction($unique_id)
    {
        return array(
            'unique_id' => $unique_id,
        );
    }

    /**
     * @Route("/sensorario/template/{unique_id}", name="sensorario_comments_template")
     * @Template()
     */
    public function newAction($unique_id)
    {
        $entity = new Comment();
        $form = $this->createForm(new CommentType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
            'unique_id' => $unique_id,
        );
    }

    /**
     * @Route("/sensorario/comment/create/{unique_id}", name="sensorario_comment_create")
     * @Template()
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

        return $this->forward('SensorarioCommentBundle:Default:index', array(
                    'unique_id' => $unique_id,
                ));
    }

}

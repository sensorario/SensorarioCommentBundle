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
     * @Route("/sensorario/comments/comments/{id}", name="sensorario_comments_comments")
     * @Template()
     */
    public function commentsAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('SensorarioCommentBundle:Comment')
                ->findOrderedFromlastToFirst();

        return array(
            'id' => $id,
            'comments' => $entity
        );
    }

    /**
     * @Route("/sensorario/comment/delete/{id}", name="sensorario_comment_delete")
     * @Template()
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('SensorarioCommentBundle:Comment')
                ->find($id);
        $em->remove($entity);
        $em->flush();

        $url = $this->generateUrl('sensorario_comments_index', array(
            'id' => $id)
        );

        return $this->redirect($url);
    }

    /**
     * @Route("/sensorario/comments/{id}", name="sensorario_comments_index")
     * @Template()
     */
    public function indexAction($id)
    {
        return array(
            'id' => $id,
        );
    }

    /**
     * @Route("/sensorario/template/{id}", name="sensorario_comments_template")
     * @Template()
     */
    public function templateAction($id)
    {

        $entity = new Comment();
        $form = $this->createForm(new CommentType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
            'id' => $id,
        );
    }

    /**
     * @Route("/sensorario/comment/create/{id}", name="sensorario_comment_create")
     * @Template()
     */
    public function createAction($id)
    {
        $commento = new Comment;

        $commento->setTitle($this->getRequest()->get('title'));
        $commento->setAuthor('Guest');
        $commento->setComment($this->getRequest()->get('comment'));
        $commento->setCreationDate(new \DateTime());

        $em = $this->getDoctrine()->getEntityManager();

        $em->persist($commento);
        $em->flush();

        return $this->forward('SensorarioCommentBundle:Default:index', array(
                    'id' => $id,
                ));
    }

}

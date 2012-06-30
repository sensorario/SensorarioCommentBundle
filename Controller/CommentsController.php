<?php

namespace Sensorario\CommentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Sensorario\CommentBundle\Entity\Comment;
use Sensorario\CommentBundle\Form\CommentType;

class CommentsController extends Controller
{
    /**
     * This method show all comments of a particulare unique_id.
     * 
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

}

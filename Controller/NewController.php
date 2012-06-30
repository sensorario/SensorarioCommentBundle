<?php

namespace Sensorario\CommentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Sensorario\CommentBundle\Entity\Comment;
use Sensorario\CommentBundle\Form\CommentType;

class NewController extends Controller
{
    /**
     * This method show a form to create a new comment.
     * 
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

}

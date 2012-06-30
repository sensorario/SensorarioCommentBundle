<?php

namespace Sensorario\CommentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Sensorario\CommentBundle\Entity\Comment;
use Sensorario\CommentBundle\Form\CommentType;

class IndexController extends Controller
{
    /**
     * This method load all javascripts.
     * 
     * @Route("/sensorario/comments/{unique_id}", name="sensorario_comments_index")
     * @Template()
     */
    public function indexAction($unique_id)
    {
        return array(
            'unique_id' => $unique_id,
        );
    }

}

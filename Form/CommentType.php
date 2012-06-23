<?php

namespace Sensorario\CommentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('author')
            ->add('title')
            ->add('comment')
        ;
    }

    public function getName()
    {
        return 'sensorario_commentbundle_commenttype';
    }
}

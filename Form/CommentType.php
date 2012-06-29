<?php

namespace Sensorario\CommentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('comment', 'text', array(
                'required' => true
            ))
        ;
    }

    public function getName()
    {
        return 'sensorario_commentbundle_commenttype';
    }
}

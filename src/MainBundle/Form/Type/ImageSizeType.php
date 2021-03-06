<?php

namespace MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ImageSizeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('width', 'text');
        $builder->add('height', 'text');
        $builder->add('draw', 'submit');
    }

    public function getName()
    {
        return 'size';
    }
}
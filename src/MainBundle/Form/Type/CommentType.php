<?php

namespace MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CommentType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('Author', 'text');
        $builder->add('Content', 'textarea');          
        $builder->add('Comment', 'submit');
    }

    public function getName() {
        return 'comment';
    }

}

<?php

namespace MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ResetPasswordType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('email', 'email');
        $builder->add('Send request', 'submit');       
    }

    public function getName() {
        return 'resetpassword';
    }

}

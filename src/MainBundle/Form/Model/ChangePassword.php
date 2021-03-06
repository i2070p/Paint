<?php

namespace MainBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Registration
{
    /**
     * @Assert\Type(type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $new_password;

    public function setNewPassword($new_password)
    {
        $this->new_password = $new_password;
    }

    public function getNewPassword()
    {
        return $this->new_password;
    }
}
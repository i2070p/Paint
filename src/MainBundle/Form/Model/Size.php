<?php

namespace MainBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Size {

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    protected $width;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    protected $height;

    public function setWidth($width) {
        $this->width = $width;
    }

    public function getWidth() {
        return $this->width;
    }

    public function setHeight($height) {
        $this->height = $height;
    }

    public function getHeight() {
        return $this->height;
    }

}

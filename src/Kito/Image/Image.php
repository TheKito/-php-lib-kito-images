<?php

namespace Kito\Image;

use Imagick;

class Image
{
    private $image;

    public function __construct(Imagick $image)
    {
        $this->image = $image;
    }


    public function trim(): Image
    {
        $_ = clone $this->image;
        $_->trimImage(0);
        return new Image($_);
    }

}

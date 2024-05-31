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


}

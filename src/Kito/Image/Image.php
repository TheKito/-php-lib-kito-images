<?php

namespace Kito\Image;

use \Imagick;

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

    public function scale(int $width, int $height): Image
    {
        $_ = clone  $this->image;
        $_->scaleImage($width, $height);
        return new Image($_);
    }
    public function monochrome(): Image
    {
        $_ = clone  $this->image;
        return new Image($_->fxImage('intensity'));
    }
    public function solidBackground(string $color = 'transparent'): Image
    {
        $_ = ImageFactory::create($this->image->getImageWidth(), $this->image->getImageHeight(), $color);
         
        $_->image->compositeImage (
            $this->image,
            Imagick::COMPOSITE_DISSOLVE,
            0,
            0
        );
        
        return $_;
    }
}

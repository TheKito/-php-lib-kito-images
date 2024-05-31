<?php

namespace Kito\Image;

use Imagick;
use ImagickPixel;

class ImageFactory
{
    public static function create(int $imageWidth, int $imageHeight, string $bgColor = 'transparent', string $format = 'png'): Image
    {
        $_ = new Imagick();
        $_->newImage($imageWidth, $imageHeight, new ImagickPixel($bgColor));
        $_->setImageFormat($format);
        return new Image($_);
    }

    public function fromFile(string $path): Image
    {
        return new Image(new \Imagick($path));
    }

}

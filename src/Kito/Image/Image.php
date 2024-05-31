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

        $_->image->compositeImage(
            $this->image,
            Imagick::COMPOSITE_DISSOLVE,
            0,
            0
        );

        return $_;
    }
    public function safeArea(): Image
    {
        $imageWidth = $this->image->getImageWidth();
        $imageHeight =  $this->image->getImageHeight();

        $_ = ImageFactory::create($imageWidth / 7 * 10, $imageHeight / 7 * 10);

        $_->image->compositeImage(
            $this->image,
            Imagick::COMPOSITE_DISSOLVE,
            ($_->image->getImageWidth() -  $this->image->getImageWidth()) / 2,
            ($_->image->getImageHeight() - $this->image->getImageHeight()) / 2
        );

        return $_;
    }
    public function square(): Image
    {
        $imageWidth =  $this->image->getImageWidth();
        $imageHeight =  $this->image->getImageHeight();
        $imageWH = $imageWidth;
        $imageDiff = abs($imageWidth - $imageHeight);

        if ($imageHeight > $imageWH) {
            $imageWH = $imageHeight;
        }

        $imageWH = $imageWH + $imageDiff / 2;

        $_ = ImageFactory::create($imageWH, $imageWH);
        $_->image->compositeImage(
            $this->image,
            Imagick::COMPOSITE_DISSOLVE,
            ($_->image->getImageWidth() -  $this->image->getImageWidth()) / 2,
            ($_->image->getImageHeight() -  $this->image->getImageHeight()) / 2
        );

        return $_;
    }

}

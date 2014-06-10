<?php

namespace JuiceLib\Color;

class CMYK implements Color
{
    private $c;
    private $m;
    private $y;
    private $k;

    public function __construct($c, $m, $y, $k)
    {
        $this->c = (int)$c;
        $this->m = (int)$m;
        $this->y = (int)$y;
        $this->k = (int)$k;
    }

    public function getC()
    {
        return $this->c;
    }

    public function getM()
    {
        return $this->m;
    }

    public function getY()
    {
        return $this->y;
    }

    public function getK()
    {
        return $this->k;
    }

    public function toCMYK()
    {
        return $this;
    }

    public function toHSL()
    {
        return $this->toRGB()->toHSL();
    }

    public function toHSV()
    {
        return $this->toRGB()->toHSV();
    }

    public function toHex()
    {
        return $this->toRGB()->toHex();
    }

    public function toRGB()
    {
        $k = $this->k / 100;

        $c = $this->c / 100;
        $m = $this->m / 100;
        $y = $this->y / 100;

        $r = 255 * (1 - $c) * (1 - $k);
        $g = 255 * (1 - $m) * (1 - $k);
        $b = 255 * (1 - $y) * (1 - $k);

        return new RGB($r, $g, $b);
    }

    function __toString()
    {
        return sprintf("CMYK[%s, %s, %s, %s]", $this->getC(), $this->getM(), $this->getY(), $this->getK());
    }


}
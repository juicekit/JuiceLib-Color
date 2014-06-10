<?php

namespace JuiceLib\Color;

class HSL implements Color
{
    private $h;
    private $s;
    private $l;

    public function __construct($h, $s, $l)
    {
        $this->h = (int)$h;
        $this->s = (int)$s;
        $this->l = (int)$l;
    }

    public function getH()
    {
        return $this->h;
    }

    public function getS()
    {
        return $this->s;
    }

    public function getL()
    {
        return $this->l;
    }

    public function toCMYK()
    {
        return $this->toRGB()->toCMYK();
    }

    public function toHSL()
    {
        return $this;
    }

    public function toHSV()
    {
        return $this->toRGB()->toHSV();
    }

    public function toHex()
    {
        return $this->toRGB()->toHex();
    }

    private function hueToRgb($p, $q, $h)
    {
        if ($h < 0)
            $h += 1;
        else if ($h > 1)
            $h -= 1;

        if (($h * 6) < 1)
            return $p + ($q - $p) * $h * 6;
        else if (($h * 2) < 1)
            return $q;
        else if (($h * 3) < 2)
            return $p + ($q - $p) * ((2 / 3) - $h) * 6;
        else
            return $p;
    }

    public function toRGB()
    {
        $h = $this->h / 360;
        $s = $this->s / 100;
        $l = $this->l / 100;

        if ($l <= 0.5) {
            $q = $l * (1 + $s);
        } else {
            $q = $l + $s - ($l * $s);
        }

        $p = 2 * $l - $q;
        $tr = $h + (1 / 3);
        $tg = $h;
        $tb = $h - (1 / 3);

        $r = (int)($this->hueToRgb($p, $q, $tr) * 255);
        $g = (int)($this->hueToRgb($p, $q, $tg) * 255);
        $b = (int)($this->hueToRgb($p, $q, $tb) * 255);

        return new RGB($r, $g, $b);
    }

    function __toString()
    {
        return sprintf("HSL[%s, %s, %s]", $this->getH(), $this->getS(), $this->getL());
    }


}

<?php

namespace JuiceLib\Color;

class HSV implements Color
{
    private $h;
    private $s;
    private $v;

    public function __construct($h, $s, $v)
    {
        $this->h = (int)$h;
        $this->s = (int)$s;
        $this->v = (int)$v;
    }

    public function getH()
    {
        return $this->h;
    }

    public function getS()
    {
        return $this->s;
    }

    public function getV()
    {
        return $this->v;
    }

    public function toCMYK()
    {
        return $this->toRGB()->toCMYK();
    }

    public function toHSL()
    {
        return $this->toRGB()->toHSL();
    }

    public function toHSV()
    {
        return $this;
    }

    public function toHex()
    {
        return $this->toRGB()->toHex();
    }

    public function toRGB()
    {

        $h = $this->h / 360;
        $s = $this->s / 100;
        $v = $this->v / 100;

        if ($s == 0) {
            return new RGB($v * 255, $v * 255, $v * 255);
        }

        $h *= 6;

        $i = (int)$h;

        $m = $v * (1 - $s);
        $n = $v * (1 - $s * ($h - $i));
        $o = $v * (1 - $s * (1 - ($h - $i)));

        switch ($i) {
            case 0:
                $r = $v;
                $g = $o;
                $b = $m;
                break;
            case 1:
                $r = $n;
                $g = $v;
                $b = $m;
                break;
            case 2:
                $r = $m;
                $g = $v;
                $b = $o;
                break;
            case 3:
                $r = $m;
                $g = $n;
                $b = $v;
                break;
            case 4:
                $r = $o;
                $g = $m;
                $b = $v;
                break;
            default:
                $r = $v;
                $g = $m;
                $b = $n;
        }

        $r = (int)($r * 255);
        $g = (int)($g * 255);
        $b = (int)($b * 255);

        return new RGB($r, $g, $b);
    }

    function __toString()
    {
        return sprintf("HSV[%s, %s, %s]", $this->getH(), $this->getS(), $this->getV());
    }


}
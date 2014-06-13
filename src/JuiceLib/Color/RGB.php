<?php

namespace JuiceLib\Color;

class RGB implements Color
{
    private $r;
    private $g;
    private $b;

    public function __construct($r, $g, $b)
    {
        if (($r < 0 || $g < 0 || $b < 0) || ($r > 255 || $g > 255 || $b > 255)) {
            throw new \Exception("RGB values range from 0 to 255");
        }

        $this->r = (int)$r;
        $this->g = (int)$g;
        $this->b = (int)$b;

    }

    public function getR()
    {
        return $this->r;
    }

    public function getG()
    {
        return $this->g;
    }

    public function getB()
    {
        return $this->b;
    }

    public function toCMYK()
    {
        $c = 1 - ($this->r / 255);
        $m = 1 - ($this->g / 255);
        $y = 1 - ($this->b / 255);

        $k = \max(array($c, $m, $y));

        $cyan = 100 * ($c - $k) / (1 - $k);
        $magenta = 100 * ($m - $k) / (1 - $k);
        $yellow = 100 * ($y - $k) / (1 - $k);
        $black = 100 * $k;

        return new CMYK($cyan, $magenta, $yellow, $black);
    }

    public function toHSL()
    {
        $r = $this->r / 255;
        $g = $this->g / 255;
        $b = $this->b / 255;

        $min = \min(array($r, $g, $b));
        $max = \max(array($r, $g, $b));

        $x = $max - $min;
        $sum = $max + $min;

        $h = 0;

        switch ($max) {
            case $r:
                $h = ((60 * ($g - $b) / $x) + 360) % 360;
                break;
            case $g;
                $h = (60 * ($b - $r) / $x) + 120;
                break;
            case $b:
                $h = (60 * ($r - $g) / $x) + 240;
                break;
        }

        $l = $sum / 2;

        if ($l == 0) {
            $s = 0;
        } else if ($l == 1) {
            $s = 1;
        } else if ($l <= 0.5) {
            $s = $x / $sum;
        } else {
            $s = $x / (2 - $sum);
        }

        return new HSL($h, $s * 100, $l * 100);
    }

    public function toHSV()
    {
        $r = $this->r / 255;
        $g = $this->g / 255;
        $b = $this->b / 255;

        $max = \max(array($r, $g, $b));
        $min = \min(array($r, $g, $b));

        $v = $max;
        $delta = $max - $min;

        if ($max != 0) {
            $s = $delta / $max;
        } else {
            return null;
        }

        if ($r == $max) {
            $h = ($g - $b) / $delta;
        } else if ($g == $max) {
            $h = 2 + ($b - $r) / $delta;
        } else {
            $h = 4 + ($r - $g) / $delta;
        }

        $h *= 60;

        if ($h < 0) {
            $h += 360;
        }


        return new HSV($h, $s * 100, $v * 100);
    }

    public function toHex()
    {
        $r = base_convert($this->r, 10, 16);
        $g = base_convert($this->g, 10, 16);
        $b = base_convert($this->b, 10, 16);


        $hex = strlen($r) < 2 ? "0" . $r : $r;
        $hex .= strlen($g) < 2 ? "0" . $g : $g;
        $hex .= strlen($b) < 2 ? "0" . $b : $b;

        return new Hex(base_convert($hex, 16, 10));
    }

    public function toRGB()
    {
        return $this;
    }

    function __toString()
    {
        return sprintf("RGB[%s, %s, %s]", $this->getR(), $this->getG(), $this->getB());
    }
}
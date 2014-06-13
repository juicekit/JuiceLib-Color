<?php

namespace JuiceLib\Color;

class Hex implements Color
{
    private $hex;

    public function __construct($color)
    {
        if (\is_int($color)) {
            if ($color > 16777216 || $color < 0) {
                throw new \Exception("Invalid color range.");
            }
            $this->hex = $color;
        } else if ($color[0] == "#") {
            $color = \substr($color, 1, \strlen($color) - 1);
        }

        if (\strlen($color) != 3 && \strlen($color) != 6) {
            throw new \Exception("Hex color length is either 3 or 6.");
        } else if (\strlen($color) == 3) {
            $color = \sprintf("%s%s%s", $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
        }

        $this->hex = base_convert($color, 16, 10);
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
        return $this->toRGB()->toHSV();
    }

    public function toHex()
    {
        return $this;
    }

    public function toRGB()
    {
        $hex = $this->hex;

        $r = $hex % 256;
        $g = $hex / 256 % 256;
        $b = $hex / 65536 % 256;

        return new RGB($r, $g, $b);
    }

    function __toString()
    {
        return sprintf("#%s", $this->hex);
    }


}

<?php

namespace JuiceLib\Color;

class Hex implements Color
{
    private $hex;

    public function __construct($color)
    {

        if (\is_int($color)) {
            throw new \Exception("Unimplemented method.");
        } elseif ($color[0] == "#") {
            $color = \substr($color, 1, \strlen($color) - 1);
        }

        if (\strlen($color) != 3 && \strlen($color) != 6) {
            throw new \Exception("Hex color length is either 3 or 6.");
        }

        if (\strlen($color) == 3) {
            $color = \sprintf("%s%s%s", $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
        }

        $this->hex = $color;
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

        $r = \base_convert(\substr($hex, 0, 2), 16, 10);
        $g = \base_convert(\substr($hex, 2, 2), 16, 10);
        $b = \base_convert(\substr($hex, 4, 2), 16, 10);

        return new RGB($r, $g, $b);
    }

    function __toString()
    {
        return sprintf("#%s", $this->hex);
    }


}

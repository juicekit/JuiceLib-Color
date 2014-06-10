<?php

namespace JuiceLib\Color;

interface Color
{
    public function toRGB();

    public function toHex();

    public function toCMYK();

    public function toHSV();

    public function toHSL();
}
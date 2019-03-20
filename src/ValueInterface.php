<?php

namespace FocalStrategy\Core;

use FocalStrategy\Core\Renderable;

interface ValueInterface extends Renderable
{
    public function value();
    public function render();
    public function getAttributes() : array;
}

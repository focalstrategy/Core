<?php

namespace FocalStrategy\Core\Buttons;

use FocalStrategy\Core\BaseBtnType;

class ImageButton extends Button
{
    protected $img_url;

    public function __construct($img_url, $route)
    {
        parent::__construct('', $route, BaseBtnType::NONE());
        $this->img_url = $img_url;
    }

    public function render()
    {
        return view('core::image_button')->with('button', $this);
    }

    public function getImage()
    {
        return $this->img_url;
    }
}

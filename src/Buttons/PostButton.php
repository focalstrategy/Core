<?php

namespace FocalStrategy\Core\Buttons;

use FocalStrategy\Core\BaseBtnType;

class PostButton extends Button
{
    protected $data;

    public function __construct($text, $action, $data, BaseBtnType $btn_type)
    {
        parent::__construct($text, $action, $btn_type);
        $this->data = $data;
    }

    public function render()
    {
        return view('_components.post_button')->with('button', $this);
    }

    public function data()
    {
        return $this->data;
    }
}

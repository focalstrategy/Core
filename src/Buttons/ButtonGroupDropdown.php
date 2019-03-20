<?php

namespace FocalStrategy\Core\Buttons;

use FocalStrategy\Core\BaseBtnType;
use View;

class ButtonGroupDropdown implements Renderable
{
    protected $text;
    protected $action_type;
    protected $attributes = [
        'class' => 'btn '
    ];

    public function __construct($text, $url, BaseBtnType $action_type, $buttons)
    {
        $this->text = $text;

        if ($url != null) {
            $this->attributes['href'] = $url;
        }

        $this->attributes['class'] .= $action_type;
        $this->buttons = $buttons;
    }

    public function mergeAttributes(array $attributes)
    {
        foreach ($attributes as $key => $a) {
            if (isset($this->attributes[$key])) {
                $this->attributes[$key] .= ' '.$a;
            } else {
                $this->attributes[$key] = $a;
            }
        }
    }

    public function getText()
    {
        return $this->text;
    }

    public function isButton()
    {
        return !isset($this->attributes['href']);
    }

    public function getRoute()
    {
        return $this->attributes['href'] ?? '';
    }

    public function attributes()
    {
        $result = '';
        foreach ($this->attributes as $key => $attr) {
            $result .= ' '.$key.'="'.$attr.'"';
        }

        return $result;
    }

    public function setTarget($target)
    {
        $this->attributes['target'] = $target;
    }

    public function render()
    {
        return view('core::button_group_dropdown')->with('button', $this);
    }
}

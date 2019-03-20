<?php

namespace FocalStrategy\Core\Buttons;

use FocalStrategy\Core\ReceivesData;
use FocalStrategy\Core\BaseBtnType;
use FocalStrategy\Core\Renderable;
use View;

class Button implements Renderable, ReceivesData
{
    protected $text;
    protected $icon;
    protected $action_type;
    protected $url_template;
    protected $data_attributes = [];
    protected $attributes = [
        'class' => 'btn '
    ];

    public function __construct($text, $url, BaseBtnType $action_type)
    {
        $this->text = $text;

        if ($url != null) {
            $this->attributes['href'] = $url;
        }

        $this->attributes['class'] .= $action_type;
    }

    public function addDataAttributes(array $data_attributes) : Button
    {
        $this->data_attributes = $data_attributes;
        return $this;
    }

    public function mergeAttributes(array $attributes) : Button
    {
        foreach ($attributes as $key => $a) {
            if (isset($this->attributes[$key])) {
                $this->attributes[$key] .= ' '.$a;
            } else {
                $this->attributes[$key] = $a;
            }
        }

        return $this;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function setIcon(string $icon)
    {
        $this->icon = $icon;
    }

    public function getText() : string
    {
        return $this->text;
    }

    public function isButton() : bool
    {
        return !isset($this->attributes['href']);
    }

    public function getRoute() : string
    {
        return $this->attributes['href'] ?? '';
    }

    public function attributes() : string
    {
        $result = '';
        foreach ($this->attributes as $key => $attr) {
            $result .= ' '.$key.'="'.$attr.'"';
        }

        return $result;
    }

    public function getDataAttributes() : string
    {
        $result = '';
        foreach ($this->data_attributes as $key => $attr) {
            $result .= ' '.$key.'="'.$attr.'"';
        }

        return $result;
    }

    public function setTarget($target) : Button
    {
        $this->attributes['target'] = $target;

        return $this;
    }

    public function setUrlTemplate(string $template) : Button
    {
        $this->url_template = $template;

        return $this;
    }

    public function addData(array $data)
    {
        if ($this->url_template) {
            $url = $this->url_template;
            foreach ($data as $key => $value) {
                $url = str_replace('+'.$key.'+', $value, $url);
                $url = str_replace('%2B'.$key.'%2B', $value, $url);
            }
            $this->attributes['href'] = $url;
        }

        if ($this->text) {
            $text = $this->text;
            foreach ($data as $key => $value) {
                if (!is_array($value)) {
                    $text = str_replace('+'.$key.'+', $value, $text);
                    $text = str_replace('%2B'.$key.'%2B', $value, $text);
                }
            }
            $this->text = $text;
        }
    }

    public function hasAttribute($key)
    {
        return isset($this->attributes[$key]);
    }

    public function render()
    {
        return view('core::button')->with('button', $this);
    }
}

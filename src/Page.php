<?php

namespace FocalStrategy\Core;

use FocalStrategy\Core\Renderable as RenderableComponent;
use FocalStrategy\Core\BaseBtnType;
use FocalStrategy\Core\Buttons\Button;
use FocalStrategy\Core\DatatableInterface;
use Illuminate\Contracts\Support\Renderable;
use View;

class Page implements Renderable
{
    protected $html_page_title;
    protected $page_title;
    protected $page_sub_title;
    protected $hide_side_bar = false;
    protected $view;
    protected $data_table;
    protected $with = [];
    protected $breadcrumbs = [];
    protected $renderables = [];

    protected $non_view_object = false;

    public function __construct()
    {
    }

    public function setPageTitle($html_page_title)
    {
        $this->html_page_title = $html_page_title;

        return $this;
    }

    public function setTitle($page_title)
    {
        $this->page_title = $page_title;

        return $this;
    }

    public function setSubTitle($page_sub_title)
    {
        $this->page_sub_title = $page_sub_title;

        return $this;
    }

    public function setHideSideBar($hide_side_bar)
    {
        $this->hide_side_bar = $hide_side_bar;
    }

    public function addButton($text, $route, BaseBtnType $type)
    {
        $this->addRenderable(new Button($text, $route, $type));
    }

    public function addRenderable(RenderableComponent $renderable)
    {
        $this->renderables[] = $renderable;
    }

    public function withTable(DatatableInterface $data_table)
    {
        $this->data_table = $data_table;
    }

    public function view($view, array $withs = [])
    {
        $this->view = $view;
        $this->with($withs);

        return $this;
    }

    public function breadcrumb(string $text, string $link = '')
    {
        $this->breadcrumbs[] = [$link, $text];
    }

    public function withArray(array $data)
    {
        $this->with = array_merge($this->with, $data);

        return $this;
    }

    public function withNamed($key, $value)
    {
        $this->with[$key] = $value;

        return $this;
    }

    public function validate()
    {
        if (!isset($this->with['dev_errors'])) {
            $this->with['dev_errors'] = [];
        }

        if (!View::exists($this->view)) {
            $this->with['dev_errors'][] = 'View "'.$this->view.'" does not exist';
        }

        if (count($this->breadcrumbs) == 0) {
            $this->with['dev_errors'][] = "View has no breadcrumbs";
        }

        if (empty($this->html_page_title)) {
            $this->with['dev_errors'][] = "HTML Page title not set";
        }

        if (empty($this->page_title)) {
            $this->with['dev_errors'][] = "Page title not set";
        }

        if ($this->non_view_object) {
            $this->with['dev_errors'][] = "Use of a non view object detected";
        }

        if ($this->renderables) {
            $this->with['header_renderables'] = $this->renderables;
        }
    }

    public function render()
    {
        $this->validate();

        if ($this->html_page_title && !isset($this->with['html_page_title'])) {
            $this->with['html_page_title'] = $this->html_page_title;
        }

        if ($this->page_title && !isset($this->with['page_title'])) {
            $this->with['page_title'] = $this->page_title;
        }

        if ($this->page_sub_title && !isset($this->with['page_sub_title'])) {
            $this->with['page_sub_title'] = $this->page_sub_title;
        }

        if (!isset($this->with['hide_side_bar'])) {
            $this->with['hide_side_bar'] = $this->hide_side_bar;
        }

        if (count($this->breadcrumbs) > 0) {
            $this->with['breadcrumbs'] = $this->breadcrumbs;
        }

        if (!View::exists($this->view)) {
            return view('core::page')
            ->with($this->with)
            ->with('data_dump', $this->with)
            ->render();
        }

        if ($this->data_table != null) {
            return $this->data_table->render($this->view, $this->with);
        }

        return View::make($this->view)
        ->with($this->with)
        ->render();
    }

    public function __call($name, $args)
    {
        if ($name == 'with') {
            if (count($args) > 0) {
                if (count($args) > 1) {
                    $name .= 'Named';
                } else {
                    $name .= 'Array';
                }
            }
            return call_user_func_array(array($this, $name), $args);
        }
    }
}

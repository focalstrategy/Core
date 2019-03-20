<?php

namespace FocalStrategy\Core;

interface DatatableInterface
{
    public function render($view, $data = [], $mergeData = []);
}

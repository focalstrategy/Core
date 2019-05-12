<?php

if (!function_exists('view')) {
    function view($template, $with = [])
    {
        return View::make($template, $with);
    }
}

if (!function_exists('collect')) {
    function collect(array $result = null)
    {
        if ($result === null) {
            $result = [];
        }

        return new Illuminate\Database\Eloquent\Collection($result);
    }
}

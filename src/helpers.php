<?php

if (!function_exists('view')) {
    function view($template, $with = [])
    {
        return View::make($template, $with);
    }
}

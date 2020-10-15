<?php

if (!function_exists('linkActiveClass')) {
    function linkActiveClass ($segment) {
        return array_intersect(is_array($segment) ? $segment : func_get_args(), request()->segments()) ? 'active' : '';
    }
}

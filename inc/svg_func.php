<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!function_exists('morekoren_get_svg')) {

    function morekoren_get_svg($name, $color = '#000000', $echo = false, $class = '')
    {

        switch ($name) {

            case 'header_logo':
                $icon = '';
                break;

            default:
                $icon = "";
        }

        if ($echo) {
            echo $icon;
        }

        return $icon;
    }
}

if (!function_exists('morekoren_get_svg_file')) {

    function morekoren_get_svg_file($svg)
    {
        return file_get_contents($svg);
    }

}

if (!function_exists('morekoren_get_image_type')) {

    function morekoren_get_image_type($image)
    {
        return pathinfo(parse_url($image, PHP_URL_PATH), PATHINFO_EXTENSION);
    }

}

if (!function_exists('morekoren_get_image')) {
    function morekoren_get_image($url, $alt)
    {
        $type = morekoren_get_image_type($url);
        if ($type == 'svg') {
            $image = morekoren_get_svg_file($url);
        } else {
            $image = '<img src="' . $url . '" alt="' . $alt ? $alt : bloginfo('name') . '">';
        }

        return $image;
    }

}
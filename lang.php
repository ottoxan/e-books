<?php

if (!function_exists('get_language_file_path')) {
    function get_language_file_path()
    {
        // Priority: URL param > session > default
        if (isset($_GET['lang'])) {
            $_SESSION['lang'] = $_GET['lang'];
        }
        $lang = $_SESSION['lang'] ?? 'en';
        return "languages/" . $lang . ".php";
    }
}

// Load the language file if it exists, fallback to English
$lang_file = get_language_file_path();
if (file_exists($lang_file)) {
    require $lang_file;
} else {
    require "languages/en.php";
}

if (!function_exists('__')) {
    function __($str)
    {
        global $lang; // Ensure $lang is accessible
        if (!empty($lang[$str])) {
            return $lang[$str];
        }
        // If you have a $lang array in your language files, use: return $lang[$str] ?? $str;
        return $str;
    }
}

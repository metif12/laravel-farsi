<?php

if(!function_exists('fa_num')){

    function fa_num($text)
    {
        $search1 = config('laravel-farsi.arabic_num');
        $search2 = config('laravel-farsi.latin_num');
        $replace = config('laravel-farsi.farsi_num');

        $text = str_replace($search1, $replace, $text);
        $text = str_replace($search2, $replace, $text);

        return $text;
    }
}

if(!function_exists('farsi')){

    function farsi($text)
    {
        foreach (config('laravel-farsi.farsi_fix_rules') as $key => $rules){
            foreach($rules as $search => $replace){
                $text = str_replace($search, $replace, $text);
            }
        }

        return $text;
    }
}

if(!function_exists('en_num')){

    function en_num($text)
    {
        $search1 = config('laravel-farsi.farsi_num');
        $search2 = config('laravel-farsi.arabic_num');
        $replace = config('laravel-farsi.latin_num');

        $text = str_replace($search1, $replace, $text);
        $text = str_replace($search2, $replace, $text);

        return $text;
    }
}

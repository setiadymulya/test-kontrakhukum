<?php

namespace App\Utils;

class PaggingChecker
{
    public static function filter($page)
    {
        if (is_null($page)) $page = 10;
        if ($page < 1) $page = 10;
        if ($page > 100) $page = 100;

        return $page;
    }
}
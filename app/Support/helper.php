<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 09.04.17
 * Time: 0:27
 */

function getUri($url)
{
    return substr(parse_url($url, PHP_URL_PATH), 1);
}
<?php

function __autoload($cn)
{
    $cn = str_replace("\\", "/", $cn);
    $classFileName = $cn . ".php";
    require_once $classFileName;
}
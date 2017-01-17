<?php

use MyClasses\Test;

//update test set ips = '', vote1 = 0, vote2 = 0, vote3= 0, vote4=0, vote5=0;
//Table 'test' have 1 null-text question

include_once "init.php";

$test = new Test("mysql:dbname=testing;host=127.0.0.1", "root", "");

$http_referer = 'http://php.les/testing/index.php'; //CSRF

if (count($_POST) > 0 && $_SERVER['HTTP_REFERER'] == $http_referer) {
    echo $test->postHandler($_POST, $_SERVER['REMOTE_ADDR']);
}

$test->constructQuestionsObjects($_SERVER['REMOTE_ADDR']);


$form = "<form name='qForm' method=POST action='index.php'>";
$form .= $test->showQuestions();
$form .= "<input type='submit' value='Vote'>";
$form .= "</form>";

echo $form;

//var_dump($test);
//echo $test->$arrAnsVote;
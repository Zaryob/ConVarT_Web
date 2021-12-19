<?php
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

$GLOBALS['base_url'] = 'https://'.$_SERVER['HTTP_HOST'].'/';
$GLOBALS['host'] =  "localhost";
$GLOBALS['user'] = "root";
$GLOBALS['password'] = "password";
$GLOBALS['dbname'] = "current_project";

$GLOBALS['smtp_host'] = "smtp.localhost"; // Mail host
$GLOBALS['smtp_user'] = "smtp@localhost"; // Mail address
$GLOBALS['smtp_cc'] = "smtp@localhost"; // This would be attached as a CC of the mail
$GLOBALS['smtp_passwd'] = "password"; // Mail password
$GLOBALS['smtp_port'] = 465; // Default mail port

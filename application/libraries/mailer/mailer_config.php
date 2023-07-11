<?php

require_once BASEPATH . 'dotenv/autoloader.php';
$dotenv = new Dotenv\Dotenv(FCPATH);
$dotenv->load();

define('GUSER', ENV('EMAIL_USER'));
define('GPWD', ENV('EMAIL_PASSWORD')); 
define('HOST', 'smtp.gmail.com');
define('PORT', 465);

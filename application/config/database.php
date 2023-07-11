<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once BASEPATH . 'dotenv/autoloader.php';
$dotenv = new Dotenv\Dotenv(FCPATH);
$dotenv->load();

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => getenv('DATABASE_HOSTNAME'),
	'username' => getenv('DATABASE_USERNAME'),
	'password' => getenv('DATABASE_PASSWORD'),
	'database' => getenv('DATABASE_NAME'),
	'dbdriver' => getenv('DATABASE_DRIVER'),
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

<?php
defined('BASEPATH') or exit('No direct script access allowed');
$autoload['time_zone'] = date_default_timezone_set('Asia/Bangkok');

$autoload['packages'] = array();

$autoload['libraries'] = array('form_validation', 'session', 'database', 'encryption', 'template');

$autoload['drivers'] = array();

$autoload['helper'] = array('url', 'form', 'html', 'download', 'error_helper', 'file');

$autoload['config'] = array();

$autoload['language'] = array();

$autoload['model'] = array('data', 'M_auth');

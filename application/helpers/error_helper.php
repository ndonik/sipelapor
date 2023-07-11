<?php if (!defined("BASEPATH")) exit("No direct script access allowed");

require_once BASEPATH . 'dotenv/autoloader.php';
$dotenv = new Dotenv\Dotenv(FCPATH);
$dotenv->load();

function encrypt_pass($pass)
{
	return hash('sha256', md5($pass));
}

function send_telegram($text)
{
	$url = 'https://api.telegram.org/bot' . ENV('TOKEN_TELEGRAM') . '/sendMessage?chat_id=' . ENV('CHANNEL_ID') . '&text=' . $text;
	$result = file_get_contents($url, true);
	return $result;
}

function wilayah($wilayah, $id)
{
	if ($wilayah == 'provinsi') {
		$data = 'province/' . $id;
	} else if ($wilayah == 'kabupaten') {
		$data = 'regency/' . $id;
	} else if ($wilayah == 'kecamatan') {
		$data = 'district/' . $id;
	} else if ($wilayah == 'kelurahan') {
		$data = 'village/' . $id;
	}

	$url = 'http://www.emsifa.com/api-wilayah-indonesia/api/' . $data . '.json';
	return json_decode(file_get_contents($url), true)['name'];
}

function ENV($name)
{
	return getenv($name);
}

function get_token($lenght)
{
	$char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
	$string = '';
	for ($i = 0; $i < $lenght; $i++) {
		$pos = rand(0, strlen($char) - 1);
		$string .= $char[$pos];
	}
	return $string;
}


function encrypt_url($string)
{
	$output = false;
	$security       = parse_ini_file("error.ini"); // parsing file security.ini output:array asosiatif
	//Hasil parsing masukkan kedalam variable
	$secret_key     = $security["encryption_key"];
	$secret_iv      = $security["iv"];
	$encrypt_method = $security["encryption_mechanism"];

	//hash $secret_key dengan algoritma sha256
	$key    = hash("sha256", $secret_key);

	//iv(initialize vector), encrypt iv dengan encrypt method AES-256-CBC (16 bytes)
	$iv     = substr(hash("sha256", $secret_iv), 0, 16);

	$result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	$output = base64_encode($result);

	return $output;
}
function decrypt_url($string)
{
	$output = false;

	$security       = parse_ini_file("error.ini");
	$secret_key     = $security["encryption_key"];
	$secret_iv      = $security["iv"];
	$encrypt_method = $security["encryption_mechanism"];

	$key    = hash("sha256", $secret_key);
	$iv = substr(hash("sha256", $secret_iv), 0, 16);

	$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);

	return $output;
}


if (!function_exists('active_link')) {
	function activate_menu($controller)
	{

		$CI = get_instance();

		$class = $CI->router->fetch_class();
		return ($class == $controller) ? 'active' : '';
	}
}

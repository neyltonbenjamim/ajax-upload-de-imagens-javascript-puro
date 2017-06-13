<?php
spl_autoload_register(function ($class){
	if(file_exists('class/'.$class.'.php')){
		require_once 'class/'.$class.'.php';
	}else{
		die('Não foi possível carregar essa class '.$class.'.php');
	}
	
});

global $config;
$config = array();
$config['dbname'] = 'ajaxupload';
$config['host'] = 'localhost';
$config['dbuser'] = 'root';
$config['dbpass'] = '';


?>
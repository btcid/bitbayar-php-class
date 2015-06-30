<?php

require_once(dirname(__FILE__) . '/../lib/bitbayar.php');

$rand_number = rand(10, 999);
$token = 'S82EFDBBE2CFFEC683925AB67FA41AD46';
$data = array(
	'token'		  => $token,
	'invoice_id'  => $rand_number,
	'rupiah'	  => 1000,
	'memo'		  => 'Invoice #'. $rand_number.' Jhon Doe',
	'callback_url'=> $_SERVER['SERVER_NAME'] . '/dev/bitbayar/example/callback.php',
	'url_success' => $_SERVER['SERVER_NAME'] . '/dev/bitbayar/example/payment_success.php',
	'url_failed'  => $_SERVER['SERVER_NAME'] . '/dev/bitbayar/example/payment_failed.php'
);


$bitbayar = new Bitbayar($token);
$create_invoice = json_decode($bitbayar->createInvoice($data));


if($create_invoice->success){
	//~ Redirect to BitBayar payment page.
	$bitbayar->redirect($create_invoice->payment_url);
}else{
	exit('Bitbayar API Error : '.$create_invoice->error_message);
}
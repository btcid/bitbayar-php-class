<?php

require_once(dirname(__FILE__) . '/../lib/bitbayar.php');
$token = 'S82EFDBBE2CFFEC683925AB67FA41AD46';

$bitbayar = new Bitbayar($token);
$invoiceStatus = json_decode($bitbayar->paymentCallback());

if($invoiceStatus>status=='paid'){
	//~ Do something
}else{
	//~ return status : pending, expired
}

file_put_contents('callback.txt', print_r($invoiceStatus, TRUE));
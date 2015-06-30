<?php

require_once(dirname(__FILE__) . '/../lib/bitbayar.php');
$token = 'S82EFDBBE2CFFEC683925AB67FA41AD46';
$id = '55923827066ce582586179';

$bitbayar = new Bitbayar($token);
$invoice_status = json_decode($bitbayar->invoiceStatus($id));


if($invoice_status->status=='paid'){
	//~ Do something
	print_r('Status : ' . $invoice_status->status);
}else{
	//~ return status : pending, expired
	print_r('Status : ' . $invoice_status->status);
}
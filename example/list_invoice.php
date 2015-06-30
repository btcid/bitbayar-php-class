<?php

require_once(dirname(__FILE__) . '/../lib/bitbayar.php');

$token = 'S82EFDBBE2CFFEC683925AB67FA41AD46';
$start_list = 300;

$bitbayar = new Bitbayar($token);
$list_invoice = json_decode($bitbayar->listInvoice($start_list)); 

echo "<pre>";
print_r($list_invoice);
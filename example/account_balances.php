<?php

require_once(dirname(__FILE__) . '/../lib/bitbayar.php');

$token = 'S82EFDBBE2CFFEC683925AB67FA41AD46';

$bitbayar = new Bitbayar($token);
$acc_balances = json_decode($bitbayar->balances()); 

echo "<pre>";
print_r($acc_balances->balances->btc);
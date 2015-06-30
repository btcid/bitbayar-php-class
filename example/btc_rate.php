<?php

require_once(dirname(__FILE__) . '/../lib/bitbayar.php');

$token = 'S82EFDBBE2CFFEC683925AB67FA41AD46';

$bitbayar = new Bitbayar($token);
$btc_rate = json_decode($bitbayar->rate()); 

//~ echo "<pre>";
print_r("Rp. ". $bitbayar->rp_format($btc_rate->rate));
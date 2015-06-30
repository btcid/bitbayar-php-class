# Bitbayar PHP Class

PHP Class accept [bitcoin](http://en.wikipedia.org/wiki/Bitcoin) using BitBayar service [Bitbayar API](https://bitbayar.com/dev).

## Installation

Download the latest version of the Bitbayar PHP class with:

    https://github.com/btcid/bitbayar-php-class/archive/master.zip
Or
    git clone https://github.com/btcid/bitbayar-php-class
Then, add the following to your PHP script:
    require_once("/path/to/bitbayar-php/lib/bitbayar.php');


## Examples

### Check your balance

```php
$token = 'S82EFDBBE2CFFEC683925AB67FA41AD46';

$bitbayar = new Bitbayar($token);
$acc_balances = json_decode($bitbayar->balances()); 
echo $acc_balances->balances->idr . " IDR";
// '75.500 IDR'
echo $acc_balances->balances->btc . " BTC";
// '3.234 BTC'
```


## Documentation

Please see the ``examples`` directory for examples on using this library.

Reading the latest documentation at https://bitbayar.com/dev
can also help.

# Support

* https://bitbayar.com/support
* https://bitbayar.com/dev

#License
http://opensource.org/licenses/MIT

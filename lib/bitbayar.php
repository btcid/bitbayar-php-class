<?php

class Bitbayar{

	const API_BASE = 'https://bitbayar.com/api/';

	private $apiToken = '';


	public function __construct($apiToken){

		$this->apiToken = $apiToken;
		if ($this->apiToken == NULL)
		{
			print "Missing Bitbayar Token!";
			return false;
		}

		if (strlen($this->apiToken) != 33 || $this->apiToken[0] != 'S')
		{
			print "API Token is not valid!";
			return false;
		}
	}


	/**
	 * Create an order/ invoice
	 * 
	 * @param string $data
	 *
	 * @return array
	 */

	public function createInvoice($data){

		return $this->doCurlRequest($data, 'create_invoice', 'POST');
	}


	/**
	 * Get post back from BitBayar
	 * 
	 * @param string 
	 *
	 * @return array
	 */
	public function paymentCallback(){

		$bitbayarID = $_POST['id'];
		
		//~ Return to check invoice status
		return $this->invoiceStatus($bitbayarID);
	}



	/**
	 * Get status of invoice
	 * 
	 * @param string 
	 *
	 * @return array
	 */
	public function invoiceStatus($bitbayarID){

		return $this->doCurlRequest(array(
				'token' => $this->apiToken, 
				'id' => $bitbayarID), 'check_invoice', 'POST');
	}



	/**
	* Get list created invoice
	* 
	* @param string $start
	*
	* @return array
	*/
	public function listInvoices($start){

		return $this->doCurlRequest(array(
				'token' => $this->apiToken, 
				'start' => $start), 'list_invoices', 'POST');
	}


	/**
	 * Get currently account balances
	 * 
	 * @return array
	 */
	public function balances(){

		return $this->doCurlRequest(array(
				'token' => $this->apiToken), 'balances', 'POST');
	}


	/**
	 * Get currently Bitcoin rate
	 * 
	 * @return array
	 */
	public function rate(){

		return $this->doCurlRequest($data=false, 'rate', 'GET');
	}


	/**
	 * Redirect to payment page
	 * 
	 * @param string $url
	 *
	 * @return string
	 */
	public function redirect($url, $permanent = false) {

		if($permanent) {
			header('HTTP/1.1 301 Moved Permanently');
		}
		header('Location: '.$url);
		exit();
	}


	/**
	 * Curl request
	 * 
	 * @param string $data
	 * @param string $action
	 * @param string $method
	 *
	 * @return array
	 */
	public function doCurlRequest($data=false, $action, $method='GET')
	{
		$url = Bitbayar::API_BASE . $action;

		if(empty($url))
		{
			return 'Error: invalid Url';
		}
		
		$ch = curl_init();

		if($method == 'POST') {
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true);
			if($data !== false) {
				curl_setopt($ch,CURLOPT_POST,count($data));
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
			}
		} else {
			if($data !== false) {
				if(is_array($data)) {
					$dataTokens = array();
					foreach($data as $key => $value) {
						array_push($dataTokens, urlencode($key).'='.urlencode($value));
					}
					$data = implode('&', $dataTokens);
				}
				curl_setopt($ch, CURLOPT_URL, $url.'?'.$data);
			} else {
				curl_setopt($ch, CURLOPT_URL, $url);
			}
		}

		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,10);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);  # Set curl to return the data instead of printing it to the browser.
		curl_setopt($ch, CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)"); # Some server may refuse your request if you dont pass user agent

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		//execute post
		$result = curl_exec($ch);

		//close connection
		curl_close($ch);
		return $result;
	}


	/**
	 * Format number to IDR syntax
	 * 
	 * @param string $rp
	 *
	 * @return string
	 */
	function rp_format($rp){

		return number_format($rp, 0, ',', '.');
	}
}
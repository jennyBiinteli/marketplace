<?php

class CurlController
{


	/*=============================================
	Ruta API
	=============================================*/

	static public function api()
	{
		$PORT = $_SERVER["SERVER_PORT"];
		// return "http://api-marketplace.com:" . $PORT . "/";
		// return "https://demomarketplace-api.biinteli.com/";
		return "https://d3moapimarketplace.herokuapp.com/";
	}


	/*=============================================
	Peticiones a la API
	=============================================*/

	static public function request($url, $method, $fields, $header)
	{

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => $method,
			CURLOPT_POSTFIELDS => $fields,
			CURLOPT_HTTPHEADER => $header
		));

		$response = curl_exec($curl);

		curl_close($curl);

		$response = json_decode($response);

		return $response;
	}
}
<?php
// namespace Multilist;

// class Multi_select() {
// 	public function add_multi_select(){
// 		$data = array (
// 	  		'add' => 
// 	  			array (
// 	    			0 => 
// 	    		array (
// 		        'name' => 'Мультилист',
// 		        'type' => '5',
// 		        'origin' => '123',
// 		        'enums' => 
// 		      array (
// 		        0 => 'Значение 1',
// 		        1 => ' Значение 2',
// 		        2 => ' Значение 3',
// 		        3 => ' Значение 4',
// 		        4 => ' Значение 5',
// 		        5 => ' Значение 6',
// 		      ),
// 		    ),
// 		  ),
// 	);
// 	$link = "https://vlubov.amocrm.ru/api/v2/fields";

// 	$headers[] = "Accept: application/json";

// 	 //Curl options
// 	$curl = curl_init();
// 	curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
// 	curl_setopt($curl, CURLOPT_USERAGENT, "amoCRM-API-client-
// 	undefined/2.0");
// 	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
// 	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
// 	curl_setopt($curl, CURLOPT_URL, $link);
// 	curl_setopt($curl, CURLOPT_HEADER,false);
// 	curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__)."/cookie.txt");
// 	curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__)."/cookie.txt");
// 	$out = curl_exec($curl);
// 	curl_close($curl);
// 	$result = json_decode($out,TRUE);
// 	print_r($result);
// 	}
// }
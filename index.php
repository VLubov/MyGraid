<?php header('Access-Control-Allow-Origin: *'); 

// $string = '"Organisation","Address","Postcode"' . PHP_EOL;
// $string .= "\"$member_organ_field\",\"$member_address_field\",\"$member_post_field\"" . PHP_EOL;

// file_put_contents('myfile.csv', $string); // write file





?>
<!DOCTYPE html>
<html>
<head>
	<title>Тестируем виджет</title>
</head>
<body>
<?php foreach ($_POST as $key => $value) {
	$data = json_decode($value,TRUE);
	foreach ($data as $k => $v) {
				$id[] = $v['id'];
	}
	
}

foreach ($id as $key_id => $value_id) {
	$link = 'https://vlubovwidget.amocrm.ru/api/v2/leads?id='.$value_id;

	$headers[] = "Accept: application/json";

	 //Curl options
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
	curl_setopt($curl, CURLOPT_USERAGENT, "amoCRM-API-client-
	undefined/2.0");
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($curl, CURLOPT_URL, $link);
	curl_setopt($curl, CURLOPT_HEADER,false);
	curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__)."/cookie.txt");
	curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__)."/cookie.txt");
	$out = curl_exec($curl);
	curl_close($curl);
	$result = json_decode($out,TRUE);
	$result[] = $result;
}
foreach ($result as $embedded => $item) {
	foreach($item as $key5 => $info){
		print_r($item);
	}
}





 ?>
</body>
</html>
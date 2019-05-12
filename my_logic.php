<?php 
namespace FirstEx;

$hash = '5c88c3456481874aa6a2d5948f7b32e0dfdcb142';
$mail = 'vlubov@team.amocrm.com';
$sd = 'vlubov';
auth_amo($mail, $hash, $sd);

trait get_in_bd {
	public function get_in_bd(){
		$data = array (
		  'add' => 
		  array (
		    0 => 
		    array (
		      'name' => $this->name,
		    ),
		  ),
		);
		$link = "https://vlubov.amocrm.ru/api/v2/{$this->type}";
		$headers[] = "Accept: application/json";

		 //Curl options
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($curl, CURLOPT_USERAGENT, "amoCRM-API-client-
		undefined/2.0");
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($curl, CURLOPT_URL, $link);
		curl_setopt($curl, CURLOPT_HEADER,false);
		curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__)."/cookie.txt");
		curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__)."/cookie.txt");
		$out = curl_exec($curl);
		curl_close($curl);
		$result = json_decode($out,TRUE);
		switch ($this->type) {
			case 'contacts':
			$whatTheType = 'Контакт';
			break;
			case 'companies':
			$whatTheType = 'Компания';
			break;
			case 'leads':
			$whatTheType = 'Сделка';
			break;
		}
		$result=$result['_embedded']['items'];
		$output= $whatTheType.' '."{$this->name}".' успешно добавлен'.'<br>'.'ID :'.PHP_EOL;
		foreach($result as $v)
		  if(is_array($v))
		   echo $output.=$v['id'].'<br>';
		return $output;	
	}
}

class add_info {
	use get_in_bd;

	public $name;
	public $type;
	public function add_company($name){
		$this->name = $name;
		$this->type = 'companies';
		$this->get_in_bd();
	}
	public function add_contact($name){
		$this->name = $name;
		$this->type = 'contacts';
		$this->get_in_bd();
	}
	public function add_lead($name){
		$this->name = $name;
		$this->type = 'leads';
		$this->get_in_bd();
	}
}


$n = $_POST['n'];

if ($n > 0 && $n < 10000) {
	for ($i = 0; $i < $n; $i++){
		$name = randString();
		$new_object = new add_info();
		$new_object->add_company($name);
		$name = randString();
		$new_object->add_contact($name);
		$name = randString();
		$new_object->add_lead($name);

		
	}
} else {
	echo 'Вы не можете добавить больше 10000 или меньше 1 записи одновременно';
}

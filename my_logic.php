<?php 
namespace FirstEx;

$hash = '5c88c3456481874aa6a2d5948f7b32e0dfdcb142';
$mail = 'vlubov@team.amocrm.com';
$sd = 'vlubov';
auth_amo($mail, $hash, $sd);

trait get_in_bd {
	public function get_in_bd(){
		$this->data;
		$link = "https://vlubov.amocrm.ru/api/v2/{$this->type}";
		$headers[] = "Accept: application/json";

		 //Curl options
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($curl, CURLOPT_USERAGENT, "amoCRM-API-client-
		undefined/2.0");
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($this->data));
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
			case 'fields':

		}
		
		$result=$result['_embedded']['items'];
		$output= $whatTheType.' '."{$this->name}".' успешно добавлен'.'<br>'.'ID :'.PHP_EOL;
		foreach($result as $v)
		  if(is_array($v))
		  	
		  	// print_r($result);
		    echo $output.=$v['id'].'<br>';
	}
}

class add_info {
	use get_in_bd;

	public $name;
	public $type;
	public $data;
	public function add_company($name){	
		$this->name = $name;
		$this->type = 'companies';
		$this->data = array (
		  	'add' => 
		  	array (
		    	0 => 
		    	array (
		    		'name' => $this->name,
		    ),
		  ),
		);
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

class MultiSelect {
	use get_in_bd;
	public $data;
	public function add_multi_select(){
		
		$this->type = 'fields';
		$this->data = array (
	  		'add' => 
	  			array (
	    			0 => 
	    		array (
		        'name' => 'Мультилист',
		        'type' => '5',
		        'element_type' => '1',
		        'origin' => '123',
		        'enums' => 
		      array (
		        0 => ' Значение 1',
		        1 => ' Значение 2',
		        2 => ' Значение 3',
		        3 => ' Значение 4',
		        4 => ' Значение 5',
		        5 => ' Значение 6',
		        6 => ' Значение 7',
		        7 => ' Значение 8',
		        8 => ' Значение 9',
		        9 => ' Значение 10',
		      ),
		    ),
		  ),
	);
	$this->get_in_bd();	
	echo 'Мультисписок добвален' . '<br>'; 
	}
}

// $valuesid = [
//     0 => '107889',
//     1 => '107891',
//     2 => '107893',
//     3 => '107895',
//     4 => '107897',
//     5 => '107899',
//     ];
// $num = rand(1, 5); 
// shuffle($valuesid);
// $valuesid = array_slice($valuesid ,0, $num);
// print_r($valuesid);


class FieldsInfo {
	
}
// $test = new FieldsInfo();
// $test->get_info_user();



class UserList {
	public function get_info_user(){
		$link = 'https://vlubov.amocrm.ru/api/v2/contacts/';

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
		$result = $result['_embedded']['items'];
		$v = [];
		foreach($result as $k) {
			  if(is_array($k))
			  	$v[] = $k['id'];
			  }
			  
			   $this->ID = $v;
	}
	public function update_multi_select(){
		$this->get_update();
	
		

		$this->get_info_user();
		foreach ($this->ID as $key => $value) {
		
			$ar_keys = [];
		foreach ($this->valuesid as $key => $v3) {
			$ar_keys[] = $key; 
		}
		$valuesid = $ar_keys;
		$num = rand(1, 10); 
		shuffle($valuesid);
		$valuesid = array_slice($valuesid ,0, $num);

		$data[] = array (
		  'update' => 
		  array (
		    0 => 
		    array (
		      'id' => $value,
		      'updated_at' => '1557687060',
		      'custom_fields' => 
		      array (
		        0 => 
		        array (
		          'id' => '83523',
		          'values' => 
		            $valuesid,
		        ),
		      ),
		    ),
		  ),
		);
		}
		$link = "https://vlubov.amocrm.ru/api/v2/contacts";

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
	

	}
	public function get_update(){
		$link = 'https://vlubov.amocrm.ru/api/v2/account?with=custom_fields';

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
		$valuesid = $result['_embedded']['custom_fields']['contacts']['83523']['enums'];
		$this->valuesid = $valuesid;
		
	}
}
$new_info = new UserList();
$new_info->update_multi_select();


// $new_multiselect = new MultiSelect();
// $new_multiselect->add_multi_select();


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

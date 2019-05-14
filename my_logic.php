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
		}
		$result=$result['_embedded']['items'];
		foreach($result as $v) {
            if (is_array($v)) {
                    $s[] = $v;
                    $s = array_pop($s);
                //    echo 'Контакт успешно добавлен'.'<br>'.'ID :'.PHP_EOL . $s['id']. '<br>';

            }
        }


	}
}




class UpdateToAll {
	public function get_up(){
		$id_contact = '671949';
		$data = array (
		  'update' => 
		  array (
		    0 => 
		    array (
		      'id' => $id_contact,
		      'updated_at' => '1557763680',
		      'company_id' => '2078565',
		      'leads_id' => 
		      array (
		        0 => '593201',
		        1 => '594173',
		        2 => '594709',
		      ),
		    ),
		  ),
		);

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
}

//$new_up = new UpdateToAll();
//$new_up->get_up();


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

class ContactUpdate {
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
		$update[] =  
		    array (
		      'id' => $value,
		      'updated_at' => '1557756000',
		      'custom_fields' => 
		      array (
		        0 => 
		        array (
		          'id' => '83523',
		          'values' => 
		            $valuesid,
		        ),
		      ),
		    );
		  
		
		}
		$data = ['update' => $update];
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
// Привязать рандомные значения к каждому контакту
// $valeus_milti = new ContactUpdate();
// $valeus_milti->update_multi_select();

// Создать поле мультисписок с 10ю значениями
// $new_multiselect = new MultiSelect();
// $new_multiselect->add_multi_select();


class Add {
    use get_in_bd;
        public function get_add($type, $data)
        {
            $this->data = $data;
            $this->type = $type;
            $this->get_in_bd();
        }
        public function set_name($name){

        $this->add =[
                'name' => $name,
            ];
    }

}

$n = $_POST['n'];
$test_con = new Add();
if ($n > 0 && $n < 10000) {
	for ($i = 0; $i < $n; $i++){
        $name = randString();
	    $test_con->set_name($name);
	    foreach ($test_con as $key => $value) {
                $data['add'][] = $value;
        }
}
} else {
	echo 'Вы не можете добавить больше 10000 или меньше 1 записи одновременно';
}
$data = array_chunk($data['add'], 500, true);
foreach ($data as $key => $value) {
    $data = ['add' => $value];

    $test_con->get_add('contacts',$data);
}

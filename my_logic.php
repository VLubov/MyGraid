<?php 
namespace FirstEx;

require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/classes/Add.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/classes/MultiSelect.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/classes/UpdateToAll.php');

use MyUpdateToAll\UpdateToAll;
use MyMultiSelect\MultiSelect;
use MyAdd\Add;

$hash = '5c88c3456481874aa6a2d5948f7b32e0dfdcb142';
$mail = 'vlubov@team.amocrm.com';
$sd = 'vlubov';
auth_amo($mail, $hash, $sd);

trait UseCurl {
    public function use_curl($use_array_data){
        $link = "https://vlubov.amocrm.ru/api/v2/{$this->type}";
        $headers[] = "Accept: application/json";

        //Curl options
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_USERAGENT, "amoCRM-API-client-
		undefined/2.0");
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        if ($use_array_data == true) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($this->data));
        }
        curl_setopt($curl, CURLOPT_URL, $link);
        curl_setopt($curl, CURLOPT_HEADER,false);
        curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__)."/cookie.txt");
        curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__)."/cookie.txt");
        $out = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($out,TRUE);
        $this->result = $result;

    }
}
function add_new($type, $n)
{
    $new_es = new Add();
    if ($n > 0 && $n <= 10000) {
        for ($i = 0; $i < $n; $i++) {
            $name = randString();
            $new_es->set_name($name);
            foreach ($new_es as $key => $value) {
                $data['add'][] = $value;
            }
        }
    } else {
        echo 'Вы не можете добавить больше 10000 или меньше 1 записи одновременно';
    }
    $data = array_chunk($data['add'], 150, true);
    foreach ($data as $key => $value) {
        $data = ['add' => $value];
        $new_es->get_add($type, $data);
    }
    return $new_es;
}

//$new_up = new UpdateToAll();
//$new_up->get_up();

// Создать поле мультисписок с 10ю значениями
// $new_multiselect = new MultiSelect();
// $new_multiselect->add_multi_select();

$n = $_POST['n'];
$type = 'contacts';

add_new($type, $n)->update_multi_select();

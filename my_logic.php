<?php 
namespace FirstEx;

require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/classes/Add.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/classes/MultiSelect.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/classes/Update.php');

use MyUpdate\Update;
use MyMultiSelect\MultiSelect;
use MyAdd\Add;

$hash = '5c88c3456481874aa6a2d5948f7b32e0dfdcb142';
$mail = 'vlubov@team.amocrm.com';
$sd = 'vlubov';

/**
 *
 */
auth_amo($mail, $hash, $sd);

// этот трейт тут не спроста

/**
 * Trait UseCurl
 * @package FirstEx
 */
trait UseCurl {
    public function use_curl($use_array_data){
        $link = "https://vlubov.amocrm.ru/api/v2/{$this->type}";
        $headers[] = "Accept: application/json";

        //Curl options
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
        curl_setopt($curl, CURLOPT_USERAGENT, "amoCRM-API-client-
		undefined/2.0");
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        if ($use_array_data == TRUE) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($this->data));
        }
        curl_setopt($curl, CURLOPT_URL, $link);
        curl_setopt($curl, CURLOPT_HEADER,FALSE);
        curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__)."/cookie.txt");
        curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__)."/cookie.txt");
        $out = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($out,TRUE);
        $this->result = $result;

    }
}


// Создать поле мультисписок с 10ю значениями
// $new_multiselect = new MultiSelect();
// $new_multiselect->add_multi_select();

$n = $_POST['n'];

$new_con = new Add();
if ($n > 0 && $n <= 10000) {
    for ($i = 0; $i < $n; $i++) {
        $name = randString();
        $new_con->set_name($name);
        foreach ($new_con as $key => $value) {
            $data['add'][] = $value;
        }
    }
} else {
    echo 'Вы не можете добавить больше 10000 или меньше 1 записи одновременно';
}
$data = array_chunk($data['add'], 150, TRUE);
foreach ($data as $key => $value) {
    $data = ['add' => $value];

}
$new_con->add('contacts', $data);
foreach ($new_con as $k => $value2) {
    $id_contacts = $value2;
}
$new_con->update_multi_select();
?> <pre> <?php

$new_comp = new Add();
if ($n > 0 && $n <= 10000) {
    for ($i = 0; $i < $n; $i++) {
        $name = randString();
        $new_comp->set_name($name);
        foreach ($new_comp as $key => $value) {
            $data['add'][] = $value;
        }
    }
} else {
    echo 'Вы не можете добавить больше 10000 или меньше 1 записи одновременно';
}
$data = array_chunk($data['add'], 150, true);
foreach ($data as $key => $value) {
    $data = ['add' => $value];
    $new_comp->add('companies', $data);
    foreach ($new_comp as $k => $value2) {
        $id_companies = $value2;
    }
}
$data= [];

$new_lead = new Add();
if ($n > 0 && $n <= 10000) {
    for ($i = 0; $i < $n; $i++) {
        $name = randString();
        $new_lead->set_name($name);
        foreach ($new_lead as $key => $value) {
            $data['add'][] = $value;
        }
    }
} else {
    echo 'Вы не можете добавить больше 10000 или меньше 1 записи одновременно';
}
$data = array_chunk($data['add'], 150, true);
foreach ($data as $key => $value) {
    $data = ['add' => $value];
    $new_lead->add('leads', $data);
    foreach ($new_lead as $k => $value2) {
        $id_leads = $value2;
    }
}
$data= [];

$new_cust = new Add();
if ($n > 0 && $n <= 10000) {
    for ($i = 0; $i < $n; $i++) {
        $name = randString();
        $new_cust->set_name_customers($name);
        foreach ($new_cust as $key => $value) {
            $data['add'][] = $value;
        }
    }
} else {
    echo 'Вы не можете добавить больше 10000 или меньше 1 записи одновременно';
}
$data = array_chunk($data['add'], 150, true);
foreach ($data as $key => $value) {
    $data = ['add' => $value];
    $new_cust->add('customers', $data);
    foreach ($new_cust as $k => $value2) {
        $id_customers = $value2;
    }
}

$update = new Update();
$update->get_up_companies($id_companies, $id_contacts, $id_leads, $id_customers);

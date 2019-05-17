<?php 
namespace SecondEx;

require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/parametres.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/fun.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/Auth.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/AddField.php');

use AuthToAmo\Auth;
use MyAddField\AddField;

/**
 * Trait UseCurl
 * @package SecondEx
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

$auth = new Auth($hash, $mail, $sd);
$auth->get_auth();

$type_es = $_POST['type_es'];
$id_for_update = $_POST['id'];
$text = $_POST['value_text'];
if (isset($_POST['enter'])) {
    $update = new AddField;
    $update->get_date($type_es, $id_for_update, $text);
}
pre($update);
























// удаление много-много полей
//function check()
//{
//    $link = 'https://vlubov.amocrm.ru/api/v2/account?with=custom_fields';
//
//    $headers[] = "Accept: application/json";
//
////Curl options
//    $curl = curl_init();
//    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
//    curl_setopt($curl, CURLOPT_USERAGENT, "amoCRM-API-client-
//undefined/2.0");
//    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//    curl_setopt($curl, CURLOPT_URL, $link);
//    curl_setopt($curl, CURLOPT_HEADER,false);
//    curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__)."/cookie.txt");
//    curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__)."/cookie.txt");
//    $out = curl_exec($curl);
//    curl_close($curl);
//    $result = json_decode($out,TRUE);
//    $type = 'leads';
//    $mas = $result['_embedded']['custom_fields'][$type];
//    $num_id = array_search('text', array_column($mas, 'name'), FALSE);
//    if ($num_id !== FALSE) {
//        foreach ($mas as $id_cust => $value_cust) {
//            $all_id_cust[] = $id_cust;
//        }
//        $data = array (
//            'delete' =>
//                array (
//                    0 =>
//                        array (
//                            'id' => $all_id_cust[$num_id],
//                            'origin' => '1223',
//                        ),
//                ),
//        );
//            $link = "https://vlubov.amocrm.ru/api/v2/fields";
//
//            $headers[] = "Accept: application/json";
//
//            //Curl options
//            $curl = curl_init();
//            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//            curl_setopt($curl, CURLOPT_USERAGENT, "amoCRM-API-client-
//undefined/2.0");
//            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
//            curl_setopt($curl, CURLOPT_URL, $link);
//            curl_setopt($curl, CURLOPT_HEADER, false);
//            curl_setopt($curl, CURLOPT_COOKIEFILE, dirname(__FILE__) . "/cookie.txt");
//            curl_setopt($curl, CURLOPT_COOKIEJAR, dirname(__FILE__) . "/cookie.txt");
//            $out = curl_exec($curl);
//            curl_close($curl);
//            $result = json_decode($out, TRUE);
//        check();
//    } else {
//        echo "Deleted All Done!";
//    }
//
//}

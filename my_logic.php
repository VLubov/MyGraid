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

switch ($_POST['type_es']){
    case 'Контакт' :
        $type_es = 'contacts';
        break;
    case 'Сделка' :
        $type_es = 'leads';
        break;
    case 'Компания' :
        $type_es = 'companies';
        break;
    case 'Покупатель' :
        $type_es = 'customers';
        break;
}
$update = new AddField;
$update->get_date($type_es, $_POST['id'], $_POST['value_text']);
echo "Данные добавленны";

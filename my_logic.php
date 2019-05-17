<?php 
namespace SecondEx;

require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/parametres.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/fun.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/Auth.php');

use AuthToAmo\Auth;


/**
 * Trait UseCurl
 * @package SecondEx
 */
trait UseCurl {
    public function use_curl($use_array_data){
        if ($use_array_data == TRUE) {
            $link='https://'.$this->sd.'.amocrm.ru/private/api/auth.php?type=json';
        } else {
            $link = "https://vlubov.amocrm.ru/{$this->type}";
        }
        $headers = ['Content-Type: application/json'];
        //Curl options
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
        curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client-
		undefined/2.0');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        if ($use_array_data == TRUE) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($this->data));
            curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
            curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
            curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
        }
        curl_setopt($curl, CURLOPT_URL, $link);
        curl_setopt($curl, CURLOPT_HEADER,FALSE);
        curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__)."/cookie.txt");
        curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__)."/cookie.txt");
        $out = curl_exec($curl);
        $this->out = $out;
        $code=curl_getinfo($curl,CURLINFO_HTTP_CODE);
        $this->code = $code;
        curl_close($curl);
        $result = json_decode($out,TRUE);
        $this->result = $result;

    }
}

$auth = new Auth($hash, $mail, $sd);
$auth->get_auth();

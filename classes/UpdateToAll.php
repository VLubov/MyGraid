<?php
/**
 * Created by PhpStorm.
 * User: vlubov
 * Date: 14.05.2019
 * Time: 18:01
 */

namespace UpdateEs;


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
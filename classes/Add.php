<?php
namespace MyAdd;

require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/classes/GetInBD.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/classes/Update.php');
use MyGetInBD\GetInBD;
use MyUpdate\Update;

class Add extends GetInBD {
    public function add($type, $data)
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
    public function set_name_customers($name){
        $this->add =[
            'name' => $name,
            'next_date' => '1559210400',
        ];
    }
    public function update_multi_select(){
        $this->get_values_id();
        $this->get_id_mult();
        $ar_keys = [];
        foreach ($this->valuesid as $key => $v3) {
            $ar_keys[] = $key;
        }
        foreach ($this->ID as $keyid => $value) {
            $num = mt_rand(1, 10);
            shuffle($ar_keys);
            $valuesid = array_slice($ar_keys , 0 , $num);
            $update[] =
                [
                    'id' => $value,
                    'updated_at' => '1559318400',
                    'custom_fields' =>
                        [
                            0 =>
                                [
                                    'id' => $this->id_multi,
                                    'values' =>
                                        $valuesid,
                                ],
                        ],
                ];

        }
        $data = ['update' => $update];
        foreach ((array_chunk($data['update'], 500, TRUE)) as $key => $chunked_data) {
            $data = ['update' => $chunked_data];
        }
        $this->data = $data;
        $this->type = 'contacts';
        $this->use_curl(TRUE);
//        print_r($this->ID);
    }
    public function get_values_id(){
        $this->type = 'account?with=custom_fields';
        $this->use_curl(FALSE);
        $valuesid = $this->result;
        $valuesid = $valuesid['_embedded']['custom_fields']['contacts']['83523']['enums'];
        $this->valuesid = $valuesid;
    }
    public function get_id_mult(){
        $this->type = 'account?with=custom_fields';
        $this->use_curl(FALSE);
        $custom_cont = $this->result['_embedded']['custom_fields']['contacts'];
        foreach ($custom_cont as $key => $value){
            if ( $value['name'] === 'Мультисписок' )
                return $key;
        }
       $this->id_multi = $key;
        
    }
}

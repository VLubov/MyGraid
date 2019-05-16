<?php
namespace MyAdd;

require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/classes/GetInBD.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/classes/Update.php');
use MyGetInBD\GetInBD;
use MyUpdate\Update;

class Add extends GetInBD {
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
    public function set_name_customers($name){
        $this->add =[
            'name' => $name,
            'next_date' => '1559210400',
        ];
    }
    public function update_multi_select(){
        $this->get_values_id();
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
                                    'id' => '83523',
                                    'values' =>
                                        $valuesid,
                                ],
                        ],
                ];

        }
        $data = ['update' => $update];
        $data = array_chunk($data['update'], 500, true);
        foreach ($data as $key => $value) {
            $data = ['update' => $value];
        }
        $this->data = $data;
        $this->type = 'contacts';
        $this->use_curl(true);
//        print_r($this->ID);
    }
    public function get_values_id(){
        $this->type = 'account?with=custom_fields';
        $this->use_curl(false);
        $valuesid = $this->result;
        $valuesid = $valuesid['_embedded']['custom_fields']['contacts']['83523']['enums'];
        $this->valuesid = $valuesid;
    }
}

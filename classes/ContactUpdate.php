<?php
/**
 * Created by PhpStorm.
 * User: vlubov
 * Date: 14.05.2019
 * Time: 19:03
 */

namespace UpdateContact;


class ContactUpdate {
    use UseCurl;
    public function get_info_user(){
        $this->type = 'contacts/';
        $this->date = '';
        $this->use_curl(false);
        $this->result = $this->result['_embedded']['items'];
        $v = [];
        foreach($this->result as $k) {
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
        $this->data = $data;
        $this->type = 'contacts';
        $this->use_curl(true)
	}
    public function get_update(){
        $this->type = 'account?with=custom_fields';
        $this->data = '';
        $this->use_curl(false);
        $valuesid = $this->result['_embedded']['custom_fields']['contacts']['83523']['enums'];
        $this->valuesid = $valuesid;

    }
}

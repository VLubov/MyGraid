<?php
namespace Add;

require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/classes/GetInBD.php');
use MyGetInBD\GetInBD;

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

}

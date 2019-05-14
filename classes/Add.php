<?php
namespace Add;


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

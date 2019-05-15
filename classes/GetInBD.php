<?php
namespace MyGetInBD;

require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/my_logic.php');
use FirstEx\UseCurl as UseCurl;

Class GetInBD {
    use UseCurl;
    public function get_in_bd(){
        $this->use_curl(true);
        $s = $this->result['_embedded']['items'];
        foreach ($s as $key => $value) {
            $this->ID[] = $value['id'];

        }

    }
}

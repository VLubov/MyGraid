<?php
namespace MyMultiSelect;

require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/my_logic.php');
use FirstEx\UseCurl as UseCurl;

class MultiSelect {
    use UseCurl;
    public function add_multi_select(){

        $this->type = 'fields';
        $this->data['add'][] =
                        [
                            'name' => 'Мультилист',
                            'type' => '5',
                            'element_type' => '1',
                            'origin' => '123',
                            'enums' =>
                                [
                                    0 => ' Значение 1',
                                    1 => ' Значение 2',
                                    2 => ' Значение 3',
                                    3 => ' Значение 4',
                                    4 => ' Значение 5',
                                    5 => ' Значение 6',
                                    6 => ' Значение 7',
                                    7 => ' Значение 8',
                                    8 => ' Значение 9',
                                    9 => ' Значение 10',
                                ],

        ];
        $this->use_curl(TRUE);
        echo 'Мультисписок добвален' . '<br>';
    }
}

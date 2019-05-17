<?php
namespace MyAddField;

require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/my_logic.php');
use SecondEx\UseCurl;

/**
 * Class AddField
 * @package MyAddField
 */
class AddField {
    use UseCurl;
    public function get_date($type_es, $id_for_update, $value) {
        $this->value = $value;
        $this->id_for_update = $id_for_update;
        $this->type = 'account?with=custom_fields';
        $this->use_curl(false);
        $mas = $this->result['_embedded']['custom_fields'][$type_es];
        $num_id = array_search('1', array_column($mas, 'field_type'), FALSE);
        pre($mas);
        if ($num_id !== FALSE) {
            foreach ($mas as $id_cust => $value_cust) {
                $all_id_cust[] = $id_cust;
            }
            $data = array (
                'add' =>
                    array (
                        0 =>
                            array (
                                'name' => $this->id_for_update,
                                'custom_fields' =>
                                    array (
                                        0 =>
                                            array (
                                                'id' => $all_id_cust[$num_id],
                                                'values' =>
                                                    array (
                                                        0 =>
                                                            array (
                                                                'value' => $this->value,
                                                            ),
                                                    ),
                                            ),
                                    ),
                            ),
                    ),
            );
            $this->data = $data;
            $this->use_curl(true);

        } else {
            switch ($type_es) {
                case 'leads' :
                    $element_type = '2';
                    break;
                case 'contacts' :
                    $element_type = 1;
                    break;
                case 'companies' :
                    $element_type = 3;
                    break;
                case 'customers' :
                    $element_type = 12;
                    break;
            }
            $data = array (
                'add' =>
                    array (
                        0 =>
                            array (
                                'name' => 'text',
                                'type' => '1',
                                'element_type' => $element_type,
                                'origin' => '1551',
                                'enums' => 'Это успех!',
                                'is_editable' => '1',
                            ),
                    ),
            );
            $this->type = 'fields';
            $this->data = $data;
            $this->use_curl(true);
        }
    }
}
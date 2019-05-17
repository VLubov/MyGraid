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
    public function get_date($type_es, $id_for_update, $text) {
        $this->id_for_update = $id_for_update;
        $this->type = 'account?with=custom_fields';
        $this->use_curl(false);
        $mas = $this->result['_embedded']['custom_fields'][$type_es];
        $num_id = array_search('1', array_column($mas, 'field_type'), FALSE);
        if ($num_id !== FALSE) {
            foreach ($mas as $id_cust => $value_cust) {
                $all_id_cust[] = $id_cust;
            }
            $data['update'][] =
                [
                    'id' => $id_for_update,
                    'updated_at' => '1559311200',
                    'custom_fields' =>
                        [
                            [
                                'id' => $all_id_cust[$num_id],
                                'values' =>
                                    [
                                        [
                                            'value' => $text,
                                        ],
                                    ],
                            ],
                        ],
                ];
            $this->data = $data;
            $this->type = $type_es;
            $this->use_curl(true);

        } else {
            switch ($type_es) {
                case 'leads' :
                    $element_type = 2;
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
                case 'default' :
                    $element_type = 1;
                    break;
            }
            $data['add'][] =
                [
                    'name' => 'text',
                    'type' => '1',
                    'element_type' => $element_type,
                    'origin' => '1551',
                    'is_editable' => '1',
                ];
            $this->type = 'fields';
            $this->data = $data;
            $this->use_curl(true);
            $this->get_date($type_es, $id_for_update, $text);
        }
    }
}
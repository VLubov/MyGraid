<?php
namespace MyNote;

require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/fun.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/my_logic.php');
use SecondEx\UseCurl;

class Note {
    use UseCurl;
    public function add_notes($element_type, $id){
        $this->id = $id;
        $this->type = 'api/v2/notes';
        $data['add'][] = [
            'element_id' => $this->id,
            'element_type' => $element_type,
            'note_type' => '4',
            'text' => 'Обычное примечание',
                        ];
        $this->data = $data;
        $this->use_curl(TRUE);
    }
    public function add_phone_contact($phone){
        $this->phone = $phone;
        $data['update'][] =
            [
                'id' => $this->id,
                'updated_at' => '1559326440',
                'custom_fields' => [
                    [
                        'id' => '48705',
                        'values' => [
                            [
                                'value' => $this->phone,
                                'enum' => 'WORK',
                                ],
                        ],
                    ],
                ],
            ];
        $this->data = $data;
        $this->type = 'api/v2/contacts';
        $this->use_curl(TRUE);
    }
    public function add_call(){
        $data['add'][] =[
            'phone_number' => $this->phone,
            'direction' => 'inbound',
            'call_result' => 'Проблема успешно решена!',
            ];
        $this->data = $data;
        $this->type = 'api/v2/calls';
        $this->use_curl(TRUE);
    }
}
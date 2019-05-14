<?php
namespace UpdateEs;


class UpdateToAll {
    use UseCurl;
    public function get_up(){
        $id_contact = '671949';
        $data = [
            'update' =>
                [
                    0 =>
                        [
                            'id' => $id_contact,
                            'updated_at' => '1557763680',
                            'company_id' => '2078565',
                            'leads_id' =>
                               [
                                    0 => '593201',
                                    1 => '594173',
                                    2 => '594709',
                                ],
                        ],
                ],
        ];
        $this->data = $data;
        $this->type = 'contacts';
        $this->use_curl(true);
    }
}

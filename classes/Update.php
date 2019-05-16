<?php
namespace MyUpdate;

require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/my_logic.php');
use FirstEx\UseCurl;

class Update {
use UseCurl;
    public function get_up_companies($id_companies, $id_contacts, $id_leads, $id_customers){
        $k = array_rand($id_contacts);
        $id_contact = $id_contacts[$k];
        $k2 = array_rand($id_customers);
        $k3 = array_rand($id_leads);
        foreach ($id_companies as $key => $value) {
            $update[] =
                [
                    'id' => $value,
                    'updated_at' => '1559311200',
                    'contacts_id' => $id_contact,
                    'customers_id' => $id_customers[$k2],
                    'leads_id' => $id_leads[$k3],

                ];
        }
        $data = ['update' => $update];
        foreach ((array_chunk($data['update'], 500, TRUE)) as $key => $chunked_data) {
        $data = ['update' => $chunked_data];
        }
        $this->data = $data;
        $this->type = 'companies';
        $this->use_curl(TRUE);
    }
}
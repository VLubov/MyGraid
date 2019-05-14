<?php
namespace GetIn;


Class GetInBD {
    use UseCurl;
    public function get_in_bd(){
        $this->use_curl(true);
        switch ($this->type) {
            case 'contacts':
                $whatTheType = 'Контакт';
                break;
            case 'companies':
                $whatTheType = 'Компания';
                break;
            case 'leads':
                $whatTheType = 'Сделка';
                break;
        }
        $this->result=$this->result['_embedded']['items'];
        foreach($this->result as $v) {
            if (is_array($v)) {
                $s[] = $v;
                $s = array_pop($s);
                //    echo 'Контакт успешно добавлен'.'<br>'.'ID :'.PHP_EOL . $s['id']. '<br>';

            }
        }


    }
}

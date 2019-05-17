<?php
namespace AuthToAmo;
require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/parametres.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/my_logic.php');
use SecondEx\UseCurl;
/**
 * Class Auth
 * @package AuthToAmo
 */
class Auth {
use UseCurl;
	public $hash;
	public function __construct($hash, $mail, $sd) {
		$this->hash = $hash;
		$this->mail = $mail;
		$this->sd = $sd;
	}
	public function authorized(){
		$user=[
            'USER_LOGIN'=>$this->mail, #Ваш логин (электронная почта)
            'USER_HASH'=>$this->hash #Хэш для доступа к API (смотрите в профиле пользователя)
    ];
	$this->data = $user;
    $this->use_curl(TRUE);
    $code = $this->code;
    $out = $this->out;
    $code=(int)$code;
    $errors=[
      301=>'Moved permanently',
      400=>'Bad request',
      401=>'Unauthorized',
      403=>'Forbidden',
      404=>'Not found',
      500=>'Internal server error',
      502=>'Bad gateway',
      503=>'Service unavailable'
    ];
    try
    {
      #Если код ответа не равен 200 или 204 - возвращаем сообщение об ошибке
     if($code!=200 && $code!=204)
        throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error',$code);
    }
    catch(Exception $E)
    {
      die('Ошибка: '.$E->getMessage().PHP_EOL.'Код ошибки: '.$E->getCode());
    }
    /*
     Данные получаем в формате JSON, поэтому, для получения читаемых данных,
     нам придётся перевести ответ в формат, понятный PHP
     */
    $Response=json_decode($out,true);
    $this->resp = $Response;
    $Response=$Response['response'];
    if(isset($Response['auth'])) #Флаг авторизации доступен в свойстве "auth"
     return 'Авторизация прошла успешно';
    return 'Авторизация не удалась';
	}
	public function get_auth(){
		$this->authorized();
	}
}
$auth = new Auth($hash, $mail, $sd);
$auth->get_auth();


<?php
namespace App\Helper;
use App\Models\UserModel as UserModel;
class Auth
{
	public static $user;

	public function __construct(){

	}

	public static function login($model){
		$_SESSION['login'] = true;
		$_SESSION['user'] = $model;
	}

	public static function checkLogin()
	{
		return array_key_exists('login', $_SESSION) ? $_SESSION['login'] : false;
	}

	public static function logout(){
		$_SESSION['login'] = false;
		session_destroy();
	}

	public static function user(){
		$userId = array_key_exists('user', $_SESSION) ? $_SESSION['user'] : false;
        if ($userId){
            $userModel = new UserModel();
            $userModel = $userModel->where('id', $userId)
              ->select('*')
              ->getOne();

            return $userModel;
        }
	}

	public static function admin(){
		$user = $this->user();
		if ($user->role == 'admin') {
			return true;
		}

		return false;
	}
}
<?php
namespace App\Controller;
use App\Models\UserModel as UserModel;
use App\Helper\Auth as Auth;
class UsersController extends BaseController
{
	public function create($parameters){

		visit()->visited();
		
		$flashMessage = getFlash();
		return view('users.create',[
			'flashMessage' => $flashMessage
		]);
	}

	public function store($parameters){

		$db = Database::instance();

		$validate = validator([
			'required' => ['username', 'password', 'email'],
			'equal' => ['password' => 're_password'],
			'email' => ['email'],
			'unique' => ['users.username', 'users.email']
		]);

		if (!$validate->check()) {
			redirect(route('users', 'create'), ['errors' => $validate->getMessage()]);
			die();
		}

		$data = request()->all();
		$data['password'] = md5($data['password']);

		$userModel = new UserModel();
		$userModel->setData($data);
		$userModel->role = 'admin';
    	$userModel->create_at = date('Y-m-d', time());
    	$userModel->save();
    	redirect('login', ['success' => ['User created!, Login to continue']]);
    	die();
	}

	public function login()
	  {
	    $flashMessage = getFlash();
	    return view('users.login', [
	      'flashMessage' => $flashMessage
	    ]);
	  }

	public function postLogin(){

		$validate = validator([
			'required' => ['password', 'email']
		]);

		if (!$validate->check()) {
			redirect(route('users', 'login'), ['errors' => $validate->getMessage()]);
			die();
		}

		$userModel = new UserModel();

		$userData = $userModel->where('email', request()->get('email'))->select('*')
			->getOne();

		if (!array_key_exists('id', $userData)) {
			redirect(route('users', 'login'), ['errors' => ['User do not exists!']]);
      		die();
		}

		$password = md5(request()->get('password'));
		if ($password != $userData->password) {
	      redirect(route('users', 'login'), ['errors' => ['Wrong password!']]);
	      return;
	    }

	    Auth::login($userData->id);
	    $page = isset($_SESSION['current_page']) ? $_SESSION['current_page'] : '/';
	    redirect($page, ['success' => ['Login successfully']]);
	    die();
	}

	public function logout(){
		Auth::logout();
		redirect('/');
	}
}
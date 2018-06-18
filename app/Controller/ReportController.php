<?php
namespace App\Controller;
use App\Models\ReportModel as ReportModel;
use App\Helper\Auth as Auth;

class ReportController extends BaseController
{
	public function create($parameters){

		if(!Auth::user()){
			$target_dir = "views/users/login.php";
			$data['route'] = route('users', 'login');
			$tempalte = ajaxTemplate($target_dir)->dataTemplate();
			echo json_encode($tempalte);
			die();
		}

    	$data = request()->all();

    	$reportModel = new ReportModel();
    	
		$this->reported($reportModel, Auth::user()->id, $data['episode_id']);

		$target_dir = "views/report/create.php";

		$tempalte = ajaxTemplate($target_dir)->dataTemplate($data);

		echo json_encode($tempalte);
	}

	public function store($parameters){

		if(!Auth::user()){
			redirect(route('users', 'login'));
			die();
		}

		$data = request()->all();
		$data['user_id'] = Auth::user()->id;
		$data['create_at'] = date('Y-m-d H:i:s', time());

		$reportModel = new ReportModel();

		$this->reported($reportModel, $data['user_id'], $data['episode_id']);

		$reportModel->setData($data);
		$reportModel->save();

		$modal = "Đã nhận được thông báo lỗi.";

		echo json_encode($modal);

	}

	public function reported($reportModel, $user_id, $episode_id){

		$report = $reportModel->where('user_id', $user_id)
			->where('episode_id', $episode_id)
			->select('*')
			->getOne();

		if($report){
			$modal = "Đã nhận được thông báo lỗi.";
			echo json_encode($modal);
			die();
		}
	}
}
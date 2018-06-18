<?php 
namespace App\Controller\Admin;
use App\Models\ParticipantsModel as ParticipantsModel;
use App\Helper\Auth as Auth;
class ParticipantsController extends BaseController
{
	public function index(){
		$participantsModel = new ParticipantsModel();
		$participants = $participantsModel->select('*')
			->getMany();

		return view('admin.participants.index', ['participants' => $participants]);
	}

	public function create(){
		$flashMessage = getFlash();
		return view('admin.participants.create', [
			'flashMessage' => $flashMessage
		]);
	}

	public function store(){

		$validValue = '';
		$validKey = '';

		$file = !empty(request()->files('thumbnail')['name']) ? request()->files('thumbnail') : '';
		if(!empty($file)){
			$validValue = [implode(',', $file) => ['image']];
			$validKey = 'validateFile';
		}

		$validate = validator([
			'required' => ['aname', 'job', 'country'],
			$validKey => $validValue
		]);

		if (!$validate->check()) {
	      redirect(route('admin/participants', 'create'), ['errors' => $validate->getMessage()]);
	      die();
	    }

	    $data = request()->all();
	    $jobs = implode(', ', $data['job']);
	    $countries = implode(', ', $data['country']);
	    $aname = repairTextInput($data['aname']);
	    $jobs = repairTextInput($jobs);
	    $countries = repairTextInput($countries);
	    $data['aname'] = $aname;
	    $data['job'] = $jobs;
	    $data['country'] = $countries;

	    $participantsModel = new ParticipantsModel();

	    $upload = upload(request()->files('thumbnail'));
	    $upload = $upload->file();

	    if($upload == false && $file)
	    	redirect(route('admin/participants', 'create'), ['errors' => ['Sorry, File upload failed!']]);

	    $data['thumbnail'] = $upload;
	    $participantsModel->setData($data);
	    $participantsModel->save();
	    redirect(route('admin/participants', 'index'), ['success' => ['Success!']]);
	    die();
		
	}

	public function edit(){

		$id = request()->get('id');

		$participantsModel = new ParticipantsModel();
		$participant = $participantsModel->where('id', $id)
			->select('*')
			->getOne();
		$participant->job = explode(',', $participant->job);
		$participant->country = explode(',', $participant->country);

		return view('admin.participants.edit', ['participant' => $participant]);
	}


	public function update($parameters){

		$id = request()->get('id');;
		$validValue = '';
		$validKey = '';

		$participantsModel = new ParticipantsModel();

	    $participant = $participantsModel->where('id', $id)
	    	->select('*')
	    	->getOne();

		$file = !empty(request()->files('thumbnail')['name']) ? request()->files('thumbnail') : '';
		if(!empty($file)){
			$validValue = [implode(',', $file) => ['image']];
			$validKey = 'validateFile';
			unlink($participant->thumbnail);
		}

		$validate = validator([
			'required' => ['aname', 'job', 'country'],
			$validKey => $validValue
		]);

		$data = request()->all();
	    $jobs = implode(', ', $data['job']);
	    $countries = implode(', ', $data['country']);
	    $aname = repairTextInput($data['aname']);
	    $jobs = repairTextInput($jobs);
	    $countries = repairTextInput($countries);
	    $data['aname'] = $aname;
	    $data['job'] = $jobs;
	    $data['country'] = $countries;

	    $upload = upload(request()->files('thumbnail'));
	    $upload = $upload->file();

	    if($upload == false && $file)
	    	redirect(route('admin/participants', 'edit?id=' . $id), ['errors' => ['Sorry, File upload failed!']]);

	    $data['thumbnail'] = $upload;
	    if(!$file)
	    	unset($data['thumbnail']);


	    $participantsModel->setData($data);
	    $participantsModel->save();
	    redirect(route('admin/participants', 'index'), ['success' => ['Update Success!']]);
	    die();
	}

	public function destroy($param){

	      $param = isset($param) ? $param : '';
	      $participantsModel = new ParticipantsModel();
	      $participant = $participantsModel->where('id', $param[1])
	        ->select('*')
	        ->getOne();

	      if (!$participant){
	        redirect(route('admin/participant', 'index'),['errors'=> ['participant not found!!']]);
	        return;
	      }

	      if (Auth::user()->role != "admin"){
	        redirect('/', ['errors' => 'You cannot do this action!']);
	        return;
	      }

	      	unlink($participant->thumbnail);

	        $participantsModel->where('id', $participant->id)
	          ->delete();

	        redirect(route('admin/participants', 'index'),['success' => ['Delete '.$participant->aname.' success!!']]);

	        die();
	}
}

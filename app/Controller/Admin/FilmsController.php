<?php
namespace App\Controller\Admin;
use App\Models\FilmsModel as FilmsModel;
class FilmsController extends BaseController
{

	public function index($parameters){
		$filmsModel = new FilmsModel();
		$films = $filmsModel->select('*')
			->getMany();

		return view('admin.films.index', ['films' => $films]);
	}

	public function create($parameters)
	{
	    $flashMessage = getFlash();
	    return view('admin.films.create', [
	      'flashMessage' => $flashMessage
	    ]);
	}

	public function store($parameters){


		$validValue = '';
		$validKey = '';

		$file = !empty(request()->files('thumbnail')['name']) ? request()->files('thumbnail') : '';
		if(!empty($file)){
			$validValue = [implode(',', $file) => ['image']];
			$validKey = 'validateFile';
		}

		$validate = validator([
			'required' => ['fname', 'quality', 'type', 'genre'],
			$validKey => $validValue
		]);

		if (!$validate->check()) {
	      redirect(route('admin/films', 'create'), ['errors' => $validate->getMessage()]);
	      die();
	    }

	    $directors = repairTextInput(request()->get('directors'));

	    $user_id = Auth::user()->id;
	    $data = request()->all();

	    $actorsNRole = array_combine($data['actor'], $data['role']);
	    foreach ($actorsNRole as $actor => $role) {
	    	if(!empty($role)){
	    		$actors[] = $actor."|".$role;
	    	}else{
	    		$actors[] = $actor;
	    	}
	    }

	    $data['user_id'] = $user_id;
	    $directors = repairTextInput($data['directors']);
	    $fname = repairTextInput($data['fname']);
	    $genres = repairTextInput($data['genre']);
	    $countries = repairTextInput($data['nation']);

	    $data['fname'] = $fname;
	    $data['nation'] = $countries;
	    $data['genre'] = $genres;
	    $data['actor'] = $actors;
	    $data['directors'] = $directors;

	    $filmsModel = new FilmsModel();
	    $filmsModel->setData($data);

	    $upload = upload(request()->files('thumbnail'));
	    $upload = $upload->file();

	    if($upload == false && $file)
	    	redirect(route('admin/films', 'create'), ['errors' => ['Sorry, File upload failed!']]);

	    $data['thumbnail'] = $upload;
	    $filmsModel->setData($data);
	    $filmsModel->save();

	    redirect(route('admin/films', 'create'), ['success' => ['Success!']]);
	    die();

	}


	public function edit(){

		$id = request()->get('id');

		$filmsModel = new FilmsModel();
		$film = $filmsModel->where('id', $id)
			->select('*')
			->getOne();

		$film->directors = explode(',', $film->directors);
		$film->actor = explode(',', $film->actor);
		$film->country = explode(',', $film->nation);
		$film->genre = explode(',', $film->genre);

		return view('admin.films.edit', ['film' => $film]);
	}


	public function update($parameters){

		$id = request()->get('id');;
		$validValue = '';
		$validKey = '';

		$filmsModel = new FilmsModel();

	    $film = $filmsModel->where('id', $id)
	    	->select('*')
	    	->getOne();

		$file = !empty(request()->files('thumbnail')['name']) ? request()->files('thumbnail') : '';

		if(!empty($file)){
			$validValue = [implode(',', $file) => ['image']];
			$validKey = 'validateFile';
			unlink($film->thumbnail);
		}

		$validate = validator([
			'required' => ['fname', 'quality', 'type', 'genre'],
			$validKey => $validValue
		]);

		if (!$validate->check()) {
	      redirect(route('admin/films', 'create'), ['errors' => $validate->getMessage()]);
	      die();
	    }


	    $user_id = Auth::user()->id;
	    $data = request()->all();

	    $actorsNRole = array_combine($data['actor'], $data['role']);
	    foreach ($actorsNRole as $actor => $role) {
	    	if(!empty($role)){
	    		$actors[] = $actor."|".$role;
	    	}else{
	    		$actors[] = $actor;
	    	}
	    }

	    $data['user_id'] = $user_id;

	    $directors = repairTextInput($data['directors']);
	    $fname = repairTextInput($data['fname']);
	    $genres = repairTextInput($data['genre']);
	    $countries = repairTextInput($data['nation']);

	    $data['fname'] = $fname;
	    $data['nation'] = $countries;
	    $data['genre'] = $genres;
	    $data['actor'] = $actors;
	    $data['directors'] = $directors;

	    $filmsModel->setData($data);
	    $upload = upload(request()->files('thumbnail'));
	    $upload = $upload->file();

	    if($upload == false && $file)
	    	redirect(route('admin/films', 'edit?id=' . $id), ['errors' => ['Sorry, File upload failed!']]);

	    $data['thumbnail'] = $upload;

	    if(!$file)
	    	unset($data['thumbnail']);

	    $filmsModel->setData($data);
	    $filmsModel->save();

	    redirect(route('admin/films', 'index'), ['success' => ['Update Success!']]);
	    die();

	}

}

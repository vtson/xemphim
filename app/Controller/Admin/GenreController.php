<?php
namespace App\Controller\Admin;
use App\Models\GenreModel as GenreModel;
class GenreController extends BaseController
{

	public function index($parameters){

		$genreModel = new GenreModel();
		$genres = $genreModel->select('*')
		->getMany();

		return view('admin.genre.index', ['genres' => $genres]);
	}

	public function create($parameters)
	{
	    $flashMessage = getFlash();
	    return view('admin.genre.create', [
	      'flashMessage' => $flashMessage
	    ]);
	}

	public function store($parameters)
	{
		$validate = validator([
			'required' => ['genre']
		]);

		if (!$validate->check()) {
	      redirect(route('admin/genre', 'create'), ['errors' => $validate->getMessage()]);
	    	return;
    	}

    	$data = request()->all();
    	$genre = repairTextInput($data['genre']);
    	$vi_to_en = convert_vi_to_en($data['genre']);
    	$slug = slug($vi_to_en);
    	$data['slug'] = $slug;
    	$data['genre'] = $genre;
    	$genreModel = new GenreModel();
    	$genreModel->setData($data);
    	$genreModel->save();

    	redirect(route('admin/genre', 'create'), ['success' => ['Genre created!!!!!!']]);
    	die();
	}

	public function edit($parameters){

		$id = request()->get('id');

		$genreModel = new GenreModel();
		$genre = $genreModel->where('id', $id)
			->select('*')
			->getOne();

		return view('admin.genre.edit', ['genre' => $genre]);
	}

	public function update($parameters){

		$id = request()->get('id');;

		$validate = validator([
			'required' => ['genre']
		]);

		if (!$validate->check()) {
	      redirect(route('admin/genre', 'edit?id=' . $id), ['errors' => $validate->getMessage()]);
	    	return;
    	}
    	
    	$data = request()->all();
    	$genre = repairTextInput($data['genre']);
    	$vi_to_en = convert_vi_to_en($data['genre']);
    	$slug = slug($vi_to_en);
    	$data['slug'] = $slug;
    	$data['genre'] = $genre;

    	$genreModel = new GenreModel();
    	$genreModel->setData($data);
    	$genreModel->save();

    	redirect(route('admin/genre', 'index'), ['success' => ['Genre Update!!!!!!']]);
    	die();
	}

	  public function destroy($param){

	      $param = isset($param) ? $param : '';
	      $genreModel = new GenreModel();
	      $genre = $genreModel->where('id', $param[1])
	        ->select('*')
	        ->getOne();

	      if (!$genre){
	        redirect(route('admin/genre', 'index'),['errors'=> ['genre not found!!']]);
	        return;
	      }

	      if (Auth::user()->role != "admin"){
	        redirect('/', ['errors' => 'You cannot do this action!']);
	        return;
	      }

	        $genreModel->where('id', $genre->id)
	          ->delete();
	        unlink($file);
	        redirect(route('admin/genre', 'index'),['success' => ['Delete '.$genre->genre.' success!!']]);

	        die();
	}
      	
  }


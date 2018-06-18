<?php 
namespace App\Controller\Admin;
use App\Models\FilmsModel as FilmsModel;
use App\Models\EpisodeModel as EpisodeModel;
class EpisodeController extends BaseController
{

	public function create($parameters){

		$filmModel = new FilmsModel();
		$films = $filmModel->select('*')
			->getMany();
		return view('admin.episode.create',['films' => $films]);
	}

	public function store($parameters){
		$data = request()->all();

		$episodes = array_combine($data['econtent'], $data['ename']);

		$film_id = $data['film_id'];

		$episodeModel = new EpisodeModel();
		$i = 0;

		foreach ($episodes as $path => $title) {
			$i++;
			$episodeModel->ename = $title;
			$episodeModel->econtent = $path;
			$episodeModel->part = $i;
			$episodeModel->film_id = $film_id;

			$episodeModel->save();
		}

		die();
	}

	public function show($parameter){

		$film_id = isset($_GET['film_id']) ? $_GET['film_id'] : '';
		$episodeModel = new EpisodeModel();

		$episodes = $episodeModel->where('film_id', $film_id)
					->select('*')
					->getMany();

		if(!$episodes)
			die();

		return view('admin.episode.show',['episodes' => $episodes]);
	}

	public function edit($parameters){
		
		$film_id = isset($_GET['film_id']) ? $_GET['film_id'] : '';
		$episodeModel = new EpisodeModel();

		$episodes = $episodeModel->where('film_id', $film_id)
					->select('*')
					->getMany();

		if(!$episodes)
			die();

		return view('admin.episode.edit',['episodes' => $episodes]);
	}

	public function update($parameters){

	}

}
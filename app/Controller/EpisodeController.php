<?php
namespace App\Controller;
use App\Models\EpisodeModel as EpisodeModel;
use App\Models\FilmsModel as FilmsModel;
use App\Models\ViewModel as ViewModel;
class EpisodeController extends BaseController
{
	public function phim($parameters)
	{
		visit()->visited();

		$visit = visit()->get_visitor_ip();

		$part = 1;
		if(isset($_GET['tap']))
			$part = $_GET['tap'];

		$filmId = isset($_GET['id']) ? $_GET['id'] : '';

		$episodeModel = new EpisodeModel();
		$filmModel = new FilmsModel();

		$film = $filmModel->where('id', $filmId)
				->select('*')
				->getOne();

		$totalEpisode = $episodeModel->where('film_id', $film->id)
							->select('count(id) as total')
							->getOne();

		$film->total = $totalEpisode->total;

		if(empty($film)){
			redirect(route('home', 'index'));
			die();
		}

		$episode = $episodeModel->where('film_id', $filmId)
					->where('part', $part)
					->select('*')
					->getOne();

		if($episode)
			$this->views($visit, $episode->id);

		if(!$episode)
			$episode = "Phim đang cập nhật";

		$filmrandoms = $filmModel->sortRand()
					->select('*', 8)
					->getMany();

		return view('episode.show',['filmrandoms' => $filmrandoms, 'film' => $film, 'episode' => $episode]);
	}

	public function views($ip, $film_id){

		$viewModel = new ViewModel();

		$view = $viewModel->sortField('id', 'ASC')
					->where('ip', $ip)
					->where('film_id', $film_id)
					->select('*')
					->getOne();
		$time = 0;
		if(!empty($view))
			$time = strtotime($view->create_at);
		
		if((time() - $time) < 1800)
			return false;

		$viewModel->ip = $ip;
		$viewModel->film_id = $film_id;
		$viewModel->create_at = date('Y-m-d H:i:s', time());

		$viewModel->save();
	}
}
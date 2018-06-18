<?php
namespace App\Controller;
use App\Models\FilmsModel as FilmsModel;
class HomeController extends BaseController
{
	public function index($parameters){

		visit()->visited();

		$flashMessage = getFlash();

		$filmsModel = new FilmsModel();

		$frandoms = $filmsModel->sortRand()
			->select('*', 10)
			->getMany();

		$fmovies = $filmsModel->sortField('id', 'DESC')
			->where('type', 'movie')
			->select('*', 8)
			->getMany();

		$fseries = $filmsModel->sortField('id', 'DESC')
			->where('type', 'series')
			->select('*', 8)
			->getMany();

		$fcartoons = $filmsModel->sortField('id', 'DESC')
			->where('')
			->find_in_set('genre', 'Hoạt Hình')
			->select('*', 8)
			->getMany();

		return view('home.index',[
			'flashMessage' => $flashMessage,
			'frandoms' => $frandoms,
			'fmovies' => $fmovies,
			'fseries' => $fseries,
			'fcartoons' => $fcartoons
		]);
	}
}

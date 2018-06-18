<?php
namespace App\Controller;
use App\Models\FilmsModel as FilmsModel;
use App\Models\CountryModel as CountryModel;
use App\Models\GenreModel as GenreModel;
class FilmsController extends BaseController
{
	public function index($parameters){

		visit()->visited();

		switch ($parameters[0]) {
			case 'phim-le':
				$column = 'type';
				$value = 'movie';
				break;
			case 'nam-phat-hanh':
				$column = 'year';
				$value = isset($parameters[1]) ? $parameters[1] : '';
				if($value < 0){
					$column = 'year <';
					$value = str_replace('-', '', $value);
				}
				break;
			case 'phim-bo':
				$column = 'type';
				$value = 'series';
				break;		
			case 'the-loai':
				$column = 'genre';
				$value = isset($parameters[1]) ? $parameters[1] : '';
				break;
			case 'quoc-gia':
				$column = 'nation';
				$value = isset($parameters[1]) ? $parameters[1] : '';
				break;											
			default:
				$name = 'phim le';
				break;
		}

		$filmModel = new FilmsModel();
		$countryModel = new CountryModel();
		$genreModel = new GenreModel();

		if($column == 'genre'){
			$genre = $genreModel->where('slug', $value)
				->select('*')
				->getOne();

			$title = $genre->genre;

			$films = $filmModel->sortField('id', 'DESC')
				->find_in_set($column, $genre->genre)
				->select('*',20)
				->getMany();
		}elseif($column == 'nation'){
			$country = $countryModel->where('slug', $value)
						->select('*')
						->getOne();

			$title = $country->country;

			$films = $filmModel->sortField('id', 'DESC')
				->find_in_set($column,$country->country)
				->select('*',20)
				->getMany();

		}else{
			$films = $filmModel->sortField('id', 'DESC')
				->where($column, $value)
				->select('*',20)
				->getMany();

			$title = $value;
			if(isset(LANGUAGE[$value]))
				$title = LANGUAGE[$value];
		}

		$notification = $title;

		return view('film.index',['films' => $films, 'notification' => $notification]);
	}

	public function filter($parameters){

		visit()->visited();

		$data = request()->all();

		if(!isset($data['submit']))
			redirect(route('home', 'index'));
		$filmModel = new FilmsModel();
		$type = !empty($data['type']) ? 'type' : null;
		$genre = !empty($data['genre']) ? 'genre AND' : null;
		$nation = !empty($data['nation']) ? 'nation AND' : null;
		$year = null;
		if(!empty($data['year'])){
			$year = 'year';
			if($data['year'] < 0){
				$year = 'year <';
				$data['year'] = str_replace('-', '', $data['year']);
			}
		}
		$films = $filmModel->sortField('id', $data['sort'])
			->where($type, $data['type'])
			->where($year, $data['year'])
			->find_in_set($genre, $data['genre'])
			->find_in_set($nation, $data['nation'])
			->select('*',20)
			->getMany();

		unset($data['sort']);
		if(!empty($data['type']))
			$data['type'] = LANGUAGE[$data['type']];

		$notification = implode(' - ', array_filter($data));

		return view('film.index',['films' => $films, 'notification' => $notification]);
	}

	public function search($parameters){

		visit()->visited();

		$search = $_POST['search'];
		if(!isset($search))
			redirect(route('home', 'index'));
		
		$filmModel = new FilmsModel();

		$films = $filmModel->sql("SELECT * FROM films WHERE MATCH (fname,actor) AGAINST ('{$search}')")->getMany();

		$notification = "Kết quả tìm kiếm cho: " . $search;
		return view('film.index',['films' => $films, 'notification' => $notification]);
	}
}

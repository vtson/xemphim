<?php 
namespace App\Controller\Admin;
use App\Models\ParticipantsModel as ParticipantsModel;
use App\Models\GenreModel as GenreModel;
use App\Models\FilmsModel as FilmsModel;
use App\Models\EpisodeModel as EpisodeModel;
class CrawlController extends BaseController
{
	public function create($parameters){

		$filmModel = new FilmsModel();

		$films = $filmModel->select('*')
					->getMany();

		return view('admin.crawl.create',['films' => $films]);
	}

	public function store($parameters){
		die();
		if(!Auth::user()->role == 'admin')
			die();

		// $url = request()->get('url');

		// $url = getUrl($url);

		// if (strpos($url[0],'phimmoi') == false) {
		// 	redirect(route('admin/crawl', 'create'),['errors' => ['Enter url phimmoi.com']]);
		// 	die();
		// }

		$proxy = PROXY_CRAWN;

		$url = "http://www.phimmoi.net/phim-le/page-1.html";
		for($i=1; $i < 6; $i++){
			$url = "http://www.phimmoi.net/phim-le/page-".$i.".html";
			$get_data = crawl()->get_data($url, $proxy);

			$links = array_slice($this->link_films($get_data),0,30);

			foreach ($links as $link) {
				$link = 'http://www.phimmoi.net/phim/'. $link .'/';

				$get_data = crawl()->get_data($link, $proxy);

				$this->film($get_data);

				$this->practicipants($get_data);
			}
		}

		die();
	}

	public function store2($parameters){

		$data = request()->all();

		$get_data = crawl()->get_data($data['url'], PROXY_CRAWN);

		if (preg_match_all("/&quot;videoId&quot;:&quot;(.*?)&quot;,&quot;shortBylineText/", $get_data, $output_array)) {

			preg_match('/=(.*?)&/', $data['url'], $linkId);

			$youtubes[] = 'https://www.youtube.com/embed/'.$linkId[1];

			$array = array_unique($output_array[1]);

			foreach ($array as $item) {

				if (strpos($item, '&', 1)) {
					$item = substr($item, 0, strpos($item, '&', 1));
					
				}

				if (strpos($item, '\\', 1)) {
						$item = substr($item, 0, strpos($item, '\\', 1));
					}

				$youtubes[] = 'https://www.youtube.com/embed/'.$item;
			
			}

			$links = array_unique($youtubes);
			
		}

		if (preg_match_all("/playlistPanelVideoRenderer&quot;:{&quot;title&quot;:{&quot;simpleText&quot;:&quot;(.*?)&quot/", $get_data, $output_array)) {
				$titles = [];
				foreach ($output_array[1] as $item) {
					$titles[] = $item;
				}
			}

		$arrays = array_combine($titles, $links);
		$film_id = $data['film-id'];

		$episodeModel = new EpisodeModel();

		$i = 0;
	    foreach ($arrays as $title => $link) {
	    	$i++;
	    	$edata['ename'] = $title;
	    	$edata['econtent'] = $link;
	    	$edata['part'] = $i;
	    	$edata['film_id'] = $film_id;

	    	$episodeModel->setData($edata);
	    	$episodeModel->save();
	    }

	    die();

	}

	private function link_films($data)
	{
		if(preg_match_all("/href=&quot;phim\/([a-zA-Z0-9\/\*\-\.\_\/\\\\]*)\/&quot;/", $data, $links)){

			return $links[1];
		}
	}

	private function film($data){

		$filmModel = new FilmsModel();

		$films = $filmModel->select('fname')
			->getMany();

		$fdata = [];
		if(preg_match("/filmInfo.title=(.*?);/", $data, $name)){

			$fname = preg_replace("/[\:\?\-\'\)\(\\/]/", '', $name[1]);

			$fname = repairTextInput($fname);

			$vi_to_en = convert_vi_to_en($fname);

    		$slug = slug($vi_to_en);

    		foreach ($films as $film) {
    			if($film->fname == $fname)
    				return false;
    		}

			$fdata['fname'] = $fname;
			$fdata['slug'] = $slug;
		}

		if(preg_match_all("/Số tập/", $data, $name)){

		 	$fdata['type'] = 'series';
		 }

		$fdata['type'] = 'movie';

		if(preg_match("/http:\/\/image.phimmoi.net\/film\/+([0-9])+\/poster.medium.jpg/", $data, $name)){
			$path = $fdata['slug'].'.jpg';
			$loadfile = crawl()->download_file($name[0] , '/var/www/html/xemphim/storage/uploads/thumbnail/'.$path);
		 	$fdata['thumbnail'] = 'storage/uploads/thumbnail/' . $path;
		}

		preg_match("/dd-cat(.*)&lt;\/a&gt;&lt;\/dd&gt;/", $data, $genres1);

		preg_match_all("/title=&quot;(.*?)&quot;&gt;/", $genres1[0], $genres2);

		$genreModel = new GenreModel();
		$genres3 = $genreModel->select('*')
			->getMany();

		foreach ($genres3 as $genre) {
			$genres[] = $genre->genre;
		}

		$genres4 = [];
		foreach ($genres2[1] as $genre) {

			$xx = repairTextInput(preg_replace('/Phim /', '', $genre));

			if(in_array($xx, $genres))
				$genres4[] = $xx;
		}

		$genres = implode(',', $genres4);

		$fdata['genre'] = $genres;

		if(preg_match_all("/title=&quot;(.*?)&quot;&gt;/", $data, $names1)){
			foreach ($names1[1] as $name) {
				if(strpos($name,'trong vai')){
					$names[] = preg_replace('/ trong vai /', '|', $name);
				}
			}
			if(isset($names))
				$fdata['actor'] = implode(',', $names);
		}

		if(preg_match("/director&quot;&gt;(.*?)&quot;&gt;/", $data, $director1)){
			
			preg_match("/title=&quot;(.*?)&quot;&gt;/", $director1[0], $director2);
			if(!empty($director2))
				$fdata['directors'] = $director2[1];
		}

		if(preg_match("/class=&quot;country&quot;(.*?)&lt;/", $data, $country1)){

			if(preg_match("/&quot;&gt;(.*?)&lt;/", $country1[0], $country))
				$fdata['nation'] = $country[1];
		}

		if(preg_match('/title-year&quot;&gt;(.*?)&lt;/', $data, $year1)){
			$year = preg_replace('/[\)\(\ ]/', '', $year1[1]);
			$fdata['year'] = $year;
		}

		$fdata['user_id'] = Auth::user()->id;

		$filmModel->setData($fdata);

		$filmModel->save();

		unset($fdata);

	}

	private function practicipants($data){

		$practicipantsModel = new ParticipantsModel();
		$practicipants = $practicipantsModel->select('aname')->getMany();

		if(preg_match_all('/actor-profile-item&quot; href=&quot;(.*?)&quot;/', $data, $plinks)){

			foreach ($plinks[1] as $link) {
				$pdata['job'] = 'Actor';
				$link = 'http://www.phimmoi.net/'. $link;
				$get_data = crawl()->get_data($link, PROXY_CRAWN);

				if(preg_match('/&quot;title-1&quot;&gt;(.*?)&lt;/', $get_data, $aname))
					$pdata['aname'] = $aname[1];

				foreach ($practicipants as $practicipant) {
					if($practicipant->aname == $aname[1])
							return false;
				}

				$vi_to_en = convert_vi_to_en($pdata['aname']);

    			$slug = slug($vi_to_en);

				if(preg_match('/Chiều cao(.*?)cm&lt;/', $get_data, $height1))
					if(preg_match('/[0-9]+/', $height1[0], $height))
						$pdata['height'] = $height[0];

				if(preg_match('/Quốc gia:&lt;\/dt&gt;&lt;dd class=&quot;movie-dd&quot;&gt;(.*?)&lt;\/dd&gt;/', $get_data, $country)){
					if($country[1] != 'Chưa có thông tin')
						$pdata['country'] = $country[1];
				}

				$pdata['thumbnail'] = '';

				if(preg_match("/content=&quot;http:\/\/image.phimmoi.net\/profile\/+([0-9])+\/medium.jpg/", $get_data, $name)){

					$image = strstr($name[0],'h');

					$path = $slug .'.jpg';
					$loadfile = crawl()->download_file($image , '/var/www/html/xemphim/storage/uploads/thumbnail/'.$path);
				 	$pdata['thumbnail'] = 'storage/uploads/thumbnail/' . $path;
			 	}
			 	
			 	$practicipantsModel->setData($pdata);

			 	$practicipantsModel->save();

			 	unset($pdata);
			 	unset($link);
			}
			
		}elseif(preg_match_all('/&quot;director&quot; href=&quot;(.*?)&quot;/', $data, $plinks)){

				foreach ($plinks[1] as $link) {
				$pdata['job'] = 'Directors';
				$link = 'http://www.phimmoi.net/'. $link;
				$get_data = crawl()->get_data($link, PROXY_CRAWN);

				if(preg_match('/title-1&quot;&gt;(.*?)&lt;/', $get_data, $aname))

					$pdata['aname'] = $aname[1];

				foreach ($practicipants as $practicipant) {
					if($practicipant->aname == $aname[1])
							return false;
				}

				$vi_to_en = convert_vi_to_en($pdata['aname']);
    			$slug = slug($vi_to_en);

				if(preg_match('/Chiều cao(.*?)cm&lt;/', $get_data, $height1))
					if(preg_match('/[0-9]+/', $height1[0], $height))
						$pdata['height'] = $height[0];

				if(preg_match('/Quốc gia:&lt;\/dt&gt;&lt;dd class=&quot;movie-dd&quot;&gt;(.*?)&lt;\/dd&gt;/', $get_data, $country)){
					if($country[1] != 'Chưa có thông tin')
						$pdata['country'] = $country[1];
				}

				if(preg_match("/content=&quot;http:\/\/image.phimmoi.net\/profile\/+([0-9])+\/medium.jpg/", $get_data, $name)){

					$image = strstr($name[0],'h');

					$path = $slug .'.jpg';
					$loadfile = crawl()->download_file($image , '/var/www/html/xemphim/storage/uploads/thumbnail/'.$path);
				 	$pdata['thumbnail'] = 'storage/uploads/thumbnail/' . $path;
			 	}
			 	
			 	$practicipantsModel->setData($pdata);

			 	$practicipantsModel->save();

			 	unset($pdata);
			 	unset($pdata);
			}
		}

	}
}
<?php
namespace App\Controller\Admin;
use App\Models\CountryModel as CountryModel;
class CountryController extends BaseController
{

	public function index($parameters){

		$countryModel = new CountryModel();
		$countrys = $countryModel->select('*')
		->getMany();

		return view('admin.country.index', ['countrys' => $countrys]);
	}

	public function create($parameters)
	{
	    $flashMessage = getFlash();
	    return view('admin.country.create', [
	      'flashMessage' => $flashMessage
	    ]);
	}

	public function store($parameters)
	{
		$validate = validator([
			'required' => ['country']
		]);

		if (!$validate->check()) {
	      redirect(route('admin/country', 'create'), ['errors' => $validate->getMessage()]);
	    	return;
    	}

    	$data = request()->all();
    	$vi_to_en = convert_vi_to_en($data['country']);
    	$slug = slug($vi_to_en);
    	$data['slug'] = $slug;

    	$genreModel = new CountryModel();
    	$genreModel->setData($data);
    	$genreModel->save();

    	redirect(route('admin/country', 'create'), ['success' => ['country created!!!!!!']]);
    	die();
	}

		public function edit($parameters){

		$id = request()->get('id');

		$countryModel = new CountryModel();
		$country = $countryModel->where('id', $id)
			->select('*')
			->getOne();

		return view('admin.country.edit', ['country' => $country]);
	}

	public function update($parameters){

		$id = request()->get('id');;

		$validate = validator([
			'required' => ['country']
		]);

		if (!$validate->check()) {
	      redirect(route('admin/country', 'edit?id=' . $id), ['errors' => $validate->getMessage()]);
	    	return;
    	}

    	$data = request()->all();
    	
		$vi_to_en = convert_vi_to_en($data['country']);
    	$slug = slug($vi_to_en);
    	$data['slug'] = $slug;

    	$countryModel = new CountryModel();
    	$countryModel->setData($data);
    	$countryModel->save();

    	redirect(route('admin/country', 'index'), ['success' => ['Genre Update!!!!!!']]);
    	die();
	}

	  public function destroy($param){

	      $param = isset($param) ? $param : '';
	      $countryModel = new CountryModel();
	      $country = $countryModel->where('id', $param[1])
	        ->select('*')
	        ->getOne();

	      if (!$country){
	        redirect(route('admin/country', 'index'),['errors'=> ['country not found!!']]);
	        return;
	      }

	      if (Auth::user()->role != "admin"){
	        redirect('/', ['errors' => 'You cannot do this action!']);
	        return;
	      }

	        $countryModel->where('id', $country->id)
	          ->delete();
	        unlink($file);
	        redirect(route('admin/country', 'index'),['success' => ['Delete '.$country->genre.' success!!']]);

	        die();
	}
}

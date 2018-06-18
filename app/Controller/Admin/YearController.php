<?php
namespace App\Controller\Admin;
use App\Models\YearModel as YearModel;
class YearController extends BaseController
{

	public function index($parameters){

		$yearModel = new YearModel();
		$years = $yearModel->select('*')
		->getMany();

		return view('admin.year.index', ['years' => $years]);
	}


	public function create($parameters)
	{
	    $flashMessage = getFlash();
	    return view('admin.year.create', [
	      'flashMessage' => $flashMessage
	    ]);
	}


	public function store($parameters)
	{
		$validate = validator([
			'required' => ['year']
		]);

		if (!$validate->check()) {
	      redirect(route('admin/year', 'create'), ['errors' => $validate->getMessage()]);
	    	return;
    	}

    	$data = request()->all();

    	$yearModel = new YearModel();
    	$yearModel->setData($data);
    	$yearModel->save();

    	redirect(route('admin/year', 'create'), ['success' => ['year created!!!!!!']]);
    	die();
	}

	public function edit($parameters){

		$id = request()->get('id');

		$yearModel = new YearModel();
		$year = $yearModel->where('id', $id)
			->select('*')
			->getOne();

		return view('admin.year.edit', ['year' => $year]);
	}

	public function update($parameters){

		$id = request()->get('id');;

		$validate = validator([
			'required' => ['year']
		]);

		if (!$validate->check()) {
	      redirect(route('admin/year', 'edit?id=' . $id), ['errors' => $validate->getMessage()]);
	    	return;
    	}

    	$yearModel = new YearModel();
    	$yearModel->setData(request()->all());
    	$yearModel->save();

    	redirect(route('admin/year', 'index'), ['success' => ['Genre Update!!!!!!']]);
    	die();
	}

	  public function destroy($param){

	      $param = isset($param) ? $param : '';
	      $yearModel = new YearModel();
	      $year = $yearModel->where('id', $param[1])
	        ->select('*')
	        ->getOne();

	      if (!$year){
	        redirect(route('admin/year', 'index'),['errors'=> ['year not found!!']]);
	        return;
	      }

	      if (Auth::user()->role != "admin"){
	        redirect('/', ['errors' => 'You cannot do this action!']);
	        return;
	      }

	        $yearModel->where('id', $year->id)
	          ->delete();
	        unlink($file);
	        redirect(route('admin/year', 'index'),['success' => ['Delete '.$year->genre.' success!!']]);

	        die();
	}
}

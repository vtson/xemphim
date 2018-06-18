<?php 
namespace App\Controller\Admin;
class DashboardController extends BaseController
{
	public function index(){
		return view('admin.dashboard');
	}
}
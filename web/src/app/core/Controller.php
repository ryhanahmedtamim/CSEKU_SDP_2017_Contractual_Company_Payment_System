<?php 

/**
* 
*/
class Controller
{
	 
	 public function model($model)
	 {
	
	 	require_once '../app/models/'. $model .'.php';
	 	return new $model();

	 }

	 public function view($view, $data = [], $id = [])
	 {
	 	require_once '../app/views/'.$view.'.php';
	 }

	 //public function view($view,$data)
	
}


 ?>
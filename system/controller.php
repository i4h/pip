<?php

class Controller {
	
	public $action;
	
	public function loadModel($name)
	{
		require_once(APP_DIR .'models/'. strtolower($name) .'.php');

		$model = new $name;
		$model->controller = $this;
		return $model;
	}
	
	public static function loadModelStatic($name)
	{
		require_once(APP_DIR .'models/'. strtolower($name) .'.php');
	}	
	
	public function loadView($name)
	{
		$view = new View($name);
		return $view;
	}
	
	public function loadPlugin($name)
	{
		require(APP_DIR .'plugins/'. strtolower($name) .'.php');
	}
	
	public function loadHelper($name)
	{
		require(APP_DIR .'helpers/'. strtolower($name) .'.php');
		$helper = new $name;
		return $helper;
	}
	
	public function redirect($loc)
	{
		global $config;
		
		header('Location: '. $config['base_url'] . $loc);
	}
    

	public function beforeAction()
	{
	}
}

?>
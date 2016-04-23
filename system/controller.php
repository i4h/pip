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
		global $app;
		/* Look for a localized version of view */
		if (!$app['translator']->isUsingSourceLanguage()) {
			if (file_exists(APP_DIR .'views/'. $name .'_'.$app['translator']->getLanguage().'.php'))
				$name = $name.'_'.$app['translator']->getLanguage();
		}

		$view = new View($name);
		if (isset($app['translator']))
			$view->set('t', $app['translator']);
		if (isset($app['themeManager']))
			$view->set('tm', $app['themeManager']);
		if (isset($app['urlManager']))
			$view->set('um', $app['urlManager']);

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
		global $app;
		$app['urlManager'] = $this->loadHelper('urlManager');

		$app['translator'] = $this->loadHelper('translator');
		$app['themeManager'] = $this->loadHelper('thememanager');
	}
}

?>
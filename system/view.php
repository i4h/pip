<?php

class View {

	private $pageVars = array();
	private $template;

	public function __construct($template)
	{
		$this->template = APP_DIR .'views/'. $template .'.php';
	}

	public function set($var, $val = null)
	{

		if (is_array($var)) {
			foreach($var as $name=>$val)
				$this->pageVars[$name] = $val;
		} else if ($val === null)
			throw new Exception("View::set called without array and without val");
		else
			$this->pageVars[$var] = $val;
	}

	public function render()
	{
		extract($this->pageVars);

		ob_start();
		require($this->template);
		echo ob_get_clean();
	}
    
}

?>
<?php

class ThemeManager {

	const DEFAULT_THEME = "default";
	private $theme;

	public function __construct()
	{
		global $config;
		$this->theme = self::DEFAULT_THEME;

		if (isset($config['theme']))
			$this->theme = $config['theme'];

	}

	public function setTheme($theme) {
		$this->theme = $theme;
	}

	public function getThemeCssFile() {
		return BASE_URL.'static/css/main_'.$this->theme.'.css';
		return $this->language;
	}



}

?>
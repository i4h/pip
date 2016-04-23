<?php

class Translator {

	const SOURCE_LANGUAGE = "en";
	private $language;
	private $dictionary = null;

	public function __construct()
	{
		global $config;
		$this->language = $config['default_language'];
	}

	public function getLanguages() {
		return [
				self::SOURCE_LANGUAGE,
		];
	}

	public function setLanguage($language) {

		if ($language !== null)
			$this->language = $language;

		if ($this->language != self::SOURCE_LANGUAGE)
			$this->loadDictionary();
	}

	public function getLanguage() {
		return $this->language;
	}


	public function isUsingSourceLanguage() {
		return $this->language == self::SOURCE_LANGUAGE;
	}

	public function t($text, $params = []) {
		if ($this->language == "en" && count($params) == 0)
			return $text;
		else {
			return $this->translate($text, $params);
		}
	}

	public function translate($text, $params) {
		if ($this->language != self::SOURCE_LANGUAGE) {
			if (isset($this->dictionary[$text]))
				$text = $this->dictionary[$text];
		}

		foreach ($params as $name=>$val) {
			$text = str_replace('{'.$name.'}', $val, $text);
		}
		return $text;
	}

	public function loadDictionary() {
		$this->dictionary = require_once(ROOT_DIR.'application/i8n/dictionary_'.$this->language.'.php');
	}

}

?>
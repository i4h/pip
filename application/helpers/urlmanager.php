<?php

class UrlManager {

	public $defaultParams = [];

	public function link($text, $controller, $action, $params = []) {
		$params = $params + $this->defaultParams;
		foreach($params as &$param)
			$param = urlencode($param);
		$paramsString = implode('/',$params);
		return '<a href="'.BASE_URL.$controller.'/'.$action.'/'.$paramsString.'">'.$text.'</a>';
	}

}

?>
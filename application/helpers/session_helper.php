<?php

class Session_helper {

	const KEY = 'applicationkey_xyz';

	function set($key, $val)
	{
		if (!isset($_SESSION[self::KEY]))
			$_SESSION[self::KEY] = [];
		$_SESSION[self::KEY]["$key"] = $val;
	}

	function get($key, $default = null)
	{
		if (!isset($_SESSION[self::KEY]))
			$_SESSION[self::KEY] = [];

		return isset($_SESSION[self::KEY]["$key"]) ? $_SESSION[self::KEY]["$key"] : $default;
	}

	function destroy()
	{
		session_destroy();
	}

}

?>
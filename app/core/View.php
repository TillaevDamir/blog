<?php 

namespace app\core;

class View
{
	protected $path;
	protected $route;
	protected $layout = 'default';

	public function __construct($route)
	{
		$this->route = $route;
		$this->path = $route['controller'].'/'.$route['action'];
	}

	public function render($title, $vars = [])
	{
		extract($vars);
		$path = 'app/views/'.$this->path.'.php';
		if(file_exists($path))
		{
			ob_start();
			require $path;
			$content = ob_get_clean();
			require 'app/view/layouts/'.$this->layout.'.php';
		}
	}

	public function redirect($url)
	{
		header('Location: /'.$url);
		exit;
	}

	public function errorCode($code)
	{
		http_response_code($code);
		$path = 'app/view/errors/'.$code.'.php';
		if(file_exists($path))
		{
			require $path;
		}
		exit;
	}

	public function message($status, $message)
	{
		exit(json_encode(['status' => $status, 'message' => $message]));
	}

	public function location($url)
	{
		exit(json_encode(['url'=>$url]));
	}
}
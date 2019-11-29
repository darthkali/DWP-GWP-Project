<?php


namespace FSR_AI;


class Controller
{
	private $_actionName = null;
	private $_controllerName = null;

	protected $_params = [];

public function __construct($actionName = null, $controllerName = null)
	{
		$this->_actionName = $actionName;
		$this->_controllerName = $controllerName;
	}

	public function renderHTML()
	{
		$viewPath = $this->viewPath($this->_actionName, $this->_controllerName);


		if(file_exists($viewPath))
		{
			extract($this->_params);
			
			$body = '';

			ob_start();
			{
				include $viewPath;
			}
			$body = ob_get_clean();

			if(isset($noLayout) && $noLayout === true)
			{
				echo $body;
			}
			else
			{
				include __DIR__.'/../views/layout.php';
			}
		}
		else
		{
		    echo $viewPath;
			//header('Location: index.php?c=pages&a=error404');
		}
	}

	protected function viewPath($actionName = null, $controllerName = null)
	{
		return __DIR__ . '/../views/pages/' .$actionName.'.php';
	}
}
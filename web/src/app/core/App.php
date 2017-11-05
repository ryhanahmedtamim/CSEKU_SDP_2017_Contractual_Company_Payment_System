<?php 
/**
* 
*/
class App 
{
	protected $databaseName = [];
	protected $controller = 'homecontroller';
    protected $methode = 'index';
    protected $paramiters = [];


	public function __construct($databaseName1 =[] )
	{
		$url = $this->perseUrl();

		//print_r($url);
		$this->databaseName = $databaseName1;


		if(file_exists('../app/controllers/'. $url[0] .'controller.php'))
		{
			$this->controller = $url[0].'controller';
			unset($url[0]);

		}
		require_once '../app/controllers/'. $this->controller .'.php';

		$this->controller = new $this->controller;

		if(isset($url[1]))
		{
			if(method_exists($this->controller, $url[1]))
			{
				$this->methode = $url[1];
				unset($url[1]);
			}
		}

		$this->paramiters = $this->databaseName;
		//echo $this->databaseName;
		$_paramiters = $url ? array_values($url) : [] ;
		
		
			$this->paramiters = array_merge($this->paramiters,$_paramiters);
		
		

		call_user_func_array([$this->controller, $this->methode],$this->paramiters);

	}

	public function perseUrl()
	{
		if(isset($_GET['url']))
		{
			return $url = explode('/' ,filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}
	}


}

 ?>
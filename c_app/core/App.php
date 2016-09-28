<?php
class App{
	protected $controller="";
	protected $method ="index";
	protected $params = array();

	public function __construct(){

		$url=$this->parseUrl();
        
        $dirlocation="http://".$_SERVER['HTTP_HOST']."/collegemobile/";
		if(file_exists("c_app/controllers/".$url[0].".php")){
            
			$this->controller=$url[0];
		}
        else{
            if($url[0]!=''){
                           
            $this->controller='pages';    
        
            
            }
			
            else{
             $this->controller='home';       
            }

            
        }
        
        
        
		//unset($url[0]);
		require_once('c_app/controllers/'.$this->controller.'.php');
      
		$this->controller = new $this->controller($url,$dirlocation);
        
        ////// If the url contains a method
		if(isset($url[1])){
			if(method_exists($this->controller, $url[1])){
				$this->method=$url[1];
				
			}
		unset($url[1]);	

		}	
		
        
		$this->params =$url ? array_values($url) : array();
		call_user_func_array(array($this->controller,$this->method), $this->params);
	}


	public function parseUrl(){

		if(isset($_GET['url'])){
			return $url=explode('/',filter_var(rtrim($_GET['url'],'/'), FILTER_SANITIZE_URL));

		}
	}
}


?>

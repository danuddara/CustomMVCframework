<?php

/*
 * @project = "iOnexa";
 * @author = "Four Corners Lanka(Pvt) Ltd";
 * @version = 0.1;
 * @date  = "03/06/2013";
 * @class = "router class";
 * 
 *  The routing page of the index.php?rt= Controller/Action
 */

class Router
{
   /* Register object will be passed to each controller*/ 
    private $registry;
    
    /*
     * controller path;
     */
    
    private $path;
    
    /*file path*/
    private $file;
   
    /*contoller path*/
    private $controller;
    
    /*contoller view*/
    private $action;
    
    /*
     * @param registry
     * regitry have to be passsed in order to get the relavant object.
     */
    public function __construct($registry) 
    {
        $this->registry = $registry;
    }
    
    
    /**
 *
 * @set controller directory path
 *
 * @param string $path
 *
 * @return void
 * 
    *** set the path to the controllers directory set in index.php***
        $router->setPath (__SITE_PATH . 'controllers');
 */
    
public function setPath($path) 
    {

	/*** check if path i sa directory ***/
	if (is_dir($path) == false)
	{
		throw new Exception ('Invalid controller path: `' . $path . '`');
	}
	/*** set the path ***/
 	$this->path = $path;
    }

    
    
    /*
     * Load the controller
     * 
     * @access public 
     * @return void
     */
    public function loader()
    {
        
        /* check the route */
        $this->getController();
        
        /* if the file is not there die with a 404 error*/
        if(is_readable($this->file)==false)
        {
            $this->file = $this->path. '/error404.php';
            $this->controller = 'error404'; // the name of the Controller
            
        }
        
        /******include the controller******** */
        include $this->file;
        
        
        /****** the controller new instance *****/
        
        $class = $this->controller.'Controller' ; 
        
        $controller = new $class($this->registry);
        
        /**check if the action is callable**** direct access to the method call**chek this again*/
        
        if (is_callable(array($controller, $this->action)) == false)
	{
		$action = 'index';
	}
	else
	{
		$action = $this->action;
	}
	/*** run the action int the controller class**
         *  might be extended to pass the query Strigs/ Alias**
         * 
         * @param No paramerters Yet
         ***/
	$controller->$action();
    }
    
    
    /**
     *  get controller from URL index.php?rt= Controller/Action
     * 
     * have to extend the function to filter and Pass the query strings to the methods
     * 
     * @rt= Controller/Action is Passed from the URL 
     * -- Use another paramerters to avoid the conflict
     */
    private function getController()
    {
        /*** get the route from the url Controller/Action ***/
	$route = (empty($_GET['rt'])) ? '' : $_GET['rt'];
        
        if (empty($route))
	{
		$route = 'index'; /* the controller classes will have to overide this abstract method*/
	}
        else 
        {
            
            /*** get the parts of the route separated by a ('/')
             * !Note:don't use any ('/') when passsing arguments 
             *  ***/
            
		$parts = explode('/', $route);
		$this->controller = $parts[0]; /*controller is the first part,set controller*/
		if(isset( $parts[1]))
		{
			$this->action = $parts[1];/* action would be the second part. set action*/
		}
        }
        /*set default page of the controller and the action*/
        if (empty($this->controller))
	{
		$this->controller = 'index';
	}

	/*** set action ***/
	if (empty($this->action))
	{
		$this->action = 'index';
	}

	/*** set the file path ***/
        /*
         * The name of the file should be saved in proper naming conventions in this module
         * a controller would be having Controller after its name
         * ex:indexController.php
         * 
         */
	$this->file = $this->path .'/'. $this->controller . 'Controller.php'; 
    }
}

?>

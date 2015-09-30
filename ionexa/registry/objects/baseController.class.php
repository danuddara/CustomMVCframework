<?php

/*
 * @project = "iOnexa";
 * @author = "Four Corners Lanka(Pvt) Ltd";
 * @version = 0.1;
 * @de  = "03/06/2013";
 * @class = "baseController class";
 * ate  = "03/06/2013";
 * @class = "baseController class";
 * 
 *  the abstract class of controller
 */


abstract class baseController
{
    /*
     * registry object has alot of work to do in here
     */
    
    protected $registry;
    protected $authenticate = array();
    
    /*
     * set the registry object on initial state
     */
    
    public function __construct($registry) 
    {
        $this->registry = $registry;
        
    }
    
    /*
     *  all controllers must have an abstract method
     * the default page load
     * 
     * The default action on any controller is the index(), 
     
     * 
     */
    
    
    abstract function index();
    
    /*
     * the controllers must have a buildpage function
     * 
     * Please build the full template this action.
     * pass all the templates in Order to build the full template
     * others can be use to load bits of templates.
     */
    abstract function buildpage();
    
    
}


?>

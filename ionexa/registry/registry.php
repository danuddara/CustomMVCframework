<?php

/*
 * @project = "iOnexa";
 * @author = "Four Corners Lanka(Pvt) Ltd";
 * @version = 0.1;
 * @date  = "04/06/2013";
 * @class = "Registry Class";
 * 
 * Resgistry implements the registry and singleton patterns
 * 
 */
class Registry
{
    /*
     * singleton registry object
     */
    private static  $registry;
    
    private $framework = "iOnexa framework 0.1";
    /*
     * core objects 
     */
    private static $objects = array(); 
    /*
     *  settings 
     */
    private static $settings = array();
    
    private function __construct()
    {
        
    }
    /*Loading the core objects*/
    public function storeCoreObjects()
	{
		$this->storeObject('dbclass', 'db' );
		$this->storeObject('template', 'template' );
                $this->storeObject('router', 'router');
                $this->storeObject('baseController','baseController');
                $this->storeObject('baseController','baseController');
                $this->storeObject('dbObject', 'dbObject');
                $this->storeObject('messageAlert', 'messageAlert');
	}
    /*static method for singleton registry object */
    public static function getRegistry()
    {
        if(self::$registry==null)
        {
            $obj = __CLASS__; // accessing the same class
            self::$registry = new $obj ;
          
        }
        
        return self::$registry;
    }
    /**
     * prevent cloning of the object: issues an E_USER_ERROR if this is attempted
     */
	public function __clone()
	{
		trigger_error( 'Cloning the registry is not permitted', E_USER_ERROR );
	}
    
       	/**
	 * Stores an object in the registry
	 * @param String $object the name of the object
	 * @param String $key the key for the array
	 * @return void
	 */
	public function storeObject( $object, $key )
	{
		require_once('objects/' . $object . '.class.php');
                
                 
                if($object=='dbclass') // change the name if you change the db file name in the registry/objects/
                {
                    self::$objects[ $key ] = DBClass::getconnection();// singleton implementation
                }
                
                else if($object=='baseController' || $object=='dbObject' ){/*this is abstract class,it cannot be initiate*/}
                 else   
                 {
                     self::$objects[ $key ] = new $object( self::$registry ); // create other objects which are non singleton
                 }
	}
        
       /**
	 * Gets an object from the registry
	 * @param String $key the array key
	 * @return object
	 */
	public function getObject( $key )
	{
		if( is_object ( self::$objects[ $key ] ) )
		{
			return self::$objects[ $key ];
		}
	}
	
	/**
	 * Stores settings in the registry
	 * @param String $data
	 * @param String $key the key for the array
	 * @return void
	 */
	public function storeSetting( $data, $key )
	{
		self::$settings[ $key ] = $data;
	}
	
	/**
	 * Gets a setting from the registry
	 * @param String $key the key in the array
	 * @return void
	 */
	public function getSetting( $key )
	{
		return self::$settings[ $key ];
	}
	
	/**
	 * Gets the frameworks name
	 * @return String
	 */
	public function getFrameworkName()
	{
		return self::$framework;
	}
}



?>

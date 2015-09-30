<?php
/*
 * @project = "iOnexa";
 * @author = "Four Corners Lanka(Pvt) Ltd";
 * @version = 0.1;
 * @date  = "03/06/2013";
 * @class = "config Class";
 * The configurations of Database class of ionexa framework.
 * 
 * Singleton design Pattern have been used to make sure it returns the same object
 */
class Config 
{
    private static  $config; // singleton object
    
    private $host ; 
    private $username ; 
    private $password ; 
    private $db;
    
    
    private function __construct() { // setting up the connection details at the initial step
        
        $this->setKeys();
    }
    public static function  getConfig() // return no duplicates, get singleton value
    {
        
        if(config::$config == null)
        {
            self::$config = new config(); 
        }
        return self::$config;
    }
    
    public static function getKeys($key) // return Keys for the connection
    {
       return self::$config->$key;
    }
    
    private function setKeys()
    {
        
        $this->host = "Localhost";
        $this->username = "nchost5";
        $this->password = "FC!H0s1in@";
        $this->db = "nchost5_ionexadb";
    }
    
    
}


?>

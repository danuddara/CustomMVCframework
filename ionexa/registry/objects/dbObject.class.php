<?php
/*
 * @project = "iOnexa";
 * @author = "Four Corners Lanka(Pvt) Ltd";
 * @version = 0.1;
 * @date  = "03/06/2013";
 * @class = "DBObject";
 * The DataBase class of ionexa framework.
 * 
 */

abstract class DBObject
{
    protected $registry;
    protected $coloums;
    protected $table;
  
    
    public function __construct($registry) 
    {
         $this->registry = $registry;
    }
    
    public function lastinserted()
    {
         $db = $this->registry->getObject('db');
         return $db->lastinserted(); 
    }
    
    
}
?>

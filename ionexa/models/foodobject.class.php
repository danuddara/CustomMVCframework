<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class FoodObject extends DBObject
{
     public function __construct($registry) {
      
        parent::__construct($registry);
        
        
          $this->table = 'favouritefood';

            $this->columns = array(
                                ':Id'=>NULL,
                                ':UserId'=>NULL,
                                ':Name'=>NULL,
                                ':Description'=>NULL,
                                    );
        
        }
        
     public function checkFood($uid)
        {
          $db = $this->registry->getObject('db');
          $sql = 'SELECT `id`,`UserId`,`Name`,`Description` FROM favouritefood WHERE UserId='.$uid; // next time don't use from to dedine a coloum name
          $rows=$db->select($sql);
          return $rows;
        } 
        
    public function addFood($name='',$Description='',$userid='')
    {
         $suc=false;
         $db = $this->registry->getObject('db');
         $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
         $coloums[':UserId']=$userid;
         $coloums[':Name']=$name;
         $coloums[':Description']=$Description;
         
         $suc=$db->InsertRecords($this->table,  $coloums);
         return $suc;
    }
    
    public function updateFood($name=null,$Description=null,$whereid=null)
    {
        $suc=false;
             $db = $this->registry->getObject('db');
             $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
             
             
                 $coloums[':Name']=$name;
                 $coloums[':Description']=$Description;
             
             $values = $this->prepareforupdate($coloums);
                $values['Id']=$whereid; //condition    
                    //print_r($values);
                if($values!=NULL)
                {
                $suc=$db->updateRecords($this->table,$values);
                }
                return $suc;
    }
    
    private function prepareforupdate($columns)
        {
            $values = array();
            
            foreach($columns as $key => $value)
        
                    {
                        if($value!=null)
                        {
                            $values[preg_replace('/:/','' , $key)] = $value;
                        }
                    }
            
            return $values;
        }
        
}
?>
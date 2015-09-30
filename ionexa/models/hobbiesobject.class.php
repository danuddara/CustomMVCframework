<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class HobbiesObject extends DBObject
{
     public function __construct($registry) {
      
        parent::__construct($registry);
        
        
          $this->table = 'hobbies';

            $this->columns = array(
                                ':id'=>NULL,
                                ':UserID'=>NULL,
                                ':Name'=>NULL,
                                ':Type'=>NULL,
                                ':Description'=>NULL,
                                    );
        
        }
        
     public function checkHobbies($uid)
        {
          $db = $this->registry->getObject('db');
          $sql = 'SELECT `id`,`UserID`,`Name`,`Type`,`Description` FROM hobbies WHERE UserID='.$uid; // next time don't use from to dedine a coloum name
          $rows=$db->select($sql);
          return $rows;
        } 
        
    public function addHobbie($name='',$Type='',$Description='',$userid='')
    {
         $suc=false;
         $db = $this->registry->getObject('db');
         $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
         $coloums[':UserID']=$userid;
         $coloums[':Name']=$name;
         $coloums[':Type']=$Type;
         $coloums[':Description']=$Description;
         
         $suc=$db->InsertRecords($this->table,  $coloums);
         return $suc;
    }
    
    public function updateHobbie($name=null,$Type=null,$Description=null,$whereid=null)
    {
        $suc=false;
             $db = $this->registry->getObject('db');
             $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
             
             
                 $coloums[':Name']=$name;
                 $coloums[':Type']=$Type;
                 $coloums[':Description']=$Description;
             
             $values = $this->prepareforupdate($coloums);
                $values['id']=$whereid; //condition    
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
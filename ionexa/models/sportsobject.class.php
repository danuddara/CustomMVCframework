<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class SportsObject extends DBObject
{
     public function __construct($registry) {
      
        parent::__construct($registry);
        
        
          $this->table = 'favouritesportteam';

            $this->columns = array(
                                ':id'=>NULL,
                                ':UserId'=>NULL,
                                ':Type'=>NULL,
                                ':Name'=>NULL,
                                ':Description'=>NULL,
                                );
        
        }
        
         public function checkSports($uid)
        {
          $db = $this->registry->getObject('db');
          $sql = 'SELECT `id`,`UserId`,`Type`,`Name`,`Description` FROM favouritesportteam WHERE UserId='.$uid; // next time don't use from to dedine a coloum name
          $rows=$db->select($sql);
          return $rows;
        } 
        
        public function addSports($userid=null,$name=null,$type=null,$description=null)
        {
             $suc=false;
             $db = $this->registry->getObject('db');
             $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
             
             $coloums[':UserId']=$userid;
             $coloums[':Name']=$name;
             $coloums[':Type']=$type;
             $coloums[':Description']=$description;
              
              
             $suc=$db->InsertRecords($this->table,  $coloums);
             return $suc;
        }
        
        public function updateSports($name=null,$type=null,$description=null,$whereid=null)
        {
             $suc=false;
             $db = $this->registry->getObject('db');
             $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
             
             $coloums[':Name']=$name;
             $coloums[':Type']=$type;
             $coloums[':Description']=$description;
             
             
             
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
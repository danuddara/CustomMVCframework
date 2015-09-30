<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class AffiliationObject extends DBObject
{
     public function __construct($registry) {
      
        parent::__construct($registry);
        
        
          $this->table = 'affiliations';

            $this->columns = array(
                                ':id'=>NULL,
                                ':UserId'=>NULL,
                                ':Name'=>NULL,
                                ':Type'=>NULL,
                                ':Description'=>NULL,
                                );
        
        }
        
         public function checkAffiliations($uid)
        {
          $db = $this->registry->getObject('db');
          $sql = 'SELECT `id`,`UserId`,`Name`,`Type`,`Description` FROM affiliations WHERE UserId='.$uid; // next time don't use from to dedine a coloum name
          $rows=$db->select($sql);
          return $rows;
        } 
        
        public function addAffiliations($userid=null,$name=null,$type=null,$description=null)
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
        
        public function updateAffiliation($name=null,$type=null,$description=null,$whereid=null)
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
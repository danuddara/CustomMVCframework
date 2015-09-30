<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class EducationObject extends DBObject
{
     public function __construct($registry) {
      
        parent::__construct($registry);
        
        
          $this->table = 'education';

            $this->columns = array(
                                ':Id'=>NULL,
                                ':CountryId'=>NULL,
                                ':UserId'=>NULL,
                                ':Type'=>NULL,
                                ':Name'=>NULL,
                                ':GraduationYear'=>NULL,
                                ':Description'=>NULL,
                               
                                );
        
        }
        
        public function checkEducationPlaces($uid)
        {
          $db = $this->registry->getObject('db');
          $sql = 'SELECT Id,CountryId,UserId,Type,Name,GraduationYear,Description  FROM education WHERE UserId='.$uid;
          $rows=$db->select($sql);
          return $rows;
        }
        
        
        public function addEducationPlace($countryid=null,$userid=null,$type=null,$name=null,$graduationyear=null,$description=null)
        {
             $suc=false;
             $db = $this->registry->getObject('db');
             $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
             $coloums[':CountryId']=$countryid;
             $coloums[':UserId'] = $userid;
             $coloums[':Type'] = $type;
             $coloums[':Name'] = $name;
             $coloums[':GraduationYear']=$graduationyear;
             $coloums[':Description']=$description;
             
             $suc=$db->InsertRecords($this->table,  $coloums);
             return $suc;
             
        }
        
        public function updateEducationPlace($countryid=null,$type=null,$name=null,$graduationyear=null,$description=null,$whereid=null)
        {
             $suc=false;
             $db = $this->registry->getObject('db');
             $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
             $coloums[':CountryId']=$countryid;
             $coloums[':Type'] = $type;
             $coloums[':Name'] = $name;
             $coloums[':GraduationYear']=$graduationyear;
             $coloums[':Description']=$description;
             
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
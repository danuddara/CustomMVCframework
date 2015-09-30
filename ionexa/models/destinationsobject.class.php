<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DestinationsObject extends DBObject
{
     public function __construct($registry) {
      
        parent::__construct($registry);
        
        
          $this->table = 'favouritedestinations';

            $this->columns = array(
                                ':Id'=>NULL,
                                ':UserId'=>NULL,
                                ':CountryId'=>NULL,
                                ':CityId'=>NULL,
                                ':Type'=>NULL,
                                ':Name'=>NULL,
                                ':Description'=>NULL,
                                ':Geotag'=>NULL
                                    );
        
        }
        
     public function checkDestinations($uid)
        {
          $db = $this->registry->getObject('db');
          $sql = 'SELECT `Id`,`UserId`,`CountryId`,`CityId`,`Type`,`Name`,`Description`,`Geotag` from favouritedestinations WHERE UserId='.$uid; // next time don't use from to dedine a coloum name
          $rows=$db->select($sql);
          return $rows;
        } 
        
    public function addDestination($country=NULL,$city=NULL,$type=NULL,$name=NULL,$Description=NULL,$geotag=NULL,$userid=NULL)
    {
         $suc=false;
         $db = $this->registry->getObject('db');
         $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
         $coloums[':UserId']=$userid;
         $coloums[':CountryId']=$country;
         $coloums[':CityId']=$city;
         $coloums[':Type']=$type;
         $coloums[':Name']=$name;
         $coloums[':Description']=$Description;
         $coloums[':Geotag']=$geotag;
         
         $suc=$db->InsertRecords($this->table,  $coloums);
         return $suc;
    }
    
    public function updateDestination($country=NULL,$city=NULL,$type=NULL,$name=NULL,$Description=NULL,$geotag=NULL,$whereid=null)
    {
        $suc=false;
             $db = $this->registry->getObject('db');
             $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
             
                $coloums[':CountryId']=$country;
                 $coloums[':CityId']=$city;
                 $coloums[':Type']=$type;
                 $coloums[':Name']=$name;
                 $coloums[':Description']=$Description;
                 $coloums[':Geotag']=$geotag;
             
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
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class WorkObject extends DBObject
{
     public function __construct($registry) {
      
        parent::__construct($registry);
        
        
          $this->table = 'employement';

            $this->columns = array(
                                ':Id'=>NULL,
                                ':CountryId'=>NULL,
                                ':UserID'=>NULL,
                                ':Employer'=>NULL,
                                ':Designation'=>NULL,
                                ':FromDate'=>NULL,
                                ':ToDate'=>NULL,
                                ':Description'=>NULL,
                                
                               
                                );
        
        }
        
     public function checkWorkPlaces($uid)
        {
          $db = $this->registry->getObject('db');
          $sql = 'SELECT `Id`,`CountryId`,`UserID`,`Employer`,`Designation`,`FromDate`,`ToDate`,`Description` FROM employement WHERE UserID='.$uid; // next time don't use from to dedine a coloum name
          $rows=$db->select($sql);
          return $rows;
        }   
        
    public function addWorkplace($countryid=null,$userid=null,$employer=null,$designation=null,$fromdate=null,$todate=null,$description=null)
    {
         $suc=false;
         $db = $this->registry->getObject('db');
         $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
         $coloums[':CountryId']=$countryid;
         $coloums[':UserID']=$userid;
         $coloums[':Employer']=$employer;
         $coloums[':Designation']=$designation;
         $coloums[':FromDate']=$fromdate;
         $coloums[':ToDate']=$todate;
         $coloums[':Description']=$description;
         
         $suc=$db->InsertRecords($this->table,  $coloums);
             return $suc;   
    }
    
    public function updateWorkplace($countryid=null,$employer=null,$designation=null,$fromdate=null,$todate=null,$description=null,$whereid=null)
    {
        $suc=false;
             $db = $this->registry->getObject('db');
             $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
             $coloums[':CountryId']=$countryid;
             $coloums[':Employer']=$employer;
             $coloums[':Designation']=$designation;
             $coloums[':FromDate']=$fromdate;
             $coloums[':ToDate']=$todate;
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
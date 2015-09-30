<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class EntertainmentObject extends DBObject
{
     public function __construct($registry) {
      
        parent::__construct($registry);
        
        
          $this->table = 'favouritemovietvstage';

            $this->columns = array(
                                ':Id'=>NULL,
                                ':UserId'=>NULL,
                                ':GenreIds'=>NULL,
                                ':Type'=>NULL,
                                ':Name'=>NULL,
                                ':Description'=>NULL,
                                    );
        
        }
        
     public function checkEntertainment($uid)
        {
          $db = $this->registry->getObject('db');
          $sql = 'SELECT `Id`,`UserId`,`GenreIds`,`Type`,`Name`,`Description` from favouritemovietvstage WHERE UserId='.$uid; // next time don't use from to dedine a coloum name
          $rows=$db->select($sql);
          return $rows;
        } 
        
    public function addEntertainment($generid=NULL,$name=NULL,$Type=NULL,$Description=NULL,$userid=NULL)
    {
         $suc=false;
         $db = $this->registry->getObject('db');
         $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
         $coloums[':UserId']=$userid;
         $coloums[':GenreIds']=$generid;
         $coloums[':Name']=$name;
         $coloums[':Type']=$Type;
         $coloums[':Description']=$Description;
         
         $suc=$db->InsertRecords($this->table,  $coloums);
         return $suc;
    }
    
    public function updateEntertainment($generid=null,$name=null,$Type=null,$Description=null,$whereid=null)
    {
        $suc=false;
             $db = $this->registry->getObject('db');
             $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
             
                 $coloums[':GenreIds']=$generid;
                 $coloums[':Name']=$name;
                 $coloums[':Type']=$Type;
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
 
    public function getallgeners()
    {
        $db = $this->registry->getObject('db');
         $sql = 'SELECT
                `Id`,
                `Name`
                 FROM `genres`';
         
         $rows=$db->select($sql);
         return $rows; 
    }
}
?>
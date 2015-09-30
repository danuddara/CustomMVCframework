<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class MusicAndBandObject extends DBObject
{
     public function __construct($registry) {
      
        parent::__construct($registry);
        
        
          $this->table = 'favoritesmusicband';

            $this->columns = array(
                                ':Id'=>NULL,
                                ':UserId'=>NULL,
                                ':Categories'=>NULL,
                                ':Type'=>NULL,
                                ':Title'=>NULL,
                                ':Artist'=>NULL,
                                ':Description'=>NULL,
                                    );
        
        }
        
     public function checkMusicAndBand($uid)
        {
          $db = $this->registry->getObject('db');
          $sql = 'SELECT `Id`,`UserId`,`Categories`,`Type`,`Title`,`Artist`,`Description` from favoritesmusicband WHERE UserId='.$uid; // next time don't use from to dedine a coloum name
          $rows=$db->select($sql);
          return $rows;
        } 
        
    public function addMusicAndBand($category=NULL,$Type=NULL,$title=NULL,$artist=NULL,$Description=NULL,$userid=NULL)
    {
         $suc=false;
         $db = $this->registry->getObject('db');
         $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
         $coloums[':UserId']=$userid;
         $coloums[':Categories']=$category;
         $coloums[':Type']=$Type;
         $coloums[':Title']=$title;
         $coloums[':Artist']=$artist;
         $coloums[':Description']=$Description;
         
         $suc=$db->InsertRecords($this->table,  $coloums);
         return $suc;
    }
    
    public function updateMusicAndBand($category=null,$Type=null,$title=null,$artist=null,$Description=null,$whereid=null)
    {
        $suc=false;
             $db = $this->registry->getObject('db');
             $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
             
                 $coloums[':Categories']=$category;
                 $coloums[':Type']=$Type;
                 $coloums[':Title']=$title;
                 $coloums[':Artist']=$artist;
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
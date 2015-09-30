<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class BooksObject extends DBObject
{
     public function __construct($registry) {
      
        parent::__construct($registry);
        
        
          $this->table = 'favouritebooks';

            $this->columns = array(
                                ':Id'=>NULL,
                                ':Userid'=>NULL,
                                ':Type'=>NULL,
                                ':Author'=>NULL,
                                ':Title'=>NULL,
                                    );
        
        }
        
     public function checkBooks($uid)
        {
          $db = $this->registry->getObject('db');
          $sql = 'SELECT `Id`,`Userid`,`Type`,`Author`,`Title` FROM favouritebooks WHERE Userid='.$uid; // next time don't use from to dedine a coloum name
          $rows=$db->select($sql);
          return $rows;
        } 
        
    public function addBook($type='',$author='',$title='',$userid='')
    {
         $suc=false;
         $db = $this->registry->getObject('db');
         $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
         $coloums[':Userid']=$userid;
         $coloums[':Type']=$type;
         $coloums[':Author']=$author;
         
         $coloums[':Title']=$title;
         
         $suc=$db->InsertRecords($this->table,  $coloums);
         return $suc;
    }
    
    public function updateBook($type=null,$author=null,$title=null,$whereid=null)
    {
        $suc=false;
             $db = $this->registry->getObject('db');
             $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
             
             
                
                 $coloums[':Type']=$type;
                 $coloums[':Author']=$author;
                 $coloums[':Title']=$title;
             
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
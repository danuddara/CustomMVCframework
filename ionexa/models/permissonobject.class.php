<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class permissonObject extends DBObject
{
     public function __construct($registry) {
      
        parent::__construct($registry);
        
        //using multiple tables soo no need to metion the table
          $this->table = 'custompermissions';

            $this->columns = array(
                                ':Id'=>NULL,
                                ':UserId'=>NULL,
                                ':Resource'=>NULL,
                                ':AccessTo'=>NULL,
                                  );
        
        }
        
        function getUserRelationship($uid,$rid)
        {
            $db = $this->registry->getObject('db');
            $sql = "SELECT `RelationshipType` FROM `relationships` WHERE `UserId` = {$uid} and `RelationUserId`={$rid}";
            $rows=$db->select($sql);
            return $rows;
        }
        
        function checkpermissions($uid)
        {
          $db = $this->registry->getObject('db');
          $sql = 'select bp.Resource, bp.Access from basepermissions bp 
                    UNION
                  select cp.Resource, cp.AccessTo from custompermissions cp
                  where UserId='.$uid; // next time don't use from to dedine a coloum name
          $rows=$db->select($sql);
          return $rows;
        }
        
        
        function checkavailability($Resource,$uid)
        {
            $db = $this->registry->getObject('db');
            $sql = "SELECT `custompermissions`.`Id`
                    FROM `custompermissions` WHERE UserId={$uid} and Resource='$Resource';";
            $rows=$db->select($sql);
            return $rows;
        }
        
        function OveridePermission($Resource,$Acess,$uid)
        {
            $suc=false;
            $db = $this->registry->getObject('db');
            
            $isavaiblable = $this->checkavailability($Resource, $uid);
            if($isavaiblable!=null)
            {
                //update
                
                 $suc=false;
                 $db = $this->registry->getObject('db');
                 $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
                 
                  
                  $coloums[':Resource']=$Resource;
                  $coloums[':AccessTo']=$Acess;
                  
                $whereid= $isavaiblable[0][0];
                
                $values = $this->prepareforupdate($coloums);
                $values['id']=$whereid;
                
                if($values!=NULL)
                {
                $suc=$db->updateRecords($this->table,$values);
                }
               
                
                
            }
            else
                {
                    //insert
                    $suc=$this->insertpermission($Resource, $Acess, $uid); // insert permssion to the custom permissions
                }
                
            return $suc;
            
          
        }
        
        function insertpermission($Resource,$Acess,$uid)
        {
            $suc=false;
             $db = $this->registry->getObject('db');
             $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
             
             $coloums[':UserId']=$uid;
             $coloums[':Resource']=$Resource;
             $coloums[':AccessTo']=$Acess;
             
              
             $suc=$db->InsertRecords($this->table,  $coloums);
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

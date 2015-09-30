<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ForgotpasswordObject extends DBObject
{
     public function __construct($registry) 
        {

            parent::__construct($registry);

            $this->table = 'forgotpassword';

            $this->columns = array(
                                ':Id'=>NULL,
                                ':UserId'=>NULL,
                                ':eMail'=>NULL,
                                ':RequestedOn'=>NULL,
                                ':IsExpired'=>0

                                );
        }
        
        public function insertForgotPassword($userid,$email,$requestedon)
        {
            $db = $this->registry->getObject('db');
            $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
            $coloums[':UserId']=$userid;
            $coloums[':eMail']=$email;
            $coloums[':RequestedOn']=$requestedon;
            
            $db->InsertRecords($this->table,  $coloums);
          
        }

        public function checkforrequest($email)
        {
            
            $db = $this->registry->getObject('db');
             $sql = 'SELECT MAX(Id),`UserId`,`eMail`,`RequestedOn`,`IsExpired` FROM `forgotpassword` WHERE eMail="'.$email.'" AND IsExpired=0';
             $rows=$db->select($sql);
             return $rows;
        }
        
      
     
}
?>
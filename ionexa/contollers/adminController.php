<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class adminController extends baseController
{
    public function index()
    {
     //if admin hasn't logged in just redirect to home   
        
     $this->getALLprofiles();
    }
    
    public function getALLprofiles()
    {   $template = $this->registry->getObject('template');
        $user = new UserObject($this->registry);
        $rows = $user->getALLpeople();
        
  
        $template->people = $rows;
        $this->buildpage();
    }
   
    
    public function editprofile()
    { //do this if the admin is logged in
       if(isset($_GET['id']))
        {
          
            $_SESSION['Userid']=$_GET['id']; // set all the User to this so he can see the edit functions.
            redirect(__BASE_URL);
        }
    }
    
    public function suspendedStatus()
    {
        $suc = false;
        $user = new UserObject($this->registry);
        
        $uid = $_GET['uid'];
        $status = $_GET['status'];
        
        
       $suc =  $user->SuspedAccount($uid, $status);
       return $suc;
    }
     public function buildpage()
    {
        $template = $this->registry->getObject('template');
        $template->buildtemplate('editiprofiles_admin.tpl.php');
    }
}
?>

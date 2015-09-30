<?php

/*
   @project = "iOnexa";
 * @author = "Four Corners Lanka(Pvt) Ltd";
 * @version = 0.1;
 * @date  = "13/06/2013";
 * @class = "VefifyController class";
 *
 */

class verifyController extends baseController
{
    public function index()
    {
         $template = $this->registry->getObject('template');
         $template->activated = false;
         
         
       if(isset ($_GET['email']) && isset ($_GET['hash'])) 
       {
             $email =   $_GET['email'];
             $hash  =   $_GET['hash'];
             $_SESSION['email'] = $email;

     
       
              if($hash==md5($email))
              {
                   $user = new UserObject($this->registry);
                  $suc = $user->ActivateAccount($email);
                  if($suc==true)
                  {
                      $template->activated = true;
                  }
                 else 
                  {
                     $template->activated = false;
                  }
              }
     
     
        }
          
    
      $this->buildpage();
    }
    
    public function buildpage()
    {
        $template = $this->registry->getObject('template');
        $template->buildtemplate('verificationemail.tpl.php');
    }
}
?>

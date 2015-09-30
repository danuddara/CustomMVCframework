<?php


/*
 *
 *  @project = "iOnexa";
 * @author = "Four Corners Lanka(Pvt) Ltd";
 * @version = 0.1;
 * @date  = "26/06/2013";
 * @class = "signinController class";
 * 
 * 
 */

class signinController extends baseController
{
    private $email;
    
    public function index()
    {
        
    }
    
    /*
     * Sign in functionality
     * the verification of user on login
     */
    public function verify()
    {
        if(!empty($_POST['Signin-submit']))
   
        {
            if(isset($_POST['SigninUsername']) && isset($_POST['SigninPassword']))
            {
               $email = $_POST['SigninUsername'];
               $password = $_POST['SigninPassword'];

              $user = new UserObject($this->registry);
              if($user->checkemailavailability($email)!=null)
                  {
              
                      $user= $user->login($email, $password);

                     if($user!=-999)
                     {
                         if($user[0][4]!=1)
                         {
                             if($user[0][3]!=0)
                             {
                             $_SESSION['Userid'] = $user[0][0];
                             $_SESSION['UserName'] = $user[0][1].' '.$user[0][2];

                             redirect(__BASE_URL.'iprofile?id='.$_SESSION['Userid']);
                             //echo $_SESSION['Userid'].' '.$_SESSION['UserName'];
                             }
                             else
                             {
                                 $this->email=$email;
                                 echo "Your account have not been activated!<a href='".__BASE_URL."signin/sendActivateAccountMail?email=".$this->email."'>click here</a> to resend the mail again if you haven't recived it.";


                             }
                        }
                         else
                             {
                                 echo "Your Account is suspended! Please Contact the Admin to Reactvate your account";


                             }
                        
                     }
                     else
                     {
                         echo "Please Login again. Password mismatch.";
                     }
                  }
               else
               {
                   echo "the email you entered is not registerd with us.Please feel free to SignUp";
               }
                 
            }
        }
  
    }
    
  /*
   * logout functionality
   * 
   */  
    public function logout()
    {
        //should destroy all the sessions.
        session_destroy();
        redirect(__BASE_URL);
        
    }


    /*
     * create password recovery page
     */
    
    public function passwordRecovery()
    {
        $template = $this->registry->getObject('template');
        $template->buildtemplate('passwordrecovery.tpl.php');
    }
    
    /*
     * send recovery mail after submitting the email
     */
    
    public function sendrecoverymail()
    {
        if(!empty($_POST['Recovery-submit']))
   
        {
             if(isset($_POST['email']))
            {
                 $email = $_POST['email'];
                 if(valid_email($email, $test_mx = true))
                    {
                         $user = new UserObject($this->registry);
                         $rows = $user->checkemailavailability($email);
                         
                         

                         if($rows!=null)
                         {
                             /*send mail over here*/
                             $userid = $rows[0][0];
                             $email = $rows[0][1];
                             $name = $rows[0][2];
                         
                             $time = time()+60*60*24;

                            
                             
                               $datetime = date_create("now");
                               
                                $forgotpasswordobj = new ForgotpasswordObject($this->registry);
                                $forgotpasswordobj->insertForgotPassword($userid, $email, date_format($datetime,"Y/m/d H:iP") );
                                 
                                $rows = $forgotpasswordobj->checkforrequest($email);
                                if($rows!=null)
                                {
                                    $hash = $rows[0][0];
                                     
                                    $hash = md5($hash);
                                   
                                
                                     $to = $email;
                                     $from = 'ionexa@fclhosting.com';
                                     $subject = 'Password Reset';
                                     $baseurll = __BASE_URL;
//here doc

$msg = <<<EOT
   
Dear {$name},<br/>

<p>
This email was sent automatically in response to your request to recover your password. This is done for your protection; only you, the recipient of this email can take the next step in the password recover process.<br/>     

To reset your password and access your account click the following link<br/>
<a href="{$baseurll}signin/resetpassword?email=$email&hash=$hash">RestPassword</a><br/>

If you did not forget your password, please ignore this email.<br/>

Thank you,<br/>
Ionexa<br/>
</p>
   

EOT;
//end of here doc

                                     $suc=send_html_mail($to, $subject, $msg, $from);
                                     setcookie("reset_me", $hash, $time, "/", ".".$_SERVER["HTTP_HOST"]);

                                     if($suc==true){
                                     echo $msg;}
                                     else
                                     {
                                         echo "error";
                                     }

                                     //sucess message or redirect

                                     
                             
                                }
                             


                         }
                         else
                         {
                             echo "please Try again. you haven't registerd with us.";
                         }
                 }
            }
             
             else
                         {
                             echo "please Try again. you haven't registerd with us.";
                         }
            
        }
        
        
    }      
    
    /*
     * acess on URL submit
     * 
     * it will access the cookie that created
     * and the email and hash(UID) to verify the correct request
     */
    public function resetpassword()
    {
        if(isset ($_GET['email']) && isset ($_GET['hash']) && isset ($_COOKIE['reset_me']))
        {
            $email=$_GET['email'];
            if(valid_email($email, $test_mx = true))
                {
                   
                        if($_GET['hash']==$_COOKIE['reset_me'])
                        {

                          $forgotpasswordobj = new ForgotpasswordObject($this->registry);
                          $rows=$forgotpasswordobj->checkforrequest($email);

                          

                          if($rows!=null)
                          {
                              $hashdb = $rows[0][0];
                             $_SESSION['email'] = $email;

                              $hashdb = md5($hashdb);

                              if($hashdb==$_GET['hash'])
                              {
                                   $template = $this->registry->getObject('template');
                                   $template->buildtemplate('resetpassword.tpl.php');

                              }
                              else
                              {
                                  // bitch please! get a life
                                  echo "we cannot find your request please submit a new one and try again";
                              }

                          }
                        }
                         else
                              {
                                  // bitch please! get a life
                                  echo "we cannot find your request please submit a new one and try again";
                              }
                    
            }
        }
        
        else
        {
            echo "Please create a new request";
        }
        
    }
    public function resetnewpassword()
    {
        
          
          if(isset ($_SESSION['email']) && isset ($_COOKIE['reset_me']) )
              {
              
                $email = $_SESSION['email'];
              
                
                  if($email!=null)
                  {
                      
                      $forgotpasswordobj = new ForgotpasswordObject($this->registry);
                      $rows=$forgotpasswordobj->checkforrequest($email);
                      
                      $hashdb = $rows[0][0];
                      $hashdb = md5($hashdb);
                      
                      if($hashdb==$_COOKIE['reset_me'])
                      {
                         
                             if(!empty($_POST['RessetPassword-submit']))
                             {
                                 
                                  if(isset ($_POST['newpassword']) && isset($_POST['confirmpassword']))
                                  {
                                        if($_POST['newpassword']==$_POST['confirmpassword'])
                                        {
                                             $password = $_POST['newpassword'];
                                             $user = new UserObject($this->registry);
                                             $suc = $user->updatePassword($email, $password);
                                             if($suc==true)
                                             {
                                                 $time = time()+60*60*24;
                                                 setcookie("reset_me","", -$time, "/", ".".$_SERVER["HTTP_HOST"]);
                                                 echo "Password changed please login again.";
                                                 // redirect to home and ask him to login again.
                                             }
                                              else {
                                                        echo "upadate was not succeed!";
                                                   }

                                        }

                                       else
                                       {
                                           echo "password dose not match";
                                       }
                                  }
                             }
                      }
                      
                      else
                      {
                          // dnt try to hack me baby. :P
                      }
                  }
          
              }
          else{
              echo "Plesease submit a new Request your request has expired!";
          }
          
          
    }
    
    public function newpassword()
    {
        
          
          if(isset ($_SESSION['email']) )
              {
              
                $email = $_SESSION['email'];
              
                
                  if($email!=null)
                  {
                         
                             if(!empty($_POST['Password-submit']))
                             {
                                 
                                  if(isset ($_POST['newpassword']) && isset($_POST['confirmpassword']))
                                  {
                                        if($_POST['newpassword']==$_POST['confirmpassword'])
                                        {
                                             $password = $_POST['newpassword'];
                                             $user = new UserObject($this->registry);
                                             $suc = $user->updatePassword($email, $password);
                                             if($suc==true)
                                             {
                                                
                                               
                                                 redirect(__BASE_URL);
                                                 // redirect to home and ask him to login again.
                                             }
                                              else {
                                                        echo "upadate was not succeed!";
                                                   }

                                        }

                                       else
                                       {
                                           echo "password dose not match";
                                       }
                                  }
                             }
                      }
                      
                      else
                      {
                          // dnt try to hack me baby. :P
                      }
                  }
          
              
          else{
              echo "Plesease submit a new Request your request has expired!";
          }
          
          
    }
    
    public function sendActivateAccountMail()
    {
        if(isset ($_GET['email']) && $_GET['email']!="")
        {
            $email = $_GET['email'];
            $to = $email;
            $subject = 'Signup | Verification';
            $message = 'Please click this link to activate your account';
            $link = __BASE_URL.'/verify?email='.$email.'&hash='.md5($email);
            /*universal mail function have to be written here*/
            echo '<br/><a href="'.$link.'">'.$link.'</a><br/>';
        }
    }
    
    public function buildpage()
    {
        
    }
}
?>

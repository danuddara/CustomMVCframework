<?php

/*
 *
 * @project = "iOnexa";
 * @author = "Four Corners Lanka(Pvt) Ltd";
 * @version = 0.1;
 * @date  = "24/06/2013";
 * @class = "signinController class";
 * 
 * 
 */


class signupController extends baseController
{
    private $firstName;
    private $lastName;
    private $email;
    private $retypeemail;
    private $newpassword;
    private $country;
    private $gender;
    private $bday;
   
    
  
    public function index()
    {
        
    }
    
    public function verify()
    {
        $template = $this->registry->getObject('template');
        
        
        if(!empty($_POST['Signup-submit']))
            
        {
            $this->firstName = $_POST['firstName'];
            $this->lastName = $_POST['lastName'];
            $this->email = $_POST['email'];
            $this->retypeemail= $_POST['email2'];
            //$this->newpassword = md5($_POST['password']);
            $this->newpassword = NULL;
            $this->country = $_POST['countrySelect'];
            $this->gender = $this->getGender();
            
            //$emailcheck = $this->checkmailavailability();
            $ageverify = $this->setBday();
            $mailCompare = $this->checkEmail();
            $captchastatus = $this->verifycaptcha();
            if($this->firstName!='First Name' && $this->lastName!='Last Name' && $this->email!='E-Mail' && $this->retypeemail!='Re-enter E-Mail' && $this->newpassword!='New Password' && $this->country!='Select Your Country')
            {
                if($captchastatus==0 || $mailCompare==0 ||  $ageverify==0)
                {
                
                    if($captchastatus==0)
                    {
                    echo "<p>Please enter the recaptha code again<p><br/>";
                    }
                    if($mailCompare==0)
                    {
                        echo "<p>re-enter the email correctly or if you have already registerd with us, please login<p><br/>";
                    }
                    
                    if($ageverify==0)
                    {
                        echo "<p>sorry you are underage. you cannot sign in to this now.<p><br/>";
                    }
                }
            elseif ($captchastatus==1 && $mailCompare==1 && $ageverify==1 ) // on sucess insert the records 
                {
                   $user = new UserObject($this->registry);
                  $user->addUserBasicDetails($this->email,  $this->firstName,  $this->lastName,  $this->newpassword,  $this->bday,  $this->gender,  $this->country);
                  
                    
                   
                   
                   $to = $this->email;
                   $from = 'ionexa@fclhosting.com';
                   $subject = 'Signup | Verification';
                   $link = __BASE_URL.'verify?email='.$this->email.'&hash='.md5($this->email);
//here doc                   
$msg = <<<EOT
   
Dear {$this->firstName},<br/>
<p>
Thank you for registering with Ionexa!<br/>

Please activate your free registration by clicking on this link:<br/>
<a>{$link}</a>
(If clicking the link does not work, please try copying and pasting the entire link into a new browser window.)<br/>

Thank you,<br/>
IOnexa<br/>
</p>
EOT;
                   
                   
                   /*universal mail function have to be written here*/
                   send_html_mail($to, $subject, $msg, $from);
                   echo '<br/><a href="'.$link.'">'.$link.'</a><br/>';
                   
                   
                }
            }
            
            else 
            {
                echo "Please fill all  the required fields";
            }
                      
        }
    }
    
    private function setBday()
    {
        $month = $_POST['birthMonth'];
        $bday = $_POST['birthDay'];
        $year = $_POST['birthYear'];
        
        $bday = $year.'-'.$month.'-'.$bday;
        
        $curyear = date('Y');
        
        //$diff=date_diff(date_create(), date_create($bday));//not working in 5.2 $diff->format('%y'); 
        
        $yeargap    = $curyear-$year;
        
        echo "<br/>:yeargap ".$yeargap."<br/>";
        
        if(12<$yeargap)
        {
            
            $this->bday= $bday;
            return true;
        }
        else
        {
            
           return false;
        }
        
    }
    private function getGender()
    {
       
        
        if(isset ($_POST['female']))
        {
            return 0;
        }
         else if(isset ( $_POST['male']))
         {
             return 1;
         }
    }
    
    private function checkEmail()
    {
        $suc =0;
        $validemail = valid_email($this->email, $test_mx = true);
        if($validemail==true)
        {
            if($this->email==$this->retypeemail)
            {
                $user = new UserObject($this->registry);
                if($user->checkemailavailability($this->email)==null)
                        {
                    
                            echo "IN";
                            $suc=1;
                
                        }
               
            }
        }
        return $suc;
    
    }
    private function verifycaptcha()
    {
        $suc = 0;
                $privatekey = "6LdiJOMSAAAAAM7egJYaMVA1PapGDBce9T7mKtV6"; /*public key is in index/index.tpl.php*/
               
                $resp = recaptcha_check_answer ($privatekey,
                                                $_SERVER["REMOTE_ADDR"],
                                                $_POST["recaptcha_challenge_field"],
                                                $_POST["recaptcha_response_field"]);

                  if (!$resp->is_valid)
                  {
                    // What happens when the CAPTCHA was entered incorrectly
                   /* die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
                         "(reCAPTCHA said: " . $resp->error . ")");*/
                    
                      $suc=0;
                  } else 
                      {
                      
                      
                        $suc=1;
                      }
                      
       return $suc;
    }
    
    public function buildpage()
    {
        
    }
    
    
}

?>

<?php

/*
 * The base URL applies to all of the submit file paths 
 */
include_once '../../../../includes/functions.php';
   require_once('../../../../includes/libs/recaptcha/recaptchalib.php');
   $privatekey = "6LdiJOMSAAAAAM7egJYaMVA1PapGDBce9T7mKtV6";// key for me (Pasindu) use a differnet key for ionexa
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
         "(reCAPTCHA said: " . $resp->error . ")");
  } else {
    // Your code here to handle a successful verification
     
      Define (__BASE_URL,'http://localhost/ionexa/');
      
    redirect(__BASE_URL.'index.php?rt=iprofile'); 
   
  }

?>

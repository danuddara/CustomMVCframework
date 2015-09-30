<?php

/*
 * @project = "iOnexa";
 * @author = "Four Corners Lanka(Pvt) Ltd";
 * @version = 0.1;
 * @date  = "12/08/2013";
 * @class = "MessageAlert class";
 * 
 * this class is created for manageing Alerts/error messages
 * the template will add a Span/div in the template. 
 * we will load the error messages to that div and rebuid the page
 * the error message popup will only shown if its not empty.
 */


class MessageAlert
{
    private $errormessages = array();
    
    
    public function addErrorMessage($message)
    {
        
        array_push($this->errormessages,$message);
    }
    
    public function getErrorMessages()
    {
        return $this->errormessages;
    }
    
    public function alert()
    {
        
    }
   
}
?>

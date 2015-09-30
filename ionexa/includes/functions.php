<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

  // Redirects user to $url
    function redirect($url = null)
    {
        if(is_null($url)) $url = $_SERVER['PHP_SELF'];
        header("Location: $url");
        exit();
    }
    
        // Tests for a valid email address and optionally tests for valid MX records, too.
    function valid_email($email, $test_mx = false)
    {
        if(preg_match("/^([_a-z0-9+-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i", $email))
        {
            if($test_mx)
            {
                list( , $domain) = explode("@", $email);
                return getmxrr($domain, $mxrecords);
            }
            else
                return true;
        }
        else
            return false;
    }
    
       // Fixes MAGIC_QUOTES
    function fix_slashes($arr = '')
    {
        if(is_null($arr) || $arr == '') return null;
        if(!get_magic_quotes_gpc()) return $arr;
        return is_array($arr) ? array_map('fix_slashes', $arr) : stripslashes($arr);
    }
    
    
    
    // Sends an HTML formatted email
    function send_html_mail($to, $subject, $msg, $from, $plaintext = '')
    {
        $suc=false;
        if(!is_array($to)) $to = array($to);

        foreach($to as $address)
        {
            $boundary = uniqid(rand(), true);

            $headers  = "From: $from\n";
            $headers .= "MIME-Version: 1.0\n";
            $headers .= "Content-Type: multipart/alternative; boundary = $boundary\n";
            $headers .= "This is a MIME encoded message.\n\n";
            $headers .= "--$boundary\n" .
                        "Content-Type: text/plain; charset=ISO-8859-1\n" .
                        "Content-Transfer-Encoding: base64\n\n";
            $headers .= chunk_split(base64_encode($plaintext));
            $headers .= "--$boundary\n" .
                        "Content-Type: text/html; charset=ISO-8859-1\n" .
                        "Content-Transfer-Encoding: base64\n\n";
            $headers .= chunk_split(base64_encode($msg));
            $headers .= "--$boundary--\n" .

            $suc=mail($address, "Subject:".$subject,$msg, $headers);
           
        }
        
        return $suc;
    }
    
?>

<?php


/*
 * @project = "iOnexa";
 * @author = "Four Corners Lanka(Pvt) Ltd";
 * @version = 0.1;
 * @date  = "13/06/2013";
 * @class = "error404Controller class";
 */

class error404Controller extends baseController
{
    
    
    public function index() 
    {
        /*add the index controll over here
         * 
         * use the template class over here. and direct it to the template.
         */
        $template = $this->registry->getObject('template');
        $template->isAuthenticated();
        $template->heading = "Error on Page load!!"; /** set heading variable in the template**/
        
        $this->buildpage();
   
        
    }
    
    public function buildpage() {
        
         $template = $this->registry->getObject('template');
         $template->buildtemplate('error404.tpl.php');
    }
    
}
?>

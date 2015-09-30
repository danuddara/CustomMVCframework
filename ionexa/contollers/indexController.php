<?php

/*
 *
 *  @project = "iOnexa";
 * @author = "Four Corners Lanka(Pvt) Ltd";
 * @version = 0.1;
 * @date  = "13/06/2013";
 * @class = "indexController class";
 * 
 * 
 */
class indexController extends baseController
{
    public function __construct($registry) 
    {
        parent::__construct($registry);
        
            $template = $this->registry->getObject('template'); /****get template object from the registry***/

            /** set variables in the template**/
            if(isset ($_SESSION['UserName']))
            {
                
                redirect(__BASE_URL.'iprofile?id='.$_SESSION['Userid']);
            }
            $template->heading = "Welcome to the iOnexa framework!";
            $user = new UserObject( $this->registry);
            $template->countries = $user->getALLcountries();
    }
    /*
     * The default action on any controller is the index(), 
     * Please build the full template this action.
     * pass all the templates in Order to build the full template
     * others can be use to load bits of templates.
     * 
     */
    
       /*
         * isAuthentication is used to separate control the 
         * privacy in section wise and display it if its nessary.
         * 
         * Note: a Common Pracetise use template file name 
         * @param = the name of the template is the key
         * @bool = the authentication true/false
         * 
         *  This should be in iprofile and many other pages soo it is good to keep this in one place
         * steps:
         * 1 : check the Role
         * 2 : if(admin) display all
         * 3 : if (!admin) check the privacy settings for that role with the relationship of that person
         * 4 : get an array for privacy settings at the load index
         * 5 : save it in the controller so every method can acess it.
         */
    
    public function index() {
       
        
        /*
         * manage privacy settings on each controller
         * call to all controllers on load of the index file it is necessary
         */
     
        $this->view();       
       
       
        //load all the relavant section templates in the index
        $this->buildpage();
        
        
    }
    
    public function view()
    {
      
       
     
         $template = $this->registry->getObject('template'); /****get template object from the registry***/
        
         $template->heading = "Welcome to the iOnexa framework!";  
         
         $template->isAuthenticated('testSection',true);
         
         //if we don't use AJAX calls use this build function
         $this->buildpage();
        
        /*
         * if its an AJAX load the section call.
         * use $template->loadtemplatebit() to load separte sections
         * Note: it will only return the content ;)// it is an include soo returning might not be a problem coz its returens the data part
         */
        
    }
     
//load all the relavant section templates in buildpage
    
    public function buildpage() {
        
        $template = $this->registry->getObject('template');
        $template->buildtemplate('index.tpl.php');
    }
    
    
}
?>

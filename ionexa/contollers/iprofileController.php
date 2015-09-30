<?php

/*
 *
 *  @project = "iOnexa";
 * @author = "Four Corners Lanka(Pvt) Ltd";
 * @version = 0.1;
 * @date  = "13/06/2013";
 * @class = "iprofileController class";
 * 
 * 
 */
class iprofileController extends baseController
{
    /*
     * set page sections
     */
    private $templatebits = array();
    private $templatebitvariables = array();
    private $sessionUser;
    private $messageAlert;
    
    public function __construct($registry) {
        parent::__construct($registry);
        
     
       $user = new UserObject( $this->registry);
       $entertainment = new EntertainmentObject($this->registry);
       
       $template = $this->registry->getObject('template');
       $template->countries = $user->getALLcountries();
       $template->geners = $entertainment->getallgeners();
       $template->messages = '';
       $this->messageAlert = $this->registry->getObject('messageAlert');
       
        /*
         * will initiate the default variables and default permissions
         * these are must for a page.
         */
       
        $this->setvariables();
        $this->managePermissions();
         /*
          * the template variables first**
          * name keys with the templatename
          * it will be easy to identifty.
          * 
          * use simple for everything
          */
        $this->templatebits['messageAlert'] = 'messageAlert.tpl.php';
        $this->templatebits['iprofile'] = 'iprofile.tpl.php';
        $this->templatebits['basicinformation'] = 'basicinformation_iprofile.tpl.php';
        $this->templatebits['personalinformation']='personalinformation_iprofile.tpl.php';
        $this->templatebits['familyinformation'] = 'familyinformation_iprofile.tpl.php';
        $this->templatebits['educationinformation'] = 'educationinformation_iprofile.tpl.php';
        $this->templatebits['workinformation'] = 'workinformation_iprofile.tpl.php';
        $this->templatebits['affiliationinformation'] = 'affiliationinformation_iprofile.tpl.php';
        $this->templatebits['hobbiesinformation'] = 'hobbiesinformation_iprofile.tpl.php';
        $this->templatebits['bookinformation'] = 'bookinformation_iprofile.tpl.php';
        $this->templatebits['moviessptv']='moviessptv_iprofile.tpl.php';
        $this->templatebits['musicandbandinformation']='musicandbandinformation_iprofile.tpl.php';
        $this->templatebits['destinationsinformation']='destinationsinformation_iprofile.tpl.php';
        $this->templatebits['food'] = 'food_iprofile.tpl.php';
        $this->templatebits['sportteaminformation'] = 'sportteaminformation_iprofile.tpl.php';
        $this->templatebits['personinformation'] = 'personinformation_iprofile.tpl.php';
       // $this->templatebits['testSection'] = 'testSection.tpl.php';
        $this->templatebits['endofpanels'] = 'endofpanels.tpl.php';
        
      
        
    }
    public  function index()
    {
     
        
        $this->buildpage();
    }
    
    public function edit()
    {
      /*
       * spearate this on admin section
       * these are admin controllers 
       * 
       */
        if($this->sessionUser=='admin')
        {
        (empty($_GET['field']))? $section="":$section =$_GET['field'] ;
        
       
        $template = $this->registry->getObject('template');
      
        $this->editfield($section);
        }
        $this->buildpage();
    }
    
    private function editfield($formfield)
    {
        
       /*
        * load the edit template
        * the naming will be the filename.edit.tpl.php
        * 
        * if you want to load a edit template please use this format.
        * 
        *   Note: you can add a submit button to the template bit
        * !important: add the form tag to the forms in each sections
        * 
        */
        
        
        $this->templatebits[$formfield]= $formfield.'_iprofile_edit.tpl.php';
        $this->setvariables();
        $this->managePermissions();
        $this->buildpage();
    }
    
    public function buildpage() 
    { 
        
       $template = $this->registry->getObject('template');
       
      
        
         /*
          * load the full completed template;
          */
       
        
         $template->buildtemplate
                 (
                     //$this->templatebits['messageAlert'],
                     $this->templatebits['iprofile'],
                     $this->templatebits['basicinformation'],
                     $this->templatebits['personalinformation'],
                 
                     $this->templatebits['familyinformation'],
                     $this->templatebits['educationinformation'],
                     $this->templatebits['workinformation'],
                     $this->templatebits['affiliationinformation'],
                     $this->templatebits['hobbiesinformation'],
                     $this->templatebits['bookinformation'],
                     $this->templatebits['moviessptv'],
                     $this->templatebits['musicandbandinformation'],
                     $this->templatebits['destinationsinformation'],
                     $this->templatebits['food'] ,
                     $this->templatebits['sportteaminformation'],
                     $this->templatebits['personinformation'], 
                    // $this->templatebits['testSection'], 
                     $this->templatebits['endofpanels']
                 );
          $template->loadtemplatebit($this->templatebits['messageAlert']); //load the message;
    }
  
  /*AJAX call on iprofle get cities based on the state*/  
    public  function getcities()
    
    {
        $str="";
        $stateid = $_GET['stateidd'];
        $user = new UserObject($this->registry);
        $row = $user->getALLCities($stateid);
        if($row!=null)
        {
           
            foreach($row as $cities)
            {
                
                $tempcity = $cities;
                
                $str.="<option value=".$tempcity[0].">".$tempcity[1]."</option>";
                
            }
        }
        
       echo $str;
    }
    
    public function getStates()
     {
        $str="";
        $countryid = $_GET['countryidd'];
        $user = new UserObject($this->registry);
        $row = $user->getALLstates($countryid);
        if($row!=null)
        {
           
            foreach($row as $states)
            {
                
                $tempstates = $states;
                
                $str.="<option value=".$tempstates[0].">".$tempstates[1]."</option>";
                
            }
        }
        
       echo $str;
    }
    
    private function setvariables()
    {
         $template = $this->registry->getObject('template');
       
       /*
        * load each filed name at the start and set the default field variables and the field sections
        */
         
       /*set unique name fields to the section, these have to be just for initate.do not assign anything here*/
       //set variables
         
       $this->setDefaultsbasicInformation(); // Basicinformation
      
       
       $this->setDefaultsPersonalInformation();//personalinformation
       
       $this->setDefaultsFamilyInformation();//familyinformation
       
       $this->setDefaultsEducationInformation();//Education information
      
       $this->setDefaultsWorkInformation();//work information

       $this->setDefaultsAffiliationInformation();//affiliation information
      
       $this->setDefaultsHobbiesInformation();//hobbies information
   
       $this->setDefaultsBookInformation();// book information
       
       $this->setDefaultsEntertainmentInformation();//entertainment
       
       $this->setDefaultsMusicAndBandInformation();//music and band information
       
       $this->setDefaultsDestinationsInformation();//destinations information
       
       $this->setDefaultsFoodInformation();//food information
        
       $this->setDefaultsSportsInformation();//sports information
       
       $this->setDefaultsPersonInformation();//person information
 
       
       
       
        
       
       //$tempfields = array('field_1'=>true,'field_2'=>true,'field_3'=>true);
       //$this->setVariableSections('testSection', $tempfields);
       
       
         
       /*
        * if admin set the admin default functionalities
        * by default they are switched off.
        * 
        * you can load this in the admin level.
        */ 
                 
               //$tempfields = array('field_1'=>true,'field_2'=>true,'field_3'=>true);
               //$this->setVariableSections('testSection_iprofile_edit', $tempfields,false);
               
               /*$this->setPermissions('basicinformation_iprofile_edit',false);
               $this->setPermissions('panelone_iprofile_edit',false);
                $this->setPermissions('paneltwo_iprofile_edit',false);
                 $this->setPermissions('panelthree_iprofile_edit',false);
                  $this->setPermissions('testSection_iprofile_edit',false);*/
         
    }
    /*
     * SetsetVariableSections() are used to loop and intiate variables in a field it they are reuring by fields
     * 
     * ex: $testSection_iprofile_edit_firstname_field_1;$testSection_iprofile_edit_bdaydate_field_1;
     *      $testSection_iprofile_edit_firstname_field_2;$testSection_iprofile_edit_bdaydate_field_2;
     */
    private function setVariableSections($section='index',$fields=array(),$auth=true)
    {
       $template = $this->registry->getObject('template');
       if($fields!=null)
       {
           foreach($fields as $tempfield=>$val)
           {
             $tempfirstname = $section.'_firstname_'.$tempfield; 
             $templastname = $section.'_lastname_'.$tempfield; 
             $tempbdaydate =  $section.'_bdaydate_'.$tempfield; 
             
             
            
             $template->{$tempfirstname} = "";
             $template->{$tempbdaydate}= "";
             $template->{$templastname}="";
             
           }
       }
       $this->setPermissions($section,$auth,$fields ); // default permission set
    }
    
    private function  managePermissions()
    {
        /*
         * check users relationship with the viewing person
         * assign it to $_SESSION['UserRelationship'] 
         */
        $adminid = $_SESSION['Userid'];
        $viewuserid = $_SESSION['Userid'];
        
        $userRelationship = null;
        
                if(isset($_SESSION['Userid']) )
                {
                    if(isset ($_GET['id']) && $_GET['id']!=null)
                    {
                       
                        if($_SESSION['Userid']==$_GET['id'])
                        {
                            
                             $_SESSION['UserRelationship']='admin';
                             $adminid = $_SESSION['Userid'];
                             $viewuserid = $_SESSION['Userid'];
                             
                        }
                         else 
                            {
                                $_SESSION['UserRelationship']='friend';
                                
                                $viewuserid = $_GET['id'];
                                
                                 
                            }
                     }
                     else
                     {
                         $_SESSION['UserRelationship']='admin';
                     }
                
                 
               }
               
               else
                     {
                            echo __BASE_URL;
                            redirect(__BASE_URL);
                     }
       
        
       
        
        
        $userRelationship = $_SESSION['UserRelationship'];
        
        /*
         * set user relationship session so other admin methods  can
         *   see who is logged in and give more security to run the admin methods
         * 
         */
        $this->sessionUser =$userRelationship ; 
        
        $template = $this->registry->getObject('template');
        if( $userRelationship =='admin')
        {
           /* 
            * set user of the page
            * get the section permissions to the relavant relationship and page and set it all in here
            */
            $template->user = 'admin';
            $adminid = $_SESSION['Userid'];
            $this->checkbasicinformationPermissions($adminid,$viewuserid);// basicinformation permssions
            $this->checkPersonalinformationPermissions($adminid, $viewuserid);
            $this->checkFamilyinformationPermissions($adminid,$viewuserid);
            $this->checkEducationinformationPermissions($adminid, $viewuserid);
            $this->checkWorkinformationPermissions($adminid,$viewuserid);
            $this->checkAffiliationinformationPermissions($adminid,$viewuserid);
            $this->checkHobbiesinformationPermissions($adminid,$viewuserid);
            $this->checkBookinformationPermissions($adminid,$viewuserid);
            $this->checkEntertainmentinformationPermissions($adminid,$viewuserid);
            $this->checkMusicAndBandinformationPermissions($adminid,$viewuserid);
            $this->checkDestinationsinformationPermissions($adminid,$viewuserid);
            $this->checkFoodinformationPermissions($adminid,$viewuserid);
            $this->checkSportsinformationPermissions($adminid,$viewuserid);
            $this->checkPersoninformationPermissions($adminid,$viewuserid);
             /*add permissions on admin level for forms*/
         
                     $this->setPermissions('personalinformation_iprofile',true);
                     $this->setPermissions('familyinformation_iprofile',true);
                     $this->setPermissions('educationinformation_iprofile',true);
                     $this->setPermissions('workinformation_iprofile',true);
                     $this->setPermissions('affiliationinformation_iprofile',true);
                     $this->setpermissions('hobbiesinformation_iprofile',true);
                     $this->setPermissions('bookinformation_iprofile',true);
                     $this->setPermissions('moviessptv_iprofile',true);
                     $this->setPermissions('musicandbandinformation_iprofile',true);
                      //$this->setPermissions('testSection_iprofile',true);
                      $this->setPermissions('food_iprofile',true);
                      $this->setPermissions('sportteaminformation_iprofile',true);
                      $this->setPermissions('personinformation_iprofile',true);
                      $this->setPermissions('destinationsinformation_iprofile',true);
                      
                     $this->setPermissions('familyinformation_iprofile_edit',true);
                     $this->setPermissions('educationinformation_iprofile_edit',true);
                     $this->setPermissions('workinformation_iprofile_edit',true);
                     $this->setPermissions('affiliationinformation_iprofile_edit',true);
                     $this->setpermissions('hobbiesinformation_iprofile_edit',true);
                     $this->setPermissions('bookinformation_iprofile_edit',true);
                     $this->setPermissions('moviessptv_iprofile_edit',true);
                     $this->setPermissions('musicandbandinformation_iprofile_edit',true);
                     // $this->setPermissions('testSection_iprofile_edit',true);
                      $this->setPermissions('food_iprofile_edit',true);
                      $this->setPermissions('sportteaminformation_iprofile_edit',true);
                      $this->setPermissions('personinformation_iprofile_edit',true);
                      $this->setPermissions('destinationsinformation_iprofile_edit',true);
                     
            $permission = new permissonObject($this->registry);
            $permissions=$permission->checkpermissions($adminid);
            $templatepermission = array();
          
            foreach ($permissions as $permission)
                {
                       
                      $templatepermission[$permission[0]]=$permission[1];
                }
            
            $template->permissionarray=$templatepermission;
             
            
        }
        else if( $userRelationship  =='friend') //if not admin set as friend
        {
            /* 
            * set user of the page
            * get the section permissions to the relavant relationship and page and set it all in here
            */
            $template->user = 'friend';
            $this->checkbasicinformationPermissions($adminid,$viewuserid); // basicinformation permssions
            $this->checkPersonalinformationPermissions($adminid, $viewuserid);
            $this->checkFamilyinformationPermissions($adminid,$viewuserid);
            $this->checkEducationinformationPermissions($adminid, $viewuserid);
            $this->checkWorkinformationPermissions($adminid,$viewuserid);
            $this->checkAffiliationinformationPermissions($adminid,$viewuserid);
            $this->checkHobbiesinformationPermissions($adminid,$viewuserid);
            $this->checkBookinformationPermissions($adminid,$viewuserid);
            $this->checkEntertainmentinformationPermissions($adminid,$viewuserid);
            $this->checkMusicAndBandinformationPermissions($adminid,$viewuserid);
            $this->checkDestinationsinformationPermissions($adminid,$viewuserid);
            $this->checkFoodinformationPermissions($adminid,$viewuserid);
            $this->checkSportsinformationPermissions($adminid,$viewuserid);
            $this->checkPersoninformationPermissions($adminid,$viewuserid);
            
            
            
            //get the overidden permissions and show the relavant ones
            /*
             * 1.check user relationship
             * 2.load all the friend acess levels
             */
            $permission = new permissonObject($this->registry);
            $relationship=$permission->getUserRelationship($adminid, $viewuserid);
            
            
            $permissions=$permission->checkpermissions($viewuserid);
            
            
            foreach($permissions as $showthis)
            {
                    
                    if($relationship!=null)//if there is some relationship
                    {
//default section set visible;
                        if($relationship[0][0]===$showthis[1] || 'PUBLIC'===$showthis[1] )
                            {

                                $this->setPermissions($showthis[0],true);

                            }
                       else if($showthis[1]==null && $relationship[0][0]==$showthis[1] ) //load defaults
                            {

                                $this->setPermissions($showthis[0],true);
                            }
                            else
                                {
                                       $this->setPermissions($showthis[0],false);
                                }
                            
                       if($relationship[0][0]=='FAMILY')
                             {
                                
                                if($relationship[0][0]===$showthis[1] || 'PUBLIC'===$showthis[1] )
                                {

                                $this->setPermissions($showthis[0],true);

                                }
                                 if($showthis[1]=='FRIEND')
                                        {
                                             $this->setPermissions($showthis[0],true);
                                        }
                             }   
                       else if($relationship[0][0]=='OEO')
                             {
                                 
                                if($relationship[0][0]===$showthis[1] || 'PUBLIC'===$showthis[1] )
                                {

                                $this->setPermissions($showthis[0],true);

                                }
                                 if($showthis[1]=='FRIEND')
                                        {
                                             $this->setPermissions($showthis[0],true);
                                        }
                                  if($showthis[1]=='FAMILY')
                                        {
                                             $this->setPermissions($showthis[0],true);
                                        }      
                                        
                             }
                            

                    }
                    else
                    {
                         if('PUBLIC'===$showthis[1] )
                            {

                                $this->setPermissions($showthis[0],true);

                            }
                    }
                
                
            }
            
           
            
            
            /*
             * use the same variable names to identify the fields
             * template will be set with the  variables as testSection_firstname in the template view
             * 
             * override the default permissions on fields and the sections
             * 
             * you can just set the section permission false without passing any arguments
             * ex: setPermissions('testSection',false);
             
            $tempfields = array('country_1'=>true,'fname_1'=>false);
            $this->setPermissions('basicinformation_iprofile',true, $tempfields); 
       
            $fields =array('field_1'=>true,'field_2'=>false);
            $this->setPermissions('testSection',false,$fields);
             * 
             */
              /*
             * These should be set in each section
             */
            
            $this->setPermissions('iprofile',true);
        }
        
    }
    
    private function setPermissions($page='iprofile',$authenticate=true,$fileds=array())
    {
         $template = $this->registry->getObject('template');
         /*Manage permission is each action,move this to the relavant method*/
         $this->setPermissionArray($page, $fileds);
         $template->isAuthenticated($page,$authenticate,$this->templatebitvariables[$page]);
    }
    
    private function setPermissionArray($action='index',$fields=array())
    {
         /*
             * set field authentications 
             * set the relatvant fields if its set or not;
             */
           
                
                 if( array_key_exists($action,  $this->templatebitvariables )==true)
                 {
                     $tempfield=$this->templatebitvariables[$action];
                    
                      if($fields!=null)
                    {  
                         foreach($fields as $field =>$value)
                        {
                           $tempfield[$field]=$value;

                        }
                        $this->templatebitvariables[$action]=$tempfield;
                    }
                 }
                 else
                 {
                     $this->templatebitvariables[$action]=$fields;
                   
                 }
                 
                
         
    }
    
 
/************Basic Information settings*******************************************/    
    public function setDefaultsbasicInformation()
    {
        // set up the variables 
        $this->setbasicinformationvariables();
        //set up Permissions
        $this->setbasicinformationPermissions();
    }
    
    private function setbasicinformationvariables($fame='',$lname='',$gender='',$country='',$email='')
    {
       $template = $this->registry->getObject('template');
        
       $template->basicinformation_iprofile_fname=$fame;
       $template->basicinformation_iprofile_lname =$lname;
       $template->basicinformation_iprofile_gender =$gender;
       $template->basicinformation_iprofile_country =$country;
       $template->basicinformation_iprofile_email =$email;
       
       $template->userName = $fame.' '.$lname;
        
    }
    
    private function setbasicinformationPermissions($permissionsrewrite= array(),$show=true)
    {
        /*default permissions*/
       $tempfields = array( 'fname_1'=>true,
                            'lname_1'=>true,
                            'gender_1'=>true,
                            'country_1'=>true,
                            'email_1'=>true );
       
      // loop the permissionsrewrite and overide the $tempfield array
       
       $this->setPermissions('basicinformation_iprofile',$show, $tempfields); //set defaults
       $this->setPermissions('basicinformation_iprofile_edit',false,$tempfields);
          
       if($permissionsrewrite!=null)
       {
           
            $this->setPermissions('basicinformation_iprofile',$show, $permissionsrewrite);
       }
       
              
       
       /*overide permissions here*/
    }
    
    private function checkbasicinformationPermissions($adminid,$viewuserid)
    {
        //check if $adminid == $viewuserid
        
        $user = new UserObject($this->registry);
        $basicdetails = null;
        if($adminid!=$viewuserid)
        {
            /* 
             * 1.get the userobject
             * 2. check user relationship
             * 3. apply the premissions
             * 
             * */
            $tempfields = array('email_1'=>false ); // get overidden permissions
            $this->setbasicinformationPermissions($tempfields,true );
            
            $basicdetails =  $user->getBasicDetails($viewuserid);
               
        }
        else
        {
            
            //set edit permissions true for admin
            $tempfields = array('email_1'=>false ); // get overidden permissions
         
            $this->setPermissions('basicinformation_iprofile_edit',true,false);
             
           $basicdetails =  $user->getBasicDetails($adminid);
           
        }
        
       if($basicdetails!=null)
           {
               $email = $basicdetails[0][0];
               $firstName = $basicdetails[0][1];
               $lastName = $basicdetails[0][2];
               $gender = $basicdetails[0][3];
               $countryid = $basicdetails[0][4];
               
               if($gender==1){ $gender = 'male'; } else {$gender = 'female';}
              
              
                   
                   $this->setbasicinformationvariables($firstName,$lastName,$gender,$countryid,$email);   
           }
        
    }
   
    
    /* Update Basic Information on Edit form field*/
    public function setBasicinformation()
    {
        if(!empty($_POST['Basicinformation-submit']))
         {
            $user = new UserObject($this->registry);
            
            if(isset ($_SESSION['Userid']))
            {
                    $uid = $_SESSION['Userid'];

                    $fname = $_POST['first-name'];
                    $lname = $_POST['last-name'];
                    $gender = $_POST['gender'];
                    $country = $_POST['countrySelect'];

                    $suc= $user->updateBasicDetails($fname,$lname,$gender,$country,$uid);
                    
                    if($suc==true)
                            { 
                            //  redirect(__BASE_URL.'iprofile');  
                            $message = 'Sucessfully updated';
                            $this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                           // iprofileController::__construct($this->registry);
                            $this-> managePermissions();
                            $this->index();
                              
                            }
                        else{
                            echo "Error On Update!";
                            
                            $message = 'Error On Update!';
                            //$this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                            $this-> managePermissions();
                            $this->index();
                            }    
                    
            }
         }
        
    }




    /************EOF Basic Information settings*******************************************/  
    
     /************Personal Information settings*******************************************/ 
    public function setDefaultsPersonalInformation()
    {
        // set up the variables 
        $this->setPersonalinformationvariables();
        //set up Permissions
        $this->setPersonalinformationPermissions();
    }
    
    
    private function setPersonalinformationvariables($secondarayemail='',$address='',$country='',$city='',$state='',$zipcode='',$homecountry='',$bday='',$relationshipstatus='',$height='',$weight='')
    {
       $template = $this->registry->getObject('template');
        
       $template->personalinformation_iprofile_secondarayemail=$secondarayemail;
       $template->personalinformation_iprofile_address=$address;
       $template->personalinformation_iprofile_country =$country;
       $template->personalinformation_iprofile_city=$city;
       $template->personalinformation_iprofile_state=$state;
       $template->personalinformation_iprofile_zipcode=$zipcode;
       $template->personalinformation_iprofile_homecountry=$homecountry;
       $template->personalinformation_iprofile_bday=$bday;
       $template->personalinformation_iprofile_relationshipstatus=$relationshipstatus;
       $template->personalinformation_iprofile_height=$height;
       $template->personalinformation_iprofile_weight=$weight;
       
       
    }
    
    private function setPersonalinformationPermissions($permissionsrewrite= array(),$show=false)
    {
         /*default permissions*/
       
       
       $tempfields = array(
                            'secondaryemail_1'=>true,
                            'address_1'=>true,
                            'city_1'=>true,
                            'state_1'=>true,
                            'zipcode_1'=>true,
                            'homecountry_1'=>true,
                            'bday_1'=>true,
                            'relationshipstatus_1'=>true,
                            'height_1'=>true,
                            'weight_1'=>true
                           );
       $this->setPermissions('personalinformation_iprofile',$show, $tempfields);
       $this->setPermissions('personalinformation_iprofile_edit',false, $tempfields);
       
       if($permissionsrewrite!=null)
       {
            $this->setPermissions('personalinformation_iprofile',$show, $permissionsrewrite);
       }
        
       
    }
    
    private function checkPersonalinformationPermissions($adminid,$viewuserid)
    {
        //check if $adminid == $viewuserid
        $personaldetials =null;
        $user = new UserObject($this->registry);
        if($adminid!=$viewuserid)
        {
            //set other
            
           
    
              $personaldetials = $user->getPersonalDetails($viewuserid);
             
        }  
        
        else
            {
               //set admin 
            
           
              //set edit permissions true for admin
              $this->setPermissions('personalinformation_iprofile_edit',true);
              
              $personaldetials = $user->getPersonalDetails($adminid);
        
            }
            
              if($personaldetials!=null)
                {
                
                   $secondarayemail = $personaldetials[0][0];
                   $address = $personaldetials[0][1];
                   $country = $personaldetials[0][2];
                   $city = $personaldetials[0][3];
                   $state = $personaldetials[0][4];
                   $zipcode=$personaldetials[0][5];
                   $homecountry=$personaldetials[0][6];
                   $bday = $personaldetials[0][7];
                   
                   $relationshipstatus = $personaldetials[0][8];
                   $height =$personaldetials[0][9]; 
                   $weight = $personaldetials[0][10];  
                   
                   $this->setPersonalinformationvariables($secondarayemail, $address,$country, $city, $state, $zipcode, $homecountry, $bday, $relationshipstatus, $height,$weight);
                   
                   $template = $this->registry->getObject('template');
                   if($country!=null || $state!=null)
                   {
                       $template->states = null;
                       $template->cities = null;
                       if($country!=null)
                       {
                           $template->states = $user->getALLstates($country);
                       }
                       if($state!=null)
                       {
                           $template->cities = $user->getALLCities($state);
                       }
                       
                   }
                   else
                   {
                       $template->states = null;
                       $template->cities = null;
                   }
                }
    }
    
    
    
    /*update personal information*/
    
 public function  updatePersonalInformation()
 {
     if(!empty($_POST['Personalinformation-submit']))
         {
            $user = new UserObject($this->registry);
            
            if(isset ($_SESSION['Userid']))
            {
                $uid = $_SESSION['Userid'];
                
              //  $SeconderyEmail=$_POST['secondary-email'];
             //   $Address=$_POST['address'];
             //   $City=$_POST['city'];
                
                $SeconderyEmail='';
                $Address='';
                $City='';
                $ZipCode='';
                $State='';
                
           //     $ZipCode=$_POST['zip-code'];
                $HomeCounty=$_POST['countrySelect'];
                $BdayDate=$_POST['bday-year'].'-'.$_POST['bday-month'].'-'.$_POST['bday-date'];
                $Relationship=$_POST['relationshipstatus'];
                $Height =$_POST['height'];
                $Weight=$_POST['weight'];
                
               
                
                
                $suc=$user->updatePersonalInformation($SeconderyEmail, $Address, $City, $State, $ZipCode, $HomeCounty, $BdayDate, $Relationship, $Height,$Weight,$uid);
                
                 if($suc==true)
                            { 
                            //  redirect(__BASE_URL.'iprofile');  
                            $message = 'Sucessfully updated';
                            $this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                            $this-> managePermissions();
                            $this->index();
                              
                            }
                        else{
                            echo "Error On Update!";
                            
                            $message = 'Error On Update!';
                            //$this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                            $this-> managePermissions();
                            $this->index();
                            } 
            }
         }
 }


 /************EOF Personal Information settings*******************************************/ 
    
   
   /************Family Information settings*******************************************/   
 
   public function setDefaultsFamilyInformation()
    {
       
       
      
        // set up the variables 
        $this->setFamilyinformationvariables();
        //set up Permissions
        $this->setFamilyinformationPermissions();
      
    }

    public function setFamilyinformationvariables($fname='',$lanme='',$bdaydate='',$gender='',$relationship='',$isBPmember='',$country='',$tempfield='')
    {
        //define a loop to define the varibales in somewhere else
        //get the variables from the DB rows and count them. if its null define only once. do the same to the permissions
        $section = 'familyinformation_iprofile';
        if($tempfield==''){$tempfield='familyy_1'; } // default temp field value
        
       
        
         $tempfirstname = $section.'_firstname_'.$tempfield; 
         $templastname = $section.'_lastname_'.$tempfield; 
         $tempbdaydate =  $section.'_bdaydate_'.$tempfield; 
         $tempgender = $section.'_gender_'.$tempfield;
         $temprelationship=$section.'_relationship_'.$tempfield;
         $tempisBPmember = $section.'_isBPmember_'.$tempfield;
         $tempCountry =$section.'_country_'.$tempfield; 
            
         
             $template = $this->registry->getObject('template');
             $template->{$tempfirstname}=$fname;
             $template->{$templastname}=$lanme;
             $template->{$tempbdaydate}=$bdaydate;
             $template->{$tempgender}=$gender;
             $template->{$temprelationship}=$relationship;
             $template->{$tempisBPmember}=$isBPmember;
             $template->{$tempCountry}=$country;
             
             
            
             
       
    }
    
    public function setFamilyinformationPermissions($permissionsrewrite= array(),$show=false)
    {
         $tempfields = array(
                            'familyy_1'=>true,
                            );
   
       
       if($permissionsrewrite!=null)
       {
           $this->setPermissions('familyinformation_iprofile',$show, $permissionsrewrite);
           $this->setPermissions('familyinformation_iprofile_edit',false, $permissionsrewrite);
       }
       else
       {
               $this->setPermissions('familyinformation_iprofile',$show, $tempfields);
               $this->setPermissions('familyinformation_iprofile_edit',false, $tempfields);
       }
    }

    
    
    private function checkFamilyinformationPermissions($adminid,$viewuserid)
    {
        $permissionvariables = array('familyy_1'=>false); // overload the default permission as false
        $overiddenPermissions = array('familyy_1'=>false);
        //check if $adminid == $viewuserid
        
        $familydetials =null;
        $family = new FamilyObject($this->registry);
        if($adminid!=$viewuserid)
        {
            //set other
            
            
            $familydetials=$family->checkFamilyMemberCount($viewuserid);
            
            //save the overidden permission to the overidden array;
            $overiddenPermissions = array('family_1'=>false);
           
        }
        else
        {
            
          
           
           
            $familydetials=$family->checkFamilyMemberCount($adminid);
            
        }
        
        if($familydetials!=null)
            {
               
                foreach($familydetials as $familymember)
                {
                   
                   $field= 'family';
                   $id=$familymember[0];
                   $tempfield = $field.'_'.$id; //family_id
                   
                   $permissionvariables[$tempfield]=true; // set the permission array
                   
                   
                   $fname = $familymember[2];
                   $lanme = $familymember[3];
                   $bdaydate = $familymember[4];
                   $gender = $familymember[5];
                   $relationship = $familymember[6];
                   $isBPmember = $familymember[7];
                   $country = $familymember[1];
                   
                    if($gender==1){ $gender = 'male'; } else {$gender = 'female';}
                   
                   $this->setFamilyinformationvariables($fname, $lanme, $bdaydate, $gender, $relationship, $isBPmember, $country, $tempfield);
                   
                   
                }
                
               
                
                $this->setFamilyinformationPermissions($permissionvariables); // set defaults variables
                
                //check for overidden and apply them again over here.
                $this->setFamilyinformationPermissions($overiddenPermissions); //bit of a problem this overides the show edit
                
            }
            
            
    }
    
    
    /*check wether its a update or insert then pass it to the relavant function*/
    
    public function updateorinsertfamilyinformation()
    {
        if(!empty($_POST['Familyinformation-submit'])) // or its an AJAX CALL
        {   $familyid = null;
            $suc = false;
            $family = new FamilyObject($this->registry);
            if(isset ($_POST['field']))
            {
                
                    $iprofileid=$_SESSION['Userid'];
                   
                    
                    $firstname=$_POST['first-name'];
                    $lastname=$_POST['last-name'];
                    $year = $_POST['bday-year'];
                    $month=$_POST['bday-month'];
                    $date=$_POST['bday-date'];
                    $dateofbirth=$_POST['bday-year'].'-'.$_POST['bday-month'].'-'.$_POST['bday-date'];
                    $gender=$_POST['gender'];
                    $relationship=$_POST['relationship'];
                    
                   // $countryid=$_POST['countrySelect'];
                
                    $familymembers = $_POST['field'];
                    foreach($familymembers as $key=>$section)
                    {
                         $dateofbirth = $year[$key].'-'.$month[$key].'-'.$date[$key];
                             $isBPmember='';
                         
                             if(isset($_POST['bp-member-'.$section]) )
                                {

                                 $isBPmember=$_POST['bp-member-'.$section];



                                }

                             else{ 

                                    $isBPmember='0'; 

                                 }
                        if($section=='familyy_1')
                        {
                            //this is an insert
                           // $suc=$family->addFamilymember($countryid[$key], $iprofileid, $firstname[$key], $lastname[$key], $dateofbirth[$key], $gender[$key], $relationship[$key], $isBPmember);
                             $suc=$family->addFamilymember(1, $iprofileid, $firstname[$key], $lastname[$key], $dateofbirth[$key], $gender[$key], $relationship[$key], NULL);
                        }
                        else
                        {
                            //update
                            
                            
                             $whereid=preg_replace('/family_/','' , $familymembers);
                             $familyid = $whereid[$key];
                             //$suc=$family->updateFamilyMember($countryid[$key], $iprofileid, $firstname[$key], $lastname[$key], $dateofbirth, $gender[$key], $relationship[$key], $isBPmember, $whereid[$key]);
                             $suc=$family->updateFamilyMember(1, $iprofileid, $firstname[$key], $lastname[$key], $dateofbirth, $gender[$key], $relationship[$key], $isBPmember, $whereid[$key]);
                        }
                    }
                    
                    
            }
           
                 if($suc==true)
                            { 
                            //  redirect(__BASE_URL.'iprofile');  
                            $message = 'Sucessfully updated';
                            $this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                            $this-> managePermissions();
                            $this->index();
                              
                            }
                        else{
                            echo "Error On Update!";
                            
                            $message = 'Error On Update!';
                            //$this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                            $this-> managePermissions();
                            $this->index();
                            } 
        }
        
        else{
            //if its and AJAX CALL
            
            $this->AJAXfamilyupdate();
            
        }
    }

    private function loadAJAXfamilydetails($uid,$familyid)
    { 
        $template = $this->registry->getObject('template');
        $permissionvariables =array();
        $family = new FamilyObject($this->registry);
        
                      
                      $familymember= $family->getFamilyMember($uid, $familyid);
                      
                      if($familymember!=null)
                      {
                          //print_r($familymember);
                       
                       $field= 'family';
                       $id=$familymember[0][0];
                       $tempfield = $field.'_'.$id; //family_id

                       $permissionvariables[$tempfield]=true; // set the permission array


                       $fname = $familymember[0][2];
                       $lanme = $familymember[0][3];
                       $bdaydate = $familymember[0][4];
                       $gender = $familymember[0][5];
                       $relationship = $familymember[0][6];
                       $isBPmember = $familymember[0][7];
                       $country = $familymember[0][1];
                       
                       

                       $this->setDefaultsFamilyInformation();
                       $template->isAuthenticated($action='familyinformation_iprofile_field',true,$permissionvariables);
                       $this->setFamilyinformationvariables($fname, $lanme, $bdaydate, $gender, $relationship, $isBPmember, $country, $tempfield);
                       $this->setFamilyinformationPermissions($permissionvariables,true);
                      }
                      
                      
                     
    }
    
    public function AJAXfamilyupdate()
    {
        $template = $this->registry->getObject('template');
        
            $familyid = null;
            $suc = false;
            $family = new FamilyObject($this->registry);
            if(isset ($_POST['field']))
            {
               
                    $iprofileid=$_SESSION['Userid'];
                   
                    
                    $firstname=$_POST['first-name'];
                    $lastname=$_POST['last-name'];
                    $year = $_POST['bday-year'];
                    $month=$_POST['bday-month'];
                    $date=$_POST['bday-date'];
                    $dateofbirth=$_POST['bday-year'].'-'.$_POST['bday-month'].'-'.$_POST['bday-date'];
                    $gender=$_POST['gender'];
                    $relationship=$_POST['relationship'];
                    
                    //$countryid=$_POST['countrySelect'];
                
                    $familymembers = $_POST['field'];
                    
                    $dateofbirth = $year[0].'-'.$month[0].'-'.$date[0];
                             $isBPmember='';
                         
                             if(isset($_POST['bp-member-'.$familymembers[0]]) )
                                {

                                 $isBPmember=$_POST['bp-member-'.$familymembers[0]];



                                }

                             else{ 

                                    $isBPmember='0'; 

                                 }
                    
                     if($familymembers[0]=='familyy_1')
                        {
                            
                            //this is an insert
                            //$suc=$family->addFamilymember($countryid[0], $iprofileid, $firstname[0], $lastname[0], $dateofbirth, $gender[0], $relationship[0], $isBPmember);
                            $suc=$family->addFamilymember(1, $iprofileid, $firstname[0], $lastname[0], $dateofbirth, $gender[0], $relationship[0], NULL);
                            
                            $familyid = $family->lastinserted();
                        }
                        else
                        {
                            //update
                            
                            
                             $whereid=preg_replace('/family_/','' , $familymembers);
                             $familyid = $whereid[0];
                             //$suc=$family->updateFamilyMember($countryid[0], $iprofileid, $firstname[0], $lastname[0], $dateofbirth, $gender[0], $relationship[0], $isBPmember, $whereid[0]);
                             $suc=$family->updateFamilyMember(1, $iprofileid, $firstname[0], $lastname[0], $dateofbirth, $gender[0], $relationship[0], NULL, $whereid[0]);
            
                        }
                                 
                                 
               }
            
             if($suc==true)
                            { 
                            // redirect(__BASE_URL.'iprofile'); 
                            $template->AJAX =false;
                            
                            $this->loadAJAXfamilydetails($iprofileid,$familyid);
                            $template->loadtemplatebit('familyinformation_iprofile_field.tpl.php');
                                
                            }
                        else{
                            echo "Error On Update!";
                            }
                            
        
    }
    
    public function AJAXdeleteFamilymember()
    {
         
              $suc = false;
              $family = new FamilyObject($this->registry);
              $uid=$_SESSION['Userid'];
              
                if(!empty($_GET['familyid']))
                  {
                   
                      $familyid = $_GET['familyid'];
                      if($familyid!='familyy_1')
                      {
                      $familyid=preg_replace('/family_/','' , $familyid);
                      $suc=$family->deleteFamilyMember($uid, $familyid);
                      }
                  }
               return $suc;
              
            
            
            
         
    }
    
    public function returnformfield()
    {
         $template = $this->registry->getObject('template');
         
        
        
      if(isset($_GET['sectionid']) )
          {
          switch($_GET['sectionid'])
          {
              case 'family':
                  $uid = $_SESSION['Userid'];
                  
                  $template->AJAX =true;
                  $familymember = null;
                  
                  
                  if(!empty($_GET['familyid']))
                  {
                      $familyid = $_GET['familyid'];
                      
                      if($familyid=='familyy_1')
                      {
                         $this->setDefaultsFamilyInformation();
                          $tempfield = 'familyy_1';
                          $permissionvariables[$tempfield]=true;
                          $template->isAuthenticated($action='familyinformation_iprofile_field',true,$permissionvariables); 
                      }
                      else
                      {
                      $familyid=preg_replace('/family_/','' , $familyid);
                      $this->loadAJAXfamilydetails($uid,$familyid);
                      }
                  }
                  else{
                          $this->setDefaultsFamilyInformation();
                          $tempfield = 'familyy_1';
                          $permissionvariables[$tempfield]=true;
                          $template->isAuthenticated($action='familyinformation_iprofile_field',true,$permissionvariables);
                        }
              
                  $template->loadtemplatebit('familyinformation_iprofile_field.tpl.php');
                  break;
              case 'edu':
                  $template->loadtemplatebit('educationinformation_iprofile_field.tpl.php');
                  break;
              case 'work':
                  $template->loadtemplatebit('workinformation_iprofile_field.tpl.php');
                  break;
              case 'affiliation':
                  $template->loadtemplatebit('affiliationinformation_iprofile_field.tpl.php');
                  break;
              case 'hobbieadd':
                  $template->loadtemplatebit('hobbiesinformation_iprofile_edit_field.tpl.php');
                  break;
              case 'book':
                  $template->loadtemplatebit('bookinformation_iprofile_field.tpl.php');
                  break;
              
              case 'entertain':
                  $template->loadtemplatebit('moviessptv_iprofile_field.tpl.php');
                  break;
              
              case 'musicbandadd':
                  $template->loadtemplatebit('musicandbandinformation_iprofile_field.tpl.php');
                  break;
              case 'destination':
                  $template->loadtemplatebit('destinationsinformation_iprofile_field.tpl.php');
                  break;
              case 'food':
                  $template->loadtemplatebit('food_iprofile_field.tpl.php');
                  break;
              
              case 'sport':
                  $template->loadtemplatebit('sportteaminformation_iprofile_field.tpl.php');
                  break;
              
              case 'person':
                  $template->loadtemplatebit('personinformation_iprofile_field.tpl.php');
                  break;
              
              default :
                  
          }
          
          } 
        
         /*
          * load the full completed template;
          */
       
         
         
        
    }


    /************EOF Family Information settings*******************************************/ 
    
    /************ Education Information settings*******************************************/ 
    
    public function setDefaultsEducationInformation()
    {
       
       
      
        // set up the variables 
        $this->setEducationinformationvariables();
        //set up Permissions
        $this->setEducationinformationPermissions();
      
    } 
    
    public function setEducationinformationvariables($type='',$name='',$graduatedon='',$description='',$country='',$tempfield='')
    {
        $section = 'educationinformation_iprofile';
        if($tempfield==''){$tempfield='educationn_1'; } // default temp field value
        
       
        
         $temptype = $section.'_type_'.$tempfield; 
         $tempname = $section.'_name_'.$tempfield; 
         $tempgraduatedon =  $section.'_graduatedon_'.$tempfield; 
         $tempdescription = $section.'_description_'.$tempfield;
         $tempCountry =$section.'_country_'.$tempfield; 
            
         
             $template = $this->registry->getObject('template');
             $template->{$temptype}=$type;
             $template->{$tempname }=$name;
             $template->{$tempgraduatedon}=$graduatedon;
             $template->{$tempdescription }=$description;
             $template->{$tempCountry}=$country; 
    }
    
    public function setEducationinformationPermissions($permissionsrewrite=null,$show=false)
    {
       $tempfields = array(
                            'educationn_1'=>true,
                            );
   
       
       if($permissionsrewrite!=null)
       {
           $this->setPermissions('educationinformation_iprofile',$show, $permissionsrewrite);
           $this->setPermissions('educationinformation_iprofile_edit',false, $permissionsrewrite);
       }
       else
       {
               $this->setPermissions('educationinformation_iprofile',$show, $tempfields);
               $this->setPermissions('educationinformation_iprofile_edit',false, $tempfields);
       }
    }
    
    public function checkEducationinformationPermissions($adminid,$viewuserid)
    {
        $permissionvariables = array('educationn_1'=>false); // overload the default permission as false
        $overiddenPermissions = array('educationn_1'=>false);
        
        $educationdetails = null;
        $education = new EducationObject($this->registry);
        
        if($adminid!=$viewuserid)
        {
            
            $educationdetails=$education->checkEducationPlaces($viewuserid);
            
             //save the overidden permission to the overidden array;
            $overiddenPermissions = array('educationn_1'=>false);
        }
        else
            {
            
            
                $educationdetails=$education->checkEducationPlaces($adminid);
            }
            
            
        if($educationdetails!=null)
        {
            
            
            foreach ($educationdetails as $educationplace)
            {
                
                   $field= 'education';
                   $id=$educationplace[0];
                   $tempfield = $field.'_'.$id; //education_id
                   
                   $permissionvariables[$tempfield]=true; // set the permission array
                   
                   $type=$educationplace[3];
                   $name=$educationplace[4];
                   $graduatedon=$educationplace[5];
                   $description= $educationplace[6];
                   $country=$educationplace[1];
                   
                   $this->setEducationinformationvariables($type, $name, $graduatedon, $description, $country, $tempfield);
            }
            
               $this->setEducationinformationPermissions($permissionvariables); // set defaults variables
                
                //check for overidden and apply them again over here.
               $this->setEducationinformationPermissions($overiddenPermissions);
        }
        
    }
    
    
    public function updateorinserteducationinformation()
    {
        if(!empty ($_POST['Educationinformation-submit']))
        {
            $suc = false;
            $education = new EducationObject($this->registry);
            
            if(isset ($_POST['field']))//this is the logic to choose wether its an update or insert
            {
                 $userid = $_SESSION['Userid'];
                 
                 $countryid = $_POST['countrySelect'];
                 $type = $_POST['type'];
                 $name = $_POST['name'];
                 $graduationdate = $_POST['graduation-date'];
                 $graduationmonth = $_POST['graduation-month'];
                 $graduationyearr = $_POST['graduation-year'];
                 
                 $graduationyear = $graduationyearr.'-'.$graduationmonth.'-'.$graduationdate;
                // $description = $_POST['Description'];
                $description = '';
                 $educationplaces = $_POST['field'];
                    foreach($educationplaces as $key=>$section)
                    {
                        $graduationyear = $graduationyearr[$key].'-'.$graduationmonth[$key].'-'.$graduationdate[$key];
                      
                       
                        
                        if($section=='educationn_1')
                        {
                             
                            //this is an insert
                          // $suc=$education->addEducationPlace($countryid[$key], $userid, $type[$key], $name[$key], $graduationyear, $description[$key]);
                           $suc=$education->addEducationPlace($countryid[$key], $userid, $type[$key], $name[$key], $graduationyear, null);
                        }
                        else
                        {
                            //update
                            
                           
                             $whereid=preg_replace('/education_/','' , $educationplaces);
                             
                            // $suc=$education->updateEducationPlace($countryid[$key], $type[$key], $name[$key], $graduationyear, $description[$key], $whereid[$key]);
                             $suc=$education->updateEducationPlace($countryid[$key], $type[$key], $name[$key], $graduationyear, null, $whereid[$key]);
                            
                            
                        }
                        
                    }
                   if($suc==true)
                            { 
                            //  redirect(__BASE_URL.'iprofile');  
                            $message = 'Sucessfully updated';
                            $this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                            $this-> managePermissions();
                            $this->index();
                              
                            }
                        else{
                            echo "Error On Update!";
                            
                            $message = 'Error On Update!';
                            //$this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                            $this-> managePermissions();
                            $this->index();
                            } 
                    
                
            }
        }
    }
    
/************EOF Education Information settings*******************************************/ 

    
/************Work Information settings*******************************************/
    
public function setDefaultsWorkInformation()
{
        // set up the variables 
        $this->setWorkinformationvariables();
        //set up Permissions
        $this->setWorkinformationPermissions();
}

public function setWorkinformationvariables($employer='',$designation='',$fromdate='',$todate='',$country='',$description='',$tempfield='')
{
    
    $section = 'workinformation_iprofile';
    if($tempfield==''){$tempfield='workk_1'; }//default value
    
         $tempemployer = $section.'_employer_'.$tempfield; 
         $tempDesignation = $section.'_designation_'.$tempfield; 
         $tempfromdate =  $section.'_fromdate_'.$tempfield; 
         $temptodate = $section.'_todate_'.$tempfield;
         $tempCountry =$section.'_country_'.$tempfield; 
         $tempdescription = $section.'_description_'.$tempfield; 
            
         
             $template = $this->registry->getObject('template');
             $template->{$tempemployer}=$employer;
             $template->{$tempDesignation}=$designation;
             $template->{$tempfromdate}=$fromdate;
             $template->{$temptodate}=$todate;
             $template->{$tempCountry}=$country; 
             $template->{$tempdescription}=$description;
    
}

public function setWorkinformationPermissions($permissionsrewrite=array(),$show=false)
    {
         $tempfields = array(
                            'workk_1'=>true,
                            );
   
       
       if($permissionsrewrite!=null)
       {
           $this->setPermissions('workinformation_iprofile',$show, $permissionsrewrite);
           $this->setPermissions('workinformation_iprofile_edit',false, $permissionsrewrite);
       }
       else
       {
               $this->setPermissions('workinformation_iprofile',$show, $tempfields);
               $this->setPermissions('workinformation_iprofile_edit',false, $tempfields);
       }
    }
    
 public function checkWorkinformationPermissions($adminid,$viewuserid)
    {
        $permissionvariables = array('workk_1'=>false); // overload the default permission as false
        $overiddenPermissions = array('workk_1'=>false);
        
        $workdetails = null;
        $work  = new WorkObject($this->registry);
        
        if($adminid!=$viewuserid)
        {
            //viewid
            
            $workdetails = $work->checkWorkPlaces($viewuserid);
            
            //save the overidden permission to the overidden array;
            $overiddenPermissions = array('workk_1'=>false);
        }
        
        else
        {
            //admin
            
           
            
            $workdetails = $work->checkWorkPlaces($adminid);
            
        }
        
         if($workdetails!=null)
            {
              
                foreach($workdetails as $workplace)
                {
                   $field= 'work';
                   $id=$workplace[0];
                   $tempfield = $field.'_'.$id; //work_id 
                   
                   $permissionvariables[$tempfield]=true; // set the permission array
                    
                       $employer=$workplace[3];
                       $designation = $workplace[4];
                       $fromdate=$workplace[5];
                       $todate = $workplace[6];
                       $country= $workplace[1];
                       $description= $workplace[7];
                    
                   $this->setWorkinformationvariables($employer, $designation, $fromdate, $todate, $country, $description, $tempfield);
                }
                
                 $this->setWorkinformationPermissions($permissionvariables); // set defaults variables
                
                //check for overidden and apply them again over here.
                 $this->setWorkinformationPermissions($overiddenPermissions);
                  
            }
        
    }
    
    public function updateorinsertworkinformation()
    {
        //FIX!!-> add the details if its !NULL
       if(!empty ($_POST['Workinformation-submit']))
        {
           $suc = false;
           $work = new WorkObject($this->registry);
           if(isset ($_POST['field']))
            {
               $userid = $_SESSION['Userid'];
               
               
               $countryid = $_POST['countrySelect'];
               $employer = $_POST['employer'];
               $designation=$_POST['designation'];
               $from_date = $_POST['from-date'];
               $from_month = $_POST['from-month'];
               $from_year = $_POST['from-year'];
               $to_date = $_POST['to-date'];
               $to_month= $_POST['to-month'];
               $to_year = $_POST['to-year'];
               $description ='';// $_POST['Description'];
               
               $workplaces = $_POST['field'];
               
               foreach($workplaces as $key=>$section)
                    {
                        $fromdate = $from_year[$key].'-'.$from_month[$key].'-'.$from_date[$key];
                        $todate = $to_year[$key].'-'.$to_month[$key].'-'.$to_date[$key];
                   
                        if($section=='workk_1')
                        {
                            //insert
                            
                           // $suc=$work->addWorkplace($countryid[$key], $userid, $employer[$key], $designation[$key], $fromdate, $todate, $description[$key]);
                            $suc=$work->addWorkplace($countryid[$key], $userid, $employer[$key], $designation[$key], $fromdate, $todate, null);
                            
                        }
                        else
                            {
                                //update
                                $whereid=preg_replace('/work_/','' , $workplaces);
                                //$suc=$work->updateWorkplace($countryid[$key], $employer[$key], $designation[$key], $fromdate, $todate, $description[$key],$whereid[$key]);
                                $suc=$work->updateWorkplace($countryid[$key], $employer[$key], $designation[$key], $fromdate, $todate, null,$whereid[$key]);
                            
                                
                            }
                    }
                    
                if($suc==true)
                            { 
                            //  redirect(__BASE_URL.'iprofile');  
                            $message = 'Sucessfully updated';
                            $this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                            $this-> managePermissions();
                            $this->index();
                              
                            }
                        else{
                            echo "Error On Update!";
                            
                            $message = 'Error On Update!';
                            //$this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                            $this-> managePermissions();
                            $this->index();
                            }     
            }
        } 
    }
    
/************EOF Work Information settings*******************************************/  

/************Affiliation Information settings*******************************************/
public function setDefaultsAffiliationInformation()
{
        // set up the variables 
        $this->setAffiliationinformationvariables();
        //set up Permissions
        $this->setAffiliationinformationPermissions();
}

public function setAffiliationinformationvariables($type='',$name='',$description='',$tempfield='')
{
    $section = 'affiliationinformation_iprofile';
    if($tempfield==''){$tempfield='affiliationn_1'; }//default value
    
         $temptype = $section.'_type_'.$tempfield; 
         $tempname = $section.'_name_'.$tempfield; 
         $tempdescription =  $section.'_description_'.$tempfield; 
         
            
         
             $template = $this->registry->getObject('template');
             $template->{$temptype}=$type;
             $template->{$tempname}=$name;
             $template->{$tempdescription}=$description;
            
}

public function setAffiliationinformationPermissions($permissionsrewrite=array(),$show=false)
{
    $tempfields = array(
                            'affiliationn_1'=>true,
                            );
   
       
       if($permissionsrewrite!=null)
       {
           $this->setPermissions('affiliationinformation_iprofile',$show, $permissionsrewrite);
           $this->setPermissions('affiliationinformation_iprofile_edit',false, $permissionsrewrite);
       }
       else
       {
               $this->setPermissions('affiliationinformation_iprofile',$show, $tempfields);
               $this->setPermissions('affiliationinformation_iprofile_edit',false, $tempfields);
       }
}

public function checkAffiliationinformationPermissions($adminid,$viewuserid)
    {
        $permissionvariables = array('affiliationn_1'=>false); // overload the default permission as false
        $overiddenPermissions = array('affiliationn_1'=>false);
        
        $affiliationdetails = null;
        $affiliation = new AffiliationObject($this->registry);
        
        
        if($adminid!=$viewuserid)
        {
            //view id
            $affiliationdetails=$affiliation->checkAffiliations($viewuserid);
        }
        else
        {
            //admin
            $affiliationdetails=$affiliation->checkAffiliations($adminid);
        }
        
        if($affiliationdetails !=null)
            {
                foreach($affiliationdetails as $affiliation)
                {
                   $field= 'affiliation';
                   $id=$affiliation[0];
                   $tempfield = $field.'_'.$id; //affiliation_id 
                   
                   $permissionvariables[$tempfield]=true; // set the permission array
                   
                   $type = $affiliation[3];
                   $name = $affiliation[2];
                   $description =$affiliation[4]; 
                    
                   
                   
                   $this->setAffiliationinformationvariables($type, $name, $description, $tempfield);
                }
                
                 $this->setAffiliationinformationPermissions($permissionvariables); // set defaults variables
                
                //check for overidden and apply them again over here.
                 $this->setAffiliationinformationPermissions($overiddenPermissions);
            }
    }
    
 public function updateorinsertAffiliationinformation()
    {
        //FIX!!-> add the details if its !NULL
     if(!empty ($_POST['Affiliationinformation-submit']))
        {
             $suc = false;
             $affiliation = new AffiliationObject($this->registry);
         
            if(isset ($_POST['field']))
            {
                $userid = $_SESSION['Userid'];
                
                $name = $_POST['name']; 
                $type = $_POST['type']; 
                $description = $_POST['Description'];
                
                
                
                $affiliations=$_POST['field'];
                
                 foreach($affiliations as $key=>$section)
                    {
                       
                       
                       
                        if($section=='affiliationn_1')
                        {
                            //insert 
                         $suc=$affiliation->addAffiliations($userid, $name[$key], $type[$key], $description[$key]);
                        }
                        else
                            {
                                //update
                            //update
                                $whereid=preg_replace('/affiliation_/','' , $affiliations);
                                $suc=$affiliation->updateAffiliation($name[$key], $type[$key], $description[$key], $whereid[$key]);
                            }
                    }
            
                    if($suc==true)
                            { 
                            //  redirect(__BASE_URL.'iprofile');  
                            $message = 'Sucessfully updated';
                            $this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                            $this-> managePermissions();
                            $this->index();
                              
                            }
                        else{
                            echo "Error On Update!";
                            
                            $message = 'Error On Update!';
                            //$this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                            $this-> managePermissions();
                            $this->index();
                            }   
                    
            }
        }
     
    }    
    
/************EOF Affiliation Information settings*******************************************/ 
 
/************Hobbies Information settings*******************************************/
    
public function setDefaultsHobbiesInformation()
{
        // set up the variables 
        $this->setHobbiesinformationvariables();
        //set up Permissions
        $this->setHobbiesinformationPermissions();
}   
    
public function setHobbiesinformationvariables($type='',$name='',$description='',$tempfield='')
{
    $section = 'hobbiesinformation_iprofile';
    if($tempfield==''){$tempfield='hobbiess_1'; }//default value
    
         $temptype = $section.'_type_'.$tempfield; 
         $tempname = $section.'_name_'.$tempfield; 
         $tempdescription =  $section.'_description_'.$tempfield; 
         
             $template = $this->registry->getObject('template');
             $template->{$temptype}=$type;
             $template->{$tempname}=$name;
             $template->{$tempdescription}=$description;
}

public function setHobbiesinformationPermissions($permissionsrewrite=array(),$show=false)
{
    $tempfields = array(
                            'hobbiess_1'=>true,
                            );
   
       
       if($permissionsrewrite!=null)
       {
           $this->setPermissions('hobbiesinformation_iprofile',$show, $permissionsrewrite);
           $this->setPermissions('hobbiesinformation_iprofile_edit',false, $permissionsrewrite);
       }
       else
       {
               $this->setPermissions('hobbiesinformation_iprofile',$show, $tempfields);
               $this->setPermissions('hobbiesinformation_iprofile_edit',false, $tempfields);
       }
}


public function checkHobbiesinformationPermissions($adminid,$viewuserid)
    {
        $permissionvariables = array('hobbiess_1'=>false); // overload the default permission as false
        $overiddenPermissions = array('hobbiess_1'=>false);
        
        $hobbiedetails= null;
        $hobbie = new HobbiesObject($this->registry);
        
        
        if($adminid!=$viewuserid)
        {
            //view id
            $hobbiedetails=$hobbie->checkHobbies($viewuserid);
        }
        else
        {
            //admin
            $hobbiedetails=$hobbie->checkHobbies($adminid);
        }
        
        if($hobbiedetails!=null)
            {
                foreach($hobbiedetails as $hobbiesection)
                {
                   $field= 'hobbie';
                   $id=$hobbiesection[0];
                   $tempfield = $field.'_'.$id; //hobbie_id 
                   
                   $permissionvariables[$tempfield]=true; // set the permission array
                   
                   $type = $hobbiesection[3];
                   $name = $hobbiesection[2];
                   $description = $hobbiesection[4];
                   
                   
                   $this->setHobbiesinformationvariables($type, $name, $description, $tempfield);
                  
                    
                }
                
                $this->setHobbiesinformationPermissions($permissionvariables); // set defaults variables
                
                //check for overidden and apply them again over here.
                $this->setHobbiesinformationPermissions($overiddenPermissions);
            }
        
    }
    
    public function updateorinserthobbieinformation()
    {
        //FIX!!-> add the details if its !NULL
       if(!empty ($_POST['Hobbiesinformation-submit']))
        {
           $suc = false;
           $hobbie = new HobbiesObject($this->registry);
           
           if(isset ($_POST['field']))
            {
               $userid = $_SESSION['Userid'];
               
               $name = $_POST['name'];
               $Type = $_POST['type'];
               $Description ='' ;// $_POST['Description'];
               
               $hobbies=$_POST['field'];
               foreach($hobbies as $key=>$section)
                    {
                        if($section=='hobbiess_1')
                        {
                            //insert
                            
                           // $suc=$hobbie->addHobbie($name[$key], $Type[$key], $Description[$key], $userid);
                            $suc=$hobbie->addHobbie($name[$key], $Type[$key], null, $userid);
                        }
                        else
                        {
                            //update
                             $whereid=preg_replace('/hobbie_/','' , $hobbies);
                           // $suc=$hobbie->updateHobbie($name[$key], $Type[$key], $Description[$key], $whereid[$key]);
                            $suc=$hobbie->updateHobbie($name[$key], $Type[$key], null, $whereid[$key]);
                        }
                   
                    }
                    
                if($suc==true)
                            { 
                            //  redirect(__BASE_URL.'iprofile');  
                            $message = 'Sucessfully updated';
                            $this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                            $this-> managePermissions();
                            $this->index();
                              
                            }
                        else{
                            echo "Error On Update!";
                            
                            $message = 'Error On Update!';
                            //$this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                            $this-> managePermissions();
                            $this->index();
                            }       
               
            }
           
        }
    }
/************EOF Hobbies Information settings*******************************************/ 
    
/************Interests Information settings*******************************************/
    
public function setDefaultsBookInformation()
{
        // set up the variables 
        $this->setBookinformationvariables();
        //set up Permissions
        $this->setBookinformationPermissions();
}   
    
public function setBookinformationvariables($type='',$name='',$description='',$tempfield='')
{
    
    $section = 'bookinformation_iprofile';
    if($tempfield==''){$tempfield='bookk_1'; }//default value
    
         $temptype = $section.'_type_'.$tempfield; 
         $tempname = $section.'_author_'.$tempfield; 
         $tempdescription =  $section.'_title_'.$tempfield; 
         
             $template = $this->registry->getObject('template');
             $template->{$temptype}=$type;
             $template->{$tempname}=$name;
             $template->{$tempdescription}=$description;
}

public function setBookinformationPermissions($permissionsrewrite=array(),$show=false)
{
    
    $tempfields = array( 'bookk_1'=>true,
                            );
   
       
       if($permissionsrewrite!=null)
       {
           $this->setPermissions('bookinformation_iprofile',$show, $permissionsrewrite);
           $this->setPermissions('bookinformation_iprofile_edit',false, $permissionsrewrite);
       }
       else
       {
               $this->setPermissions('bookinformation_iprofile',$show, $tempfields);
               $this->setPermissions('bookinformation_iprofile_edit',false, $tempfields);
       }
}


public function checkBookinformationPermissions($adminid,$viewuserid)
    {
     
        $show = true;
        $permissionvariables = array('bookk_1'=>false); // overload the default permission as false
        $overiddenPermissions = array('bookk_1'=>false);
        
        $bookdetails= null;
        $book = new BooksObject($this->registry);
        
        
        if($adminid!=$viewuserid)
        {
            //view id
            
            $bookdetails=$book->checkBooks($viewuserid);
        }
        else
        {
            //admin
             
            $bookdetails=$book->checkBooks($adminid);
        }
        
        if($bookdetails!=null)
            {
                
                foreach($bookdetails as $booksection)
                {
                   $field= 'book';
                   $id=$booksection[0];
                   $tempfield = $field.'_'.$id; //book_id 
                   
                   $permissionvariables[$tempfield]=true; // set the permission array
                   
                   $type = $booksection[2];
                   $name = $booksection[3];
                   $description = $booksection[4];
                   
                   
                   $this->setBookinformationvariables($type, $name, $description, $tempfield);//set variables
                  
                    
                }
                
                $this->setBookinformationPermissions($permissionvariables); // set defaults variables
                
                //check for overidden and apply them again over here.
                $this->setBookinformationPermissions($overiddenPermissions);
            }
        
    }
    
    public function updateorinsertBookinformation()
    {
        //FIX!!-> add the details if its !NULL
       if(!empty ($_POST['Bookinformation-submit']))
        {
           $suc = false;
           $book = new BooksObject($this->registry);
           
           if(isset ($_POST['field']))
            {
               $userid = $_SESSION['Userid'];
               
               
               $type = $_POST['type'];
               $author = $_POST['author'];
               $title =  $_POST['title'];
               
               $books=$_POST['field'];
               foreach($books as $key=>$section)
                    {
                        if($section=='bookk_1')
                        {
                            //insert
                            
                            $suc=$book->addBook($type[$key], $author[$key], $title[$key], $userid);
                        }
                        else
                        {
                            //update
                            $whereid=preg_replace('/book_/','' , $books);
                            $suc=$book->updateBook($type[$key], $author[$key], $title[$key], $whereid[$key]);
                        }
                   
                    }
                    
              if($suc==true)
                            { 
                            //  redirect(__BASE_URL.'iprofile');  
                            $message = 'Sucessfully updated';
                            $this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                            $this-> managePermissions();
                            $this->index();
                              
                            }
                        else{
                            echo "Error On Update!";
                            
                            $message = 'Error On Update!';
                            //$this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                            $this-> managePermissions();
                            $this->index();
                            }      
               
            }
           
        }
    }
/************EOF Books Information settings*******************************************/ 
    
    
/************Entertainment Information settings*******************************************/
    
public function setDefaultsEntertainmentInformation()
{
        // set up the variables 
        $this->setEntertainmentinformationvariables();
        //set up Permissions
        $this->setEntertainmentinformationPermissions();
}   
    
public function setEntertainmentinformationvariables($category='',$gener='',$name='',$description='',$tempfield='')
{
    $section = 'moviessptv_iprofile';
    if($tempfield==''){$tempfield='mobiesptvv_1'; }//default value
    
    
         $tempcategory = $section.'_category_'.$tempfield;
         $tempgener = $section.'_genere_'.$tempfield;
         $tempname = $section.'_name_'.$tempfield; 
         $tempdescription =  $section.'_description_'.$tempfield; 
         
             $template = $this->registry->getObject('template');
             $template->{$tempcategory}=$category;
             $template->{$tempgener}=$gener;
             $template->{$tempname}=$name;
             $template->{$tempdescription}=$description;
}

public function setEntertainmentinformationPermissions($permissionsrewrite=array(),$show=false)
{
    $tempfields = array(
                            'mobiesptvv_1'=>true,
                            );
   
       
       if($permissionsrewrite!=null)
       {
           $this->setPermissions('moviessptv_iprofile',$show, $permissionsrewrite);
           $this->setPermissions('moviessptv_iprofile_edit',false, $permissionsrewrite);
       }
       else
       {
               $this->setPermissions('moviessptv_iprofile',$show, $tempfields);
               $this->setPermissions('moviessptv_iprofile_edit',false, $tempfields);
       }
}


public function checkEntertainmentinformationPermissions($adminid,$viewuserid)
    {
        $show = true;
        $permissionvariables = array('mobiesptvv_1'=>false); // overload the default permission as false
        $overiddenPermissions = array('mobiesptvv_1'=>false);
        
        $entertainmentdetails= null;
        $entertainment = new EntertainmentObject($this->registry);
        
        
        if($adminid!=$viewuserid)
        {
            //view id
            $entertainmentdetails=$entertainment->checkEntertainment($viewuserid);
        }
        else
        {
            //admin
            $entertainmentdetails=$entertainment->checkEntertainment($adminid);
        }
        
        if($entertainmentdetails!=null)
            {
                foreach($entertainmentdetails as $entertainmentsection)
                {
                   $field= 'mobiesptv';
                   $id=$entertainmentsection[0];
                   $tempfield = $field.'_'.$id; //mobiesptv_id 
                   
                   $permissionvariables[$tempfield]=true; // set the permission array
                   
                   $category = $entertainmentsection[3];
                   $gener = $entertainmentsection[2];
                   $name = $entertainmentsection[4];
                   $description = $entertainmentsection[5];
                   
                   
                   $this->setEntertainmentinformationvariables($category,$gener, $name, $description, $tempfield);//set variables
                  
                    
                }
                
                $this->setEntertainmentinformationPermissions($permissionvariables); // set defaults variables
                
                //check for overidden and apply them again over here.
                 $this->setEntertainmentinformationPermissions($overiddenPermissions);
            }
        
    }
    
    public function updateorinsertEntertainmentinformation()
    {
        //FIX!!-> add the details if its !NULL
       if(!empty ($_POST['Entertainmentinformation-submit']))
        {
           $suc = false;
           $entertainment = new EntertainmentObject($this->registry);
           
           if(isset ($_POST['field']))
            {
               $userid = $_SESSION['Userid'];
               
               
               $Type = $_POST['type'];
               $gener = $_POST['geners'];
               $name = $_POST['name'];
               $Description = '';// $_POST['Description'];
               
               $entertainments=$_POST['field'];
               foreach($entertainments as $key=>$section)
                    {
                        if($section=='mobiesptvv_1')
                        {
                            //insert
                            
                            //$suc=$entertainment->addEntertainment($gener[$key],$name[$key], $Type[$key], $Description[$key], $userid);
                            $suc=$entertainment->addEntertainment($gener[$key],$name[$key], $Type[$key], null, $userid);
                        }
                        else
                        {
                            //update
                             $whereid=preg_replace('/mobiesptv_/','' , $entertainments);
                           // $suc=$entertainment->updateEntertainment($gener[$key],$name[$key], $Type[$key], $Description[$key], $whereid[$key]);
                            $suc=$entertainment->updateEntertainment($gener[$key],$name[$key], $Type[$key], null, $whereid[$key]);
                        }
                   
                    }
                    
                  if($suc==true)
                            { 
                            //  redirect(__BASE_URL.'iprofile');  
                            $message = 'Sucessfully updated';
                            $this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                            $this-> managePermissions();
                            $this->index();
                              
                            }
                        else{
                            echo "Error On Update!";
                            
                            $message = 'Error On Update!';
                            //$this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                            $this-> managePermissions();
                            $this->index();
                            }      
               
            }
           
        }
    }
/************EOF Entertainment Information settings*******************************************/     
    

/************MUSIC&BAND Information Information settings*******************************************/
    
public function setDefaultsMusicAndBandInformation()
{
        // set up the variables 
        $this->setMusicAndBandinformationvariables();
        //set up Permissions
        $this->setMusicAndBandinformationPermissions();
}   
    
public function setMusicAndBandinformationvariables($category='',$type='',$title='',$artist='',$description='',$tempfield='')
{
    $section = 'musicandbandinformation_iprofile';
    if($tempfield==''){$tempfield='MusicandBandd_1'; }//default value
    
    
         $tempcategory = $section.'_category_'.$tempfield;
         $temptype = $section.'_type_'.$tempfield;
         $temptitle = $section.'_title_'.$tempfield; 
         $tempartist= $section.'_artist_'.$tempfield;
         $tempdescription =  $section.'_Description_'.$tempfield;
         
         
             $template = $this->registry->getObject('template');
             $template->{$tempcategory}=$category;
             $template->{$temptype}=$type;
             $template->{$temptitle}=$title;
             $template->{$tempartist}=$artist;
             $template->{$tempdescription}=$description;
}

public function setMusicAndBandinformationPermissions($permissionsrewrite=array(),$show=false)
{
    $tempfields = array(
                            'MusicandBandd_1'=>true,
                        );
   
       
       if($permissionsrewrite!=null)
       {
           $this->setPermissions('musicandbandinformation_iprofile',$show, $permissionsrewrite);
           $this->setPermissions('musicandbandinformation_iprofile_edit',false, $permissionsrewrite);
       }
       else
       {
               $this->setPermissions('musicandbandinformation_iprofile',$show, $tempfields);
               $this->setPermissions('musicandbandinformation_iprofile_edit',false, $tempfields);
       }
}


public function checkMusicAndBandinformationPermissions($adminid,$viewuserid)
    {
        $show = true;
        $permissionvariables = array('MusicandBandd_1'=>false); // overload the default permission as false
        $overiddenPermissions = array('MusicandBandd_1'=>false);
        
        $musicandbanddetails= null;
        $musicandband = new MusicAndBandObject($this->registry);
        
        
        if($adminid!=$viewuserid)
        {
            //view id
            $musicandbanddetails=$musicandband->checkMusicAndBand($viewuserid);
        }
        else
        {
            //admin
            $musicandbanddetails=$musicandband->checkMusicAndBand($adminid);
        }
        
        if($musicandbanddetails!=null)
            {
                foreach($musicandbanddetails as $musicandbandsection)
                {
                   $field= 'MusicandBand';
                   $id=$musicandbandsection[0];
                   $tempfield = $field.'_'.$id; //MusicandBand_id 
                   
                   $permissionvariables[$tempfield]=true; // set the permission array
                   
                   $category = $musicandbandsection[2];
                   $type = $musicandbandsection[3];
                   $title= $musicandbandsection[4];
                   $artist=$musicandbandsection[5];
                   $description = $musicandbandsection[6];
                   
                   
                   $this->setMusicAndBandinformationvariables($category, $type, $title, $artist, $description, $tempfield);//set variables
                  
                    
                }
                
                $this->setMusicAndBandinformationPermissions($permissionvariables); // set defaults variables
                
                //check for overidden and apply them again over here.
                 $this->setMusicAndBandinformationPermissions($overiddenPermissions);
            }
        
    }
    
    public function updateorinsertMusicAndBandinformation()
    {
        //FIX!!-> add the details if its !NULL
       if(!empty ($_POST['MusicandBandInformation-submit']))
        {
           $suc = false;
           $musicandband = new MusicAndBandObject($this->registry);
           
           if(isset ($_POST['field']))
            {
               $userid = $_SESSION['Userid'];
               
               $category = $_POST['category'];
               $Type = $_POST['type'];
               $title = $_POST['title'];
               $artist = $_POST['artist'];
               $Description = '';// $_POST['Description'];
               
               $entertainments=$_POST['field'];
               foreach($entertainments as $key=>$section)
                    {
                        if($section=='MusicandBandd_1')
                        {
                            //insert
                            
                            //$suc=$musicandband->addMusicAndBand($category[$key], $Type[$key], $title[$key], $artist[$key], $Description[$key], $userid);
                            $suc=$musicandband->addMusicAndBand($category[$key], $Type[$key], $title[$key], $artist[$key], null, $userid);
                        
                            
                        }
                        else
                        {
                            //update
                             $whereid=preg_replace('/MusicandBand_/','' , $entertainments);
                             //$suc=$musicandband->updateMusicAndBand($category[$key], $Type[$key], $title[$key], $artist[$key], $Description[$key], $whereid[$key]);
                             $suc=$musicandband->updateMusicAndBand($category[$key], $Type[$key], $title[$key], $artist[$key], null, $whereid[$key]);
                        
                             
                        }
                   
                    }
                    
                 if($suc==true)
                            { 
                            //  redirect(__BASE_URL.'iprofile');  
                            $message = 'Sucessfully updated';
                            $this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                            $this-> managePermissions();
                            $this->index();
                              
                            }
                        else{
                            echo "Error On Update!";
                            
                            $message = 'Error On Update!';
                            //$this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                            $this-> managePermissions();
                            $this->index();
                            }      
               
            }
           
        }
    }
/************EOF MUSIC&BAND Information settings*******************************************/ 
    
    
/************Destinations Information settings*******************************************/
    
public function setDefaultsDestinationsInformation()
{
        // set up the variables 
        $this->setDestinationsinformationvariables();
        //set up Permissions
        $this->setDestinationsinformationPermissions();
}   
    
public function setDestinationsinformationvariables($name='',$type='',$country='',$city='',$geotag='',$description='',$tempfield='')
{
    $section = 'destinationsinformation_iprofile';
    if($tempfield==''){$tempfield='destinationn_1'; }//default value
    
    
         $tempname = $section.'_name_'.$tempfield;
         $temptype = $section.'_type_'.$tempfield;
         $tempcountry = $section.'_country_'.$tempfield; 
         $tempcity= $section.'_city_'.$tempfield;
         $tempgeotag= $section.'_geotag_'.$tempfield;
         $tempdescription =  $section.'_description_'.$tempfield;
         
         
             $template = $this->registry->getObject('template');
             $template->{$tempname }=$name;
             $template->{$temptype}=$type;
             $template->{$tempcountry}=$country;
             $template->{$tempcity}=$city;
             $template->{$tempgeotag}=$geotag;
             $template->{$tempdescription}=$description;
}

public function setDestinationsinformationPermissions($permissionsrewrite=array(),$show=false)
{
    $tempfields = array(
                            'destinationn_1'=>true,
                        );
   
       
       if($permissionsrewrite!=null)
       {
           $this->setPermissions('destinationsinformation_iprofile',$show, $permissionsrewrite);
           $this->setPermissions('destinationsinformation_iprofile_edit',false, $permissionsrewrite);
       }
       else
       {
               $this->setPermissions('destinationsinformation_iprofile',$show, $tempfields);
               $this->setPermissions('destinationsinformation_iprofile_edit',false, $tempfields);
       }
}


public function checkDestinationsinformationPermissions($adminid,$viewuserid)
    {
        $show = true;
        $permissionvariables = array('destinationn_1'=>false); // overload the default permission as false
        $overiddenPermissions = array('destinationn_1'=>false);
        
        $destinationdetails= null;
        $destination = new DestinationsObject($this->registry);
        
        
        if($adminid!=$viewuserid)
        {
            //view id
            $destinationdetails=$destination->checkDestinations($viewuserid);
        }
        else
        {
            //admin
            $destinationdetails=$destination->checkDestinations($adminid);
        }
        
        if($destinationdetails!=null)
            {
                foreach($destinationdetails as $destionationsection)
                {
                   $field= 'destination';
                   $id=$destionationsection[0];
                   $tempfield = $field.'_'.$id; //destination_id 
                   
                   $permissionvariables[$tempfield]=true; // set the permission array
                   
                   $name = $destionationsection[5];
                   $type = $destionationsection[4];
                   $country= $destionationsection[2];
                   $city=$destionationsection[3];
                   $geotag=$destionationsection[7];
                   $description = $destionationsection[6];
                   
                   
                   $this->setDestinationsinformationvariables($name, $type, $country, $city, $geotag, $description, $tempfield);//set variables
                  
                    
                }
                
                $this->setDestinationsinformationPermissions($permissionvariables); // set defaults variables
                
                //check for overidden and apply them again over here.
                 $this->setDestinationsinformationPermissions($overiddenPermissions);
            }
        
    }
    
    public function updateorinsertDestinationsinformation()
    {
        //FIX!!-> add the details if its !NULL
       if(!empty ($_POST['Destinationinformation-submit']))
        {
           
           $suc = false;
            $destination = new DestinationsObject($this->registry);
           
           if(isset ($_POST['field']))
            {
               $userid = $_SESSION['Userid'];
               
               $country = $_POST['country'];
               $city= $_POST['city'];
               //$type = $_POST['type'];
                 $type = '';
               $name = $_POST['name'];
               $Description = '' ;//$_POST['Description'];
               $geotag = $_POST['geotag'];
               
               $destinatons=$_POST['field'];
               foreach($destinatons as $key=>$section)
                    {
                        if($section=='destinationn_1')
                        {
                            //insert
                            
                            //$suc=$destination->addDestination($country[$key], $city[$key], $type[$key], $name[$key], $Description[$key], $geotag[$key], $userid);
                            $suc=$destination->addDestination($country[$key], $city[$key], null, $name[$key], null, $geotag[$key], $userid);
                      
                        }
                        else
                        {
                            //update
                               $whereid=preg_replace('/destination_/','' , $destinatons);
                        //     $suc=$destination->updateDestination($country[$key], $city[$key], $type[$key], $name[$key], $Description[$key], $geotag[$key], $whereid[$key]);
                               $suc=$destination->updateDestination($country[$key], $city[$key], null, $name[$key], null, $geotag[$key], $whereid[$key]);
                      
                        }
                   
                    }
                    
                 if($suc==true)
                            { 
                            //  redirect(__BASE_URL.'iprofile');  
                            $message = 'Sucessfully updated';
                            $this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                            $this-> managePermissions();
                            $this->index();
                              
                            }
                        else{
                            echo "Error On Update!";
                            
                            $message = 'Error On Update!';
                            //$this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                            $this-> managePermissions();
                            $this->index();
                            }       
               
            }
           
        }
    }
/************EOF Destinations Information settings*******************************************/     
    
    
/************Food Information settings*******************************************/
    
public function setDefaultsFoodInformation()
{
        // set up the variables 
        $this->setFoodinformationvariables();
        //set up Permissions
        $this->setFoodinformationPermissions();
}   
    
public function setFoodinformationvariables($name='',$description='',$tempfield='')
{
    $section = 'food_iprofile';
    if($tempfield==''){$tempfield='Foodd_1'; }//default value
    
         
         $tempname = $section.'_name_'.$tempfield; 
         $tempdescription =  $section.'_description_'.$tempfield; 
         
             $template = $this->registry->getObject('template');
         
             $template->{$tempname}=$name;
             $template->{$tempdescription}=$description;
}

public function setFoodinformationPermissions($permissionsrewrite=array(),$show=false)
{
    $tempfields = array(
                            'Foodd_1'=>true,
                            );
   
       
       if($permissionsrewrite!=null)
       {
           $this->setPermissions('food_iprofile',$show, $permissionsrewrite);
           $this->setPermissions('food_iprofile_edit',false, $permissionsrewrite);
       }
       else
       {
               $this->setPermissions('food_iprofile',$show, $tempfields);
               $this->setPermissions('food_iprofile_edit',false, $tempfields);
       }
}


public function checkFoodinformationPermissions($adminid,$viewuserid)
    {
        $show = true;
        $permissionvariables = array('Foodd_1'=>false); // overload the default permission as false
        $overiddenPermissions = array('Foodd_1'=>false);
        
        $Fooddetails= null;
        $Food = new FoodObject($this->registry);
        
        
        if($adminid!=$viewuserid)
        {
            //view id
            $Fooddetails=$Food->checkFood($viewuserid);
        }
        else
        {
            //admin
            $Fooddetails=$Food->checkFood($adminid);
        }
        
        if($Fooddetails!=null)
            {
                foreach($Fooddetails as $Foodsection)
                {
                   $field= 'Food';
                   $id=$Foodsection[0];
                   $tempfield = $field.'_'.$id; //Food_id 
                   
                   $permissionvariables[$tempfield]=true; // set the permission array
                   
                   
                   $name = $Foodsection[2];
                   $description = $Foodsection[3];
                   
                   
                   $this->setFoodinformationvariables( $name, $description, $tempfield);//set variables
                  
                    
                }
                
                $this->setFoodinformationPermissions($permissionvariables); // set defaults variables
                
                //check for overidden and apply them again over here.
                 $this->setFoodinformationPermissions($overiddenPermissions);
            }
        
    }
    
    public function updateorinsertFoodinformation()
    {
        //FIX!!-> add the details if its !NULL
       if(!empty ($_POST['Foodinformation-submit']))
        {
           $suc = false;
            $Food = new FoodObject($this->registry);
            
           if(isset ($_POST['field']))
            {
               $userid = $_SESSION['Userid'];
               
               $name = $_POST['name'];
               $Description =  $_POST['Description'];
               
               $Fooditems=$_POST['field'];
               foreach($Fooditems as $key=>$section)
                    {
                        if($section=='Foodd_1')
                        {
                            //insert
                            echo "inserted";
                            $suc=$Food->addFood($name[$key],$Description[$key], $userid);
                        }
                        else
                        {
                            //update
                             $whereid=preg_replace('/Food_/','' , $Fooditems );
                            $suc=$Food->updateFood($name[$key],$Description[$key], $whereid[$key]);
                        }
                   
                    }
                    
                  if($suc==true)
                            { 
                            //  redirect(__BASE_URL.'iprofile');  
                            $message = 'Sucessfully updated';
                            $this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                            $this-> managePermissions();
                            $this->index();
                              
                            }
                        else{
                            echo "Error On Update!";
                            
                            $message = 'Error On Update!';
                            //$this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                            $this-> managePermissions();
                            $this->index();
                            }     
               
            }
           
        }
    }
/************EOF Food Information settings*******************************************/   
    
    
    
/************Sports Information settings*******************************************/
public function setDefaultsSportsInformation()
{
        // set up the variables 
        $this->setSportsinformationvariables();
        //set up Permissions
        $this->setSportsioninformationPermissions();
}

public function setSportsinformationvariables($type='',$name='',$description='',$tempfield='')
{
    $section = 'sportteaminformation_iprofile';
    if($tempfield==''){$tempfield='sportss_1'; }//default value
    
         $temptype = $section.'_type_'.$tempfield; 
         $tempname = $section.'_name_'.$tempfield; 
         $tempdescription =  $section.'_description_'.$tempfield; 
         
            
         
             $template = $this->registry->getObject('template');
             $template->{$temptype}=$type;
             $template->{$tempname}=$name;
             $template->{$tempdescription}=$description;
            
}

public function setSportsioninformationPermissions($permissionsrewrite=array(),$show=false)
{
    $tempfields = array(
                            'sportss_1'=>true,
                            );
   
       
       if($permissionsrewrite!=null)
       {
           $this->setPermissions('sportteaminformation_iprofile',$show, $permissionsrewrite);
           $this->setPermissions('sportteaminformation_iprofile_edit',false, $permissionsrewrite);
       }
       else
       {
               $this->setPermissions('sportteaminformation_iprofile',$show, $tempfields);
               $this->setPermissions('sportteaminformation_iprofile_edit',false, $tempfields);
       }
}

public function checkSportsinformationPermissions($adminid,$viewuserid)
    {
        $permissionvariables = array('sportss_1'=>false); // overload the default permission as false
        $overiddenPermissions = array('sportss_1'=>false);
        
        $sportsdetails = null;
        $sports = new SportsObject($this->registry);
        
        
        if($adminid!=$viewuserid)
        {
            //view id
            $sportsdetails=$sports->checkSports($viewuserid);
        }
        else
        {
            //admin
            $sportsdetails=$sports->checkSports($adminid);
        }
        
        if($sportsdetails !=null)
            {
                foreach($sportsdetails as $sport)
                {
                   $field= 'sport';
                   $id=$sport[0];
                   $tempfield = $field.'_'.$id; //sport_id 
                   
                   $permissionvariables[$tempfield]=true; // set the permission array
                   
                   $type = $sport[2];
                   $name = $sport[3];
                   $description =$sport[4]; 
                    
                   
                   
                   $this->setSportsinformationvariables($type, $name, $description, $tempfield);
                }
                
                 $this->setSportsioninformationPermissions($permissionvariables); // set defaults variables
                
                //check for overidden and apply them again over here.
                 $this->setSportsioninformationPermissions($overiddenPermissions);
            }
    }
    
 public function updateorinsertSportsinformation()
    {
        //FIX!!-> add the details if its !NULL
     if(!empty ($_POST['Sportinformation-submit']))
        {
             $suc = false;
             $sports = new SportsObject($this->registry);
         
            if(isset ($_POST['field']))
            {
                $userid = $_SESSION['Userid'];
                
                $name = $_POST['name']; 
                $type = $_POST['type']; 
                $description = '';//$_POST['Description'];
                
                
                
                $sportsinfo=$_POST['field'];
                
                 foreach($sportsinfo as $key=>$section)
                    {
                       
                       
                       
                        if($section=='sportss_1')
                        {
                            //insert 
                         //$suc=$sports->addSports($userid, $name[$key], $type[$key], $description[$key]);
                          $suc=$sports->addSports($userid, $name[$key], $type[$key], null);
                        }
                        else
                            {
                                //update
                            //update
                                $whereid=preg_replace('/sport_/','' , $sportsinfo);
                               // $suc=$sports->updateSports($name[$key], $type[$key], $description[$key], $whereid[$key]);
                                 $suc=$sports->updateSports($name[$key], $type[$key], null, $whereid[$key]);
                           
                                
                           }
                    }
            
                     if($suc==true)
                            { 
                            //  redirect(__BASE_URL.'iprofile');  
                            $message = 'Sucessfully updated';
                            $this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                            $this-> managePermissions();
                            $this->index();
                              
                            }
                        else{
                            echo "Error On Update!";
                            
                            $message = 'Error On Update!';
                            //$this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                            $this-> managePermissions();
                            $this->index();
                            }     
                    
            }
        }
     
    }    
    
/************EOF Sports Information settings*******************************************/ 

    
/************Person Information settings*******************************************/
public function setDefaultsPersonInformation()
{
        // set up the variables 
        $this->setPersoninformationvariables();
        //set up Permissions
        $this->setPersonioninformationPermissions();
}

public function setPersoninformationvariables($type='',$name='',$description='',$tempfield='')
{  
    $section = 'personinformation_iprofile';
    if($tempfield==''){$tempfield='personn_1'; }//default value
    
         $temptype = $section.'_type_'.$tempfield; 
         $tempname = $section.'_name_'.$tempfield; 
         $tempdescription =  $section.'_description_'.$tempfield; 
         
            
         
             $template = $this->registry->getObject('template');
             $template->{$temptype}=$type;
             $template->{$tempname}=$name;
             $template->{$tempdescription}=$description;
            
}

public function setPersonioninformationPermissions($permissionsrewrite=array(),$show=false)
{
    
    $tempfields = array(
                            'personn_1'=>true,
                            );
   
       
       if($permissionsrewrite!=null)
       {
           $this->setPermissions('personinformation_iprofile',$show, $permissionsrewrite);
           $this->setPermissions('personinformation_iprofile_edit',false, $permissionsrewrite);
       }
       else
       {
               $this->setPermissions('personinformation_iprofile',$show, $tempfields);
               $this->setPermissions('personinformation_iprofile_edit',false, $tempfields);
       }
}

public function checkPersoninformationPermissions($adminid,$viewuserid)
    {
        $permissionvariables = array('personn_1'=>false); // overload the default permission as false
        $overiddenPermissions = array('personn_1'=>false);
        
        $persondetails = null;
        $person = new PersonObject($this->registry);
        
        
        if($adminid!=$viewuserid)
        {
            //view id
            $persondetails=$person->checkPerson($viewuserid);
        }
        else
        {
            //admin
            $persondetails=$person->checkPerson($adminid);
        }
        
        if($persondetails !=null)
            {
                foreach($persondetails as $person)
                {
                   $field= 'person';
                   $id=$person[0];
                   $tempfield = $field.'_'.$id; //person_id 
                   
                   $permissionvariables[$tempfield]=true; // set the permission array
                   
                   $type = $person[2];
                   $name = $person[3];
                   $description =$person[4]; 
                    
                   
                   
                   $this->setPersoninformationvariables($type, $name, $description, $tempfield);
                }
                
                 $this->setPersonioninformationPermissions($permissionvariables); // set defaults variables
                
                //check for overidden and apply them again over here.
                 $this->setPersonioninformationPermissions($overiddenPermissions);
            }
    }
    
 public function updateorinsertPersoninformation()
    {
        //FIX!!-> add the details if its !NULL
     if(!empty ($_POST['Personinformation-submit']))
        {
             $suc = false;
             $person = new PersonObject($this->registry);
         
            if(isset ($_POST['field']))
            {
                $userid = $_SESSION['Userid'];
                
                $name = $_POST['name']; 
                $type = $_POST['type']; 
                $description ='';// $_POST['Description'];
                
                
                
                $personinfo=$_POST['field'];
                
                 foreach($personinfo as $key=>$section)
                    {
                       
                       
                       
                        if($section=='personn_1')
                        {
                            //insert 
                         //$suc=$person->addPerson($userid, $name[$key], $type[$key], $description[$key]);
                          $suc=$person->addPerson($userid, $name[$key], $type[$key], null);
                        }
                        else
                            {
                                //update
                            //update
                                $whereid=preg_replace('/person_/','' , $personinfo);
                                //$suc=$person->updatePerson($name[$key], $type[$key], $description[$key], $whereid[$key]);
                                 $suc=$person->addPerson($userid, $name[$key], $type[$key], null);
                            }
                    }
            
                    if($suc==true)
                            { 
                            //  redirect(__BASE_URL.'iprofile');  
                            $message = 'Sucessfully updated';
                            $this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                            $this-> managePermissions();
                            $this->index();
                              
                            }
                        else{
                            echo "Error On Update!";
                            
                            $message = 'Error On Update!';
                            //$this->messageAlert->addErrorMessage($message);
                            $template = $this->registry->getObject('template');
                            $template->messages = $message;
                            $this-> managePermissions();
                            $this->index();
                            }    
                    
            }
        }
     
    }    
    
/************EOF Person Information settings*******************************************/  
    
    
    
    
public function updateprivacysection() //AJAX CALL
{
    $suc = false;
    $Resource = $_GET['Resource'];
    $Acess = $_GET['Access'];
    $uid  = $_SESSION['Userid'];
    
    $premission = new permissonObject($this->registry);
    $suc= $premission->OveridePermission($Resource, $Acess, $uid);
   
   echo $suc;
}
}
?>

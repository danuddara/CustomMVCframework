<?php

/*
 *
 *  @project = "iOnexa";
 * @author = "Four Corners Lanka(Pvt) Ltd";
 * @version = 0.1;
 * @date  = "31/12/2013";
 * @class = "indexController class";
 * 
 * 
 */
class eventsController extends baseController
{
        private $templatebits = array();
        private $templatebitvariables = array();
        private $sessionUser;
        private $messageAlert;
    
    public function __construct($registry) 
    {
        
       
        
        
        parent::__construct($registry);
        
            $template = $this->registry->getObject('template'); /****get template object from the registry***/

            /** set variables in the template**/
            if(!isset ($_SESSION['UserName']))
            {
                
                redirect(__BASE_URL);
            }
            $userid = $_SESSION['Userid'];
            
            $template->title =  'Event Planner';
            $template->heading = "Welcome to the iOnexa framework!";
             $template->messages = ''; // messages
            
            $user = new UserObject($this->registry);
            
            
            $template->countries = $user->getALLcountries();
            $template->food_categories = $this->getAllFoodcategories();
            $template->food_list_items = $this->getAllFoodItemListById();
            $template->entertainment_categories = $this->getALLentertainmentcategories();
            $template->entertainment_list_items = $this->getALLentertainmentItemListById();
            $template->volunteer_categories = $this->getALLvolunteerTypes();
            $template->equipment_categories = $this->getALLequipmetTypes();
            
            $this->templatebits['messageAlert'] = 'messageAlert.tpl.php';
            $this->templatebits['events'] = 'events.tpl.php';
            $this->templatebits['eof'] = 'eof_events.tpl.php';
            $this->templatebits['event_calendar'] = 'event_calendar_events.tpl.php';
            $this->templatebits['create_form']='create_form_events.tpl.php';
            $this->templatebits['detailed_plan']='detailed_plan_events.tpl.php';
            $this->templatebits['food_items']='food_items_events.tpl.php';
            $this->templatebits['entertainment_items']='entertainment_items_events.tpl.php';
            $this->templatebits['Volunteer_items']='Volunteer_items_events.tpl.php';
            $this->templatebits['equipment_items']='equipment_items_events.tpl.php';
            
       
            
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
     
        //$this->view();       
        $user = new UserObject( $this->registry);
        $template = $this->registry->getObject('template');
        $template->invitees= $this->getAllinvitees();
        //load all the relavant section templates in the index
        $this->buildpage();
        
        
    }
    
    /*
     * This function is used to create basic event. the others should create separtate actions to get contents from each form.
     * 
     */
    public function createEvent()
    {
         $event = new eventsObject($this->registry);
         $datetime = new DateTime(); 
         $datetimenow= $datetime->format('Y/m/d H:i:s');
         $userid = $_SESSION['Userid'];
         
        if(isset($_POST['createEvent-submit']))
        {
            /*Basic details of event*/
            $event_type= $_POST['event_type'];
            $event_name = $_POST['event_basic_name'];
            $event_start_Date = $_POST ['event_start_Date'];
            $event_end_Date = $_POST['event_end_Date'];
            
                $starting_time_hours = $_POST['starting_time_hours'];
                $starting_time_mins = $_POST['starting_time_mins'];

                $ending_time_hours = $_POST['ending_time_hours'];
                $ending_time_mins = $_POST['ending_time_mins'];
            $Description = $_POST['event_description'];
            $address  = $_POST['address'];

                //$contact_p_id = $_POST['contact_p_id'];
                $contact_p_id =0;
                $contact_p_name = $_POST['contact_p_name'];
                $contact_p_number = $_POST['contact_p_number'];
            /*have to mark to send the values to this form//selection of invitees*/
            $invitee = 0; 
                if(isset($_POST['invitee']))
                {
                    $invitee = $_POST['invitee'];
                }
            $event_confirm_attendance = $_POST['event_confirm_attendance'];
            $event_dress_code = $_POST['event_dress_code'];
            $event_for = $_POST['event_for'];

            $event_parking_info = $_POST['event_parking_info'];
            /*selection of detail plan and its details*/
            $event_need_detail_plan =$event_add_dietary_restrictions=$event_add_allergies= $event_add_spirits=0;
            if(isset ($_POST['event_need_detail_plan']))
            {
                $event_need_detail_plan = $_POST['event_need_detail_plan']; // if this is yes , set the belows too
                
                if(isset ( $_POST['event_add_dietary_restrictions']))
                {
                    $event_add_dietary_restrictions = $_POST['event_add_dietary_restrictions'];
                }
                if(isset ($_POST['event_add_allergies']))
                {
                    $event_add_allergies = $_POST['event_add_allergies'];
                }
                if(isset ($_POST['event_add_spirits']))
                {
                    $event_add_spirits = $_POST['event_add_spirits'];
                }
            }
            
            
           // echo $event_need_detail_plan;
            /*echo $event_type.$event_name.$event_Date.$starting_time_hours.$starting_time_mins.$ending_time_hours.$ending_time_mins.$Description.$address.$contact_p_name.$contact_p_number;
            var_dump($invitee);
            echo $event_confirm_attendance.$event_dress_code.$event_for.$event_parking_info.$event_need_detail_plan.$event_add_allergies.$event_add_dietary_restrictions.$event_add_spirits;
            */
            
            /*eof Basic details of event*/        
            
            $new_event_id = $event->createbasicevent($event_type, $event_name, $Description, $event_start_Date, $starting_time_hours, $starting_time_mins, $event_end_Date, $ending_time_hours, $ending_time_mins, $datetimenow, NULL, $address, $event_for, $event_parking_info, $event_need_detail_plan, $event_add_dietary_restrictions, $event_add_allergies, $event_add_spirits, $userid, $event_dress_code, $contact_p_id, $contact_p_name,$contact_p_number, $invitee);
            
            $_SESSION['event_id'] = $new_event_id; // keep on track of the event
            
            
            $template->messages = 'Event created Successfully.';       
            /*add Food items*/
                    
                    
            /*eof food items*/       
            
           $this->viewEvent(); // created sucessfully.
                    
        }
        
    }
        /* Add Foods to the event */
    
    public function addFood()
    {   $template = $this->registry->getObject('template'); 
        $event = new eventsObject($this->registry);
        
        //if food is submitted and new session is created
        if(isset ($_POST['Food-submit']) && isset ($_SESSION['event_id']) )
        {
            $event_id = $_SESSION['event_id']; // this is created in the createEvent() function
            $food_mealtype = $_POST['food_mealtype']; // breakfast,lunch or dinner
            $food_category  = $_POST['food_category']; // meat,polutry.etc
            $food_item = $_POST['food_item'];//food item
            $food_menu_name = $_POST['food_menu_name']; // deviled chicken or somthing like that,
            $food_item_qty = $_POST['food_item_qty']; // qty
            
            $food_request_contributors = false;
                if(isset ($_POST['food_request_contributors']))
                {
                     $food_request_contributors=true;
                }
        
                
          echo   "Meal:{$food_mealtype}<br/>Category:{$food_category}<br/>fooditem:{$food_item}<br/>food_menu_name{$food_menu_name}<br/>food_qty:{$food_item_qty}<br/>{$food_request_contributors}"; 
          $food_id = 0;
          if(isset ($_SESSION['food_id'])) // if food id isset pass that.else pass 0
          {
            $food_id =$_SESSION['food_id'];
          }
          
          var_dump($food_id);
          
           $_SESSION['food_id']=$event->CreateEventFood($event_id,$food_id, $food_mealtype, $food_item, $food_item_qty, $food_menu_name,$food_request_contributors); // create food dish
           $template->messages = 'Food Added to the Event';
        }
        else
        {
            $template->messages = 'Please Create An Event First';
        }
         $this->viewEvent();
    }
    
    
    public function getAllFoodcategories()
    {
        $event = new eventsObject($this->registry);
        $cats = $event->getALLFoodCategories();
        
        $options = '';
        foreach($cats as $cat)
        {
            $options .= '<option value="'.$cat[0].'">'.$cat[1].'</option>'; // categories
        }
        
        return $options;
    }
    
    public function getAllFoodItemListById($id=1)
    {
        $event = new eventsObject($this->registry);
        $food_list = $event->getALLFoodItemListByid($id);
        
        $options = '';
        foreach($food_list as $food_item)
        {
            $options .= '<option value="'.$food_item[0].'">'.$food_item[1].'</option>'; // categories
        }
        
        return $options;
    }

    /*Add entertainment to the event*/
    
    public function addEntertainment()
    {
        $template = $this->registry->getObject('template'); 
        $event = new eventsObject($this->registry);
        
         if(isset ($_POST['Entertainment-submit']) && isset ($_SESSION['event_id']) ) // if the new event is created and the entertainment button clicked
        {
             $event_id = $_SESSION['event_id']; // this is created in the createEvent() function
             $entertainment_cats = $_POST['entertainment_cats'];
             $entertainment_items = $_POST['entertainment_items'];
             $event_entertainment_name = $_POST['event_entertainment_name'];
             $event_entertainment_qty = $_POST['event_entertainment_qty'];
             
             $entertainment_request_contributors = false;
                 if(isset ($_POST['entertainment_request_contributors']))
                 {
                     $entertainment_request_contributors = true;
                 }
             
             echo "eventid = {$event_id}<br/> entertainment_cat = {$entertainment_cats}<br/> entertainment_items = {$entertainment_items}<br/> entertainment name = {$event_entertainment_name} <br/> entertainnment_qty = {$event_entertainment_qty} ";
             $event->createEntertainment($event_id, $entertainment_cats, $entertainment_items, $event_entertainment_name, $event_entertainment_qty, $entertainment_request_contributors);
             $template->messages = 'Entertainment Added to the Event';    
        }
         else
        {
            $template->messages = 'Please Create An Event First';
        }
         $this->viewEvent();
        
    }
    
    public function getALLentertainmentcategories()
    {
        $event = new eventsObject($this->registry);
        $entertainment_cat_list = $event->getALLentertainmentcats(); //get all the categories
        
         $options = '';
        foreach($entertainment_cat_list as $entertainment_cat)
        {
            $options .= '<option value="'.$entertainment_cat[0].'">'.$entertainment_cat[1].'</option>'; // categories
        }
        
        return $options;
    }

    public function getALLentertainmentItemListById($id=1)
    {
         $event = new eventsObject($this->registry);
        $eventitem_list = $event->getALLenterteainmentItemsListByid($id);
        
        $options = '';
        foreach($eventitem_list as $event_item)
        {
            $options .= '<option value="'.$event_item[0].'">'.$event_item[1].'</option>'; // categories
        }
        
        return $options;
    }

    
    
    /*Add Volunteers to the Event*/
    
    public function addVolunteer()
    {
         $template = $this->registry->getObject('template'); 
         $event = new eventsObject($this->registry);
         
         if(isset ($_POST['volunteer-submit']) && isset ($_SESSION['event_id']) )
         {
             $event_id = $_SESSION['event_id']; // this is created in the createEvent() function
             $volunteer_cats = $_POST['volunteer_cats'];
             $volunteer_Description = $_POST['volunteer_Description'];
             $volunteer_tools_needed = $_POST['volunteer_tools_needed'];
             $volunteer_qty = $_POST['volunteer_qty'];
             $volunteer_request_contributors = false;
             
             if(isset ($_POST['volunteer_request_contributors']))
             {
                 $volunteer_request_contributors = true;
             }
             
             echo "volunteer category : {$volunteer_cats}<br/>volunteer_description: {$volunteer_Description}<br/> tools: {$volunteer_tools_needed}<br/> qty : {$volunteer_qty}<br/>request contributions: {$volunteer_request_contributors}";
             $event->createVolunteers($event_id, $volunteer_cats, $volunteer_Description, $volunteer_tools_needed, $volunteer_qty, $volunteer_request_contributors);
             $template->messages = 'Volunteer Added to the Event';   
         }
          else
            {
                $template->messages = 'Please Create An Event First';
            }
         $this->viewEvent();
        
    }


    public function getALLvolunteerTypes()
    {
         $event = new eventsObject($this->registry);
        $volunteer_cat_list = $event->getALLvolunteerTypes(); //get all the categories
        
         $options = '';
        foreach($volunteer_cat_list as $volunteer_cat)
        {
            $options .= '<option value="'.$volunteer_cat[0].'">'.$volunteer_cat[1].'</option>'; // categories
        }
        
        return $options; 
    }



    /*add volunteer*/
    public function addEquipment()
    {
         $template = $this->registry->getObject('template'); 
         $event = new eventsObject($this->registry);
         if(isset ($_POST['Equipment-submit']) && isset ($_SESSION['event_id']) )
         {
              $event_id = $_SESSION['event_id']; // this is created in the createEvent() function
              $equipment_cat_id = $_POST['equipment_id'];
              $equipment_description = $_POST['equipment_description'];
              $equipment_qty = $_POST['equipment_qty'];
              $equipment_request_contributors = false;
              
              if(isset($_POST['equipment_request_contributors']))
              {
                  $equipment_request_contributors = true;
              }
              
              echo "event_id:{$event_id}<br/>equipment_cat_id : {$equipment_cat_id}<br/> equipment description : {$equipment_description} <br/> equipment_qty : {$equipment_qty} <br/> request_contributions : {$equipment_request_contributors}";
              $event->createEquipments($event_id, $equipment_description, $equipment_qty, $equipment_request_contributors,$equipment_cat_id);    
              $template->messages = 'Equipment Added to the Event';
              
         }
           else
            {
                $template->messages = 'Please Create An Event First';
            }
         $this->viewEvent();
        
    }
    
    
    
    public function getALLequipmetTypes()
    {   
        $event = new eventsObject($this->registry);
        $equipment_cat_list = $event->getALLequipmetTypes(); //get all the categories
        
         $options = '';
        foreach($equipment_cat_list as $equipment_cat)
        {
            $options .= '<option value="'.$equipment_cat[0].'">'.$equipment_cat[1].'</option>'; // categories
        }
        
        return $options; 
        
    }




    /*get all invities of the user and display it
     * 
     * For AJAX we can use another method to get JSON requests. and that can be used in User controller
     */
    public function getAllinvitees()
    {
        $userid = $_SESSION['Userid'];
        $user = new UserObject( $this->registry);
        $allinvits = $user->getAllconnectedProfiles($userid);
        
        $fields = '';
        foreach($allinvits as $invitee)
        {
            
            //$fields .=$invitee;
            $fields .='<dd><input class="profileids" type="checkbox" name="invitee[]" value="'.$invitee[0].'"/><a href="'.__BASE_URL.'iprofile?id='.$invitee[0].'">'.$invitee[1].' '.$invitee[2].'</a></dd>';
            
        }
        
        return $fields; 
        
    }
    
    
    public function viewEvent()
    {
        (empty($_GET['event']))? $event="":$event =$_GET['event'] ;
        
        //create an object of event
        
        //create a function to declare the variables and the permissions
        //pass the event id and get the information for the view.
        //display it later. // 2013/12/31
        
        $template = $this->registry->getObject('template');
        $template->buildtemplate(
                    
                    $this->templatebits['events'],
                    $this->templatebits['event_calendar'],
                    $this->templatebits['detailed_plan'],
                    $this->templatebits['food_items'],
                    $this->templatebits['entertainment_items'],
                    $this->templatebits['Volunteer_items'],
                    $this->templatebits['equipment_items'],
                    $this->templatebits['eof']
                );
        $template->loadtemplatebit($this->templatebits['messageAlert']);
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
        $template->buildtemplate(
                
                    $this->templatebits['messageAlert'],
                    $this->templatebits['events'],
                    $this->templatebits['event_calendar'],
                    $this->templatebits['create_form'],
                    $this->templatebits['eof']
                
                );
    }
    
    
}
?>


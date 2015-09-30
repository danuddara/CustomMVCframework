<?php

/*
 * This is the event object class of events
 * Handle to insert event data
 * 
 *  
 */

class eventsObject extends DBObject
{
    public function __construct($registry) {
      
        parent::__construct($registry);
        
        
            $this->table = 'events';

            $this->columns = array(
                                ':Id'=>NULL,
                                ':IonexaGroupId'=>NULL,
                                ':Type'=>NULL,
                                ':Subject'=>NULL,
                                ':Description'=>NULL,
                                ':StartTime'=>NULL,
                                ':EndTime'=>NULL,
                                ':UpdateTime'=>NULL,
                                ':Photo'=>NULL,
                                ':Address'=>NULL,
                                ':Event_for'=>NULL,
                                ':Parking_Instructions'=>NULL,
                                ':Detail_plan'=>NULL,
                                ':IonexaProfileId'=>NULL,
                                ':EventCalenderId'=>NULL,
                                ':Event_Dress_code_Id'=>NULL
                                    );
        
        }
        
        /*get all event details created by user this is created for the calendar and the view*/
        public function getAllEventsCreatedByUser($uid)
        {
            $db = $this->registry->getObject('db');
             $sql = 'SELECT * FROM events 
                        INNER JOIN eventcalender ON events.EventCalenderId =eventcalender.Id 
                        INNER JOIN event_dress_code ON events.Event_Dress_code_Id = event_dress_code.Id 
                        WHERE events.IonexaProfileId='.$uid;

             $rows=$db->select($sql);
             return $rows; 
        }
        
        /*get all contact details of the event*/
        public function getALLcontactdetails($event_id)
        {
            $db = $this->registry->getObject('db');
             $sql = 'SELECT *
                        FROM `event_contacts` WHERE events_Id='.$event_id;

             $rows=$db->select($sql);
             return $rows;
        }


        /*
         * this is usable to display invite list of friends/family and others
         * 
         */
        
        public  function getAllconnectedProfiles($uid)
        {
             $db = $this->registry->getObject('db');
             $sql = 'SELECT *
                        FROM `relationships`
                        WHERE `UserId` ='.$uid;

             $rows=$db->select($sql);
             return $rows; 
        }

        
      /*creation of basic event*/  
        public function createbasicevent($type,$subject,$description,$startdate,$starttime_hours,$starttime_mins,$enddate,$endtime_hours,$endtime_mins,$updatetime,$photo,$address,$eventfor,$parkinginstructions,$detailplan,$add_dietary_restrictions,$add_allergies,$add_spirits,$ionexaprofileid,$eventdresscodeid,$contact_profile_ids,$contact_names,$phonenumbers,$group_ids)
        {
            echo 'subject: '.$subject.'<br/>'.
                 'Description: '.$description.'<br/>'.
                 'startdate: '.$startdate.'<br/>'.
                 'starttimehours: '.$starttime_hours.'<br/>'.
                 'starttimemins:'.$starttime_mins.'<br/>'.
                 'enddate:'.$enddate.'<br/>'.
                 'endtimehours:'.$endtime_hours.'<br/>'.
                 'endtimemins:'.$endtime_mins.'<br/>'.
                  'updatetime:'.$updatetime.'<br/>'.
                  'photo:'.$photo.'<br/>'.
                    'addresss'.$address.'<br/>'.
                    'eventfor'.$eventfor.'<br/>'.
                    'parkinginstructions'.$parkinginstructions.'<br/>'.
                    'detailplan'.$detailplan.'<br/>'.
                    'adddietaryrestrictions'.$add_dietary_restrictions.'<br/>'.
                    'addallergies'.$add_allergies.'<br/>'.
                    'addspirits'.$add_spirits.'<br/>'.
                    'ionexaprofileid'.$ionexaprofileid.'<br/>'.
                    'eventdresscodeid'.$eventdresscodeid.'<br/>'.
                    
                    var_dump($contact_profile_ids,$contact_names,$phonenumbers,$group_ids);
            /*start date time has been created. the duration can be extended. it can be oneday event or more.*/
            $startdatetime = $startdate.' '.$starttime_hours.':'.$starttime_mins.':00';
            $enddatetime = $enddate.' '.$endtime_hours.':'.$endtime_mins.':00';
            //create event calendar
            $calendarid = $this->createeventcalendar($subject, $startdatetime, $enddatetime);
            
            //  and then create the event
            $db = $this->registry->getObject('db');
            $coloums =  $this->columns;
            
            $coloums[':Type']=$type;
            $coloums[':Subject']=$subject;
            $coloums[':Description'] =$description;
            $coloums[':StartTime']=$startdatetime;
            $coloums[':EndTime']=$enddatetime;
            $coloums[':UpdateTime'] = $updatetime;
            $coloums[':Photo']=$photo;
            $coloums[':Address']=$address;
            $coloums[':Event_for']=$eventfor;
            $coloums[':Parking_Instructions'] =$parkinginstructions;
            $coloums[':Detail_plan']=$detailplan;
            $coloums[':IonexaProfileId']=$ionexaprofileid;
            $coloums[':EventCalenderId'] = $calendarid;
            $coloums[':Event_Dress_code_Id']=$eventdresscodeid;
            
            $db->InsertRecords($this->table,  $coloums);
            
            $event_id = $db->lastinserted(); // the event_id of newly created event
            
            //and then the group of invitees
            $this->creategroup($group_ids, $event_id,$type,$subject,$description);
            //create the caller groups
            $this->createcallergroup($contact_names, $contact_profile_ids,$phonenumbers, $event_id);
            
            if($detailplan==1) // if user need a detail plan , insert the management sections to the detail_plan_management table.
            {
                $this->createeventdetailplanmangement($add_dietary_restrictions, $add_allergies, $add_spirits, $event_id);
            }
            
            //echo "detailplan: ".$detailplan;
            
            return $event_id; /*return event id for a session to keep on track on the lastly created event. adding food/entertainment/equipment and volunteer can be done in steps as 1/2/3/4*/
            
        }
        
        
        /*create event calendar and get the id*/
        private function createeventcalendar($subject,$startdate,$enddate)
        {
            $db = $this->registry->getObject('db');
            $table = 'eventcalender';
            $coloums = array(
                                ':Id'=>NULL,
                                ':Subject'=>NULL,
                                ':Description'=>NULL,
                                ':StartDate'=>NULL,
                                ':EndDate'=>NULL,
                                
                                    ); 
            
           $coloums[':Subject'] = $subject;  //the name of the event
           $coloums[':StartDate'] = $startdate; 
           $coloums[':EndDate'] = $enddate; 
           
            $db->InsertRecords( $table,  $coloums);
            $calendarid = $db->lastinserted();
            return $calendarid;
            
            
            
            
        }
        
            /*
             * create group id
             */
        private function creategroup($group_ids, $event_id,$type,$subject,$description)
        {
            $db = $this->registry->getObject('db');
            
            $table = 'ionexagroup';
            $coloums = array(
                                ':Id'=>NULL,
                                ':PhotoId'=>NULL,
                                ':Type'=>NULL,
                                ':Name'=>NULL,
                                ':Description'=>NULL,
                                ':RecentUpdates'=>NULL,
                                ':EventsId'=>NULL,
                                ':IonexaProfileId'=>NULL,
                                ':confirm_attendace'=>NULL,
                                ':ionexagroupcol'=>NULL
                                ); 
            
            if($group_ids!=null)
            {
                   $coloums[':Type'] = $type;  //the name of the event
                   $coloums[':Name'] = $subject; 
                   $coloums[':Description'] = $description;
                 
                   $coloums[':EventsId'] = $event_id;
                   
                  
                  
                   /*loop for ech person
                    * 
                    */
                   foreach($group_ids as $ionexaid)
                   {
                       $coloums[':IonexaProfileId'] = $ionexaid;
                       $db->InsertRecords( $table,  $coloums);
                   }
            }
            
           
                
           
            //type = event
            //event name
            //description
            //recent updates
            
           
        }
        /*
             * createcallgroup 
             */
        private function createcallergroup($names,$profileids,$phonenumbers,$eventid)
        {
            $db = $this->registry->getObject('db');
            $table = 'event_contacts';
            $coloums = array(
                                ':id'=>NULL,
                                ':name'=>NULL,
                                ':IonexaProfileId'=>NULL,
                                ':contactNo'=>NULL,
                                ':events_Id'=>NULL,
                                
                                    ); 
            if($names!=null)
            {
                $coloums[':events_Id']=$eventid;
                
                foreach($names as $key=>$id) /*add each contact details*/
                {
                     $coloums[':name'] = $names[$key];
                     $coloums[':IonexaProfileId'] = 0;
                     $coloums[':contactNo'] = $phonenumbers[$key];
                     $db->InsertRecords( $table,  $coloums);
                }
            }
            
        }
        
        /*create main detail management plan*/
        
        private function createeventdetailplanmangement($add_dietary_restrictions,$add_allergies,$add_spirits,$event_id)
        {
            $db = $this->registry->getObject('db');
            $table = 'event_detail_plan_management';
            $coloums = array(
                                ':Id'=>NULL,
                                ':add_dietary_restrictions'=>NULL,
                                ':add_allergies'=>NULL,
                                ':add_spirits'=>NULL,
                                ':events_Id'=>NULL,
                                
                                    ); 
            
           $coloums[':add_dietary_restrictions'] = $add_dietary_restrictions;  //the name of the event
           $coloums[':add_allergies'] = $add_allergies; 
           $coloums[':add_spirits'] = $add_spirits; 
           $coloums[':events_Id'] = $event_id;
           
            $db->InsertRecords( $table,  $coloums);
          
        }
        
         /*eof creation of basic event*/ 

        
        
        
        
        
        /*check wether the event is available if so, update else insert*/
        private function isAvailableEventPlanningSection($event_id)
        {
            $isavalable = false;
             $db = $this->registry->getObject('db');
             $sql = 'SELECT *
                        FROM `event_planning` WHERE `events_Id` = 
                     '.$event_id;

             $rows=$db->select($sql);
             
             if($rows!=null)
             {
                 $isavalable = true;
             }
             return $rows; 
        }
        
        
              /*get the event planning ID or create a new planning ID and return it*/
            private function checkAndReturnEventPlanningId($event_id)
            {
                $event_planning_id = NULL;
                $db = $this->registry->getObject('db');
                var_dump($event_id);

                $rows = $this->isavailableeventplanningsection($event_id);
                var_dump($rows);

                if($rows!=null) // if this is not null get  the id or create a new event
                {
                    $event_planning_id  = $rows[0][0]; // get the id of the event planning table align with event_id;
                }
                else
                {
                    $this->eventPlanningSection($event_id);
                    $lastinsertedrow = $db->lastinserted();
                     var_dump($lastinsertedrow);
                    $event_planning_id = $lastinsertedrow[0]; // assign the last inserted id for this.


                }
                var_dump($event_planning_id);

                return $event_planning_id;

            }
        
        
        /*check wether the event food type is already exsits, if breakfasst is already added you have to get that id, do not create a new one here*/
        private function isAvailableFoodMealType($type_id,$event_planning_id)
        {
             $isavalable = false;
             $db = $this->registry->getObject('db');
             $sql = 'SELECT *
                        FROM `event_food` WHERE `Type` = 
                     '.$type_id.' AND `event_planning_Id`='.$event_planning_id;

             $rows=$db->select($sql);
             
             if($rows!=null)
             {
                 $isavalable = true;
             }
             return $rows;
        }

        
        /*check wether the event entertainment type is already exsists, if Music is already added you have to get that id, do not create new one here too*/
        
        private function isAvailableEntertainmentType($type_id,$event_planning_id)
        {
             $isavalable = false;
             $db = $this->registry->getObject('db');
             $sql = 'SELECT *
                        FROM `event_entertainment` WHERE `Type` = 
                     '.$type_id.' AND `event_planning_Id`='.$event_planning_id;

             $rows=$db->select($sql);
             
             if($rows!=null)
             {
                 $isavalable = true;
             }
             return $rows;
        }
        
         /*check wether the event voulnteer type is already exsists, if cleanning is already added you have to get that id, do not create new one here too*/
        private function isAvailableVolunteerType($type_id,$event_planning_id)
        {
             $isavalable = false;
             $db = $this->registry->getObject('db');
             $sql = 'SELECT *
                        FROM `event_volunteers` WHERE `Type` = 
                     '.$type_id.' AND `event_planning_Id`='.$event_planning_id;

             $rows=$db->select($sql);
             
             if($rows!=null)
             {
                 $isavalable = true;
             }
             return $rows;
        }

        /*check wether the event Equipment type is already exsists, if Music Accessories is already added you have to get that id, do not create new one here too*/
        private function isAvailableEquipmentType($type_id,$event_planning_id)
        {
             $isavalable = false;
             $db = $this->registry->getObject('db');
             $sql = 'SELECT *
                        FROM `event_equipment` WHERE `Type` = 
                     '.$type_id.' AND `event_planning_Id`='.$event_planning_id;

             $rows=$db->select($sql);
             
             if($rows!=null)
             {
                 $isavalable = true;
             }
             return $rows;
        }




        /* event_planning sections
          * 
         *  $event_id  we'll get from Session
         */
        private function eventPlanningSection($event_id)
        {
              $db = $this->registry->getObject('db');
              $table = 'event_planning';
              $coloums = array(
                                ':Id'=>NULL,
                                ':events_Id'=>NULL,
                                
                                    ); 
              
              $coloums[':events_Id'] = $event_id;
              $db->InsertRecords( $table,  $coloums);
              
        }
        
        /*creation of foods*/
        
     
        // get the event id from the session.
        public function CreateEventFood($event_id,$food_id,$type,$event_food_list_id,$qty,$menu_name,$request_contributors)
        {
            $db = $this->registry->getObject('db');
            
            $event_planning_id=$this->checkAndReturnEventPlanningId($event_id);
            
            
            $table = 'event_food';
            $coloums = array(
                                ':Id'=>NULL,
                                ':Type'=>NULL,
                                ':event_planning_Id'=>NULL,
                                ); 
            
            $availability_food_type = $this->isAvailableFoodMealType($type, $event_planning_id); // check the availability of food mealtype
            
            $event_food_id = NULL;
                if($availability_food_type==null) // if food type is not registed do this
                {
                 $coloums[':Type'] =$type;
                 $coloums[':event_planning_Id'] = $event_planning_id;

                 $db->InsertRecords( $table,  $coloums);
                 $event_food_id  = $db->lastinserted();
                }
                 else { 
                     
                     $event_food_id = $availability_food_type[0][0]; // assign the id that is already available
                }
             
             
              // get the newly created id
             $this->insert_event_food_dishes($event_food_id, $event_food_list_id, $qty,$menu_name,$request_contributors); // anyway do the insert
             
             return $event_food_id; // return it so we can use it in a session when adding foods.
        }
        
        public function insert_event_food_dishes($event_food_id,$event_food_list_id,$qty,$menu_name,$request_contributors) // insert food dishes with food id
        {
              $db = $this->registry->getObject('db');
              $table = 'event_food_dishes';
              $coloums = array(
                                ':Id'=>NULL,
                                ':menu_name'=>NULL,
                                ':Qty'=>NULL,
                                ':request_contributors'=>NULL,
                                ':event_food_menu_cats_and_lists_Id'=>NULL,
                                ':event_Food_Id'=>NULL,
                  
                                    );
              $coloums[':menu_name'] = $menu_name;
              $coloums[':Qty'] = $qty;
              $coloums[':event_food_menu_cats_and_lists_Id']=$event_food_list_id;
              $coloums[':event_Food_Id'] = $event_food_id;
              $coloums[':request_contributors'] = $request_contributors;
              
              $db->InsertRecords( $table,  $coloums);
        }

        
        /*creation of entertainment*/
        
        
        public function createEntertainment($event_id,$entertainment_type_id,$entertainment_list_item_id,$entertainment_name,$qty,$request_contributors)
        {
            
            $db = $this->registry->getObject('db');
            
            $event_planning_id=$this->checkAndReturnEventPlanningId($event_id);
            
            $table = 'event_entertainment';
            $coloums = array(
                                ':Id'=>NULL,
                                ':Type'=>NULL,
                                ':event_planning_Id'=>NULL,
                                ); 
            
             $availability_entertainment_type = $this->isAvailableEntertainmentType($entertainment_type_id, $event_planning_id); 
             
             $event_entertainment_id = NULL;
                if($availability_entertainment_type==null) // if entertainment type is not registed do this
                {
                 $coloums[':Type'] =$entertainment_type_id;
                 $coloums[':event_planning_Id'] = $event_planning_id;

                 $db->InsertRecords( $table,  $coloums);
                 $event_entertainment_id  = $db->lastinserted();
                }
                 else { 
                     
                     $event_entertainment_id = $availability_entertainment_type[0][0]; // assign the id that is already available
                }
                
                
                 // get the newly created id
             $this->insert_event_entertainment_items($event_entertainment_id, $entertainment_list_item_id, $qty,$entertainment_name,$request_contributors); // anyway do the insert
             
             return $event_entertainment_id; // return it so we can use it in a session when adding entertainments.
            
        }

        
        public function insert_event_entertainment_items($event_entertainment_id, $entertainment_list_item_id, $qty,$entertainment_name,$request_contributors) // insert entertainment items with entertainment list ids
        {
             $db = $this->registry->getObject('db');
              $table = 'event_entertainment_items';
              $coloums = array(
                                ':Id'=>NULL,
                                ':name'=>NULL,
                                ':Qty'=>NULL,
                                ':request_contributors'=>NULL,
                                ':event_entertainment_Id'=>NULL,
                                ':event_entertainment_category_and_lists_Id'=>NULL,
                  
                                    );
              $coloums[':name'] = $entertainment_name;
              $coloums[':Qty'] = $qty;
              $coloums[':event_entertainment_category_and_lists_Id']=$entertainment_list_item_id;
              $coloums[':event_entertainment_Id'] = $event_entertainment_id;
              $coloums[':request_contributors'] = $request_contributors;
              
              $db->InsertRecords( $table,  $coloums);
            
        }




        /*creation of volunteers*/
        
        //lets do it today!!!!! :)
        
        public function createVolunteers($event_id,$volunteer_type_id,$description,$tools_needed,$qty,$request_contributors)
        {
             $db = $this->registry->getObject('db');
            
            $event_planning_id=$this->checkAndReturnEventPlanningId($event_id);
            
            $table = 'event_volunteers';
            $coloums = array(
                                ':Id'=>NULL,
                                ':Type'=>NULL,
                                ':event_planning_Id'=>NULL,
                                ); 
            
            $availability_volunteer_type = $this->isAvailableVolunteerType($volunteer_type_id, $event_planning_id); 
            
            
            $event_volunteer_id = NULL;
                if($availability_volunteer_type==null) // if entertainment type is not registered do this
                {
                 $coloums[':Type'] =$volunteer_type_id;
                 $coloums[':event_planning_Id'] = $event_planning_id;

                 $db->InsertRecords( $table,  $coloums);
                 $event_volunteer_id  = $db->lastinserted();
                }
                 else { 
                     
                     $event_volunteer_id = $availability_volunteer_type[0][0]; // assign the id that is already available
                }
                
                
                $this->insertVolunteers($description,$tools_needed,$qty,$request_contributors,$volunteer_type_id,$event_volunteer_id); // insert anyway
                return $event_volunteer_id; // set it up in a session
            
        }
        
        public function insertVolunteers($description,$tools_needed,$qty,$request_contributors,$event_volunteers_cateogies_Id,$event_volunteers_Id)
        {
              $db = $this->registry->getObject('db');
              $table = 'event_volunteers_work_list';
              $coloums = array(
                                ':Id'=>NULL,
                                ':Description'=>NULL,
                                ':Tools_needed'=>NULL,
                                ':Qty'=>NULL,
                                ':request_contributors'=>NULL,
                                ':event_volunteers_cateogies_Id'=>NULL, // this is the same as the TYPE in event_volunteers table. we can add categories to the categories table
                                ':event_volunteers_Id'=>NULL,
                  
                                    );
              $coloums[':Description'] = $description;
              $coloums[':Tools_needed'] = $tools_needed;
              $coloums[':Qty']=$qty;
              $coloums[':request_contributors'] = $request_contributors;
              $coloums[':event_volunteers_cateogies_Id'] = $event_volunteers_cateogies_Id;
              $coloums[':event_volunteers_Id'] = $event_volunteers_Id;
              
              $db->InsertRecords( $table,  $coloums);
        }
        
        
        /*creation of equipments*/
        
        public function createEquipments($event_id,$description,$qty,$request_contributors,$event_equipment_categories_Id)
        {
             $db = $this->registry->getObject('db');
            
            $event_planning_id=$this->checkAndReturnEventPlanningId($event_id);
            
            $table = 'event_equipment';
            $coloums = array(
                                ':Id'=>NULL,
                                ':Type'=>NULL,
                                ':event_planning_Id'=>NULL,
                                ); 
            
            $availability_equipment_type = $this->isAvailableEquipmentType($event_equipment_categories_Id, $event_planning_id);
            
            $event_equipment_id = NULL;
            if($availability_equipment_type==null) // if entertainment type is not registered do this
                {
                 $coloums[':Type'] =$event_equipment_categories_Id;
                 $coloums[':event_planning_Id'] = $event_planning_id;

                 $db->InsertRecords( $table,  $coloums);
                 $event_equipment_id  = $db->lastinserted();
                }
                 else { 
                     
                     $event_equipment_id = $availability_equipment_type[0][0]; // assign the id that is already available
                }
                
                $this->insertEquipments($description, $qty, $request_contributors, $event_equipment_id, $event_equipment_categories_Id);
                return $event_equipment_id;
            
        }

        public function insertEquipments($description,$qty,$request_contributors,$event_equipment_id,$event_equipment_categories_Id)
        {
             $db = $this->registry->getObject('db');
              $table = 'event_equipment_list';
              $coloums = array(
                                ':Id'=>NULL,
                                
                                ':Qty'=>NULL,
                                ':Description'=>NULL,
                                ':request_contributors'=>NULL,
                                ':event_equipment_Id'=>NULL, // this is the same as the TYPE in event_volunteers table. we can add categories to the categories table
                                ':event_equipment_categories_Id'=>NULL,
                  
                                    );
              $coloums[':Description'] = $description;
              $coloums[':Qty']=$qty;
              $coloums[':request_contributors'] = $request_contributors;
              $coloums[':event_equipment_categories_Id'] = $event_equipment_categories_Id;
              $coloums[':event_equipment_Id'] = $event_equipment_id;
              
              $db->InsertRecords( $table,  $coloums);
            
        }




        /* option fields for the form */
        public function getALLFoodCategories()
        {
             $db = $this->registry->getObject('db');
             $sql = 'SELECT * FROM `event_food_menu_categories`';

             $rows=$db->select($sql);
             return $rows; 
            
        }

        public function  getALLFoodItemListByid($id)
        {
            $db = $this->registry->getObject('db');
             $sql = 'SELECT * FROM `event_food_menu_cats_and_lists` WHERE `event_food_menu_categories_Id`='.$id;

             $rows=$db->select($sql);
             return $rows;
        }



        public function getALLentertainmentcats()
        {
            $db = $this->registry->getObject('db');
             $sql = 'SELECT * FROM `event_entertainment_categories`';

             $rows=$db->select($sql);
             return $rows; 
        }
        
        public function getALLenterteainmentItemsListByid($id)
        {
            $db = $this->registry->getObject('db');
             $sql = 'SELECT * FROM `event_entertainment_category_and_lists` WHERE `event_entertainment_categories_Id`='.$id;

             $rows=$db->select($sql);
             return $rows;
        }
        
        
        public function getALLvolunteerTypes()
        {
             $db = $this->registry->getObject('db');
             $sql = 'SELECT * FROM `event_volunteers_cateogies`';

             $rows=$db->select($sql);
             return $rows;
        }
        
        public function getALLequipmetTypes()
        {
             $db = $this->registry->getObject('db');
             $sql = 'SELECT * FROM `event_equipment_categories`';

             $rows=$db->select($sql);
             return $rows;
        }










        private function prepareforupdate($columns)
        {
            $values = array();
            
            foreach($columns as $key => $value)
        
                    {
                        if($value!=null)
                        {
                            $values[preg_replace('/:/','' , $key)] = $value;
                        }
                    }
            
            return $values;
        }
        
        
}
?>

<?php
/*
 *  @project = "iOnexa";
 * @author = "Four Corners Lanka(Pvt) Ltd";
 * @version = 0.1;
 * @date  = "13/06/2013";
 * @class = "User class";
 */
class UserObject extends DBObject
{
   
    
    public function __construct($registry) {
      
        parent::__construct($registry);
        
        $this->table = 'iprofile';
      
        $this->columns = array(
                       ":id"=>null,
                       ":Email"=>null,
                       ":SeconderyEmail"=>null,
                       ":FirstName"=>null,
                       ":LastName"=>null,
                       ":Password"=>null,
                       ":DateofBirth"=>null,
                       ":Relationship"=>null,
                       ":Height"=>null,
                       ":Weight"=>null,
                       ":Gender"=>null,
                       ":Address"=>null,
                       ":CountryId"=>null,
                       ":StateId"=>null,
                       ":CityId"=>null,
                       ":Zipcode"=>null,
                       ":LivingStateId"=>null,
                       ":LivingCityId"=>null,
                       ":LivingCountryId"=>null,
                       ":Active"=>0, // in PHP 0 means NULL if we write the condition as ==0/==NULL
                       ":Suspended"=>0,
                           );
        
       
    }
    
    public function login($email,$password)
    {       $db = $this->registry->getObject('db');
         $sql = 'SELECT Id,FirstName,LastName,Active,Suspended FROM iprofile WHERE Password="'.md5($password).'" AND Email="'.$email.'"';
       
         $rows=$db->select($sql);
         if($rows!=null)
         {
             return $rows;
         }
         else
         {
             return -999;
         }
         
         
    }
    
    public function checkemailavailability($email)
    {
         $db = $this->registry->getObject('db');
         $sql = 'SELECT Id,Email,FirstName FROM iprofile WHERE Email="'.$email.'"';
         $rows=$db->select($sql);
         return $rows;
    }


    public  function addUserBasicDetails($email,$firstname,$lastname,$password,$dob,$gender,$countryid)
    {
        $db = $this->registry->getObject('db');
        $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
        $coloums[':Email']=$email;
        $coloums[':FirstName']=$firstname;
        $coloums[':LastName'] =$lastname;
        $coloums[':Password']=$password;
        $coloums[':DateofBirth']=$dob;
        $coloums[':Gender'] = $gender;
        $coloums[':CountryId']=$countryid;
        
        $db->InsertRecords($this->table,  $coloums);
        
       
              
    }
    
    public function updateBasicDetails($firstname=null,$lastname=null,$gender=null,$country=null,$whereid=null)
    {
        $suc=false;
        $db = $this->registry->getObject('db');
        $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
        $coloums[':Email']=null;
        $coloums[':FirstName']=$firstname;
        $coloums[':LastName'] =$lastname;
        $coloums[':Password']=null;
        $coloums[':DateofBirth']=null;
        $coloums[':Gender']=$gender;
        $coloums[':CountryId']=$country;
        
        
      
        
        
        
        $values = $this->prepareforupdate($coloums);
        $values['id']=$whereid; //condition    
            //print_r($values);
        if($values!=NULL)
        {
        $suc=$db->updateRecords($this->table,$values);
        }
        return $suc;
    }
    
    
    public function updatePersonalInformation($SeconderyEmail=null,$Address=null,$City=null,$State=null,$ZipCode=null,$HomeCounty=null,$BdayDate=null,$Relationship=null,$Height=null,$Weight=null,$whereid=null)
    {
        $suc=false;
        $db = $this->registry->getObject('db');
        $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
        $coloums[':SeconderyEmail']=$SeconderyEmail;
        $coloums[':Address']=$Address;
        $coloums[':CityId']=$City;
        $coloums[':StateId']=$State;
        $coloums[':Zipcode']=$ZipCode;
        $coloums[':LivingCountryId']=$HomeCounty; /*note: living country id has been set has Home Country ID this has no relationships by default the country id have been set as living country*/
        $coloums[':DateofBirth']=$BdayDate;
        $coloums[':Relationship']=$Relationship;
        $coloums[':Height'] = $Height;
        $coloums[':Weight'] = $Weight;
       
        $values = $this->prepareforupdate($coloums);
        $values['id']=$whereid; //condition    
            //print_r($values);
        if($values!=NULL)
        {
        $suc=$db->updateRecords($this->table,$values);
        }
        return $suc;
        
    }
    
    public function updatePassword($email,$password)
    {
        $suc=false;
        $db = $this->registry->getObject('db');
        $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
        $coloums[':Password']=md5($password);
        $values = $this->prepareforupdate($coloums);
        $values['Email']=$email;
        
         if($values!=NULL)
        {
         $suc = $db->updateRecords($this->table,$values);
         
        }
        return $suc;
    }
    public function ActivateAccount($whereemail)
    {
        $suc=false;
        $db = $this->registry->getObject('db');
        $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
        $coloums [':Active']=1;
        $values = $this->prepareforupdate($coloums);
        $values['email']=$whereemail; //condition  
        if($values!=NULL)
        {
            $suc=$db->updateRecords($this->table,$values);
        }
        
        return $suc;
    }
    
    public function SuspedAccount($uid,$status)
    {
        $suc=false;
        $db = $this->registry->getObject('db');
        $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
        $coloums [':Suspended']=$status;
        $values = $this->prepareforupdate($coloums);
        $values['id']=$uid; //condition  
        if($values!=NULL)
        {
            $suc=$db->updateRecords($this->table,$values);
        }
        
        return $suc;
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
    
   
    
    public function getALLcountries()
    {
         $db = $this->registry->getObject('db');
         $sql = 'SELECT * FROM countries';
         
         $rows=$db->select($sql);
         return $rows; 
    }
     public function getALLstates($countryid)
    {
         $db = $this->registry->getObject('db');
         $sql = 'SELECT
                `Id`,
                `State`
                 FROM `countrystates` WHERE CountryId='.$countryid;
         
         $rows=$db->select($sql);
         return $rows; 
    }
    public function getALLCities($stateid)
    {
        $db = $this->registry->getObject('db');
         $sql = 'SELECT
                `Id`,
                `Name`
                FROM `countrycities` WHERE StateId='.$stateid;
         
         $rows=$db->select($sql);
         return $rows;
    }
    
    
    

    public function getBasicDetails($userid)
    {
         $db = $this->registry->getObject('db');
         $sql = 'SELECT `Email`,`FirstName`,`LastName`,`Gender`,`CountryId` FROM `iprofile` WHERE Id ='.$userid;
         
         $rows=$db->select($sql);
         return $rows;
    }
    
    public function getPersonalDetails($userid)
    {
         $db = $this->registry->getObject('db');
         $sql = 'SELECT `SeconderyEmail`,`Address`,`CountryId`,`CityId`,`StateId`,`Zipcode`,`LivingCountryId`,`DateofBirth`,`Relationship`,`Height`,`Weight` FROM `iprofile` WHERE Id ='.$userid;
         
         $rows=$db->select($sql);
         
         return $rows;
    }
    
    
    /*
     * event invites for all, and might be use full for friend search,
     */
    
    public  function getAllconnectedProfiles($userid)
        {
             $db = $this->registry->getObject('db');
             $sql = 'SELECT relationships.RelationUserId, iprofile.FirstName, iprofile.LastName, relationships.RelationshipType
                    FROM relationships
                    INNER JOIN iprofile ON relationships.RelationUserId = iprofile.Id
                    WHERE relationships.UserId ='.$userid;

             $rows=$db->select($sql);
             return $rows; 
        }
    
    
    /*admin methods*/
    public function getALLpeople()
    {
        $db = $this->registry->getObject('db');
         $sql = 'SELECT `id`,`Email`,`FirstName`,`LastName`,`Suspended` FROM `iprofile` WHERE Active=1';
         
         $rows=$db->select($sql);
         
         return $rows;
    }
    
    
}
?>
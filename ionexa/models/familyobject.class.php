<?php

/*
  *  @project = "iOnexa";
 * @author = "Four Corners Lanka(Pvt) Ltd";
 * @version = 0.1;
 * @date  = "04/07/2013";
 * @class = "FamilyObject class";
 */

class FamilyObject extends DBObject
{
     public function __construct($registry) {
      
        parent::__construct($registry);
        
        
          $this->table = 'family';

            $this->columns = array(
                                ':Id'=>NULL,
                                ':CountryId'=>NULL,
                                ':iProfileID'=>NULL,
                                ':FirstName'=>NULL,
                                ':LastName'=>NULL,
                                ':DateOfBirth'=>NULL,
                                ':Gender'=>NULL,
                                ':Relationship'=>NULL,
                                ':IsBPMember'=>NULL
                                );
        
        }
     
        public function getFamilyMember($uid,$familyid)
        {
             $db = $this->registry->getObject('db');
             $sql = "SELECT Id,CountryId,FirstName,LastName,DateOfBirth,Gender,Relationship,IsBPMember  FROM family WHERE iProfileID={$uid} AND Id={$familyid}";
             $rows=$db->select($sql);
             return $rows;
            
        }


     public function checkFamilyMemberCount($uid)
     {
         $db = $this->registry->getObject('db');
         $sql = 'SELECT Id,CountryId,FirstName,LastName,DateOfBirth,Gender,Relationship,IsBPMember  FROM family WHERE iProfileID='.$uid;
         $rows=$db->select($sql);
         return $rows;
     }
     
     public function addFamilymember($countryid=null,$iprofileid=null,$firstname=null,$lastname=null,$dateofbirth=null,$gender=null,$relationship=null,$isBPmember=null)
     {
        $suc=false;
        $db = $this->registry->getObject('db');
        $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
        $coloums[':CountryId']=$countryid;
        $coloums[':iProfileID']=$iprofileid;
        $coloums[':FirstName']=$firstname;
        $coloums[':LastName']=$lastname;
        $coloums[':DateOfBirth']=$dateofbirth;
        $coloums[':Gender']=$gender;
        $coloums[':Relationship']=$relationship;
        $coloums[':IsBPMember']=$isBPmember;
        
        $suc=$db->InsertRecords($this->table,  $coloums);
        return $suc;
     }

     



     public function updateFamilyMember($countryid=null,$iprofileid=null,$firstname=null,$lastname=null,$dateofbirth=null,$gender=null,$relationship=null,$isBPmember=null,$whereid=null)
     {
        $suc=false;
        $db = $this->registry->getObject('db');
        $coloums =  $this->columns; // keep a temprory copy so that we can use user object eaach time
        $coloums[':CountryId']=$countryid;
        $coloums[':iProfileID']=$iprofileid;
        $coloums[':FirstName']=$firstname;
        $coloums[':LastName']=$lastname;
        $coloums[':DateOfBirth']=$dateofbirth;
        $coloums[':Gender']=$gender;
        $coloums[':Relationship']=$relationship;
        $coloums[':IsBPMember']=$isBPmember;
        
        
        $values = $this->prepareforupdate($coloums);
        $values['id']=$whereid; //condition    
            //print_r($values);
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
    
    
    public function deleteFamilyMember($uid,$id)
    {
         $db = $this->registry->getObject('db');
         $sql = "DELETE FROM `family` WHERE `Id` ={$id} AND iProfileID ={$uid}";
         $suc=$db->deleteRecord($sql);
         echo $suc;
    }
}
?>
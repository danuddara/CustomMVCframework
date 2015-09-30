<?php
/*
 * @project = "iOnexa";
 * @author = "Four Corners Lanka(Pvt) Ltd";
 * @version = 0.1;
 * @date  = "03/06/2013";
 * @class = "DBclass";
 * The DataBase class of ionexa framework.
 * 
 */
//include config.class to work

require_once 'config/config.class.php';

class DBClass
{
    private static $connections; // singleton database object
    private $con;
    private $host;
    private $username;
    private $password;
    private $db;
   // private $cashQuery;
   // private $dbid;
    
    private function  __construct()
    
    {
       $config = Config::getConfig(); // set singleton config object
       $host        = $this->host  = Config::getKeys('host');
       $user        = $this->username = Config::getKeys('username');
       $password    = $this->password = Config::getKeys('password');
       $database    = $this->db = Config::getKeys('db');
       $this->newConnection($host, $user, $password, $database);
      // return $dbid; //dbid to the registrey
      
    }
    
    public static function getconnection()
    {
        
        if(DBClass::$connections==null)
            {
                self::$connections = new DBClass();
            }
            return self::$connections; // return database object
    }


    /**
     * Create a new PDO database connection
     * @param String database hostname
     * @param String database username
     * @param String database password
     * @param String database we are using
     *
     */
    private function newConnection( $host, $user, $password, $database )
    {
      try
        { 
            $dsn  = "mysql:host=$host;dbname=$database";
            
            $this->con = new PDO( $dsn, $user, $password);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);//error handiling on production
           
         }
     catch ( PDOException $e)
         {
              print "Error!: " . $e->getMessage() . "<br/>";
              die();

         }
    
    	//return $connection_id;
    }
    /*
     * Get method for the connection link
     */
    private function getActiveConnection() 
    {
        
        return $this->con;
    }
    /*
     * INSERT statement for any table with Values.
     * 
     * @PDO SQL = INSERT INTO {$table} VALUES (:value[1],:value[2]);
     * @param String $table  : the table name
     * @param array $values = array (':table'=>tableName,
     *                  ':value1'=>Value1,
     *                  ':value2'=>Value2,
     *                   )
     * 
     * ex:  $sql = INSERT INTO genres VALUES ( :id, :Name, :Description );
     *      $table = 'genres';
            $values = array(
                           ":id"=>'8',
                           ":Name"=>'Test',
                           ":Description"=>'Test',
                           );
     */
    public function insertRecords($table,$values)
    {   //print_r($values);
    
        $keys = array_keys($values);
        //print_r($keys);
        $size = sizeof($keys);
        //echo "size::".$size;
        try
        {
            $sql = "INSERT INTO {$table} VALUES (  ";
         for($i=0;$i<$size;$i++)
            {
                if($i==($size-1))
                {
                   $sql .=$keys[$i]; 
                }
                else
                    $sql .= $keys[$i].', '; 
            }
            $sql .=" );";

            
            $con = $this->getActiveConnection();
            $prep = $con->prepare($sql);
            $suc=$prep->execute($values);
             //echo  "sucess crieteria: {$suc} Error: {$prep->errorCode()}<br/>";
             //echo '<br/>'.$sql;
             $con= null;
             return $suc;
             
             

        }
        catch (PDOException $e)
        {
            
            print "Error!: " . $e->getMessage() . "<br/>";
            die();

        }
        
        
    }
    
    public function lastinserted()
    {
        $con = $this->getActiveConnection();
        return $con->lastInsertId();
    }
    
    /*
     * Query data from a table
     * @param String $query : the query to select
     */
    public  function select($query)
    {
        $con = $this->getActiveConnection();
        $q= $con->query($query);
        $q->setFetchMode(PDO::FETCH_NUM); // Set like MySQL fetch ROW
       $rows = array();
        while($r = $q->fetch())
            {
                array_push($rows, $r);
            }
         $con= null;   
            return  $rows;
            
            
   }


    /*
     * set UPDATE to any table with one condition.
     * Pass the condtion at last, do not duplicate the coloum condtion 
     * @PDO SQL = UPDATE {$table} SET
                    `Id` = {Id: },
                    `Name` = {Name: },
                    `Description` = {Description: }
                        WHERE <{where_condition}>;
     * 
     * @parm String $table : table name
     * @param  Array $values = array (
     *                  'value1'=>Value1,
     *                  'value2'=>Value2,
     *                  'C_{coloum}'=>condtion,)
     * 
     * ex: sql = UPDATE genress SET id=?, Name=?, Description=?, WHERE condtion = ?;
     *      $table = 'genress';
             $values = array(
                           "Name"=>'Test',
                           "Description"=>'Test',
                            "id"=>'condtion');
     */
    public function updateRecords($table,$values)
    {
        try{
               $keys = array_keys($values);
               $size = sizeof($keys);
               $sql = "UPDATE {$table} SET "; //UPDATE PDO Statement 
               for($i=0;$i<$size-1;$i++)
                    {
                        if($i==($size-2))
                        {
                           $sql .=$keys[$i]."=? "; 
                        }
                        else
                            $sql .= $keys[$i].'=?, '; 
                    }
                    $sql .="WHERE {$keys[$size-1]} = ?;"; //the last @param = condtion
                     //echo $sql;

              $param = array();

              foreach($values as $keys=>$val) // creating dynamic variables and inserting it to an array for PDO exectue
              {
                  $$keys = $val;
                  array_push($param,$$keys);

              }
              $con = $this->getActiveConnection();
              $prep= $con->prepare($sql);
              $suc=$prep->execute($param);
              $con= null;
              //echo  "sucess crieteria: {$suc} Error: {$prep->errorCode()}<br/>";
              return $suc;
            
        }
        
        catch (PDOException $e)
        {
           
            print "Error!: " . $e->getMessage() . "<br/>";
            die();

        }
    }
    
    public  function deleteRecord($Query)
    {
        $con = $this->getActiveConnection();
        $suc=$con->exec($Query);
        return $suc;
        
    }
    
    

   
}


?>

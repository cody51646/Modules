<?php
namespace App\Layer\MySQLAccessLayer;
use App\Layer\AccessLayerInterface;

class MySQLAccessLayer implements AccessLayerInterface{
    /**
     * $config is an array for DB connection info.
     * $statement is string for query statement.
     * $con_obj is an connection object for MySQL.
     */ 
        //$config = ["servername" => $servername, "username" =$username, 
        //           "password" => $password, "dbname" => $dbname];
        protected $config;
        protected $statement;
    
        protected $con_obj;
        protected $result;

        public function __construct($myconfig)
        {   
            
            $this->config = $myconfig;          
        }
        /**
         * public function sannitizedQuery($statement){
         *     //more add-in
         *     $statement = mysql_real_escape_string($statement);
         * }
         */ 
        public function setStatement($mystatement){
            $this->statement = $mystatement;
        }
    
        public function connect($config){
            
            $this->con_obj = $config !== NULL ?  
                              new mysqli($this->config["servername"], $this->config["username"], $this->config["password"], $this->config["dbname"]) :
                              new mysqli($config["servername"], $config["username"], $config["password"], $config["dbname"]);
            if ($this->con_obj->connect_error){
                                                 die("Connection failed: " . $this->con_obj->connect_error);
                                               }
            return $this;
        }

        public function query($statement){
            $this->result = $this->con_obj->query($statement !== NULL ? $this->statement : $statement);
            return $this;
        }

        public function fetchResults(){
            //or more add-in
            $this->result->fetch_assoc();
            return $this->result !== NULL ? $this->result
                                          : NULL;
        }
        
        public function disconnect(){
            $this->con_obj->close();
        }
        

}
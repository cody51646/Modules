<?php
namespace App\Laye\AccessLayerInterface;

Interface AccessLayerInterface{
    /**
     * $config is an array for DB connection info.
     * $statement is string for query statement.
     * $con_obj is an connection object for DB.
     */ 
    
     //public function sannitizedQuery($statement);

    public function query($statement);

    public function fetchResults($con_obj);
    
    public function connect($config);

    public function disconnect($con_obj);

    //public function transaction();
} 

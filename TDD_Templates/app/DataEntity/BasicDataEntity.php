<?php
namespace App\DataEntity;
use App\DataEntity\BasicDataEntityInterface;

class BasicDataEntity implements BasicDataEntityInterface{
    protected $int; 
    protected $varchar; 
    protected $timestamp;
    protected $boolean = false; //by default not deleted
    
    
    public function __construct($params = []){
        $this->int = $params[0];
        $this->varchar = $params[1];
        $this->timestamp = $params[2];
        $this->boolean = $params[3];
        
        }

    public function getID(){
        return $this->int;
    }
    public function getName(){
        return $this->varchar;
    }
    public function getTimestamp(){
        return $this->timestamp;
    }
    public function getDeleted(){
        return $this->boolean;
    }

    

    public function setID($int){
        $this->int = $int;
    }
    public function setName($varchar){
        $this->varchar = $varchar;
    }
    public function setTimestamp($timestamp){
        $this->timestamp = $timestamp;
    }
    public function setDeleted($boolean){
        $this->boolean = $boolean;
    }
    
 
}
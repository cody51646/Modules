<?php 
namespace App\DataEntity;

Interface BasicDataEntityInterface{
    
    //more data types can be added by extending more IDerfaces accordingly 
    public function getID();
    public function getName();
    public function getTimestamp();
    public function getDeleted();
    
    public function setID($id);
    public function setName($Name);
    public function setTimestamp($timestamp);
    public function setDeleted($boolean);

    

}
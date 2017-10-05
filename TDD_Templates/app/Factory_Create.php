<?php
use App\Layer\MySQLAccessLayer\MySQLAccessLayer;
use App\Factory_CRUD as Factory;
use App\DataEntity\BasicDataEntity;

//so that my table name becomes Customer  
class Customer extends BasicDataEntity{}
//do more stuff with $customer
$customer = new Customer();
function sanitize($un_sanitized){
    //more add on
    $clean = mysql_real_escape_string($un_sanitized);
    return $clean; 
}

$customer->setID(sanitize($_POST['id']));
$customer->setName(sanitize($_POST['name']));
$customer->setTimestamp(sanitize($_POST['time']));
 
$config = ["servername"=> "localhost", "username"=> "root", "password"=> "", "dbname"=> "customerdb"];
// factory procedures
Factory::$layer  = new MySQLAccessLayer($config);
Factory::create($customer);




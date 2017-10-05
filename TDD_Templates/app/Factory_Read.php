<?php

use App\Layer\MySQLAccessLayer\MySQLAccessLayer;
use App\Factory_CRUD as Factory;
use App\DataEntity\BasicDataEntity;

//so that my table name becomes Customer  
class Customer extends BasicDataEntity{}
$customer = new Customer();
$match_array = [];
if (preg_match('/id/', $_POST['search'][0])){
    $customer->setID($_POST['search'][1]);
    $match_array['id'] = $_POST['search'][1];
} 
elseif(preg_match('/name/', $_POST['search'][0])){
    $customer->setName($_POST['search'][1]);
    $match_array['name'] = $_POST['search'][1];
} 
else{
    $customer->setTimestamp($_POST['search'][1]);
    $match_array['time'] = $_POST['search'][1];
} 
        
//do more stuff with $customer 
$config = ["servername"=> "localhost", "username"=> "root", "password"=> "", "dbname"=> "customerdb"];
// factory procedures
Factory::$layer  = new MySQLAccessLayer($config);
$fetched_data = Factory::read($customer);

//ajax data from front end 
//$front_end_data = $_POST['id'];
// clean the data and get back to front end 
function clean_up($data){
   //or more   
    return json_encode(array_intersect($match_array, $data)); // return in json
}

echo clean_up($fetched_data);
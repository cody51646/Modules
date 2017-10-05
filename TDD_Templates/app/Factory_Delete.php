<?php

use App\Layer\MySQLAccessLayer\MySQLAccessLayer;
use App\Factory_CRUD as Factory;
use App\DataEntity\BasicDataEntity;

class Customer extends BasicDataEntity{}
$customer = new Customer();
//do more stuff with $customer 
$config = ["servername"=> "localhost", "username"=> "root", "password"=> "", "dbname"=> "customerdb"];
// factory procedures
Factory::$layer  = new MySQLAccessLayer($config);
Factory::delete($customer);

// or more 
echo "success";

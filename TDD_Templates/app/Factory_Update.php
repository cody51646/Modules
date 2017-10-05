<?php
use App\Layer\MySQLAccessLayer\MySQLAccessLayer;
use App\Factory_CRUD as Factory;
use App\DataEntity\BasicDataEntity;

//so that my table name becomes Customer  
class Customer extends BasicDataEntity{}

$customer_update_from = new Customer();
$customer_to_update   = new Customer();
//do more stuff with $customer 
// $_POST from updateAjax
$_from = $_POST['back'][0];
$_to   = $_POST['back'][1];

$customer_update_from->setID($_from['id']);
$customer_update_from->setName($_from['name']);
$customer_update_from->setTimestamp($_from['time']);
$customer_to_update->setDeleted(true);

$customer_to_update->setID($_to['id']);
$customer_to_update->setName($_to['name']);
$customer_to_update->setTimestamp($_to['time']);

$config = ["servername"=> "localhost", "username"=> "root", "password"=> "", "dbname"=> "customerdb"];
// factory procedures
Factory::$layer  = new MySQLAccessLayer($config);
Factory::update($customer_update_from, $customer_to_update);
<?php

use App\DataEntity\BasicDataEntity;

class BasicDataEntityTest extends PHPUnit_Framework_TestCase{
    public function testGetInt(){
        $expected = 1;
        $actual = new BasicDataEntity(["1", "Tao", "10.03.2017", TRUE]);
        $this->assertEquals($expected, $actual->getInt());
        
    }
}
<?php 
namespace App;
use App\DataEntity\BasicDataEntity;

class Factory_CRUD{
   // Factory::$layer = new SomeDBAccessLayer(); 
   // setup layer first otherwise it will be default mysql settings;
    public static $layer; 

    private function generateDafultLayer(){
        return new MySQLAccessLayer(["servername"=> "localhost", "username"=> "root", "password"=> "", "dbname"=> "userdb"]);
    }
    
     
    //insert entire row into table, return void
    public static function create($dataEntity){
            if(self::$layer === null) self::$layer = self::generateDafultLayer();
            
            $insert_1 = is_int($dataEntity->getID()) ? 
                               $dataEntity->getID() :
                               intval($dataEntity->getID());
            $insert_2 = $dataEntity->getName();
            $insert_3 = $dataEntity->getTimestamp();
            $insert_4 = $dataEntity->getDeleted();
            //Convert class name to table name, by default table names are lowercase
            $tableName = lcfirst(get_class($dataEntity)); 
            $sql = "INSERT INTO ".$tableName." (*) VALUES ('".$insert_1."',
                                                           '".$insert_2."', 
                                                           '".$insert_3."', 
                                                           '".$insert_4."')";
            self::$layer->connect()->query($sql);
            self::$layer->disconnect();

    } 
    //read or fetch row from table, return associative array $where_Config = ['id', ' = ', null]
    public static function read($dataEntity){
            if(self::$layer === null) self::$layer = self::generateDafultLayer();
            
            $tableName = strtolower(get_class($dataEntity));
            //condition is empty in case needed
            $where = "";
            $sql = "SELECT * FROM ".$tableName.$where;        
            $result = self::$layer->connect()->query($sql)->fetchResults();
            self::$layer->disconnect();

            return $result;  
    }
    
    //updata row into table, return void
    public static function update($dataEntity_from, $dataEntity_to){
            if(self::$layer === null) self::$layer = self::generateDafultLayer();
            
            $tableName     = strtolower(get_class($dataEntity_from));

            $col_1_name = self::methodName_to_columnName('getID');
            $col_1_val  = $dataEntity_to->getID();
            $col_2_name = self::methodName_to_columnName('geName');
            $col_2_val  = $dataEntity_to->getName();
            $col_3_name = self::methodName_to_columnName('getTimestamp');
            $col_3_val  = $dataEntity_to->getTimestamp();
            $col_4_name = self::methodName_to_columnName('getDeleted');
            $col_4_val  = $dataEntity_to->getDeleted();
            
            $set = $col_1_name."=`".$col_1_val."` ".$col_2_name."=`".$col_2_val."` ".$col_3_name."=`".$col_3_val."` ".$col_4_name."=`".$col_4_val."`" ;
            $where = self::methodName_to_columnName('getName')."=".$dataEntity_from->getName();
            $sql = "UPDATE ".$tableName." SET ".$set.
                                        " WHERE ".$where;
                                                            
            self::$layer->connect()->query($sql);
            self::$layer->disconnect();
        
    } 
    //delete row into table, return true or false
    public static function delete($dataEntity){
        if(self::$layer === null) self::$layer = self::generateDafultLayer();
        
        $tableName = strtolower(get_class($dataEntity));
        $where = "id"."=".$dataEntity->getID(); 
        $sql = "DELETE FROM ".$tableName." WHERE ".$where;

        self::$layer->connect()->query($sql);
        self::$layer->disconnect();
        
    } 

    public static function customized(){
        // customized query 
    }

    //extract columnName out of the function's name, ex: from 'getInt' to 'Int'
    public static function methodName_to_columnName($functionName){
        // column name is all lowercase
        return strtolower(preg_split('/_/', preg_replace('/([a-z])([A-Z])/', '$1_$2', $functionName))[1]);
    }
      
}


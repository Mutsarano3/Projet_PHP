<?php
/*Représente la classe de configuration de la BDD*/
class DataBase
{
    private static $dbHost = "localhost";
    private static $dbName = "projet_php";
    private static $dbUser = "root";
    private static $dbpassword = "";
    private static $dbport = "3308";
    private static $database = null;
    public static function connect()
    {
        try
        {
            if(self::$database == null)self::$database = new PDO("mysql:host=". self::$dbHost .";dbname=". self::$dbName . ";port=".self::$dbport,self::$dbUser,self::$dbpassword);
           
        }
        catch(Exeception $e)
        {
            die('ERROR:'.$e->getMessage());
        }
        return self::$database;
    }
    
    public static function disconnect()
    {
        self::$database = null;
        
    }
    
}

?>
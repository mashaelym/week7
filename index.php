<?php

class dbConn
{ 
protected static $db;
private function __construct()
{
   
try {
   self::$db = new PDO( 'mysql:host=sql1.njit.edu;dbname=ma735', 'ma735', 'olZd6y4DE' );
   self::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
   echo "Connected successfully";
    }
catch (PDOException $e)
   {
   echo "Connection Error:  " . $e->getMessage();
   }
    
}
     
public static function getConnection()
{
      
  if (!self::$db) 
  {
    new dbConn();
  }
  return self::$db;
}
}

$db = dbConn::getConnection();
print_r($db);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$statement = $db->prepare('SELECT * FROM accounts WHERE id < 6 ');
$statement->execute();
while($result = $statement->fetch(PDO::FETCH_OBJ)) {
    $results[] = $result;
}
print_r($results) . "<br>" ;
?>
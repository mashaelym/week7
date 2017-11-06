<?php

class dbConn
{ 
protected static $db;
private function __construct()
{
   
try {
   self::$db = new PDO( 'mysql:host=sql1.njit.edu;dbname=ma735', 'ma735', 'olZd6y4DE' );
   self::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
   print "Connected successfully" . "<br/>";
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

$c = dbConn::getConnection(); 

//prepare select statement
$statement = $c->prepare('SELECT * FROM accounts WHERE id < 6');
$statement->execute();

//intialize results array
$results = [];

//store query results
while($result = $statement->fetch(PDO::FETCH_OBJ)) {
    $results[] = $result;
}

//show html table
print '<h2>The number of records returned is: ' . $statement->rowCount() . '</h2><br/>';

$s = '<table>';
$s .= '<thead>';
$s .= '<tr>';
$s .= '<td>ID</td>';
$s .= '<td>Email</td>';
$s .= '<td>First Name</td>';
$s .= '<td>Last Name</td>';
$s .= '<td>Phone</td>';
$s .= '<td>Birthday</td>';
$s .= '<td>Gender</td>';
$s .= '<td>Password</td>';
$s .= '</tr>';
$s .= '</thead>';
$s .= '<tbody>';

foreach($results as $result)
{
  $id = $result->{'id'};
  $email = $result->{'email'};
  $fname = $result->{'fname'};
  $lname = $result->{'lname'};
  $phone = $result->{'phone'};
  $birthday = $result->{'birthday'};
  $gender =  $result->{'gender'};
  $password =  $result->{'password'};
  
  $s .= '<tr>';
  $s .= "<td>$id</td>";
  $s .= "<td>$email</td>";
  $s .= "<td>$fname</td>";
  $s .= "<td>$lname</td>";
  $s .= "<td>$phone</td>";
  $s .= "<td>$birthday</td>";
  $s .= "<td>$gender</td>";
  $s .= "<td>$password</td>";
  $s .= '</tr>';
}

$s .= '</tbody>';
$s .= '</table>';

print $s;
?>
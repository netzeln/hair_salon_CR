<?php


/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Client.php";


$server = 'mysql:host=localhost;dbname=hair_salon_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);



class  ClientTest  extends PHPUnit_Framework_TestCase{


}
 ?>

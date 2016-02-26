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

    function testGetId()
    {
        //arrange
        $name = "Jane Hamilton";
        $stylist_id = 2;
        $id = 1;
        $new_client = new Client ($name, $stylist_id, $id);

        //act
        $result = $new_client->getId();

        //assert
        $this->assertEquals(1, $result);
    }

    function testGetName()
    {
        //arrange
        $name = "Jane Hamilton";
        $stylist_id = 2;
        $id = 1;
        $new_client = new Client ($name, $stylist_id, $id);

        //act
        $result = $new_client->getClientName();

        //assert
        $this->assertEquals("Jane Hamilton", $result);
    }

    function testSave()
    {
        //arrange
        $name = "Jane Hamilton";
        $stylist_id = 2;
        $id = 1;
        $new_client = new Client ($name, $stylist_id, $id);

        //act
        $new_client->save();

        //assert
        $
    }

}
 ?>

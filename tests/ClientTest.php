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

    protected function tearDown()
    {
        Client::deleteAll();
    }
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
        $name = "Eliza Hamilton";
        $stylist_id = 2;
        $id = null;
        $new_client = new Client($name, $stylist_id, $id);

        //act
        $new_client->save();

        //assert
        $result = Client::getAll();
        $this->assertequals($new_client, $result[0]);
    }

    function testGetAll()
    {
        //arrange
        $name = "Theodosia Burr";
        $stylist_id = 2;
        $id = null;
        $new_client = new Client ($name, $stylist_id, $id);
        $new_client->save();

        $name2 = "Jane Hamilton";
        $stylist_id2 = 2;
        $new_client2 = new Client ($name, $stylist_id, $id);
        $new_client2->save();

        //act
        $result = Client::getAll();

        //assert
        $this->assertEquals([$new_client, $new_client2], $result);
    }

    function testDeleteAll()
    {
        //arrange
        $name = "Theodosia Burr";
        $stylist_id = 2;
        $id = null;
        $new_client = new Client ($name, $stylist_id, $id);
        $new_client->save();

        $name2 = "Jane Hamilton";
        $stylist_id2 = 2;
        $new_client2 = new Client ($name, $stylist_id, $id);
        $new_client2->save();

        //act
        Client::deleteAll();

        //assert
        $result = Client::getAll();
        $this->assertEquals([], $result);
    }

    function testFind()
    {
        //arrange
        $name = "Theodosia Burr";
        $stylist_id = 2;
        $id = null;
        $new_client = new Client ($name, $stylist_id, $id);
        $new_client->save();

        $name2 = "Jane Hamilton";
        $stylist_id2 = 2;
        $new_client2 = new Client ($name, $stylist_id, $id);
        $new_client2->save();

        //act
        $result = Client::find($new_client2->getId());

        //assert
        $this->assertEquals($new_client2, $result);
    }

    function testDelete()
    {
        //arrange
        $name = "Theodosia Burr";
        $stylist_id = 2;
        $id = null;
        $new_client = new Client ($name, $stylist_id, $id);
        $new_client->save();

        $name2 = "Jane Hamilton";
        $stylist_id2 = 2;
        $new_client2 = new Client ($name, $stylist_id, $id);
        $new_client2->save();

        //act
        $new_client2->delete();

        //assert
        $result = Client::getAll();
        $this->assertEquals([$new_client], $result);
    }

}
 ?>

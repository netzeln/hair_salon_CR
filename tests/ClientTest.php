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
        $name = "Eliza Hamilton";
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
        $name = "Eliza Hamilton";
        $stylist_id = 2;
        $id = 1;
        $new_client = new Client ($name, $stylist_id, $id);

        //act
        $result = $new_client->getClientName();

        //assert
        $this->assertEquals("Eliza Hamilton", $result);
    }

    function testSave()
    {
        //arrange

        $name = "Thomas Jefferson";
        $id = null;
        $new_stylist = new Stylist ($name, $id);
        $new_stylist->save();

        $name = "Eliza Hamilton";
        $stylist_id = $new_stylist->getId();
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
        $name = "Thomas Jefferson";
        $id = null;
        $new_stylist = new Stylist ($name, $id);
        $new_stylist->save();

        $name = "Theodosia Burr";
        $stylist_id = $new_stylist->getId();
        $id = null;
        $new_client = new Client ($name, $stylist_id, $id);
        $new_client->save();

        $name2 = "Eliza Hamilton";
        $stylist_id2 = $new_stylist->getId();
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
        $name = "Thomas Jefferson";
        $id = null;
        $new_stylist = new Stylist ($name, $id);
        $new_stylist->save();

        $name = "Theodosia Burr";
        $stylist_id = $new_stylist->getId();
        $id = null;
        $new_client = new Client ($name, $stylist_id, $id);
        $new_client->save();

        $name2 = "Eliza Hamilton";
        $stylist_id2 = $new_stylist->getId();
        $new_client2 = new Client ($name, $stylist_id2, $id);
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
        $name = "Thomas Jefferson";
        $id = null;
        $new_stylist = new Stylist ($name, $id);
        $new_stylist->save();

        $name = "Theodosia Burr";
        $stylist_id = $new_stylist->getId();
        $id = null;
        $new_client = new Client ($name, $stylist_id, $id);
        $new_client->save();

        $name2 = "Eliza Hamilton";
        $stylist_id2 = $new_stylist->getId();
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

        $name = "Thomas Jefferson";
        $id = null;
        $new_stylist = new Stylist ($name, $id);
        $new_stylist->save();

        $name = "Theodosia Burr";
        $stylist_id = $new_stylist->getId();
        $id = null;
        $new_client = new Client ($name, $stylist_id, $id);
        $new_client->save();

        $name2 = "Eliza Hamilton";
        $stylist_id2 = $new_stylist->getId();
        $new_client2 = new Client ($name, $stylist_id, $id);
        $new_client2->save();

        //act
        $new_client2->delete();

        //assert
        $result = Client::getAll();
        $this->assertEquals([$new_client], $result);
    }

    function testUpdateClient()
    {
        //arrange

        $name2 = "Eliza Hamilton";
        $stylist_id2 = 2;
        $id=null;
        $new_client2 = new Client ($name2, $stylist_id2, $id);
        $new_client2->save();

        $new_name = "Eliza Schuyler";

        //act
        $new_client2->updateClient($new_name);

        //assert

        $this->assertEquals("Eliza Schuyler", $new_client2->getClientName());
    }

}
 ?>

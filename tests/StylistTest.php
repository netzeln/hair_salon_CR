<?php


/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Stylist.php";
require_once "src/Client.php";


$server = 'mysql:host=localhost;dbname=hair_salon_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);



class  StylistTest  extends PHPUnit_Framework_TestCase{

    protected function tearDown()
    {
        Stylist::deleteAll();
        Client::deleteAll();
    }
    function testGetId()
    {
        //arrange
        $name = "George Washington";
        $id = 1;
        $new_stylist = new Stylist ($name, $id);

        //act
        $result = $new_stylist->getId();

        //assert
        $this->assertEquals(1, $result);
    }

    function testGetName()
    {
        //arrange
        $name = "George Washington";
        $id = 1;
        $new_stylist = new Stylist ($name, $id);

        //act
        $result = $new_stylist->getStylistName();

        //assert
        $this->assertEquals("George Washington", $result);
    }

    function testSave()
    {
        //arrange
        $name = "George Washington";
        $id = null;
        $new_stylist = new Stylist($name, $id);

        //act
        $new_stylist->save();

        //assert
        $result = Stylist::getAll();
        $this->assertequals($new_stylist, $result[0]);
    }

    function testGetAll()
    {
        //arrange
        $name = "Thomas Jefferson";
        $id = null;
        $new_stylist = new Stylist ($name, $id);
        $new_stylist->save();

        $name2 = "George Washington";
        $new_stylist2 = new Stylist ($name, $id);
        $new_stylist2->save();

        //act
        $result = Stylist::getAll();

        //assert
        $this->assertEquals([$new_stylist, $new_stylist2], $result);
    }

    function testDeleteAll()
    {
        //arrange
        $name = "Thomas Jefferson";
        $id = null;
        $new_stylist = new Stylist ($name, $id);
        $new_stylist->save();

        $name2 = "George Washington";
        $new_stylist2 = new Stylist ($name, $id);
        $new_stylist2->save();

        //act
        Stylist::deleteAll();

        //assert
        $result = Stylist::getAll();
        $this->assertEquals([], $result);
    }

    function testFind()
    {
        //arrange
        $name = "Thomas Jefferson";
        $id = null;
        $new_stylist = new Stylist ($name, $id);
        $new_stylist->save();

        $name2 = "George Washington";
        $new_stylist2 = new Stylist ($name, $id);
        $new_stylist2->save();

        //act
        $result = Stylist::find($new_stylist2->getId());

        //assert
        $this->assertEquals($new_stylist2, $result);
    }

    function testDelete()
    {
        //arrange
        $name = "Thomas Jefferson";
        $id = null;
        $new_stylist = new Stylist ($name, $id);
        $new_stylist->save();

        $name2 = "George Washington";
        $new_stylist2 = new Stylist ($name, $id);
        $new_stylist2->save();

        //act
        $new_stylist2->delete();

        //assert
        $result = Stylist::getAll();
        $this->assertEquals([$new_stylist], $result);
    }

    function testUpdateStylist()
    {
        //arrange

        $name2 = "George Washington";
        $id=null;
        $new_stylist2 = new Stylist ($name2, $id);
        $new_stylist2->save();

        $new_name = "King George";

        //act
        $new_stylist2->updateStylist($new_name);

        //assert

        $this->assertEquals("King George", $new_stylist2->getStylistName());
    }

}
 ?>

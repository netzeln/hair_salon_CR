<?php
  class Stylist
  {
        private $stylist_name;
        private $id;

    function __construct($stylist_name, $id= NULL)
    {
        $this->stylist_name = $stylist_name;
        $this->id = $id;
    }

    //setters
    function setStylistName($new_stylist_name)
    {
        $this->stylist_name = $new_stylist_name;
    }


    //getters
    function getStylistName()
    {
        return $this->stylist_name;
    }

    function getId()
    {
        return $this->id;
    }



    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO stylists (stylist_name) VALUES ('{$this->getStylistName()}');");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    //statics
    static function getAll()
    {
        $found_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
        $stylists = array();
        foreach($found_stylists as $stylist)
        {
            $name = $stylist['stylist_name'];
            $id = $stylist['id'];
            $new_stylist = new Stylist($name, $id);
            array_push($stylists, $new_stylist);
        }
        return $stylists;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM stylists;");
    }

    static function find($search_id)
    {
        $found_stylist = null;
        $stylists = Stylist::getAll();
        foreach($stylists as $stylist)
        {
            if($stylist->getId() == $search_id)
            {
                $found_stylist = $stylist;
            }
        }
        return $found_stylist;
    }

    //find clients by stylist
    function getClients()
    {
        $found_clients = array();
        $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients WHERE stylist_id = {$this->getId()};");
        foreach($returned_clients as $client)
        {
            $name = $client['name'];
            $stylist_id = $client['stylist_id'];
            $id = $client['id'];
            $found_client = new Client($name, $stylist_id, $id);
            array_push($found_clients, $found_client);
        }
        return $found_clients;
    }
    //individual record updates and deletes

    function updateStylist($new_stylist_name)
    {
        $GLOBALS['DB']->exec("UPDATE stylists SET stylist_name = '{$new_stylist_name}' WHERE id ={$this->getId()};'");
        $this->setStylistName($new_stylist_name);
    }
    function delete()
    {
        $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getId()};");
    }
} ?>

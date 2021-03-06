<?php
  class Client
  {
        private $client_name;
        private $stylist_id;
        private $id;

    function __construct($client_name, $stylist_id, $id= NULL)
    {
        $this->client_name = $client_name;
        $this->stylist_id = $stylist_id;
        $this->id = $id;
    }

    //setters
    function setClientName($new_client_name)
    {
        $this->client_name = $new_client_name;
    }
    function setStylistId($new_stylist_id)
    {
        $this->stylist_id = (int) $new_stylist_id;
    }

    //getters
    function getClientName()
    {
        return $this->client_name;
    }

    function getStylistId()
    {
        return $this->stylist_id;
    }

    function getId()
    {
        return $this->id;
    }



    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO clients (name, stylist_id) VALUES ('{$this->getClientName()}', {$this->getStylistId()});");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    //statics
    static function getAll()
    {
        $found_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
        $clients = array();
        foreach($found_clients as $client)
        {
            $name = $client['name'];
            $stylist_id = $client['stylist_id'];
            $id = $client['id'];
            $new_client = new Client($name, $stylist_id, $id);
            array_push($clients, $new_client);
        }
        return $clients;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM clients;");
    }

    static function find($search_id)
    {
        $found_client = null;
        $clients = Client::getAll();
        foreach($clients as $client)
        {
            if($client->getId() == $search_id)
            {
                $found_client = $client;
            }
        }
        return $found_client;
    }

    //individual record updates and deletes

    function updateClient($new_client_name, $new_stylist_id)
    {
        $GLOBALS['DB']->exec("UPDATE clients SET name = '{$new_client_name}', stylist_id = {$new_stylist_id} WHERE id = {$this->getId()};'");
        $this->setClientName($new_client_name);
        $this->setStylistId($new_stylist_id);
    }
    function delete()
    {
        $GLOBALS['DB']->exec("DELETE FROM clients WHERE id = {$this->getId()};");
    }
} ?>

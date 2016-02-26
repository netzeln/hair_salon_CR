<?php
  class Client
  {
        private $client_name;
        private $stylist_id;
        private $id;

    function __construct($client_name, $stylist_id, $id=null)
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
        $this->stylist_id = $new_stylist_id;
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

    //statics

    function static save()
    {
        // $GLOBALS['DB']->exec("INSERT INTO clients (name, stylist_id) VALUES('{$this->getClientName}', {$this->getStylistId});");
        // $this->id = $GLOBALS['DB']->lastInsertId();
    }

    function static getAll()
    {

    }

    function static deleteAll()
    {
        
    }
} ?>

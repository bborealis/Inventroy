<?php
class Rock
{
    private $description;
    private $id;

    function __construct($description, $id = null)
    {
        $this->description = $description;
        $this->id = $id;
    }

    function setDescription($new_description)
    {
        $this->description = (string) $new_description;
    }

    function getDescription()
    {
        return $this->description;
    }

    function getId()
    {
        return $this->id;
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO rocks (description) VALUES ('{$this->getDescription()}');");
        $this->id = $GLOBALS['DB']->lastInsertID();
    }

    static function getAll()
    {
        $returned_inventory = $GLOBALS['DB']->query("SELECT * FROM rocks;");
        $rocks = array();
        foreach($returned_rocks as $rock) {
            $description = $rock['description'];
            $id = $rock['id'];
            $new_rock = new Rock($description, $id);
            array_push($rocks, $new_inventory);
        }
        return $rocks;
    }

    static function deleteAll()
    {
        $GLOBALS ['DB']->exec("DELETE FROM rocks;");
    }

    static function find($search_id)
    {
        $found_inventory = null;
        $rocks = Rock::getAll();
        foreach($rocks as $rock) {
            $rock_id = $rock->getId();
            if ($rock_id == $search_id) {
                $found_rock = $task;
            }
        }
        return $found_rock;
    }

}

?>

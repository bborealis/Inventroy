<?php

  /**
  * @backupGlobals disabled
  * @backupStaticAttributes disabled
  */

  require_once "src/Rock.php";

  $server = 'mysql:host=localhost;dbname=inventory_tests';
  $username = 'root';
  $password = 'root';
  $DB = new PDO($server, $username, $password);

  class RockTest extends PHPUnit_Framework_TestCase
  {
      protected function tearDown()
      {
          Rock::deleteAll();
      }


      function test_save()
      {

      //Arrange
      $description = "Granite";
      $test_Rock = new Rock($description);

      //Act
      $test_Rock->save();

      //Assert
      $result = Rock::getAll();
      $this->assertEquals($test_Rock, $result[0]);

        }

    function test_getAll()
    {
        //Arrange
        $description = "Granite";
        $description2 = "Crystal";
        $test_Rock = new Task($description);
        $test_Rock->save();
        $test_Rock2 = new Task($description2);
        $test_Rock2->save();

        //Act
        $result = Rock::getAll();

        //Assert
        $this->assertEquals([$test_Rock, $test_Rock2], $result);
    }

    function test_deleteAll()
    {
        //Arrange
        $description = "Granite";
        $description2 = "Crystal";
        $test_Rock = new Rock($description);
        $test_Rock->save();
        $test_Rock2 = new Rock($description2);
        $test_Rock2->save();

        //Act
        Rock::deleteAll();

        //Asser
        $result = Rock::getAll();
        $this->assertEquals([], $result);
    }

    function test_getId()
    {
        //Arrange
        $description = "Granite";
        $id = 1;
        $test_Rock = new Rock($description, $id);

        //Act
        $result = $test_Rock->getId();

        //Assert
        $this->assertEquals(1, $result);
    }

    function test_find()
    {
        //Arrange
        $description = "Granite";
        $description2 = "Crystal";
        $test_Rock = new Rock($description);
        $test_Rock->save();
        $test_Rock2 = new Rock($description2);
        $test_Rock2->save();


        //Act
        $id = $test_Rock->getId();
        $result = Rock::find($id);

        //Assert
        $this->assertEquals($test_Rock, $result);
    }

  }

?>

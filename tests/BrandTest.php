<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Store.php";
    require_once "src/Brand.php";

    $DB = new PDO('pgsql:host=localhost;dbname=shoes_test');

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }

        //setters
        function test_setBrandName()
        {
            //Arrange
            $brand_name = "Asics";
            $id = 2;
            $test_brand_name = new Brand($brand_name, $id);
            //Act
            $test_brand_name->setBrandName("Nike");
            $result = $test_brand_name->getBrandName();
            //Assert
            $this->assertEquals("Nike", $result);
        }

        function test_setId()
        {
            //Arrange
            $brand_name = "Asics";
            $id = 1;
            $test_brand = new Brand($brand_name, $id);
            //Act
            $test_brand->setId(2);
            //Assert
            $result = $test_brand->getId();
            $this->assertEquals(2, $result);
        }

        //getters
        function test_getBrandName()
        {
            //Arrange
            $brand_name = "Asics";
            $id = 1;
            $test_brand = new Brand($brand_name, $id);
            //Act
            $result = $test_brand->getBrandName();
            //Assert
            $this->assertEquals($brand_name, $result);
        }


        function test_getId()
        {
            //Arrange
            $brand_name = "Asics";
            $id = 1;
            $test_brand = new Brand($brand_name, $id);
            //Act
            $result = $test_brand->getId();
            //Assert
            $this->assertEquals(1, $result);
        }

        function test_save()
        {
            //Arrange
            $brand_name = "Asics";
            $id = 1;
            $test_brand = new Brand($brand_name, $id);
            //Act
            $test_brand->save();
            //Assert
            $result = Brand::getAll();
            $this->assertEquals($test_brand, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $brand_name = "Nike";
            $id = 1;
            $test_brand = new Brand($brand_name, $id);
            $test_brand->save();
            $brand_name2 = "Reebok";
            $id2 = 2;
            $test_brand2 = new Brand($brand_name2, $id2);
            $test_brand2->save();
            //Act
            $result = Brand::getAll();
            //Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $brand_name = "Nike";
            $id = 1;
            $test_brand = new Brand($brand_name, $id);
            $test_brand->save();
            $pname2 = "Reebok";
            $id2 = 2;
            $test_brand2 = new Brand($pname2, $id2);
            $test_brand2->save();
            //Act
            Brand::deleteAll();
            //Assert
            $result = Brand::getAll();
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $brand_name = "Asics";
            $id = 1;
            $test_brand = new Brand($brand_name, $id);
            $test_brand->save();
            $pname2 = "Nike";
            $id2 = 2;
            $test_brand2 = new Brand($brand_name, $id);
            $test_brand2->save();
            //Act
            $result = Brand::find($test_brand->getId());
            //Assert
            $this->assertEquals($test_brand, $result);
        }

    }
?>

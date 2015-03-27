<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Store.php";

    $DB = new PDO('pgsql:host=localhost;dbname=shoes_test');

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();

        }
        function test_getStoreName()
        {
            //Arrange
            $store_name = "Foot Locker";
            $id = 1;
            $test_store = new Store($store_name, $id);
            //Act
            $result = $test_store->getStoreName();
            //Assert
            $this->assertEquals($store_name, $result);
        }

        function test_getId()
        {
            //Arrange
            $store_name = "Foot Locker";
            $id = 1;
            $test_store = new Store($store_name, $id);
            //Act
            $result = $test_store->getId();
            //Assert
            $this->assertEquals($id, $result);
        }

        function test_setId()
        {
            //Arrange
            $store_name = "Foot Locker";
            $id = 1;
            $test_store = new Store($store_name, $id);
            //Act
            $test_store->setId(1);
            //Assert
            $result = $test_store->getId();
            $this->assertEquals(1, $result);
        }

        function test_save()
        {
            //Arrange
            $store_name = "Foot Locker";
            $id = 1;
            $test_store = new Store($store_name, $id);
            $test_store->save();
            //Act
            $result= Store::getAll();
            //Assert
            $this->assertEquals($test_store, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $store_name = "Foot Locker";
            $id = 1;
            $test_store = new Store($store_name, $id);
            $test_store->save();
            $store2 = "Nordstrom";
            $id2 = 2;
            $test_store2 = new Store ($store2, $id2);
            $test_store2->save();
            //Act
            $result = Store::getAll();
            //Assert
            $this->assertEquals([$test_store, $test_store2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $store_name = "Foot Locker";
            $id = 1;
            $test_store = new Store($store_name, $id);
            $test_store->save();
            $store2 = "Nordstrom";
            $id2 = 2;
            $test_store2 = new Store ($store2, $id2);
            $test_store2->save();
            //Act
            Store::deleteAll();
            $result = Store::getAll();
            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $store_name = "Foot Locker";
            $id = 1;
            $test_store = new Store($store_name, $id);
            $test_store->save();
            $store2 = "Nordstrom";
            $id2 = 2;
            $test_store2 = new Store ($store2, $id2);
            $test_store2->save();
            //Act
            $result = Store::find($test_store->getId());
            //Assert
            $this->assertEquals($test_store, $result);
        }


        function test_updateTitle()
        {
            //Arrange
            $store_name = "Foot Locker";
            $id = 1;
            $test_store = new Store($store_name, $id);
            $test_store->save();
            $new_store = "MegaFoot";
            //Act
            $test_store->updateStore($new_store);
            //Assert
            $this->assertEquals("MegaFoot", $test_store->getStoreName());
        }


        // To add after Brand.php is written:
        //
        // function test_deleteStore()
        // {
        //     //Arrange
        //     $store_name = "Foot Locker";
        //     $id = 1;
        //     $test_store = new Store($store_name, $id);
        //     $test_store->save();
        //     $brand_name = "Asics";
        //     $id2 = 2;
        //     $test_brand = new Brand($brand_name, $id2);
        //     $test_brand->save();
        //     //Act
        //     $test_store->addBrand($test_brand);
        //     $test_store->deleteStore();
        //     //Assert
        //     $this->assertEquals([], $test_brand->getStores());
        // }
        //
        //
        //
        // function test_addBrand()
        // {
        //     //Arrange
        //     $store_name = "Foot Locker";
        //     $id = 1;
        //     $test_store = new Store($store_name, $id);
        //     $test_store->save();
        //     $brand_name = "Asics";
        //     $id2 = 2;
        //     $test_brand = new Brand($name, $id2);
        //     $test_brand->save();
        //     //Act
        //     $test_store->addBrand($test_brand);
        //     //Assert
        //     $this->assertEquals($test_store->getBrands(), [$test_brand]);
        // }
        //
        // function test_getBrands()
        // {
        //     //Arrange
        //     $store_name = "Foot Locker";
        //     $id = 1;
        //     $test_store = new Store($store_name, $id);
        //     $test_store->save();
        //     $brand_name = "Asics";
        //     $id2 = 2;
        //     $test_brand = new Brand($brand_name, $id2);
        //     $test_brand->save();
        //     $brand_name2 = "Nike";
        //     $id3 = 3;
        //     $test_brand2 = new Brand($brand_name2, $id3);
        //     $test_brand2->save();
        //     //Act
        //     $test_store->addBrand($test_brand);
        //     $test_store->addBrand($test_brand2);
        //     //Assert
        //     $this->assertEquals($test_store->getBrands(), [$test_brand, $test_brand2]);
        // }
    }
?>

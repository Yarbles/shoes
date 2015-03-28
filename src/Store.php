<?php

    Class Store
    {
        private $store_name;
        private $id;

        function __construct($store_name, $id = null)
        {
            $this->store_name = $store_name;
            $this->id = $id;
        }

        //setters
        function setStoreName($new_store)
        {
            $this->store_name = (string) $new_store;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        //getters
        function getStoreName()
        {
            return $this->store_name;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO stores (store_name)
                VALUES ('{$this->getStoreName()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }


        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $stores = array();
            foreach($returned_stores as $store) {
                $store_name = $store['store_name'];
                $id = $store['id'];
                $new_store = new Store($store_name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores*;");
            $GLOBALS['DB']->exec("DELETE FROM stores_brands*;");
        }

        static function find($search_id)
        {
            $found_store = null;
            $stores = Store::getAll();
            foreach($stores as $store) {
                $store_id = $store->getId();
                if ($store_id == $search_id) {
                    $found_store = $store;
                }
            }
            return $found_store;
        }

        function updateStore($new_store)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET store_name = '{$new_store}' WHERE id = {$this->getId()};");
            $this->setStoreName($new_store);
        }

        function deleteStore()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE store_id = {$this->getId()};");
        }

        function addBrand($brand_name)
        {
            $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$this->getId()}, {$brand_name->getId()});");
        }

        function getBrands()
        {
            $statement = $GLOBALS['DB']->query("SELECT brands.* FROM stores JOIN stores_brands ON (stores.id = stores_brands.store_id)
                     JOIN brands ON (stores_brands.brand_id = brands.id)
                     WHERE stores.id = {$this->getId()};");
                $brand_ids = $statement->fetchAll(PDO::FETCH_ASSOC);
                $brands = array();
                foreach ($brand_ids as $brand) {
                    $brand_name = $brand['brand_name'];
                    $id = $brand['id'];
                    $new_brand = new Brand($brand_name, $id);
                    array_push($brands, $new_brand);
                }
                return $brands;
        }
    }

?>

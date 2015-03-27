<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Store.php";

    $app = new Silex\Application();

    $app['debug'] = true;

    $DB = new PDO('pgsql:host=localhost;dbname=shoes_test');

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.twig');
    });


    //get all stores
    // $app->get("/stores", function() use ($app) {
    //     return $app['twig']->render('stores.twig', array('stores' => Store::getAll());  //...
    // });

    //get a single store
    // $app->get("/stores/{id}", function($id) use ($app) {
    //     $store = Store::find($id);
    //     return $app['twig']->render('store.twig', array('store' => $stores);  //...
    // });


    //get edit store form
    $app->get("/store/{id}/edit", function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render('store_edit.twig', array('store' => $store));
    });

    //create a store
    // $app->post("/stores", function() use ($app) {
    //     $store_name = $_POST['store_name'];
    //     $store = new Store($store);
    //     $store->save();
    //     // $brand_name = $_POST['store_name'];
    //     // $brand = new Brand($brand_name);
    //     // $brand->save();
    //     return $app['twig']->render('stores.twig', array('stores' => Store::getAll());  //...
    // });



    //delete ALL stores
    $app->post("/delete_stores", function() use ($app) {
        Store::deleteAll();
        return $app['twig']->render('index.twig');
    });


    //delete singular store
    $app->delete("/stores/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->deleteStore();
        return $app['twig']->render('index.twig', array('stores' => Store::getAll()));
    });

    //patch routes
    $app->patch("/stores/{id}", function($id) use ($app) {
        $store_name = $_POST['store_name'];
        $store = Store::find($id);
        $store->updateStoreName($store_name);
        return $app['twig']->render('store.twig', array('store' => $store);  //...
    });


    return $app;
?>

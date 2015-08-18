<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Rock.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=inventory';
    $username = 'root';
    $password = '';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    $app->get("/rocks", function() use ($app) {
        return $app['twig']->render('rocks.html.twig', array('rocks' => Rock::getAll()));
    });

    $app->get("/categories", function() use ($app) {
        return $app['twig']->render('categories.html.twig', array('categories' => Category::getAll()));
    });

    $app->post("/rocks", function() use ($app) {
        $rock = new Rock($_POST['description']);
        $rock->save();
        return $app['twig']->render('rocks.html.twig', array('rocks' => Rock::getAll()));
    });

    $app->post("/delete_rocks", function() use ($app) {
        Rock::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    $app->post("/categories", function() use ($app) {
        $category = new Category($_POST['name']);
        $category->save();
        return $app['twig']->render('categories.html.twig', array('categories' => Category::getAll()));
    });

    $app->post("/delete_categories", function() use ($app) {
        Category::deleteAll();
        return $app['twig']->render('index.html.twig');
    });



    return $app

?>

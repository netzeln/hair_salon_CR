<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Client.php";
    require_once __DIR__."/../src/Stylist.php";



    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path'=>__DIR__."/../views"
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get('/', function() use ($app)
    {
        $stylists = Stylist::getAll();
      return $app['twig']->render('index.html.twig', array("stylists"=>$stylists));
    });
//CREATE routes
    $app->post('/add_stylist', function() use ($app)
    {
        $new_stylist = new Stylist($_POST['stylist_name']);
        $new_stylist->save();
      return $app['twig']->render('index.html.twig', array("stylists"=>Stylist::getAll()));
    });

    $app->post('/add_client/{id}', function($id) use ($app)
    {
        $stylist_id = $_POST['stylist_id'];
        $new_client = new Client($_POST['client_name'], $_POST['stylist_id']);
        $new_client->save();
        $stylist = Stylist::find($id);
      return $app['twig']->render('stylist.html.twig', array("clients"=>$stylist->getClients(), "stylist"=> $stylist));
    });


//READ routes

    $app->get('stylist/{id}', function($id) use ($app)
    {
        $stylist = Stylist::find($id);
        $clients = $stylist->getClients();
      return $app['twig']->render('stylist.html.twig', array("stylist"=>$stylist, "clients"=> $clients));
    });

    $app->get('client/{id}', function($id) use ($app)
    {
        $client = Client::find($id);
        $stylists = Stylist::getAll();
      return $app['twig']->render('client.html.twig', array("stylists"=>$stylists, "client"=> $client));
    });



    $app->get("/view_clients", function() use ($app)
    {
        return $app['twig']->render('all_clients.html.twig', array('clients'=>Client::getAll(), 'stylists'=>Stylist::getAll()));
    });

//UPDATE ROUTES

    $app->patch("/stylist/{id}", function($id) use($app)
    {
        $name = $_POST['new_name'];
        $stylist = Stylist::find($id);
        $stylist->updateStylist($name);
      return $app['twig']->render('stylist.html.twig', array("stylist"=>$stylist, "clients"=>$stylist->getClients()));
    });
    $app->patch("/client/{id}", function($id) use ($app)
    {
        $name = $_POST['client_name'];
        $stylist_id = $_POST['stylist_id'];

        $client = Client::find($id);
        $client->updateClient($name, $stylist_id);

      return $app['twig']->render("all_clients.html.twig", array ("clients"=>Client::getAll(), "stylists"=>Stylist::getAll()));
    });

//DELETE ROUTES
    $app->post('/delete_all', function() use ($app)
    {
        Stylist::deleteAll();
      return $app['twig']->render('index.html.twig', array("stylists"=>Stylist::getAll()));
    });

    $app->post('/delete_all_clients', function() use ($app)
    {
        Client::deleteAll();
      return $app['twig']->render('index.html.twig', array("stylists"=>Stylist::getAll()));
    });

    $app->delete('/stylist/{id}', function($id) use ($app)
    {
        $stylist_to_delete = Stylist::find($id);
        $stylist_to_delete->delete();
      return $app['twig']->render("/index.html.twig", array("stylists"=>Stylist::getAll()));

    });

    $app->delete('/client/{id}', function($id) use ($app)
    {
        $client_to_delete = Client::find($id);
        $client_to_delete->delete();
      return $app['twig']->render("/all_clients.html.twig", array("clients"=>Client::getAll(), "stylists"=>Stylist::getAll()));

    });
    return $app;
 ?>

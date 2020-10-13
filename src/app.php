<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('hello', new Route('/hello/{name}', array('name' => 'World')));
//$routes->add('hello/ccc', new Route('/hello/ccc'));
$routes->add('bye', new Route('/bye'));

return $routes;
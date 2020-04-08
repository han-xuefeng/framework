<?php


require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;


$request = Request::createFromGlobals();

$response = new Response();

$context = new RequestContext();
$context->fromRequest($request);

$routes = new RouteCollection();

$routes->add('hello', new Route('/hello/{name}', array('name' => 'World')));
$routes->add('hello/ccc', new Route('/hello/ccc'));
$routes->add('bye', new Route('/bye'));


$matcher = new UrlMatcher($routes, $context);


$attributes = $matcher->match($request->getPathInfo());



$map = [
    '/hello'=>__DIR__.'/../src/pages/hello.php',
    '/bye'=>__DIR__.'/../src/pages/bye.php',
];

$path = $request->getPathInfo();

if(isset($map['/'.$attributes['_route']])){
    ob_start();
    include $map['/'.$attributes['_route']];//$map[$path];
    $response->setContent(ob_get_clean());
}else{
    $response->setStatusCode(404);
    $response->setContent('not found');
}
$response->send();

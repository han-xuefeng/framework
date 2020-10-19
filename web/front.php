<?php

require_once __DIR__ . '/../vendor/autoload.php';
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

use Simplex\ContentLengthListener;
use Simplex\Framework;
use Simplex\GoogleListener;
use Simplex\StringResponseListener;
use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\EventListener\ErrorListener;
use Symfony\Component\HttpKernel\EventListener\ResponseListener;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\EventListener\StreamedResponseListener;
use Symfony\Component\HttpKernel\Exception\LengthRequiredHttpException;
use Symfony\Component\HttpKernel\HttpCache\Esi;
use Symfony\Component\HttpKernel\HttpCache\HttpCache;
use Symfony\Component\HttpKernel\HttpCache\Store;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../src/app.php';

$requestStack = new RequestStack();

$context = new RequestContext();
$matcher = new UrlMatcher($routes, $context);

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$dispatcher = new EventDispatcher();

//$dispatcher->addSubscriber(new ContentLengthListener());
//$dispatcher->addSubscriber(new GoogleListener());

$dispatcher->addSubscriber(new RouterListener($matcher, $requestStack));

//$errorHandler = function (FlattenException $exception) {
//    $msg = 'Something went wrong! ('.$exception->getMessage().')';
//    echo '$$$$$$$$';
//    return new Response($msg, $exception->getStatusCode());
//};
$listener = new ErrorListener('Calendar\\Controller\\ErrorController::exceptionAction');
$dispatcher->addSubscriber($listener);
$dispatcher->addSubscriber(new StreamedResponseListener('UTF-8'));
$dispatcher->addSubscriber(new StringResponseListener());

$framework = new Framework($dispatcher, $controllerResolver, $requestStack, $argumentResolver);
//$framework = new HttpCache(
//    $framework,
//    new Store(__DIR__.'/../cache'),
//    new Esi(),
//    array('debug' => true)
//);
$response = $framework->handle($request);

$response->send();
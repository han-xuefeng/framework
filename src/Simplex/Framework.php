<?php

namespace Simplex;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\EventListener\ErrorListener;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\EventListener\StreamedResponseListener;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

class Framework extends HttpKernel
{
//    public function __construct($routes)
//    {
//        $context = new RequestContext();
//        $matcher = new UrlMatcher($routes, $context);
//
//        $controllerResolver = new ControllerResolver();
//        $argumentResolver = new ArgumentResolver();
//
//        $dispatcher = new EventDispatcher();
//        $requestStack = new RequestStack();
//
//        $dispatcher->addSubscriber(new RouterListener($matcher, $requestStack));
//
//        $listener = new ErrorListener('Calendar\\Controller\\ErrorController::exceptionAction');
//        $dispatcher->addSubscriber($listener);
//        $dispatcher->addSubscriber(new StreamedResponseListener('UTF-8'));
//        $dispatcher->addSubscriber(new StringResponseListener());
//        parent::__construct($dispatcher, $controllerResolver, $requestStack, $argumentResolver);
//    }
}
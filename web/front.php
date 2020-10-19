<?php

require_once __DIR__ . '/../vendor/autoload.php';
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

use Simplex\Framework;
use Symfony\Component\HttpFoundation\Request;


$request = Request::createFromGlobals();

$sc = include __DIR__.'/../src/container.php';
$sc->setParameter('charset', 'UTF-8');
$sc->setParameter('routes', include __DIR__.'/../src/app.php');

$response = $sc->get('framework')->handle($request);

$response->send();
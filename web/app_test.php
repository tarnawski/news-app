<?php

use Symfony\Component\HttpFoundation\Request;

$loader = require __DIR__ . '/../vendor/autoload.php';
$loader = require __DIR__.'/../app/autoload.php';
$kernel = new AppKernel('test', true);
$request = Request::createFromGlobals();
$response = $kernel->handle($request)->send();
$kernel->terminate($request, $response);

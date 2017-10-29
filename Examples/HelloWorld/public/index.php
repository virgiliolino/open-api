<?php
require 'vendor/autoload.php';
$app = new \Slim\App;
$swaggerApiFile = 'routes.json';
$swaggerConfigParser = Dispatcher\Swagger\ParserFactory::parserFor($swaggerApiFile);
$swaggerConfig = $swaggerConfigParser->parse($swaggerApiFile);
\Dispatcher\Swagger\SwaggerDispatcher::InjectRoutesFromConfig($app, $swaggerConfig); 
$app->run();
